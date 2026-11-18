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
 * @var string $wa_url
 * @var string $submit_url
 * @var string $thanks_url
 * @var string $city
 * @var string $page_type
 * @var string $location_slug
 * @var array $clinic_options
 * @var array $outstation
 */
$loc = $location;
$phone = $loc['phone'];
$phoneDisplay = $loc['phone_display'];
$cityName = $loc['name'];
$topbarCity = $loc['topbar_city'];
$surgeries = $loc['surgeries'];
$addressPhrase = $loc['address_phrase'];
$outstation = $outstation ?? [];
$outstationHeroRegion = (string) ($outstation['hero_region'] ?? $cityName);
$outstationServingTitle = (string) ($outstation['serving_title'] ?? ('Serving Patients Near ' . $cityName));
$outstationClinicLabel = (string) ($outstation['clinic_option_label'] ?? $cityName);
$outstationDistricts = $outstation['districts'] ?? [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= esc($seo['title']) ?></title>
  <meta name="description" content="<?= esc($seo['description'], 'attr') ?>">
  <link rel="canonical" href="<?= esc($seo['canonical']) ?>" />

  <!-- ✅ Preload hero image -->
  <link rel="preload" as="image"
        href="<?= esc($hero_preload ?: ($asset_base . 'image/hair-transplant-results.webp')) ?>"
        fetchpriority="high" type="image/webp">

  <!-- ✅ Minimal critical CSS -->
  <style>
    html{box-sizing:border-box}
    *,*:before,*:after{box-sizing:inherit}
    body{margin:0;background:#fff;color:#0f172a;
         font:400 16px/1.45 system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
    img{max-width:100%;height:auto;display:block}
    a{color:inherit;text-decoration:none}
    h1{font-size:28px;font-weight:800;line-height:1.2;margin:12px 0 8px}
    h2{font-size:22px;font-weight:700;margin:10px 0 6px}
    h3{font-size:18px;font-weight:700;margin:10px 0 6px}
    p{margin:8px 0}
    .container{max-width:1040px;margin:0 auto;padding:12px 16px}
    .site-header{position:sticky;top:0;background:#fff;z-index:50}
    .hero{padding:16px 16px 20px}
    .points{list-style:none;padding:0;margin:8px 0}
    .points li{margin:6px 0}
    .form-card{background:#fff;border:1px solid #e6e8ee;border-radius:12px;
               padding:12px;box-shadow:0 8px 24px rgba(2,8,20,.06)}
    .input, select{width:100%;padding:12px;border:1px solid #d9dee8;border-radius:10px}
    .fonts-loaded body{font-family:"Inter",system-ui,-apple-system,Segoe UI,Roboto,Arial,sans-serif}
    .fonts-loaded h1,.fonts-loaded h2,.fonts-loaded h3{letter-spacing:-.01em}
  </style>

  <!-- ✅ Fonts async -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
  <link rel="stylesheet" media="print" onload="this.media='all'"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
  <noscript><link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap"></noscript>

  <!-- ✅ Async site CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css" media="print" onload="this.media='all'">
  <link rel="preload" href="<?= esc($css_url) ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript><link rel="stylesheet" href="<?= esc($css_url) ?>"></noscript>

  <!-- ✅ Prevent text flash when font loads -->
  <script>
    if ('fonts' in document) {
      document.fonts.ready.then(function(){
        document.documentElement.classList.add('fonts-loaded');
      });
    }
  </script>

  <!-- ✅ Google Ads / GA4 (deferred + idle init + load-fired page_view) -->
  <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
  <script defer src="https://www.googletagmanager.com/gtag/js?id=G-LV9XNCGB6Q"></script>


  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){ dataLayer.push(arguments); }

    (function initAnalytics(){
      function runConfig(){
        // No auto page_view to avoid layout work during critical path
        var baseCfg = { send_page_view: false, transport_type: 'beacon' };

        gtag('js', new Date());
        gtag('config', 'AW-1014342854', baseCfg);   // Google Ads
        gtag('config', 'G-LV9XNCGB6Q', baseCfg);    // GA4 (primary)
        gtag('config', 'G-1C8G5MSX42', baseCfg);    // GA4 (secondary, if used)

        // Fire page_view after load -> avoids reflow during initial render
        window.addEventListener('load', function(){ gtag('event', 'page_view'); }, { once: true });
      }

      // Delay config until the browser is idle (fallback to small timeout)
      if ('requestIdleCallback' in window) {
        requestIdleCallback(runConfig, { timeout: 3000 });
      } else {
        setTimeout(runConfig, 1500);
      }
    })();
  </script>

<script>
function gtag_report_conversion(url) {
  var callback = function () {
    if (typeof(url) != 'undefined') {
      window.location = url;
    }
  };
  gtag('event', 'conversion', {
      'send_to': 'AW-1014342854/vP56COnJqXMQxsnW4wM',
      // 'event_callback': callback
  });
  return false;
}
</script>

  
</head>

<body class="push-bottom">


    <!-- Topbar -->
    <div class="topbar">
        <div class="container">
            <div>#1 Hair Transplant Clinic in <?= esc($topbarCity) ?></div>
            <div><a href="tel:<?= esc($phone, 'attr') ?>" onclick="return gtag_report_conversion();">Call: <?= esc($phoneDisplay) ?></a></div>
        </div>
    </div>

    <!-- Header -->
    <header class="header">
        <div class="container row">
            <div class="brand">
                <div class="brand-badge">AK</div> AK Clinics
            </div>
            <nav class="nav" aria-label="Primary">
                <a href="#results">Results</a><a href="#treatments">Treatments</a><a href="#doctors">Doctors</a><a
                    href="#testimonials">Testimonials</a><a href="#reviews">Reviews</a><a href="#faq">FAQ</a>
            </nav>
            <a class="cta-btn" href="javascript:void(0)" onclick="document.getElementById('openCalc').click()">Start My Virtual Assessment</a>
            <button id="hamb" class="hamburger"><span></span></button>
        </div>
        <nav id="mnav" class="mnav">
            <a href="#results" onclick="toggleMenu(false)">Results</a>
            <a href="#treatments" onclick="toggleMenu(false)">Treatments</a>
            <a href="#doctors" onclick="toggleMenu(false)">Doctors</a>
            <a href="#testimonials" onclick="toggleMenu(false)">Testimonials</a>
            <a href="#reviews" onclick="toggleMenu(false)">Reviews</a>
            <a href="#faq" onclick="toggleMenu(false)">FAQ</a>
            <a href="javascript:void(0)" onclick="toggleMenu(false); document.getElementById('openCalc').click()" style="color:#fd7e14;font-weight:800">Start My Virtual Assessment</a>
        </nav>
    </header>
    <!-- HERO -->
    <section class="hero">
        <div class="container hero-wrap">
            <div>
                <h1>Travelling for a Hair Transplant?</h1>
                <p>We make it simple — patients from across <?= esc($outstationHeroRegion) ?> trust our <?= esc($cityName) ?> clinic for Bio-FUE hair transplants. A virtual consultation first, travel only once you're ready.</p>
                <ul class="hero-list">
                    <li>American Board Certified Doctors</li>
                    <li>Virtual consultation before you travel</li>
                    <li><?= esc($surgeries) ?> Successful Surgeries</li>
                    <li>20+ Years of Expertise You Can Rely On</li>
                    <li>Transparent pricing & 0% Easy EMI</li>


                </ul>
            </div>
            <aside class="form-card" id="assessment">
                <h3>Get Your Hair Assessment Now!</h3>
                <form id="lead_otp" style="display:grid;gap:12px">
                    <input type="hidden" name="lp_url" value="<?= esc(base_url()) ?>" />
<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, 'attr') ?>">
                    <input type="hidden" name="page_type" value="<?= esc($page_type, 'attr') ?>">
                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, 'attr') ?>">
                    <input type="hidden" name="service" value="<?= esc($service, 'attr') ?>">
                    <input type="hidden" name="paid_lead" value="yes">
                    <input type="hidden" name="utm_source" value="">
                    <input type="hidden" name="utm_medium" value="">
                    <input type="hidden" name="utm_campaign" value="">
                    <input type="hidden" name="utm_content" value="">
                    <input type="hidden" name="utm_term" value="">
                    <input type="hidden" name="gclid" value="">
                    <input type="hidden" name="fbclid" value="">
                    <input type="hidden" name="first_touch_source" value="">
                    <input type="hidden" name="first_touch_medium" value="">
                    <input type="hidden" name="first_touch_channel" value="">
                    <input type="hidden" name="first_touch_campaign" value="">
                    <input type="hidden" name="first_touch_referrer" value="">
                    <input type="hidden" name="first_touch_landing_page" value="">
                    <input type="hidden" name="first_touch_at" value="">
                    <input type="hidden" name="last_touch_source" value="">
                    <input type="hidden" name="last_touch_medium" value="">
                    <input type="hidden" name="last_touch_channel" value="">
                    <input type="hidden" name="last_touch_campaign" value="">
                    <input type="hidden" name="last_touch_referrer" value="">
                    <input type="hidden" name="last_touch_landing_page" value="">
                    <input type="hidden" name="last_touch_at" value="">

                    <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">

                    <input class="input" placeholder="Enter Name" name="name">
                    <label id="name-error" class="error" for="name"></label>

                    <input class="input" type="tel" placeholder="Enter Phone Number" name="mobile_no" minlength="10"
                        maxlength="10" oninput='this.value=this.value.replace(/[^0-9]/g,"")'>
                    <label id="mobile_no-error" class="error" for="mobile_no"></label>

                    <input class="input" placeholder="Enter Email" name="email">

                    <select id="city" name="cliniccity" class="input">
                        <option value="">Clinic Location</option>
                        <?php foreach ($clinic_options as $slug => $opt):
                            // Highlight the current clinic for outstation visitors.
                            $optLabel = ($slug === $location_slug) ? $outstationClinicLabel : $opt['label'];
                        ?>
                        <option value="<?= esc($opt['city_api'], 'attr') ?>" <?= $location_slug === $slug ? 'selected' : '' ?>><?= esc($optLabel) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <label class="consent-label" style="display:flex;gap:8px;align-items:flex-start;font-size:13px;line-height:1.4;cursor:pointer;color:#444">
                        <input type="checkbox" name="contact_consent" value="1" required style="margin-top:3px;flex-shrink:0">
                        <span>I agree to be contacted by AK Clinics via call, SMS, WhatsApp, or email regarding my enquiry.</span>
                    </label>
                    <label id="contact_consent-error" class="error contact-consent-error" for="contact_consent" style="display:none"></label>

                    <button type="submit" class="btn-primary">Submit Now<i class="fas fa-arrow-right"></i></button>
                </form>
                <!-- <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>
                <div class="form-note">Get a free hair assessment reports. T&C apply.</div> -->
            </aside>
        </div>
        <div class="ticker">
            <div class="container">
                <div class="t-track">
                    <div class="t-item"><span class="t-icon">✔</span>No Touch to Root Technique</div>
                    <div class="t-item"><span class="t-icon">✔</span>Virtually Painless & Faster Healing</div>
                    <div class="t-item"><span class="t-icon">✔</span>Award-Winning Team of Doctors</div>
                    <div class="t-item"><span class="t-icon">✔</span>Minimal Downtime</div>
                    <div class="t-item"><span class="t-icon">✔</span>20+ Years. 4 Clinics. 1 Trusted Brand</div>
                </div>
            </div>
        </div>
    </section>

    <!-- STATS STRIP (verified figures only) -->
    <section class="section" id="stats" style="padding:28px 0">
        <div class="container">
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;text-align:center">
                <div><div style="font-size:28px;font-weight:800;color:var(--brand)">20+</div><div style="color:var(--muted);font-size:14px">Years of Experience</div></div>
                <div><div style="font-size:28px;font-weight:800;color:var(--brand)"><?= esc($surgeries) ?></div><div style="color:var(--muted);font-size:14px">Procedures Performed</div></div>
                <div><div style="font-size:28px;font-weight:800;color:var(--brand)">95%</div><div style="color:var(--muted);font-size:14px">Success Rate</div></div>
                <div><div style="font-size:28px;font-weight:800;color:var(--brand)">99%</div><div style="color:var(--muted);font-size:14px">No-Swelling Rate</div></div>
            </div>
        </div>
    </section>
    <style>@media (max-width:720px){#stats .container>div{grid-template-columns:repeat(2,1fr)!important}}</style>

    <!-- Tabs / RESULTS -->
    <section class="section" id="results">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Celebrity-Trusted | <?= esc($loc['possessive']) ?> No.1 Hair Transplant Clinic</h2>
            </div>
            <p class="lead"><?= esc($surgeries) ?> successful surgeries • 20+ years of expertise • Advanced Bio-FUE technology.</p>

            <div class="tabbar">
                <button class="pill active" data-tab="tab-r">Results</button>
                <button class="pill" data-tab="tab-w">About AK Clinics</button>
                <button class="pill" data-tab="tab-t">Why Choose Us</button>
            </div>

            <!-- RESULTS Swiper -->
            <div id="tab-r" class="tabp">
                <div class="swiper" id="resultsSwiper">
          <div class="swiper-wrapper">

              <!-- Slide 1 -->
              <div class="swiper-slide">
                <div class="ba-card">
                  <div class="ba-row">

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                                srcset="<?= esc($asset_base) ?>image/1-after-360.webp 360w,
                                        <?= esc($asset_base) ?>image/1-after-740.webp 740w,
                                        <?= esc($asset_base) ?>image/1-after-980.webp 980w,
                                        <?= esc($asset_base) ?>image/1-after-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/1-after-740.webp"
                             alt="After"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                                srcset="<?= esc($asset_base) ?>image/1-before-360.webp 360w,
                                        <?= esc($asset_base) ?>image/1-before-740.webp 740w,
                                        <?= esc($asset_base) ?>image/1-before-980.webp 980w,
                                        <?= esc($asset_base) ?>image/1-before-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/1-before-740.webp"
                             alt="Before"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                  </div>
                  <div class="ba-meta">
                    <span>BEFORE</span><span style="color:#0a67a3">AFTER</span>
                  </div>
                </div>
              </div>

              <!-- Slide 2 -->
              <div class="swiper-slide">
                <div class="ba-card">
                  <div class="ba-row">

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                                         srcset="<?= esc($asset_base) ?>image/2-before-360.webp 360w,
                                        <?= esc($asset_base) ?>image/2-before-740.webp 740w,
                                        <?= esc($asset_base) ?>image/2-before-980.webp 980w,
                                        <?= esc($asset_base) ?>image/2-before-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/2-before-740.webp"
                             alt="After"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                             srcset="<?= esc($asset_base) ?>image/2-after-360.webp 360w,
                                        <?= esc($asset_base) ?>image/2-after-740.webp 740w,
                                        <?= esc($asset_base) ?>image/2-after-980.webp 980w,
                                        <?= esc($asset_base) ?>image/2-after-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/2-after-740.webp"
                             alt="Before"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                  </div>
                  <div class="ba-meta">
                    <span>BEFORE</span><span style="color:#0a67a3">AFTER</span>
                  </div>
                </div>
              </div>

              <!-- Slide 3 -->
              <div class="swiper-slide">
                <div class="ba-card">
                  <div class="ba-row">

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                             srcset="<?= esc($asset_base) ?>image/3-before-360.webp 360w,
                                        <?= esc($asset_base) ?>image/3-before-740.webp 740w,
                                        <?= esc($asset_base) ?>image/3-before-980.webp 980w,
                                        <?= esc($asset_base) ?>image/3-before-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/3-before-740.webp"
                             alt="After"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                               srcset="<?= esc($asset_base) ?>image/3-after-360.webp 360w,
                                        <?= esc($asset_base) ?>image/3-after-740.webp 740w,
                                        <?= esc($asset_base) ?>image/3-after-980.webp 980w,
                                        <?= esc($asset_base) ?>image/3-after-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/3-after-740.webp"
                             alt="Before"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                  </div>
                  <div class="ba-meta">
                    <span>BEFORE</span><span style="color:#0a67a3">AFTER</span>
                  </div>
                </div>
              </div>

              <!-- Slide 4 -->
              <div class="swiper-slide">
                <div class="ba-card">
                  <div class="ba-row">

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/4-before-360.webp 360w,
                                        <?= esc($asset_base) ?>image/4-before-740.webp 740w,
                                        <?= esc($asset_base) ?>image/4-before-980.webp 980w,
                                        <?= esc($asset_base) ?>image/4-before-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/4-before-740.webp"
                             alt="After"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                    <div class="im">
                      <picture>
                        <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/4-after-360.webp 360w,
                                        <?= esc($asset_base) ?>image/4-after-740.webp 740w,
                                        <?= esc($asset_base) ?>image/4-after-980.webp 980w,
                                        <?= esc($asset_base) ?>image/4-after-1080.webp 1080w">
                        <img src="<?= esc($asset_base) ?>image/4-after-740.webp"
                             alt="Before"
                             loading="lazy" decoding="async"
                             width="740" height="900"
                             sizes="(max-width: 480px) 360px,
                                    (max-width: 1024px) 740px,
                                    (max-width: 1440px) 980px,
                                    1080px">
                      </picture>
                    </div>

                  </div>
                  <div class="ba-meta">
                    <span>BEFORE</span><span style="color:#0a67a3">AFTER</span>
                  </div>
                </div>
              </div>

            </div>

                </div>
                <div class="caro-controls pin-top-right">
                    <button class="caro-btn" id="resultsPrev" title="Previous"><span>‹</span></button>
                    <button class="caro-btn" id="resultsNext" title="Next"><span>›</span></button>
                </div>
            </div>

            <!-- WHY Choose -->
            <div id="tab-w" class="tabp" style="display:none">
                <div class="grid-2">
                    <img src="<?= esc($asset_base) ?>image/delhi-clinic.webp"
                        alt="Explainer">

                    <div>
                        <h2 style="margin:0 0 10px">Best Hair Transplant Clinic in <?= esc($cityName) ?></h3>
                            <p style="margin:0 0 10px; color:#667085;">Choosing the right clinic is key to achieving
                                long-term, natural-looking results. At AK Clinics, <?= esc($cityName) ?>, every hair transplant is
                                performed by qualified doctors ensuring unmatched safety, precision, and aesthetics.</p>
                            <p style="margin:0 0 10px; color:#667085;"><?= esc($addressPhrase) ?>
                                center is one of India’s most trusted names in Bio-FUE Hair Transplants, led by
                                world-renowned surgeons Dr. Kapil Dua and Dr. Aman Dua. With over <?= esc($surgeries) ?> successful
                                surgeries and more than 95% success rate, AK Clinics has earned the trust of thousands
                                of patients, from celebrities to professionals. </p>
                    </div>
                </div>
            </div>
            </div>

            <!-- WHY Choose -->
            <div id="tab-t" class="tabp" style="display:none">
                <div class="grid-2"><img
                        src="<?= esc($asset_base) ?>image/why-ak-clinics.webp"
                        alt="Why choose AK Clinics" loading="lazy"
                        style="display:block;width:100%;border-radius:14px;overflow:hidden" />
                    <div>
                        <h2 style="margin:0 0 10px">Why Choose AK Clinics?</h3>
                            <p style="margin:0 0 10px; color:#667085;">
                                At AK Clinics we recommend what is best for the patient. So we proudly acclaim that
                                wherever you plan hair transplant in <?= esc($cityName) ?> but you must take advice from us as it does
                                not cost anything. We also strive to provide great aesthetic results through our
                                experienced surgeon at affordable cost.
                            </p>
                            <ul class="ul-check">
                                <li>India's Leading Hair Transplant Clinics</li>
                                <li>Doctor-led procedures performed only by qualified surgeons</li>
                                <li>20+ years of experience, <?= esc($surgeries) ?> successful surgeries, and 5 million+ grafts
                                    transplanted</li>
                                <li>Advanced Bio-FUE technique ensuring faster recovery and higher graft survival.</li>
                                <li>Trusted by Celebrities & Recommended by Patients across India and abroad.</li>
                                <li>Transparent pricing with 0% finance options — no hidden costs.</li>
                            </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- PROCESS / JOURNEY -->
    <section class="section" id="process" style="background:#f8f9fb">
        <div class="container">
            <div class="section-head"><h2 class="section-title">Your Hair Transplant Journey</h2></div>
            <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:18px;margin-top:18px">
                <div class="d-card" style="padding:18px"><div style="color:var(--brand);font-weight:800;font-size:13px;margin-bottom:6px">STEP 1</div><strong>Virtual Consultation</strong><p style="color:var(--muted);font-size:14px;margin-top:6px">Start with a video assessment from wherever you are — travel only once you're ready.</p></div>
                <div class="d-card" style="padding:18px"><div style="color:var(--brand);font-weight:800;font-size:13px;margin-bottom:6px">STEP 2</div><strong>Personalised Treatment Plan</strong><p style="color:var(--muted);font-size:14px;margin-top:6px">A Bio-FUE plan built around your graft requirement, confirmed before you travel.</p></div>
                <div class="d-card" style="padding:18px"><div style="color:var(--brand);font-weight:800;font-size:13px;margin-bottom:6px">STEP 3</div><strong>Procedure Day</strong><p style="color:var(--muted);font-size:14px;margin-top:6px">Performed by the doctor-led surgical team at AK Clinics, <?= esc($cityName) ?>.</p></div>
                <div class="d-card" style="padding:18px"><div style="color:var(--brand);font-weight:800;font-size:13px;margin-bottom:6px">STEP 4</div><strong>Structured Aftercare</strong><p style="color:var(--muted);font-size:14px;margin-top:6px">Progress tracked at Week 1, Month 1, 3, 6 and 9–12, including remote follow-up for outstation patients.</p></div>
            </div>
        </div>
    </section>
    <style>@media (max-width:900px){#process .container>div{grid-template-columns:1fr 1fr!important}}@media (max-width:560px){#process .container>div{grid-template-columns:1fr!important}}</style>

    <!-- SERVING DISTRICTS -->
    <section class="section" id="serving-districts">
        <div class="container" style="max-width:900px;text-align:center">
            <h2 class="section-title" style="margin-bottom:10px"><?= esc($outstationServingTitle) ?></h2>
            <p class="lead" style="margin-bottom:16px">Travelling to our <?= esc($cityName) ?> clinic from any of these districts? Start with a virtual consultation first.</p>
            <div style="display:flex;flex-wrap:wrap;gap:10px;justify-content:center">
                <?php foreach ($outstationDistricts as $district): ?>
                <span style="background:#f3f4f6;border:1px solid #e6ebf2;border-radius:999px;padding:8px 16px;font-weight:600;font-size:14px;color:var(--ink)"><?= esc($district) ?></span>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- TREATMENTS -->
    <section class="section" id="treatments">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Hair Restoration Treatment at AK Clinics, <?= esc($cityName) ?></h2>
            </div>
            <p class="lead">Doctor-led techniques designed to restore natural hair and confidence.</p>

            <div class="swiper" id="treatSwiper">
                <div class="swiper-wrapper">

                                <!-- Slide 1 -->
            <div class="swiper-slide">
              <div class="t-card" style="position:relative">
                <div class="ribbon">For Hair Thinning or Baldness</div>

                <div class="t-media">
                  <picture>
                    <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/male-hair-transplant-360.webp 360w,
                                    <?= esc($asset_base) ?>image/male-hair-transplant-740.webp 740w,
                                    <?= esc($asset_base) ?>image/male-hair-transplant-980.webp 980w,
                                    <?= esc($asset_base) ?>image/male-hair-transplant-1080.webp 1080w">
                    <img
                      src="<?= esc($asset_base) ?>image/male-hair-transplant-740.webp"
                      alt="Male Hair Transplant"
                      loading="lazy" decoding="async"
                      width="740" height="908"
                      sizes="(max-width: 480px) 360px,
                             (max-width: 1024px) 740px,
                             (max-width: 1440px) 980px,
                             1080px">
                  </picture>
                </div>

                <div class="t-body">
                  <h3>Male Hair Transplant</h3>
                  <p>Restore your hair and confidence with advanced Bio-FUE techniques. </p>
                  <strong>Benefits</strong>
                  <ul>
                    <li>100% doctor-performed procedure</li>
                    <li>Natural density & hairline design</li>
                    <li>Fast recovery, lasting results</li>
                  </ul>
                </div>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
              <div class="t-card" style="position:relative">
                <div class="ribbon">For Patchy Beard</div>

                <div class="t-media">
                  <picture>
                    <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/beard-transplant-360.webp 360w,
                                    <?= esc($asset_base) ?>image/beard-transplant-740.webp 740w,
                                    <?= esc($asset_base) ?>image/beard-transplant-980.webp 980w,
                                    <?= esc($asset_base) ?>image/beard-transplant-1080.webp 1080w">
                    <img
                      src="<?= esc($asset_base) ?>image/beard-transplant-740.webp"
                      alt="Beard Hair Transplant"
                      loading="lazy" decoding="async"
                      width="740" height="908"
                      sizes="(max-width: 480px) 360px,
                             (max-width: 1024px) 740px,
                             (max-width: 1440px) 980px,
                             1080px">
                  </picture>
                </div>

                <div class="t-body">
                  <h3>Beard Hair Transplant</h3>
                  <p>Get a fuller, natural-looking beard with precise graft placement.</p>
                  <strong>Benefits</strong>
                  <ul>
                    <li>Custom beard shape & density</li>
                    <li>Seamless, natural look</li>
                    <li>Improves thickness</li>
                  </ul>
                </div>
              </div>
            </div>
                    <!-- Slide 3 -->
                    <div class="swiper-slide">
                      <div class="t-card" style="position:relative">
                        <div class="ribbon">For Limited Donor Area</div>

                        <div class="t-media">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/body-hair-transplant-360.webp 360w,
                                            <?= esc($asset_base) ?>image/body-hair-transplant-740.webp 740w,
                                            <?= esc($asset_base) ?>image/body-hair-transplant-980.webp 980w,
                                            <?= esc($asset_base) ?>image/body-hair-transplant-1080.webp 1080w">
                            <!-- choose a sensible default; 740 is good -->
                            <img
                              src="<?= esc($asset_base) ?>image/body-hair-transplant-740.webp"
                              alt="Body Hair Transplant"
                              loading="lazy" decoding="async"
                              width="740" height="908"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                        </div>

                    <div class="t-body">
                      <h3>Body Hair Transplant</h3>
                      <p>Use beard or chest hair to cover larger bald zones naturally.</p>
                      <strong>Benefits</strong>
                      <ul>
                        <li>Increases donor availability</li>
                        <li>Blends naturally with scalp hair</li>
                        <li>Ideal for repair or advanced baldness</li>
                      </ul>
                    </div>
                  </div>
                </div>


                <!-- Slide 4 -->
                <div class="swiper-slide">
                  <div class="t-card" style="position:relative">
                    <div class="ribbon">For Hair Thinning</div>

                    <div class="t-media">
                      <picture>
                        <source type="image/webp"
                                srcset="<?= esc($asset_base) ?>image/female-hair-transplant-360.webp 360w,
                                        <?= esc($asset_base) ?>image/female-hair-transplant-740.webp 740w,
                                        <?= esc($asset_base) ?>image/female-hair-transplant-980.webp 980w,
                                        <?= esc($asset_base) ?>image/female-hair-transplant-1080.webp 1080w">
                        <img
                          src="<?= esc($asset_base) ?>image/female-hair-transplant-740.webp"
                          alt="Female Hair Transplant"
                          loading="lazy" decoding="async"
                          width="740" height="908"
                          sizes="(max-width: 480px) 360px,
                                 (max-width: 1024px) 740px,
                                 (max-width: 1440px) 980px,
                                 1080px">
                      </picture>
                    </div>

                    <div class="t-body">
                      <h3>Female Hair Transplant</h3>
                      <p>Restores density in thinning areas with the Bio-FUE technique, planned around women's natural hair pattern and growth direction.</p>
                      <strong>Benefits</strong>
                      <ul>
                        <li>Revives thinning areas</li>
                        <li>No visible scars</li>
                        <li>Safe & customized for women</li>
                      </ul>
                    </div>
                  </div>
                </div>


                </div>
            </div>

            <!-- Controls -->
            <div class="caro-controls pin-top-right">
                <button class="caro-btn" id="treatPrev" title="Previous"><span>‹</span></button>
                <button class="caro-btn" id="treatNext" title="Next"><span>›</span></button>
            </div>
        </div>
    </section>



    <!-- DOCTORS -->
    <section class="section" id="doctors">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Best Hair Transplant Surgeon in <?= esc($cityName) ?></h2>
            </div>
                <div class="swiper" id="docSwiper">
                  <div class="swiper-wrapper">

                    <!-- Dr. Kapil Dua -->
                    <div class="swiper-slide">
                      <div class="d-card">
                        <div class="d-media">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/dr-kapil-360.webp 360w,
                                            <?= esc($asset_base) ?>image/dr-kapil-740.webp 740w,
                                            <?= esc($asset_base) ?>image/dr-kapil-980.webp 980w,
                                            <?= esc($asset_base) ?>image/dr-kapil-1080.webp 1080w">
                            <img
                              src="<?= esc($asset_base) ?>image/dr-kapil-740.webp"
                              alt="Dr. Kapil Dua"
                              loading="lazy" decoding="async"
                              width="740" height="908"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                        </div>
                        <div class="d-body">
                          <h3 style="margin:0 0 6px">Dr. Kapil Dua</h3>
                          <strong>Chairman & Chief Hair Transplant Surgeon</strong>
                          <ul>
                            <li>Dipl. American Board of Hair Restoration Surgery</li>
                            <li>Former President – ISHRS (USA), AAHRS (Asia), AHRS India</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <!-- Dr. Aman Dua -->
                    <div class="swiper-slide">
                      <div class="d-card">
                        <div class="d-media">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/dr-aman-360.webp 360w,
                                            <?= esc($asset_base) ?>image/dr-aman-740.webp 740w,
                                            <?= esc($asset_base) ?>image/dr-aman-980.webp 980w,
                                            <?= esc($asset_base) ?>image/dr-aman-1080.webp 1080w">
                            <img
                              src="<?= esc($asset_base) ?>image/dr-aman-740.webp"
                              alt="Dr. Aman Dua"
                              loading="lazy" decoding="async"
                              width="740" height="908"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                        </div>
                        <div class="d-body">
                          <h3 style="margin:0 0 6px">Dr. Aman Dua</h3>
                          <strong>Co-Founder & Chief Dermatologist</strong>
                          <ul>
                            <li>MBBS, MD (Dermatology, Venereology & Leprology)</li>
                            <li>Specialist in advanced hair & skin treatment</li>
                            <li>Internationally Trained Doctor</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                    <!-- Dr. Suhail -->
                    <div class="swiper-slide">
                      <div class="d-card">
                        <div class="d-media">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/dr-suhail-360.webp 360w,
                                            <?= esc($asset_base) ?>image/dr-suhail-740.webp 740w,
                                            <?= esc($asset_base) ?>image/dr-suhail-980.webp 980w,
                                            <?= esc($asset_base) ?>image/dr-suhail-1080.webp 1080w">
                            <img
                              src="<?= esc($asset_base) ?>image/dr-suhail-740.webp"
                              alt="Dr. Suhail"
                              loading="lazy" decoding="async"
                              width="740" height="908"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                        </div>
                        <div class="d-body">
                          <h3 style="margin:0 0 6px">Dr. Suhail</h3>
                          <strong>Dermatologist & Hair Transplant Surgeon</strong>
                          <ul>
                            <li>MBBS, MD in Dermatology</li>
                            <li>Specializes in FUE and Bio-FUE</li>
                            <li>Hair Restoration Expert</li>
                          </ul>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>

            <div class="caro-controls pin-top-right">
                <button class="caro-btn" id="docPrev" title="Previous"><span>‹</span></button>
                <button class="caro-btn" id="docNext" title="Next"><span>›</span></button>
            </div>
        </div>
    </section>
    <section class="section" id="infra">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Experience World-Class Facilities & Care</h2>
            </div>
            <p class="lead">Step inside AK Clinics - where medical excellence meets modern comfort.
            <p>

            <div class="infra" style="margin-top:16px">
                <div class="tile">
  <picture>
    <source type="image/webp"
            srcset="<?= esc($asset_base) ?>image/infra-1-360.webp 360w,
                    <?= esc($asset_base) ?>image/infra-1-740.webp 740w,
                    <?= esc($asset_base) ?>image/infra-1-980.webp 980w,
                    <?= esc($asset_base) ?>image/infra-1-1080.webp 1080w">
    <img
      src="<?= esc($asset_base) ?>image/infra-1-740.webp"
      alt="Clinic lobby"
      loading="lazy" decoding="async"
      width="740" height="908"
      sizes="(max-width: 480px) 360px,
             (max-width: 1024px) 740px,
             (max-width: 1440px) 980px,
             1080px">
  </picture>
</div>

                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-2.webp" alt="Clinic facade">
                </div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-3.webp" alt="Procedure room">
                </div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-4.webp"
                        alt="Consultation room"></div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-5.webp" alt="Recovery suite">
                </div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-6.webp" alt="Equipment">
                </div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-7.webp" alt="Waiting area">
                </div>
                <div class="tile"><img loading="lazy"
                        src="<?= esc($asset_base) ?>image/infra-8.webp" alt="OT standards">
                </div>
            </div>
        </div>
    </section>


    <!-- VIDEO TESTIMONIALS -->
    <!-- VIDEO TESTIMONIALS -->
    <section class="section" id="testimonials">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Real Patients. Real Results. Real Stories.</h2>
            </div>
            <p class="lead">Hear from real patients who regained confidence through doctor-led Bio-FUE transplants.</p>

            <div class="swiper" id="videoSwiper">
                <div class="swiper-wrapper">



                <div class="swiper-slide">
              <div class="vcard">
                <div class="vthumb" data-video="fF5xriFLJfI">
                  <picture>
                    <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/testimonial-1-360.webp 360w,
                                    <?= esc($asset_base) ?>image/testimonial-1-740.webp 740w,
                                    <?= esc($asset_base) ?>image/testimonial-1-980.webp 980w,
                                    <?= esc($asset_base) ?>image/testimonial-1-1080.webp 1080w">
                    <img
                      src="<?= esc($asset_base) ?>image/testimonial-1-740.webp"
                      alt="Testimonial 1"
                      loading="lazy" decoding="async"
                      width="740" height="740"
                      sizes="(max-width: 480px) 360px,
                             (max-width: 1024px) 740px,
                             (max-width: 1440px) 980px,
                             1080px">
                  </picture>
                  <div class="play-yt"></div>
                </div>
                <div class="vbody">
                  <p class="vname">Gurmeet Singh</p>
                  <p class="vtxt">Hair Transplant Experience at AK Clinics</p>
                </div>
              </div>
            </div>





            <div class="swiper-slide">
              <div class="vcard">
                <div class="vthumb" data-video="BYtlrEd_Dwc">
                  <picture>
                    <source type="image/webp"
                            srcset="<?= esc($asset_base) ?>image/testimonial-2-360.webp 360w,
                                    <?= esc($asset_base) ?>image/testimonial-2-740.webp 740w,
                                    <?= esc($asset_base) ?>image/testimonial-2-980.webp 980w,
                                    <?= esc($asset_base) ?>image/testimonial-2-1080.webp 1080w">
                    <img
                      src="<?= esc($asset_base) ?>image/testimonial-2-740.webp"
                      alt="Testimonial 2"
                      loading="lazy" decoding="async"
                      width="740" height="740"
                      sizes="(max-width: 480px) 360px,
                             (max-width: 1024px) 740px,
                             (max-width: 1440px) 980px,
                             1080px">
                  </picture>
                  <div class="play-yt"></div>
                </div>
                <div class="vbody">
                  <p class="vname">Jaspal Singh</p>
                  <p class="vtxt">Hair Transplant Experience at AK Clinics</p>
                </div>
              </div>
            </div>
            <div class="swiper-slide">
                  <div class="vcard">
                    <div class="vthumb" data-video="LsXh4vMP71c">
                      <picture>
                        <source type="image/webp"
                                srcset="<?= esc($asset_base) ?>image/testimonial-3-360.webp 360w,
                                        <?= esc($asset_base) ?>image/testimonial-3-740.webp 740w,
                                        <?= esc($asset_base) ?>image/testimonial-3-980.webp 980w,
                                        <?= esc($asset_base) ?>image/testimonial-3-1080.webp 1080w">
                        <img
                          src="<?= esc($asset_base) ?>image/testimonial-3-740.webp"
                          alt="Testimonial 3"
                          loading="lazy" decoding="async"
                          width="740" height="740"
                          sizes="(max-width: 480px) 360px,
                                 (max-width: 1024px) 740px,
                                 (max-width: 1440px) 980px,
                                 1080px">
                      </picture>
                      <div class="play-yt"></div>
                    </div>
                    <div class="vbody">
                      <p class="vname">Sartaj Gill</p>
                      <p class="vtxt">Hair Transplant Experience at AK Clinics</p>
                    </div>
                  </div>
                </div>
            <div class="swiper-slide">
                      <div class="vcard">
                        <div class="vthumb" data-video="_YwcR0dM7O0">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/testimonial-4-360.webp 360w,
                                            <?= esc($asset_base) ?>image/testimonial-4-740.webp 740w,
                                            <?= esc($asset_base) ?>image/testimonial-4-980.webp 980w,
                                            <?= esc($asset_base) ?>image/testimonial-4-1080.webp 1080w">
                            <img
                              src="<?= esc($asset_base) ?>image/testimonial-4-740.webp"
                              alt="Testimonial 4"
                              loading="lazy" decoding="async"
                              width="740" height="740"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                          <div class="play-yt"></div>
                        </div>
                        <div class="vbody">
                          <p class="vname">Sachin Sen</p>
                          <p class="vtxt">Hair Transplant Experience at AK Clinics</p>
                        </div>
                      </div>
                    </div>




                    <div class="swiper-slide">
                      <div class="vcard">
                        <div class="vthumb" data-video="y5mHbgXlWhk">
                          <picture>
                            <source type="image/webp"
                                    srcset="<?= esc($asset_base) ?>image/testimonial-5-360.webp 360w,
                                            <?= esc($asset_base) ?>image/testimonial-5-740.webp 740w,
                                            <?= esc($asset_base) ?>image/testimonial-5-980.webp 980w,
                                            <?= esc($asset_base) ?>image/testimonial-5-1080.webp 1080w">
                            <img
                              src="<?= esc($asset_base) ?>image/testimonial-5-740.webp"
                              alt="Testimonial 5"
                              loading="lazy" decoding="async"
                              width="740" height="740"
                              sizes="(max-width: 480px) 360px,
                                     (max-width: 1024px) 740px,
                                     (max-width: 1440px) 980px,
                                     1080px">
                          </picture>
                          <div class="play-yt"></div>
                        </div>
                        <div class="vbody">
                          <p class="vname">Daanveer Singh</p>
                          <p class="vtxt">Hair Transplant Experience at AK Clinics</p>
                        </div>
                      </div>
                    </div>



                </div>
            </div>

            <div class="caro-controls pin-top-right">
                <button class="caro-btn" id="vidPrev" title="Previous"><span>‹</span></button>
                <button class="caro-btn" id="vidNext" title="Next"><span>›</span></button>
            </div>
        </div>
    </section>


    <!-- TEXT REVIEWS -->
    <section class="section" id="reviews">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">What Our Patients Say About Us</h2>
            </div>

            <div class="swiper" id="revSwiper" style="margin-top:12px">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="review"><strong>Rohit Khanna</strong> ★★★★★<br>“Had my hair transplant at AK Clinics
                            <?= esc($cityName) ?> under Dr. Kapil Dua. The results look natural and the entire process was handled with
                            great care.”</div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review"><strong>Ankit Verma</strong> ★★★★★<br>“Dr. Kapil Dua and his team at AK
                            Clinics <?= esc($cityName) ?> are extremely professional. My hairline design and overall density look very
                            natural.”</div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review"><strong>Karan Mehta</strong> ★★★★★<br>“I chose AK Clinics <?= esc($cityName) ?> after a lot
                            of research. The consultation with Dr. Kapil Dua was detailed, and I’m very happy with the
                            outcome.”</div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review"><strong>Ravi Bhatia</strong> ★★★★★<br>“Dr. Kapil Dua personally ensured
                            every detail was taken care of. The <?= esc($cityName) ?> clinic is modern, hygienic, and truly
                            patient-focused.”</div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review"><strong>Sandeep Malhotra</strong> ★★★★★<br>“My experience at AK Clinics
                            <?= esc($cityName) ?> was excellent. The staff was attentive, and my results after the transplant are
                            impressive and natural.”</div>
                    </div>
                    <div class="swiper-slide">
                        <div class="review"><strong>Amit Arora</strong> ★★★★★<br>“I chose AK Clinics <?= esc($cityName) ?> after a lot
                            of research. The consultation with Dr. Kapil Dua was detailed, and I’m very happy with the
                            outcome.”</div>
                    </div>
                </div>
            </div>
            <div class="caro-controls pin-top-right">
                <button class="caro-btn" id="revPrev" title="Previous"><span>‹</span></button>
                <button class="caro-btn" id="revNext" title="Next"><span>›</span></button>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="section" id="faq">
        <div class="container">
            <h2 class="section-title" style="text-align:center;margin:0 0 6px">Frequently Asked Questions (FAQ)</h2>
            <div class="faq-wrap" style="margin-top:14px">
                <div class="faq-item">
                    <div class="faq-q">Can patients from outside <?= esc($cityName) ?> book a consultation?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">Absolutely. Many of our patients travel from across India and abroad. You can
                        schedule a virtual consultation before visiting our <?= esc($cityName) ?> center for your procedure.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">Who performs the hair transplant surgery at AK Clinics <?= esc($cityName) ?>?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">All procedures are performed exclusively by experienced, qualified doctors at our <?= esc($cityName) ?>
                        center, under the surgical protocols founded by Dr. Kapil Dua and Dr. Aman Dua, to ensure
                        safety and natural-looking results.</div>
                </div>


                <div class="faq-item">
                    <div class="faq-q">How much does Hair Transplant cost in <?= esc($cityName) ?> at AK Clinics?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">The cost of a hair transplant at AK Clinics, <?= esc($cityName) ?>, starts around Rs. 60,000 and
                        depends on grafts, technique (Bio-FUE/FUT), and surgeon expertise. You’ll get a precise estimate
                        after your assessment.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">Do you offer EMI or 0% finance options?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">Yes, we offer 0% EMI and flexible finance options to make your treatment more
                        affordable without compromising quality.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">When will I see visible results after the transplant?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">You’ll start seeing new hair growth in 3–4 months, with fuller density visible by
                        8–10 months. Final results appear around 12 months post-surgery.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">Is a hair transplant painful?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">The procedure is done under local anesthesia, ensuring comfort throughout. Some
                        mild tenderness may occur for 1–2 days and is easily managed with medication.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">Are hair transplant results permanent?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">Yes. Transplanted grafts are taken from the permanent donor area, ensuring
                        lifelong growth and natural appearance with proper care.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">What makes AK Clinics different from other clinics in <?= esc($cityName) ?>?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">All transplants are doctor-led, using advanced Bio-FUE for faster healing and
                        natural density. AK Clinics is celebrity-trusted, maintains a 95%+ success rate, and follows
                        international hygiene standards.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">What kind of post-surgery care does AK Clinics provide?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">We offer complete follow-up support, including hair wash guidance, recovery
                        monitoring, and long-term maintenance advice until results are fully achieved.</div>
                </div>

                <div class="faq-item">
                    <div class="faq-q">Which is better — Bio-FUE or DHI technique?
                        <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                            <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                        </svg>
                    </div>
                    <div class="faq-a">Both techniques are effective, but Bio-FUE offers more precision and customization. The grafts are extracted and implanted as per your hair length using special tools, ensuring smooth placement and over 95% success rate - that’s why it’s our most preferred method at AK Clinics.</div>
                </div>

            </div>
        </div>
    </section>

    <!-- ===== Cost Calculator CTA Widget ===== -->
    <section class="cta-widget">
        <div class="container">
            <h3>Planning to travel for your hair transplant?</h3>
            <p>Get a virtual assessment and cost estimate before you make the trip. Takes under a minute.</p>
            <button class="cta-btn-white" id="openCalc">Start My Virtual Assessment</button>
        </div>
    </section>

    <!-- ===== Multi-step Cost Calculator Modal ===== -->
    <div class="modal-overlay" id="calcModal" aria-hidden="true">
        <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="calcTitle">
            <button class="modal-close" id="closeCalc" aria-label="Close">&times;</button>
            <div style="font-size:12px;font-weight:700;color:var(--muted);letter-spacing:.04em;margin:4px 0 6px" id="modalStepLabel">STEP 1 OF 4</div>
            <div style="height:4px;background:#eef1f6;border-radius:999px;overflow:hidden;margin-bottom:16px">
                <div id="modalProgressFill" style="height:100%;width:25%;background:var(--brand);transition:width .25s"></div>
            </div>
          <form id="calcForm" enctype="multipart/form-data">
            <!-- Step 1 -->
            <div class="step active" id="step1">
                <h3 id="calcTitle">Tell us about yourself</h3>
                <p class="modal-sub">We’ll use this detail to send hair assessment reports (grafts & cost).</p>
                <div class="row">
                    <input type="hidden" name="lp_url" value="<?= esc(base_url()) ?>" />
<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, 'attr') ?>">
                    <input type="hidden" name="page_type" value="<?= esc($page_type, 'attr') ?>">
                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, 'attr') ?>">
                    <input type="hidden" name="service" value="<?= esc($service, 'attr') ?>">
                    <input type="hidden" name="paid_lead" value="yes">
                    <input type="hidden" name="utm_source" value="">
                    <input type="hidden" name="utm_medium" value="">
                    <input type="hidden" name="utm_campaign" value="">
                    <input type="hidden" name="utm_content" value="">
                    <input type="hidden" name="utm_term" value="">
                    <input type="hidden" name="gclid" value="">
                    <input type="hidden" name="fbclid" value="">
                    <input type="hidden" name="first_touch_source" value="">
                    <input type="hidden" name="first_touch_medium" value="">
                    <input type="hidden" name="first_touch_channel" value="">
                    <input type="hidden" name="first_touch_campaign" value="">
                    <input type="hidden" name="first_touch_referrer" value="">
                    <input type="hidden" name="first_touch_landing_page" value="">
                    <input type="hidden" name="first_touch_at" value="">
                    <input type="hidden" name="last_touch_source" value="">
                    <input type="hidden" name="last_touch_medium" value="">
                    <input type="hidden" name="last_touch_channel" value="">
                    <input type="hidden" name="last_touch_campaign" value="">
                    <input type="hidden" name="last_touch_referrer" value="">
                    <input type="hidden" name="last_touch_landing_page" value="">
                    <input type="hidden" name="last_touch_at" value="">

                    <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">
                    <input class="input" id="ccName" placeholder="Full name*" name="name" autocomplete="name">
                    <input class="input" id="ccPhone"  type="number" placeholder="Phone*" name="mobile_no" autocomplete="tel">
                    <input class="input" id="ccCity" placeholder="City*" name="cliniccity" autocomplete="address-level2">
                    <input class="input" id="ccEmail" placeholder="Email (optional)"  name="email" autocomplete="email">
                    <label class="consent-label" style="display:flex;gap:8px;align-items:flex-start;font-size:13px;line-height:1.4;cursor:pointer;color:#444;grid-column:1/-1;margin-top:4px">
                        <input type="checkbox" name="contact_consent" value="1" required style="margin-top:3px;flex-shrink:0">
                        <span>I agree to be contacted by AK Clinics via call, SMS, WhatsApp, or email regarding my enquiry.</span>
                    </label>
                    <label id="calc_contact_consent-error" class="error contact-consent-error" for="contact_consent" style="display:none;grid-column:1/-1"></label>
                </div>
                <!-- <div class="modal-actions">
                    <button class="btn primary" id="toStep2">Continue</button>
                </div> -->
                <div class="modal-actions">
                    <button type="button" class="btn primary" id="toStep2">Continue</button>
                </div>
            </div>

            <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>

            <!-- Step 2 -->
            <div class="step" id="step2">
                <h3>Select your Hair Loss Type</h3>
                <p class="modal-sub">Choose the pattern that best matches your current baldness level.</p>
                <div class="scale-grid" id="scaleGrid">
                    <!-- Minimal, feel free to swap thumbnails for your own -->
                    <div class="scale-card" data-stage="1">
                        <img src="<?= esc($asset_base) ?>image/grade-1.webp" alt="Norwood 1">
                        <strong>Stage 1</strong>
                    </div>
                    <div class="scale-card" data-stage="2">
                        <img src="<?= esc($asset_base) ?>image/grade-2.webp" alt="Norwood 2">
                        <strong>Stage 2</strong>
                    </div>
                    <div class="scale-card" data-stage="3">
                        <img src="<?= esc($asset_base) ?>image/grade-3.webp" alt="Norwood 3">
                        <strong>Stage 3</strong>
                    </div>
                    <div class="scale-card" data-stage="4">
                        <img src="<?= esc($asset_base) ?>image/grade-4.webp" alt="Norwood 4">
                        <strong>Stage 4</strong>
                    </div>
                    <div class="scale-card" data-stage="5">
                        <img src="<?= esc($asset_base) ?>image/grade-5.webp" alt="Norwood 5">
                        <strong>Stage 5</strong>
                    </div>
                    <div class="scale-card" data-stage="6">
                        <img src="<?= esc($asset_base) ?>image/grade-6.webp" alt="Norwood 6">
                        <strong>Stage 6</strong>
                    </div>
                    <div class="scale-card" data-stage="7">
                        <img src="<?= esc($asset_base) ?>image/grade-7.webp" alt="Norwood 7">
                        <strong>Stage 7</strong>
                    </div>
                    <input type="hidden" id="norwoodStage" name="norwood_stage">
                </div>
                <!-- <div class="modal-actions">
                    <button class="btn" id="backTo1">Back</button>
                    <button class="btn primary" id="toStep3" disabled>Continue</button>
                </div> -->
                <div class="modal-actions">
                    <button type="button" class="btn" id="backTo1">Back</button>
                    <button type="button" class="btn primary" id="toStep3" disabled>Continue</button>
                </div>
            </div>

            <!-- Step 3 -->
            <div class="step" id="step3">
                <h3>Upload scalp photos</h3>
                <p class="modal-sub">Upload 1–4 clear photos (front / top / sides / back). JPG or PNG.</p>
                <div class="upload-zone">
                    <input type="file" id="ccFiles" name="user_image[]" accept="image/*" multiple style="display:none">
                    <!-- <input type="file" id="imageUpload" name="user_image" accept="image/*" multiple
                        style="display:none"> -->
                    <button class="btn" id="pickFiles" type="button">Choose Photos</button>
                    <div class="small" style="margin-top:6px">Max 10 MB per image</div>
                    <div class="preview-grid" id="previewGrid"></div>
                </div>
                <!-- <div class="modal-actions">
                    <button class="btn" id="backTo2">Back</button>
                    <button class="btn primary" id="toStep4">Submit</button>
                </div> -->
                <div class="modal-actions">
                    <button type="button" class="btn" id="backTo2">Back</button>
                    <button type="submit" class="btn primary">Submit</button>
                </div>
            </div>

            </form>
            <!-- Step 4 -->
       <div class="step" id="step4">
          <h3>Thank you, <span id="thanksName"></span>!</h3>
          <p class="modal-sub">
            Based on your selection (<strong>Norwood <span id="nwStage"></span></strong>), here is the possible requirement in your case:
            <strong><span id="graftCount"></span></strong>
          </p>

          <p class="modal-sub" id="treatmentMessage"></p>

          <p class="modal-sub" id="disclaimer">
            <strong>Disclaimer:</strong> Final graft requirement & cost may vary depending upon requirement, surgeon, and technique used.
            Exact plan will be advised after consultation with the doctor.
          </p>

          <div class="modal-actions">
            <button class="btn primary" id="closeDone">Close</button>
          </div>
        </div>
        </div>
    </div>
    <button class="calc-fab" id="calcFab" type="button" aria-label="Start your virtual assessment">
        Virtual&nbsp;Assessment
    </button>




    <footer class="footer-slim">
        <div class="container">
            <div>© <span id="yr"></span> AK Clinics - All rights reserved</div>
            <div><em>*One of India’s most trusted names for quality hair transplants in <?= esc($cityName) ?>.</em></div>
        </div>
    </footer>


    <!-- Mobile quick actions -->
    <div class="mobile-bar">
        <a class="mobile-btn wa"
            href="<?= esc($wa_url) ?>"
            onclick="return gtag_report_conversion();"
            target="_blank" rel="noopener"><svg class="wa-icon" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path fill="currentColor" d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.08.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.13-.27-.2-.57-.35M12.05 21.79h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.88 9.89-9.88 2.64 0 5.12 1.03 6.99 2.9a9.82 9.82 0 0 1 2.89 6.99c0 5.45-4.44 9.88-9.89 9.88m8.41-18.3A11.81 11.81 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.14 1.59 5.95L.06 24l6.3-1.65a11.88 11.88 0 0 0 5.68 1.45h.01c6.55 0 11.89-5.34 11.89-11.89 0-3.18-1.24-6.16-3.48-8.41"/></svg><span>WhatsApp</span></a>
        <a class="mobile-btn primary" href="tel:<?= esc($phone, 'attr') ?>" onclick="return gtag_report_conversion();">Call Now</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- ✅ jQuery Validation Plugin -->
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <script defer src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
    <script src="<?= esc($script_url) ?>"></script>

    
<script>
window.AK_LANDING = {
  submitUrl: <?= json_encode($submit_url) ?>,
  pageType: <?= json_encode($page_type) ?>,
  locationSlug: <?= json_encode($location_slug) ?>,
  thanksUrl: <?= json_encode($thanks_url) ?>,
  city: <?= json_encode($cityName) ?>
};
</script>
<script>
window.__LEAD_ATTRIBUTION_SERVER_TIME__ = <?= json_encode(date('c')) ?>;
</script>
<script src="<?= esc(base_url('js/landing-tracking.js')) ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= esc(base_url('js/landing-forms.js')) ?>?v=thanks1"></script>
<script src="<?= esc(base_url('js/landing-calculator.js')) ?>?v=thanks1"></script>
<script type='text/javascript'>
            (function(I, L, T, i, c, k, s) {if(I.iticks) return;I.iticks = {host:c, settings:s, clientId:k, cdn:L, queue:[]};var h = T.head || T.documentElement;var e = T.createElement(i);var l = I.location;e.async = true;e.src = (L||c)+'/client/inject-v2.min.js';h.insertBefore(e, h.firstChild);I.iticks.call = function(a, b) {I.iticks.queue.push([a, b]);};})(window, 'https://cdn-v1.intelliticks.com/prod/common', document, 'script', 'https://app.intelliticks.com', 'kEEbS63MgGiojbePd_c', {});
    </script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const phoneInput = document.getElementById("ccPhone");
  const continueBtn = document.getElementById("toStep2");
  // Keep Continue clickable so validation can highlight empty fields
  if (continueBtn) {
    continueBtn.disabled = false;
    continueBtn.classList.remove("disabled");
    continueBtn.removeAttribute("disabled");
  }
  if (!phoneInput) return;
  phoneInput.addEventListener("input", function() {
    this.value = this.value
      .replace(/[^\d+]/g, '')
      .replace(/(?!^)\+/g, '');
  });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const fileInput = document.getElementById("ccFiles");
  const pickBtn = document.getElementById("pickFiles");
  const submitBtn = document.querySelector("#step3 button[type='submit']");
  const previewGrid = document.getElementById("previewGrid");

  // disable by default
  submitBtn.disabled = true;
  submitBtn.classList.add("disabled");

  // open file picker
  // pickBtn.addEventListener("click", () => fileInput.click());

  // when files selected
  fileInput.addEventListener("change", function() {
    previewGrid.innerHTML = ""; // clear old previews
    const files = Array.from(this.files);

    if (files.length === 0) {
      submitBtn.disabled = true;
      submitBtn.classList.add("disabled");
      return;
    }

    // limit 4 images
    if (files.length > 4) {
      alert("Please select up to 4 photos only.");
      fileInput.value = "";
      submitBtn.disabled = true;
      submitBtn.classList.add("disabled");
      return;
    }

    // check size limit (10 MB)
    let validFiles = true;
    files.forEach(file => {
      if (file.size > 10 * 1024 * 1024) {
        alert(`"${file.name}" exceeds 10 MB limit.`);
        validFiles = false;
      } else {
        const img = document.createElement("img");
        img.src = URL.createObjectURL(file);
        img.style.width = "80px";
        img.style.height = "80px";
        img.style.objectFit = "cover";
        img.style.borderRadius = "8px";
        previewGrid.appendChild(img);
      }
    });

    // enable or disable submit
    if (validFiles && files.length > 0) {
      submitBtn.disabled = false;
      submitBtn.classList.remove("disabled");
    } else {
      fileInput.value = "";
      submitBtn.disabled = true;
      submitBtn.classList.add("disabled");
    }
  });
});
</script>

<style>
#previewGrid {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  margin-top: 10px;
}
.btn.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>


<style>
.btn.disabled {
  opacity: 0.6;
  cursor: not-allowed;
}
</style>


<style>
  /* Optional: Style for disabled button */
  .btn.disabled {
    opacity: 0.6;
    cursor: not-allowed;
  }
</style>

<script>
(function(){
  var fill = document.getElementById('modalProgressFill');
  var label = document.getElementById('modalStepLabel');
  if (!fill || !label) return;
  function setStep(n){
    fill.style.width = (n * 25) + '%';
    label.textContent = 'STEP ' + n + ' OF 4';
  }
  var map = {
    'openCalc': 1, 'calcFab': 1,
    'toStep2': 2, 'backTo1': 1,
    'toStep3': 3, 'backTo2': 2
  };
  Object.keys(map).forEach(function(id){
    var el = document.getElementById(id);
    if (el) el.addEventListener('click', function(){ setStep(map[id]); });
  });
  var form = document.getElementById('calcForm');
  if (form) form.addEventListener('submit', function(){ setStep(4); });
})();
</script>

</body>

</html>