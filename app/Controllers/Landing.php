<?php

namespace App\Controllers;

use App\Libraries\LandingContext;
use App\Services\CampaignLeadService;
use CodeIgniter\HTTP\ResponseInterface;

class Landing extends BaseController
{
    protected $helpers = ['url', 'form'];

    /**
     * Render a location-specific landing page.
     * URL: /landing/{pageType}/{location}
     */
    public function show(string $pageType, string $location): string
    {
        /** @var LandingContext $ctx */
        $ctx  = service('landingContext');
        $data = $ctx->resolve($pageType, $location);

        if ($data === null) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $viewFile = 'landing/' . $pageType;

        if (! is_file(APPPATH . 'Views/' . $viewFile . '.php')) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view($viewFile, $data);
    }

    /**
     * AJAX lead submission → Campaign Leads API.
     * POST /landing/submit-lead
     */
    public function submitLead(): ResponseInterface
    {
        $request = $this->request;
        $json    = $request->getJSON(true);
        $input   = is_array($json) ? $json : $request->getPost();

        if (! is_array($input)) {
            $input = [];
        }

        $pageType = (string) ($input['page_type'] ?? '');
        $location = strtolower((string) ($input['location_slug'] ?? ''));
        $formId   = (string) ($input['form_id'] ?? 'lead_otp');

        /** @var LandingContext $ctx */
        $ctx     = service('landingContext');
        $context = $ctx->resolve($pageType, $location);

        if ($context === null) {
            return $this->response->setStatusCode(400)->setJSON([
                'ok'      => false,
                'message' => 'Invalid landing page.',
            ]);
        }

        $name   = trim((string) ($input['name'] ?? ''));
        $mobile = preg_replace('/\D+/', '', (string) ($input['mobile'] ?? $input['mobile_no'] ?? '')) ?? '';

        if ($name === '' || $mobile === '') {
            return $this->response->setStatusCode(422)->setJSON([
                'ok'      => false,
                'message' => 'Please enter your name and mobile number.',
                'errors'  => [
                    'name'   => $name === '' ? ['Name is required.'] : [],
                    'mobile' => $mobile === '' ? ['Mobile is required.'] : [],
                ],
            ]);
        }

        $formName = $formId === 'calcForm'
            ? $context['page']['form_name_calc']
            : $context['page']['form_name_hero'];

        $descriptionParts = array_filter([
            $context['service'] . ' enquiry from ' . $context['city'],
            ! empty($input['norwood_stage']) ? 'Norwood stage: ' . $input['norwood_stage'] : null,
        ]);

        $apiContext = [
            'source_id'             => $context['source_id'],
            'source_url'            => current_url(),
            'landing_page'          => $context['landing_page'],
            'form_id'               => $formId,
            'form_name'             => $formName,
            'campaign_id'           => $context['campaign_id'],
            'campaign_name'         => $context['campaign_name'],
            'procedure_category_id' => $context['procedure_category_id'],
            'description'           => implode(' | ', $descriptionParts),
            'city'                  => $context['city'],
        ];

        $tracking = [];
        $trackingKeys = [
            'first_touch_source', 'first_touch_medium', 'first_touch_channel',
            'first_touch_campaign', 'first_touch_referrer', 'first_touch_landing_page', 'first_touch_at',
            'last_touch_source', 'last_touch_medium', 'last_touch_channel',
            'last_touch_campaign', 'last_touch_referrer', 'last_touch_landing_page', 'last_touch_at',
            'utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term',
            'gclid', 'fbclid',
        ];

        foreach ($trackingKeys as $key) {
            if (isset($input[$key]) && $input[$key] !== '' && $input[$key] !== null) {
                $tracking[$key] = $input[$key];
            }
        }

        /** @var CampaignLeadService $service */
        $service = service('campaignLeadService');
        $payload = $service->buildPayload($input, $apiContext, $tracking);
        $result  = $service->submit($payload);

        $httpStatus = $result['ok'] ? 200 : (in_array($result['status'], [422, 429], true) ? $result['status'] : 502);

        return $this->response->setStatusCode($httpStatus)->setJSON([
            'ok'      => $result['ok'],
            'message' => $result['ok']
                ? 'Thank you! Your request has been submitted. Our team will contact you shortly.'
                : $result['message'],
            'errors'  => $result['errors'],
        ]);
    }
}
