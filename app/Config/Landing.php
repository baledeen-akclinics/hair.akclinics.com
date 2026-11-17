<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Landing page types, locations, and per-page SEO / lead metadata.
 *
 * procedure_category_id values must match the Campaign API
 * GET /procedure-categories response. Leave null until confirmed —
 * do not invent IDs.
 */
class Landing extends BaseConfig
{
    /**
     * Allowed location slugs.
     *
     * @var list<string>
     */
    public array $locationSlugs = ['delhi', 'bangalore', 'ludhiana'];

    /**
     * Allowed page type slugs.
     *
     * @var list<string>
     */
    public array $pageTypeSlugs = [
        'hair-transplant',
        'hair-transplant-cost',
        'hair-treatments',
        'laser-hair-removal',
        'candidacy',
        'outstation',
    ];

    /**
     * Shared clinic locations for form selects.
     *
     * @var array<string, array{label: string, city_api: string}>
     */
    public array $clinicOptions = [
        'delhi'     => ['label' => 'Delhi', 'city_api' => 'Delhi'],
        'bangalore' => ['label' => 'Bengaluru', 'city_api' => 'Bangalore'],
        'ludhiana'  => ['label' => 'Ludhiana', 'city_api' => 'Ludhiana'],
    ];

    /**
     * Location-specific display / contact data.
     *
     * @var array<string, array<string, mixed>>
     */
    public array $locations = [
        'delhi' => [
            'slug'            => 'delhi',
            'name'            => 'Delhi',
            'display_name'    => 'Delhi',
            'possessive'      => "Delhi's",
            'phone'           => '7087046120',
            'phone_display'   => '+91-7087046120',
            'address_short'   => 'Greater Kailash (GK-1)',
            'address_phrase'  => 'Located in Greater Kailash (GK-1), our Delhi',
            'surgeries'       => '5,000+',
            'whatsapp'        => '919779028861',
            'topbar_city'     => 'Delhi',
            // Used only by the 'outstation' page type. PROPOSED list, not confirmed
            // against actual targeting data — marketing to verify before launch.
            'outstation_area_label' => 'NCR & Nearby',
            'outstation_districts'  => [
                'Gurugram', 'Noida', 'Ghaziabad', 'Faridabad', 'Meerut', 'Panipat',
                'Sonipat', 'Rohtak', 'Karnal', 'Agra', 'Aligarh', 'Moradabad', 'Hisar', 'Jaipur',
            ],
        ],
        'bangalore' => [
            'slug'            => 'bangalore',
            'name'            => 'Bangalore',
            'display_name'    => 'Bangalore',
            'possessive'      => "Bangalore's",
            'phone'           => '7087001629',
            'phone_display'   => '7087001629',
            'address_short'   => 'Indiranagar',
            'address_phrase'  => 'Located in Indiranagar, our Bengaluru',
            'surgeries'       => '10,000+',
            'whatsapp'        => '919779028861',
            'topbar_city'     => 'Bengaluru',
            // Used only by the 'outstation' page type. PROPOSED list, not confirmed
            // against actual targeting data — marketing to verify before launch.
            'outstation_area_label' => 'Bangalore',
            'outstation_districts'  => [
                'Electronic City', 'Whitefield', 'Koramangala', 'HSR Layout', 'Marathahalli',
                'Sarjapur Road', 'Jayanagar', 'JP Nagar', 'Bannerghatta Road', 'Yelahanka',
                'Hebbal', 'BTM Layout',
            ],
        ],
        'ludhiana' => [
            'slug'            => 'ludhiana',
            'name'            => 'Ludhiana',
            'display_name'    => 'Ludhiana',
            'possessive'      => "Ludhiana's",
            'phone'           => '7087045805',
            'phone_display'   => '7087045805',
            'address_short'   => 'Sharabha Nagar & South City',
            'address_phrase'  => 'Located in Sharabha Nagar & South City, our Ludhiana',
            'surgeries'       => '5,000+',
            'whatsapp'        => '919779028861',
            'topbar_city'     => 'Ludhiana',
            // Used only by the 'outstation' page type.
            'outstation_area_label' => 'Punjab',
            'outstation_districts'  => [
                'Jalandhar', 'Amritsar', 'Patiala', 'Moga', 'Bathinda', 'Hoshiarpur',
                'Phagwara', 'Kapurthala', 'Sangrur', 'Barnala', 'Gurdaspur', 'Ferozepur',
                'Malerkotla', 'Chandigarh',
            ],
        ],
    ];

    /**
     * Per page-type defaults (shared across locations).
     *
     * procedure_category_id: set from API /procedure-categories when known.
     * Override via env e.g. landing.procedureCategory.hair-transplant = 1
     *
     * @var array<string, array<string, mixed>>
     */
    public array $pageTypes = [
        'hair-transplant' => [
            'slug'                  => 'hair-transplant',
            'service'               => 'Hair transplant',
            'form_name_hero'        => 'Free Hair Assessment',
            'form_name_calc'        => 'Cost Calculator',
            'source_id_prefix'      => 'landing-hair-transplant',
            'wa_campaign_suffix'    => 'HT',
            'wa_message'            => "Hi, I'm looking for a hair transplant in {city}. Can I get more information?",
            'procedure_category_id' => 4, // Hair Transplant (GET /procedure-categories)
            'css_version'           => '2',
            'hero_preload'          => 'image/hair-transplant-results.webp',
        ],
        'hair-transplant-cost' => [
            'slug'                  => 'hair-transplant-cost',
            'service'               => 'Hair transplant',
            'form_name_hero'        => 'Free Hair Assessment',
            'form_name_calc'        => 'Cost Calculator',
            'source_id_prefix'      => 'landing-hair-transplant-cost',
            'wa_campaign_suffix'    => 'HT',
            'wa_message'            => "Hi, I'm looking for hair transplant cost in {city}. Can I get more information?",
            'procedure_category_id' => 4, // Hair Transplant
            'css_version'           => '2',
            'hero_preload'          => 'image/hair-transplant-results.webp',
        ],
        'hair-treatments' => [
            'slug'                  => 'hair-treatments',
            'service'               => 'Hair Loss treatment',
            'form_name_hero'        => 'Free Hair Assessment',
            'form_name_calc'        => 'Cost Calculator',
            'source_id_prefix'      => 'landing-hair-treatments',
            'wa_campaign_suffix'    => 'HL',
            'wa_message'            => "Hi, I'm looking for hair loss treatment in {city}. Can I get more information?",
            'procedure_category_id' => 5, // Hair Loss Treatments
            'css_version'           => '2',
            'hero_preload'          => null,
        ],
        'laser-hair-removal' => [
            'slug'                  => 'laser-hair-removal',
            'service'               => 'Laser Hair Removal',
            'form_name_hero'        => 'Free Consultation',
            'form_name_calc'        => 'Quote Calculator',
            'source_id_prefix'      => 'landing-laser-hair-removal',
            'wa_campaign_suffix'    => 'LHR',
            'wa_message'            => "Hi, I'm looking for laser hair removal in {city}. Can I get more information?",
            'procedure_category_id' => 3, // Laser Hair Removal
            'css_version'           => '3',
            'hero_preload'          => null,
        ],
        'candidacy' => [
            'slug'                  => 'candidacy',
            // Reuses hair-transplant's physical assets (images, doctor photos, css/js)
            // instead of duplicating ~14MB of binary files for a nearly-identical layout.
            'asset_path'            => 'hair-transplant',
            'service'               => 'Hair transplant',
            'form_name_hero'        => 'Hair Assessment',
            'form_name_calc'        => 'Cost Calculator',
            'source_id_prefix'      => 'landing-candidacy',
            'wa_campaign_suffix'    => 'HTC',
            'wa_message'            => "Hi, I'd like a doctor assessment to check if I'm a candidate for a hair transplant in {city}.",
            'procedure_category_id' => 4, // Hair Transplant
            'css_version'           => '2',
            'hero_preload'          => 'image/hair-transplant-results.webp',
        ],
        'outstation' => [
            'slug'                  => 'outstation',
            // Reuses hair-transplant's physical assets (images, doctor photos, css/js)
            // instead of duplicating ~14MB of binary files for a nearly-identical layout.
            'asset_path'            => 'hair-transplant',
            'service'               => 'Hair transplant',
            'form_name_hero'        => 'Virtual Assessment',
            'form_name_calc'        => 'Cost Calculator',
            'source_id_prefix'      => 'landing-outstation',
            'wa_campaign_suffix'    => 'HTO',
            'wa_message'            => "Hi, I'm travelling from outside {city} for a hair transplant. Can I start with a virtual consultation?",
            'procedure_category_id' => 4, // Hair Transplant
            'css_version'           => '2',
            'hero_preload'          => 'image/hair-transplant-results.webp',
        ],
    ];

    /**
     * Per-location overrides for phones (when they differ by page type).
     * Key: "{pageType}.{location}"
     *
     * @var array<string, array{phone?: string, phone_display?: string}>
     */
    public array $phoneOverrides = [
        // 2026-11-17: all overrides updated to the new numbers given for Ludhiana/Delhi/Bangalore,
        // applied uniformly across every existing page type (not just the new ad-group pages).
        'hair-transplant.delhi'           => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'hair-transplant.bangalore'       => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'hair-transplant.ludhiana'        => ['phone' => '7087045805', 'phone_display' => '7087045805'],
        'hair-transplant-cost.delhi'      => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'hair-transplant-cost.bangalore'  => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'hair-transplant-cost.ludhiana'   => ['phone' => '7087045805', 'phone_display' => '7087045805'],
        'hair-treatments.delhi'           => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'hair-treatments.bangalore'       => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'hair-treatments.ludhiana'        => ['phone' => '7087045805', 'phone_display' => '7087045805'],
        'laser-hair-removal.delhi'        => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'laser-hair-removal.bangalore'    => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'laser-hair-removal.ludhiana'     => ['phone' => '7087045805', 'phone_display' => '7087045805'],
        'candidacy.delhi'                 => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'candidacy.bangalore'             => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'candidacy.ludhiana'              => ['phone' => '7087045805', 'phone_display' => '7087045805'],
        'outstation.delhi'                => ['phone' => '7087046120', 'phone_display' => '+91-7087046120'],
        'outstation.bangalore'            => ['phone' => '7087001629', 'phone_display' => '7087001629'],
        'outstation.ludhiana'             => ['phone' => '7087045805', 'phone_display' => '7087045805'],
    ];

    /**
     * Per-page WhatsApp link overrides (replaces the generated wa.me URL).
     * Key: "{pageType}.{location}"
     *
     * @var array<string, string>
     */
    public array $waUrlOverrides = [
        'hair-transplant.delhi'     => 'https://wa.akclinics.com/AKC5192',
        'hair-transplant.bangalore' => 'https://wa.akclinics.com/AKC1285',
    ];

    /**
     * Legacy lead_source IDs from the previous CRM (kept as campaign_id when useful).
     * Key: "{pageType}.{location}"
     *
     * @var array<string, string>
     */
    public array $legacyLeadSources = [
        'hair-transplant.delhi'           => '158',
        'hair-transplant.bangalore'       => '170',
        'hair-transplant.ludhiana'        => '164',
        'hair-transplant-cost.delhi'      => '158',
        'hair-transplant-cost.bangalore'  => '170',
        'hair-transplant-cost.ludhiana'   => '164',
        'hair-treatments.delhi'           => '159',
        'hair-treatments.bangalore'       => '171',
        'hair-treatments.ludhiana'        => '165',
        'laser-hair-removal.delhi'        => '160',
        'laser-hair-removal.bangalore'    => '172',
        'laser-hair-removal.ludhiana'     => '166',
    ];

    /**
     * SEO metadata per page type + location.
     * Canonicals preserve the existing /landing/{type}/{city}/ URL pattern.
     *
     * @var array<string, array{title: string, description: string, canonical: string}>
     */
    public array $seo = [
        'hair-transplant.delhi' => [
            'title'       => 'Hair Transplant in Delhi | Cost, Surgeons & Bio-FUE Clinic – AK Clinics',
            'description' => "Delhi's top hair transplant clinic offering advanced Bio-FUE by expert surgeons. 5,000+ surgeries, transparent cost & 0% EMI. Book a free consultation!",
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant/delhi',
        ],
        'hair-transplant.bangalore' => [
            'title'       => 'Hair Transplant in Bangalore | Cost, Surgeons & Bio-FUE Clinic – AK Clinics',
            'description' => "Bangalore's top hair transplant clinic offering advanced Bio-FUE by expert surgeons. 10,000+ surgeries, transparent cost & 0% EMI. Book a free consultation!",
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant/bangalore',
        ],
        'hair-transplant.ludhiana' => [
            'title'       => 'Hair Transplant in Ludhiana | Cost, Surgeons & Bio-FUE Clinic – AK Clinics',
            'description' => "Ludhiana's top hair transplant clinic offering advanced Bio-FUE by expert surgeons. 5,000+ surgeries, transparent cost & 0% EMI. Book a free consultation!",
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant/ludhiana',
        ],
        'hair-transplant-cost.delhi' => [
            'title'       => 'Hair Transplant Cost in Delhi – Get Exact Price & Free Assessment | AK Clinics',
            'description' => 'Know your exact hair transplant cost in Delhi. Transparent pricing, advanced Bio-FUE, experienced surgeons & 0% EMI. Book a free assessment!',
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant-cost/delhi/',
        ],
        'hair-transplant-cost.bangalore' => [
            'title'       => 'Hair Transplant Cost in Bangalore – Get Exact Price & Free Assessment | AK Clinics',
            'description' => 'Know your exact hair transplant cost in Bangalore. Transparent pricing, advanced Bio-FUE, experienced surgeons & 0% EMI. Book a free assessment!',
            // Preserve corrected spelling (original had typo "angalore")
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant-cost/bangalore/',
        ],
        'hair-transplant-cost.ludhiana' => [
            'title'       => 'Hair Transplant Cost in Ludhiana – Get Exact Price & Free Assessment | AK Clinics',
            'description' => 'Know your exact hair transplant cost in Ludhiana. Transparent pricing, advanced Bio-FUE, experienced surgeons & 0% EMI. Book a free assessment!',
            'canonical'   => 'https://hair.akclinics.com/landing/hair-transplant-cost/ludhiana/',
        ],
        'hair-treatments.delhi' => [
            'title'       => 'Best Hair Loss Treatment in Delhi | Advanced PRP, GFC & Hair Transplant – AK Clinics',
            'description' => 'Regain your confidence with expert hair loss treatments in Delhi. ✅ 20+ years of experience | PRP | GFC | Hair Transplant. Book free consultation!',
            'canonical'   => 'https://hair.akclinics.com/landing/hair-treatments/delhi/',
        ],
        'hair-treatments.bangalore' => [
            'title'       => 'Best Hair Loss Treatment in Bangalore | Advanced PRP, GFC & Hair Transplant – AK Clinics',
            'description' => 'Regain your confidence with expert hair loss treatments in Bangalore. ✅ 20+ years of experience | PRP | GFC | Hair Transplant. Book free consultation!',
            'canonical'   => 'https://hair.akclinics.com/landing/hair-treatments/bangalore/',
        ],
        'hair-treatments.ludhiana' => [
            'title'       => 'Best Hair Loss Treatment in Ludhiana | Advanced PRP, GFC & Hair Transplant – AK Clinics',
            'description' => 'Regain your confidence with expert hair loss treatments in Ludhiana. ✅ 20+ years of experience | PRP | GFC | Hair Transplant. Book free consultation!',
            'canonical'   => 'https://hair.akclinics.com/landing/hair-treatments/ludhiana/',
        ],
        'laser-hair-removal.delhi' => [
            'title'       => 'Full Body Laser Hair Removal in Delhi | Painless & Safe | AK Clinics',
            'description' => 'Get smooth, hair-free skin with full body laser hair removal in Delhi. Pain-reduced, safe for all skin types. Book your free consultation today!',
            'canonical'   => 'https://hair.akclinics.com/landing/laser-hair-removal/delhi/',
        ],
        'laser-hair-removal.bangalore' => [
            'title'       => 'Full Body Laser Hair Removal in Bangalore | Painless & Safe | AK Clinics',
            'description' => 'Get smooth, hair-free skin with full body laser hair removal in Bangalore. Pain-reduced, safe for all skin types. Book your free consultation today!',
            'canonical'   => 'https://hair.akclinics.com/landing/laser-hair-removal/bangalore/',
        ],
        'laser-hair-removal.ludhiana' => [
            'title'       => 'Full Body Laser Hair Removal in Ludhiana | Painless & Safe | AK Clinics',
            'description' => 'Get smooth, hair-free skin with full body laser hair removal in Ludhiana. Pain-reduced, safe for all skin types. Book your free consultation today!',
            'canonical'   => 'https://hair.akclinics.com/landing/laser-hair-removal/ludhiana/',
        ],
        'candidacy.delhi' => [
            'title'       => 'Am I a Candidate for Hair Transplant? | AK Clinics Delhi',
            'description' => 'Doctor-led candidacy assessment for hair transplant in Delhi — Norwood grade, donor area, diffuse thinning and repair cases evaluated by AK Clinics.',
            'canonical'   => 'https://hair.akclinics.com/landing/candidacy/delhi/',
        ],
        'candidacy.bangalore' => [
            'title'       => 'Am I a Candidate for Hair Transplant? | AK Clinics Bangalore',
            'description' => 'Doctor-led candidacy assessment for hair transplant in Bangalore — Norwood grade, donor area, diffuse thinning and repair cases evaluated by AK Clinics.',
            'canonical'   => 'https://hair.akclinics.com/landing/candidacy/bangalore/',
        ],
        'candidacy.ludhiana' => [
            'title'       => 'Am I a Candidate for Hair Transplant? | AK Clinics Ludhiana',
            'description' => 'Doctor-led candidacy assessment for hair transplant in Ludhiana — Norwood grade, donor area, diffuse thinning and repair cases evaluated by AK Clinics.',
            'canonical'   => 'https://hair.akclinics.com/landing/candidacy/ludhiana/',
        ],
        'outstation.delhi' => [
            'title'       => 'Hair Transplant for NCR & Outstation Patients | AK Clinics Delhi',
            'description' => 'Travelling from Gurugram, Noida, Ghaziabad, Faridabad or elsewhere near NCR? Start with a virtual consultation at AK Clinics Delhi before you travel.',
            'canonical'   => 'https://hair.akclinics.com/landing/outstation/delhi/',
        ],
        'outstation.bangalore' => [
            'title'       => 'Hair Transplant Clinic Near You in Bangalore | AK Clinics',
            'description' => 'Travelling from Electronic City, Whitefield, Koramangala or elsewhere in Bangalore? Start with a virtual consultation at AK Clinics Indiranagar before you visit.',
            'canonical'   => 'https://hair.akclinics.com/landing/outstation/bangalore/',
        ],
        'outstation.ludhiana' => [
            'title'       => 'Hair Transplant for Punjab Outstation Patients | AK Clinics Ludhiana',
            'description' => 'Travelling from Jalandhar, Amritsar, Patiala, Bathinda or elsewhere in Punjab? Start with a virtual consultation at AK Clinics Ludhiana before you travel.',
            'canonical'   => 'https://hair.akclinics.com/landing/outstation/ludhiana/',
        ],
    ];

    /**
     * Optional procedure_category_id overrides from env-friendly keys.
     *
     * @var array<string, int|null>
     */
    /**
     * Overrides pageTypes procedure_category_id when set (via .env).
     * Values from GET /api/v1/procedure-categories:
     *   4 = Hair Transplant, 5 = Hair Loss Treatments, 3 = Laser Hair Removal
     *
     * @var array<string, int|null>
     */
    public array $procedureCategoryIds = [
        'hair-transplant'      => 4,
        'hair-transplant-cost' => 4,
        'hair-treatments'      => 5,
        'laser-hair-removal'   => 3,
        'candidacy'            => 4,
        'outstation'           => 4,
    ];
}
