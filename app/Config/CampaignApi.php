<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Campaign Leads API configuration.
 *
 * Override via .env:
 *   campaignApi.baseURL = https://test.intelligible.co.in/api/v1
 */
class CampaignApi extends BaseConfig
{
    /**
     * API base URL without trailing slash.
     * OpenAPI documents the v1 base as /api/v1.
     */
    public string $baseURL = 'https://test.intelligible.co.in/api/v1';

    /**
     * Campaign lead submission path (appended to baseURL).
     */
    public string $campaignLeadsPath = '/campaign-leads';

    /**
     * Request timeout in seconds.
     */
    public int $timeout = 20;

    /**
     * Default mobile country code when not provided by the form.
     */
    public string $defaultMobileCountryCode = '91';
}
