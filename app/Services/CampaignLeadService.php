<?php

namespace App\Services;

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * Submits campaign leads to the public Campaign Leads API.
 * Assignment is handled by the API (clinic mapping + round-robin).
 *
 * Configured via .env:
 *   API_BASE_URL
 *   CRM_AUTH_KEY
 *   API_CAMPAIGN_LEADS_PATH (optional, default /campaign-leads)
 *   API_TIMEOUT (optional, default 20)
 *   API_DEFAULT_MOBILE_COUNTRY_CODE (optional, default 91)
 */
class CampaignLeadService
{
    /**
     * POST a lead payload to the Campaign Leads API.
     *
     * @param array<string, mixed> $payload
     * @return array{ok: bool, status: int, message: string, errors: array<string, mixed>, data: array<string, mixed>}
     */
    public function submit(array $payload): array
    {
        $baseUrl = rtrim((string) env('API_BASE_URL', ''), '/');
        $path    = (string) env('API_CAMPAIGN_LEADS_PATH', '/campaign-leads');
        $url     = $baseUrl . '/' . ltrim($path, '/');

        $client = service('curlrequest', [
            'timeout'     => (int) env('API_TIMEOUT', 20),
            'http_errors' => false,
        ]);

        try {
            $response = $client->post($url, [
                'headers' => [
                    'Accept'       => 'application/json',
                    'Content-Type' => 'application/json',
                    'Auth-Key'     => (string) env('CRM_AUTH_KEY', ''),
                ],
                'json' => $payload,
            ]);
        } catch (HTTPException $e) {
            log_message('error', 'CampaignLeadService HTTP exception: {msg}', ['msg' => $e->getMessage()]);

            return $this->failure(502, 'Unable to submit your request right now. Please try again later.');
        } catch (\Throwable $e) {
            log_message('error', 'CampaignLeadService unexpected error: {msg}', ['msg' => $e->getMessage()]);

            return $this->failure(500, 'Unable to submit your request right now. Please try again later.');
        }

        return $this->normalizeResponse($response);
    }

    /**
     * Build API payload from form + page context + tracking fields.
     * Only includes values that are actually available.
     *
     * @param array<string, mixed> $form
     * @param array<string, mixed> $context
     * @param array<string, mixed> $tracking
     * @return array<string, mixed>
     */
    public function buildPayload(array $form, array $context, array $tracking = []): array
    {
        $name   = trim((string) ($form['name'] ?? ''));
        $mobile = preg_replace('/\D+/', '', (string) ($form['mobile'] ?? $form['mobile_no'] ?? '')) ?? '';
        $email  = trim((string) ($form['email'] ?? ''));

        $city = $form['city'] ?? $form['cliniccity'] ?? ($context['city'] ?? null);
        if (is_string($city)) {
            $city = $this->normalizeCity($city);
        }

        $payload = [
            'name'                => $name,
            'mobile'              => $mobile,
            'mobile_country_code' => (string) ($form['mobile_country_code'] ?? env('API_DEFAULT_MOBILE_COUNTRY_CODE', '91')),
            'source_id'           => (string) ($context['source_id'] ?? 'landing-form'),
            'source_url'          => (string) ($context['source_url'] ?? current_url()),
        ];

        if ($email !== '') {
            $payload['email'] = $email;
        }

        if (! empty($city)) {
            $payload['city'] = $city;
        }

        $payload['contact_consent'] = filter_var(
            $form['contact_consent'] ?? false,
            FILTER_VALIDATE_BOOLEAN
        );

        $optionalContext = [
            'description',
            'campaign_id',
            'campaign_name',
            'ad_id',
            'ad_name',
            'form_id',
            'form_name',
            'procedure_category_id',
            'landing_page',
        ];

        foreach ($optionalContext as $key) {
            if (array_key_exists($key, $context) && $context[$key] !== null && $context[$key] !== '') {
                $payload[$key] = $context[$key];
            }
        }

        if (! empty($form['norwood_stage'])) {
            $desc  = $payload['description'] ?? '';
            $extra = 'Norwood stage: ' . $form['norwood_stage'];
            $payload['description'] = $desc !== '' ? ($desc . ' | ' . $extra) : $extra;
        }

        $trackingKeys = [
            'first_touch_source',
            'first_touch_medium',
            'first_touch_channel',
            'first_touch_campaign',
            'first_touch_referrer',
            'first_touch_landing_page',
            'first_touch_at',
            'last_touch_source',
            'last_touch_medium',
            'last_touch_channel',
            'last_touch_campaign',
            'last_touch_referrer',
            'last_touch_landing_page',
            'last_touch_at',
            'utm_source',
            'utm_medium',
            'utm_campaign',
            'utm_content',
            'utm_term',
            'gclid',
            'fbclid',
        ];

        foreach ($trackingKeys as $key) {
            $value = $tracking[$key] ?? $form[$key] ?? null;
            if ($value !== null && $value !== '') {
                $payload[$key] = $value;
            }
        }

        return $payload;
    }

    protected function normalizeCity(string $city): string
    {
        $map = [
            'delhi'     => 'Delhi',
            'bangalore' => 'Bangalore',
            'bengaluru' => 'Bangalore',
            'ludhiana'  => 'Ludhiana',
        ];

        $key = strtolower(trim($city));

        return $map[$key] ?? ucfirst(strtolower(trim($city)));
    }

    /**
     * @return array{ok: bool, status: int, message: string, errors: array<string, mixed>, data: array<string, mixed>}
     */
    protected function normalizeResponse(ResponseInterface $response): array
    {
        $status = $response->getStatusCode();
        $body   = (string) $response->getBody();
        $json   = json_decode($body, true);

        if (! is_array($json)) {
            log_message('error', 'CampaignLeadService non-JSON response [{status}]: {body}', [
                'status' => $status,
                'body'   => substr($body, 0, 500),
            ]);

            if ($status === 429) {
                return $this->failure(429, 'Too many requests. Please wait a moment and try again.');
            }

            return $this->failure($status >= 400 ? $status : 500, 'Unable to submit your request right now. Please try again later.');
        }

        if ($status === 200 && ($json['status'] ?? false) === true) {
            return [
                'ok'      => true,
                'status'  => 200,
                'message' => (string) ($json['message'] ?? 'Thank you! Your request has been submitted.'),
                'errors'  => [],
                'data'    => is_array($json['data'] ?? null) ? $json['data'] : [],
            ];
        }

        if ($status === 422) {
            $errors   = is_array($json['data']['errors'] ?? null) ? $json['data']['errors'] : [];
            $messages = is_array($json['data']['messages'] ?? null) ? $json['data']['messages'] : [];
            $message  = $messages[0] ?? ($json['message'] ?? 'Please check your details and try again.');

            return [
                'ok'      => false,
                'status'  => 422,
                'message' => (string) $message,
                'errors'  => $errors,
                'data'    => is_array($json['data'] ?? null) ? $json['data'] : [],
            ];
        }

        if ($status === 429) {
            return $this->failure(429, 'Too many requests. Please wait a moment and try again.');
        }

        log_message('error', 'CampaignLeadService API error [{status}]: {body}', [
            'status' => $status,
            'body'   => substr($body, 0, 1000),
        ]);

        return $this->failure($status, 'Unable to submit your request right now. Please try again later.');
    }

    /**
     * @return array{ok: bool, status: int, message: string, errors: array<string, mixed>, data: array<string, mixed>}
     */
    protected function failure(int $status, string $message): array
    {
        return [
            'ok'      => false,
            'status'  => $status,
            'message' => $message,
            'errors'  => [],
            'data'    => [],
        ];
    }
}
