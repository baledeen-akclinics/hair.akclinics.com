<?php

namespace App\Libraries;

use Config\Landing as LandingConfig;

/**
 * Resolves location + page-type context for landing pages.
 */
class LandingContext
{
    protected LandingConfig $config;

    public function __construct(?LandingConfig $config = null)
    {
        $this->config = $config ?? config('Landing');
    }

    public function isValidLocation(string $location): bool
    {
        return in_array(strtolower($location), $this->config->locationSlugs, true);
    }

    public function isValidPageType(string $pageType): bool
    {
        return in_array($pageType, $this->config->pageTypeSlugs, true);
    }

    /**
     * @return array<string, mixed>|null
     */
    public function resolve(string $pageType, string $location): ?array
    {
        $location = strtolower($location);
        $pageType = strtolower($pageType);

        if (! $this->isValidLocation($location) || ! $this->isValidPageType($pageType)) {
            return null;
        }

        $loc  = $this->config->locations[$location];
        $page = $this->config->pageTypes[$pageType];
        $key  = $pageType . '.' . $location;

        if (isset($this->config->phoneOverrides[$key])) {
            $loc = array_merge($loc, $this->config->phoneOverrides[$key]);
        }

        $seo = $this->config->seo[$key] ?? [
            'title'       => $page['service'] . ' in ' . $loc['name'] . ' – AK Clinics',
            'description' => $page['service'] . ' in ' . $loc['name'],
            'canonical'   => site_url('landing/' . $pageType . '/' . $location),
        ];

        $procedureCategoryId = $this->config->procedureCategoryIds[$pageType]
            ?? $page['procedure_category_id']
            ?? null;

        $sourceId = $page['source_id_prefix'] . '-' . $location;
        $legacyId = $this->config->legacyLeadSources[$key] ?? null;

        $waMessage = str_replace('{city}', $loc['name'], $page['wa_message']);
        $waCampaign = $loc['name'] . '_' . $page['wa_campaign_suffix'];
        $waUrl = $this->config->waUrlOverrides[$key]
            ?? 'https://wa.me/' . $loc['whatsapp']
            . '?text=' . rawurlencode($waMessage)
            . '&utm_source=google&utm_medium=cpc&utm_campaign=' . rawurlencode($waCampaign);

        // A page type can reuse another page type's physical assets (image/img/css/js)
        // via 'asset_path' in its pageTypes config entry, instead of duplicating files.
        // e.g. candidacy/outstation reuse hair-transplant's assets.
        $assetPageType = $page['asset_path'] ?? $pageType;
        $assetBase = base_url('landing/' . $assetPageType . '/');
        $landingPageUrl = site_url($pageType . '/' . $location);

        return [
            'location'              => $loc,
            'page'                  => $page,
            'page_type'             => $pageType,
            'location_slug'         => $location,
            'seo'                   => $seo,
            'asset_base'            => $assetBase,
            'css_url'               => $assetBase . 'assets/style.css?v=' . $page['css_version'],
            'script_url'            => $assetBase . 'assets/script.js',
            'hero_preload'          => $page['hero_preload'] ? $assetBase . $page['hero_preload'] : null,
            'source_id'             => $sourceId,
            'campaign_id'           => $legacyId,
            'campaign_name'         => $page['service'] . ' - ' . $loc['name'],
            'service'               => $page['service'],
            'procedure_category_id' => $procedureCategoryId,
            'landing_page'          => $landingPageUrl,
            'wa_url'                => $waUrl,
            'clinic_options'        => $this->config->clinicOptions,
            'city'                  => $loc['name'],
            'submit_url'            => site_url('submit-lead'),
        ];
    }
}
