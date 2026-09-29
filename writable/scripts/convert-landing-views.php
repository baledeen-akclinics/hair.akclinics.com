#!/usr/bin/env php
<?php
/**
 * One-time converter: landing/{type}/delhi/index.php → app/Views/landing/{type}.php
 * Makes city/phone/SEO/assets dynamic for reuse across locations.
 */

$srcRoot = '/var/www/html/landing';
$dstRoot = '/var/www/html/hair.akclinics.com/app/Views/landing';

$types = [
    'hair-transplant',
    'hair-transplant-cost',
    'hair-treatments',
    'laser-hair-removal',
];

foreach ($types as $type) {
    $src = "{$srcRoot}/{$type}/delhi/index.php";
    if (! is_file($src)) {
        fwrite(STDERR, "Missing: {$src}\n");
        continue;
    }

    $html = file_get_contents($src);

    // --- PHP preamble ---
    $preamble = <<<'PHP'
<?php
/**
 * Landing page template — location data injected by Landing controller.
 *
 * @var array $location
 * @var array $page
 * @var array $seo
 * @var string $asset_base
 * @var string $css_url
 * @var string $script_url
 * @var string|null $hero_preload
 * @var string $source_id
 * @var string|null $campaign_id
 * @var string $service
 * @var string $landing_page
 * @var string $thanks_url
 * @var string $wa_url
 * @var string $submit_url
 * @var string $city
 * @var string $page_type
 * @var string $location_slug
 * @var array $clinic_options
 */
$loc = $location;
$phone = $loc['phone'];
$phoneDisplay = $loc['phone_display'];
$cityName = $loc['name'];
$topbarCity = $loc['topbar_city'];
$surgeries = $loc['surgeries'];
$addressPhrase = $loc['address_phrase'];
?>
PHP;

    // Remove original $page_url PHP block
    $html = preg_replace('/<\?php\s+\$page_url\s*=.*?\?>/s', '', $html);

    // SEO
    $html = preg_replace(
        '/<title>.*?<\/title>/s',
        '<title><?= esc($seo[\'title\']) ?></title>',
        $html,
        1
    );
    $html = preg_replace(
        '/<meta name="description" content="[^"]*">/',
        '<meta name="description" content="<?= esc($seo[\'description\'], \'attr\') ?>">',
        $html,
        1
    );
    $html = preg_replace(
        '/<link rel="canonical" href="[^"]*"\s*\/>/',
        '<link rel="canonical" href="<?= esc($seo[\'canonical\'], \'attr\') ?>" />',
        $html,
        1
    );

    // Preload hero — make dynamic
    $html = preg_replace(
        '/href="https:\/\/hair\.akclinics\.com\/landing\/[^"]+"/i',
        'href="<?= esc($hero_preload ?: ($asset_base . \'image/hair-transplant-results.webp\'), \'attr\') ?>"',
        $html,
        1
    );

    // Asset paths
    $html = str_replace('../assets/style.css', '<?= esc($css_url, \'attr\') ?>', $html);
    // Fix the above if it doubled query params — css_url already has ?v=
    $html = preg_replace(
        "/href=\"<\?= esc\(\\\$css_url, 'attr'\) \?>\?v=\d+\"/",
        'href="<?= esc($css_url, \'attr\') ?>"',
        $html
    );
    $html = str_replace('href="<?= esc($css_url, \'attr\') ?>?v=1"', 'href="<?= esc($css_url, \'attr\') ?>"', $html);
    $html = str_replace('href="<?= esc($css_url, \'attr\') ?>?v=2"', 'href="<?= esc($css_url, \'attr\') ?>"', $html);
    $html = str_replace("href=\"<?= esc(\$css_url, 'attr') ?>?v=1\"", "href=\"<?= esc(\$css_url, 'attr') ?>\"", $html);
    $html = str_replace("href=\"<?= esc(\$css_url, 'attr') ?>?v=2\"", "href=\"<?= esc(\$css_url, 'attr') ?>\"", $html);

    $html = str_replace('../assets/script.js', '<?= esc($script_url, \'attr\') ?>', $html);
    $html = str_replace('../assets/script.js?v=1', '<?= esc($script_url, \'attr\') ?>', $html);

    $html = str_replace('src="../image/', 'src="<?= esc($asset_base, \'attr\') ?>image/', $html);
    $html = str_replace('src="../img/', 'src="<?= esc($asset_base, \'attr\') ?>img/', $html);
    $html = str_replace("url('../image/", "url('<?= esc($asset_base, 'attr') ?>image/", $html);
    $html = str_replace('url("../image/', 'url("<?= esc($asset_base, \'attr\') ?>image/', $html);

    // Absolute asset URLs pointing at hair.akclinics.com/landing/{type}/
    $html = preg_replace(
        '#https://hair\.akclinics\.com/landing/' . preg_quote($type, '#') . '/#',
        '<?= esc($asset_base, \'attr\') ?>',
        $html
    );
    // Cross-folder image refs (treatments sometimes point at hair-transplant images)
    $html = preg_replace(
        '#https://hair\.akclinics\.com/landing/hair-transplant/#',
        '<?= esc(base_url(\'landing/hair-transplant/\'), \'attr\') ?>',
        $html
    );

    // Topbar
    $html = preg_replace(
        '/#1 Hair Transplant Clinic in Delhi/',
        '#1 Hair Transplant Clinic in <?= esc($topbarCity) ?>',
        $html
    );
    $html = preg_replace(
        '/#1 Hair Loss Treatment Clinic in Delhi|#1 Hair Treatment Clinic in Delhi/i',
        '#1 Hair Loss Treatment Clinic in <?= esc($topbarCity) ?>',
        $html
    );
    $html = preg_replace(
        '/#1 .*? in Delhi/',
        '#1 <?= esc($page[\'service\']) ?> in <?= esc($topbarCity) ?>',
        $html,
        1
    );

    // Phone links / displays (Delhi defaults in source)
    $html = str_replace('tel:6239957752', 'tel:<?= esc($phone, \'attr\') ?>', $html);
    $html = str_replace('Call: +91-6239957752', 'Call: <?= esc($phoneDisplay) ?>', $html);
    $html = str_replace('+91-6239957752', '<?= esc($phoneDisplay) ?>', $html);

    // lead_source / service / page_url hiddens
    $html = preg_replace(
        '/<input type="hidden" name="lead_source" value="\d+">/',
        '<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, \'attr\') ?>">' . "\n"
        . '                    <input type="hidden" name="page_type" value="<?= esc($page_type, \'attr\') ?>">' . "\n"
        . '                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, \'attr\') ?>">',
        $html
    );
    $html = preg_replace(
        '/<input type="hidden" name="service" value="[^"]*">/',
        '<input type="hidden" name="service" value="<?= esc($service, \'attr\') ?>">',
        $html
    );
    $html = preg_replace(
        '/<input type="hidden" name="page_url" value="<\?= \$page_url \?>">/',
        '<input type="hidden" name="page_url" value="<?= esc($landing_page, \'attr\') ?>">',
        $html
    );
    $html = preg_replace(
        '/<input type="hidden" name="lp_url" value="[^"]*"\s*\/>/',
        '<input type="hidden" name="lp_url" value="<?= esc(base_url(), \'attr\') ?>" />',
        $html
    );
    $html = preg_replace(
        '/<input type="hidden" name="return_url" value="[^"]*"\s*>/',
        '<input type="hidden" name="return_url" value="<?= esc($thanks_url, \'attr\') ?>">',
        $html
    );

    // Clinic select — consistent options, preselect current city
    $clinicSelect = <<<'HTML'
<select id="city" name="cliniccity" class="input">
                        <option value="">Clinic Location</option>
                        <?php foreach ($clinic_options as $slug => $opt): ?>
                        <option value="<?= esc($opt['city_api'], 'attr') ?>" <?= $location_slug === $slug ? 'selected' : '' ?>><?= esc($opt['label']) ?></option>
                        <?php endforeach; ?>
                    </select>
HTML;
    $html = preg_replace(
        '/<select id="city" name="cliniccity" class="input">.*?<\/select>/s',
        $clinicSelect,
        $html,
        1
    );

    // City name replacements (order matters — possessive first)
    $replacements = [
        "Delhi's" => "<?= esc(\$loc['possessive']) ?>",
        'Delhi’s' => "<?= esc(\$loc['possessive']) ?>",
        'in Delhi' => 'in <?= esc($cityName) ?>',
        'In Delhi' => 'In <?= esc($cityName) ?>',
        'AK Clinics, Delhi' => 'AK Clinics, <?= esc($cityName) ?>',
        'AK Clinics Delhi' => 'AK Clinics <?= esc($cityName) ?>',
        'Clinics Delhi' => 'Clinics <?= esc($cityName) ?>',
        'our Delhi' => 'our <?= esc($cityName) ?>',
        'The Delhi clinic' => 'The <?= esc($cityName) ?> clinic',
        'the Delhi clinic' => 'the <?= esc($cityName) ?> clinic',
        'Delhi center' => '<?= esc($cityName) ?> center',
        'Delhi under' => '<?= esc($cityName) ?> under',
        'outside Delhi' => 'outside <?= esc($cityName) ?>',
        'Clinic in Delhi' => 'Clinic in <?= esc($cityName) ?>',
        'surgeon in Delhi' => 'surgeon in <?= esc($cityName) ?>',
        'Surgeons in Delhi' => 'Surgeons in <?= esc($cityName) ?>',
        'Treatment in Delhi' => 'Treatment in <?= esc($cityName) ?>',
        'treatments in Delhi' => 'treatments in <?= esc($cityName) ?>',
        'cost in Delhi' => 'cost in <?= esc($cityName) ?>',
        'Cost in Delhi' => 'Cost in <?= esc($cityName) ?>',
        'removal in Delhi' => 'removal in <?= esc($cityName) ?>',
        'Removal in Delhi' => 'Removal in <?= esc($cityName) ?>',
        'transplant in Delhi' => 'transplant in <?= esc($cityName) ?>',
        'Transplant in Delhi' => 'Transplant in <?= esc($cityName) ?>',
        'clinics in Delhi' => 'clinics in <?= esc($cityName) ?>',
        'hair transplants in Delhi' => 'hair transplants in <?= esc($cityName) ?>',
    ];

    foreach ($replacements as $from => $to) {
        $html = str_replace($from, $to, $html);
    }

    // Address phrase (Delhi-specific)
    $html = str_replace(
        'Located in Greater Kailash (GK-1), our <?= esc($cityName) ?>',
        '<?= esc($addressPhrase) ?>',
        $html
    );
    $html = str_replace(
        'Located in Greater Kailash (GK-1), our Delhi',
        '<?= esc($addressPhrase) ?>',
        $html
    );

    // Surgery counts
    $html = str_replace('5,000+ Successful Surgeries', '<?= esc($surgeries) ?> Successful Surgeries', $html);
    $html = str_replace('5,000+ successful surgeries', '<?= esc($surgeries) ?> successful surgeries', $html);
    $html = str_replace('5,000+ successful', '<?= esc($surgeries) ?> successful', $html);
    $html = str_replace('over 5,000 successful', 'over <?= esc($surgeries) ?> successful', $html);
    $html = str_replace('5,000+ successful surgeries, and 5 million+', '<?= esc($surgeries) ?> successful surgeries, and 5 million+', $html);

    // WhatsApp + mobile bar
    $html = preg_replace(
        '/href="https:\/\/wa\.me\/[^"]+"/',
        'href="<?= esc($wa_url, \'attr\') ?>"',
        $html
    );

    // Strip old form AJAX blocks — replace with config + shared JS
    $formsBootstrap = <<<'JS'

<script>
window.AK_LANDING = {
  submitUrl: <?= json_encode($submit_url) ?>,
  pageType: <?= json_encode($page_type) ?>,
  locationSlug: <?= json_encode($location_slug) ?>,
  thanksUrl: <?= json_encode($thanks_url) ?>,
  city: <?= json_encode($cityName) ?>
};
</script>
<script src="<?= esc(base_url('js/landing-tracking.js'), 'attr') ?>"></script>
<script src="<?= esc(base_url('js/landing-forms.js'), 'attr') ?>"></script>
JS;

    // Remove the large inline $(document).ready lead_otp / calcForm AJAX handlers
    // Keep swiper/other page scripts that are in assets/script.js
    // Strategy: find from `$("#lead_otp").validate` or `$(document).ready` with lead_otp through end of that script tag carefully.

    // Simpler: replace the script that contains leadswithoutotpdata.php
    $html = preg_replace_callback(
        '/<script>\s*\$\(document\)\.ready\(function\(\)\s*\{.*?leadswithoutotpdata\.php.*?<\/script>/s',
        static function () use ($formsBootstrap) {
            return $formsBootstrap;
        },
        $html
    );

    // If still present (different formatting), remove remaining AJAX to old endpoint
    if (str_contains($html, 'leadswithoutotpdata.php')) {
        // Fallback: inject bootstrap before </body> and neutralize old URL
        $html = str_replace('/leadswithoutotpdata.php', '<?= esc($submit_url, \'attr\') ?>', $html);
        if (! str_contains($html, 'landing-forms.js')) {
            $html = str_replace('</body>', $formsBootstrap . "\n</body>", $html);
        }
    }

    // Ensure tracking/forms scripts are present
    if (! str_contains($html, 'landing-forms.js')) {
        $html = str_replace('</body>', $formsBootstrap . "\n</body>", $html);
    }

    // Year script if present uses #yr — leave as-is

    $out = $preamble . "\n" . $html;
    $dst = "{$dstRoot}/{$type}.php";
    file_put_contents($dst, $out);
    echo "Wrote {$dst} (" . strlen($out) . " bytes)\n";
}

echo "Done.\n";
