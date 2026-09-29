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
            <div><a href="tel:<?= esc($phone, 'attr') ?>">Call: <?= esc($phoneDisplay) ?></a></div>
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
            <a class="cta-btn" href="#assessment">Free Assessment</a>
            <button id="hamb" class="hamburger"><span></span></button>
        </div>
        <nav id="mnav" class="mnav">
            <a href="#results" onclick="toggleMenu(false)">Results</a>
            <a href="#treatments" onclick="toggleMenu(false)">Treatments</a>
            <a href="#doctors" onclick="toggleMenu(false)">Doctors</a>
            <a href="#testimonials" onclick="toggleMenu(false)">Testimonials</a>
            <a href="#reviews" onclick="toggleMenu(false)">Reviews</a>
            <a href="#faq" onclick="toggleMenu(false)">FAQ</a>
            <a href="#assessment" onclick="toggleMenu(false)" style="color:#fd7e14;font-weight:800">Free Assessment</a>
        </nav>
    </header>
    <!-- HERO -->
    <section class="hero">
        <div class="container hero-wrap">
            <div>
                <h1>Hair Transplant Cost in <?= esc($cityName) ?><br>Get a Quick Price Estimate</h1>
                <p>Transparent pricing. No surprises. Advanced Bio-FUE by India’s Top Hair Transplant Surgeons.</p>
                <ul class="hero-list">
                    <li>American Board Certified Doctors</li>
                    <li>Founders of Bio-FUE™</li>
                    <li><?= esc($surgeries) ?> Successful Surgeries</li>
                    <li>20+ Years of Expertise You Can Rely On</li>
                    <li>Get Hair Transparent @ 0% Easy EMI</li>


                </ul>
            </div>
            <aside class="form-card" id="assessment">
                <h2>Know your Hair Transplant Cost!</h2>
                <form id="lead_otp" style="display:grid;gap:12px">
                    <input type="hidden" name="lp_url" value="<?= esc(base_url()) ?>" />
<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, 'attr') ?>">
                    <input type="hidden" name="page_type" value="<?= esc($page_type, 'attr') ?>">
                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, 'attr') ?>">
                    <input type="hidden" name="service" value="<?= esc($service, 'attr') ?>">
                    <input type="hidden" name="paid_lead" value="yes">
                    <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">

                    <input class="input" placeholder="Enter Name" name="name">
                    <label id="name-error" class="error" for="name"></label>

                    <input class="input" type="tel" placeholder="Enter Phone Number" name="mobile_no" minlength="10"
                        maxlength="10" oninput='this.value=this.value.replace(/[^0-9]/g,"")'>
                    <label id="mobile_no-error" class="error" for="mobile_no"></label>

                    <input class="input" placeholder="Enter Email" name="email">

                    <select id="city" name="cliniccity" class="input">
                        <option value="">Clinic Location</option>
                        <?php foreach ($clinic_options as $slug => $opt): ?>
                        <option value="<?= esc($opt['city_api'], 'attr') ?>" <?= $location_slug === $slug ? 'selected' : '' ?>><?= esc($opt['label']) ?></option>
                        <?php endforeach; ?>
                    </select>

                    <button type="submit" class="btn-primary">Submit Now<i class="fas fa-arrow-right"></i></button>
                </form>
                <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>
               <div class="form-note" style="text-align: center;">T&C apply - affordable Hair Transplant in <?= esc($cityName) ?>.</div>

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
                <button class="pill" data-tab="tab-c">Hair Transplant cost in <?= esc($cityName) ?></button>
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
                        <h2 style="margin:0 0 10px">#1 Hair Transplant Clinic In <?= esc($cityName) ?></h3>
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
               <!-- WHY Choose -->
            <div id="tab-c" class="tabp" style="display:none">
                <div class="grid-2">
                    <img src="<?= esc($asset_base) ?>image/delhi-clinic.webp"
                        alt="Explainer">

                    <div>
                        <h2 style="margin:0 0 10px">How Much Does a Hair Transplant Cost in <?= esc($cityName) ?>?</h2>
                            <p style="margin:0 0 10px; color:#667085;">Hair transplant cost in <?= esc($cityName) ?> typically starts from Rs.50,000 to 60,000 and varies depending on your baldness grade, graft requirement, and the technique used. The exact cost can only be determined after a detailed assessment of your scalp and donor area.</p>
                            
                            <h3 style="margin:0 0 10px">How We Evaluate Your Cost at AK Clinics</h3>
                            <ul class="ul-check">
                                <li>Understanding Your Expectations (hairline design, density, coverage area)</li>
                                <li>Total Grafts Required</li>
                                <li>Technique Recommended (Bio-FUE, DHT, Beard-to-Scalp, etc.)</li>
                                <li>Complexity of the Case (repair, weak donor, scarring alopecia)</li>
                                <li>Surgeon’s Involvement & Expertise</li>
                            </ul>
                            
                    </div>
                </div>
            </div>
            <!-- WHY Choose -->
            <div id="tab-w" class="tabp" style="display:none">
                <div class="grid-2"><img
                        src="<?= esc($asset_base) ?>image/why-ak-clinics.webp"
                        alt="Why choose AK Clinics" loading="lazy"
                        style="display:block;width:100%;border-radius:14px;overflow:hidden" />
                    <div>
                        <h2 style="margin:0 0 10px">Why choose AK Clinics?</h3>
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

    <!-- TREATMENTS -->
    <section class="section" id="treatments">
        <div class="container">
            <div class="section-head">
                <h2 class="section-title">Advanced Hair Transplant Options in <?= esc($cityName) ?> at AK Clinics</h2>
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
                      <p>Restore natural density in thinning or widening areas commonly seen in women.</p>
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
                <h2 class="section-title">Meet the Experts Behind Your Hair Transplant in <?= esc($cityName) ?></h2>
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

                    <!-- Dr. Bhawna -->
                    <!--<div class="swiper-slide"> <div class="d-card"> <div class="d-media"><img loading="lazy" src="<?= esc($asset_base) ?>image/dr-bhawna.webp" alt="Dr. Bhawna Bhardwaj"></div> <div class="d-body"> <h3 style="margin:0 0 6px">Dr. Bhawana Bhardwaj</h3> <strong>Dermatologist & Hair Transplant Surgeon</strong> <ul> <li>MBBS, DVDL (Skin & VD)</li> <li>Member of IADVL and AHRS India</li> <li>Hair Restoration Expert</li> </ul> </div> </div> </div>-->

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
        <h2 class="section-title" style="text-align:center;margin:0 0 6px">General Cost & Treatment FAQs</h2>
        <div class="faq-wrap" style="margin-top:14px">

            <!-- FAQ 1 -->
            <div class="faq-item">
                <div class="faq-q">How much does a hair transplant cost in <?= esc($cityName) ?> at AK Clinics?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Hair transplant cost in <?= esc($cityName) ?> at AK Clinics usually starts from <strong>Rs. 50,000 to Rs. 60,000</strong>. 
                    The final cost depends on your graft requirement, baldness grade, and the technique recommended. 
                    A quick scalp assessment helps us share an accurate estimate.
                </div>
            </div>

            <!-- FAQ 2 -->
            <div class="faq-item">
                <div class="faq-q">Who performs the hair transplant surgery at AK Clinics <?= esc($cityName) ?>?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    All procedures are performed by highly experienced surgeons. 
                    At our <?= esc($cityName) ?> centre, <strong>Dr. Kapil Dua</strong> and <strong>Dr. Bhawana Bhardwaj</strong> 
                    lead the treatments to ensure safe and natural-looking results.
                </div>
            </div>

            <!-- FAQ 3 -->
            <div class="faq-item">
                <div class="faq-q">Is a hair transplant painful?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    The treatment is done under local anesthesia, so you remain comfortable throughout. 
                    You may feel slight tightness or tenderness for a day or two, which settles easily with medication.
                </div>
            </div>

            <!-- FAQ 4 -->
            <div class="faq-item">
                <div class="faq-q">When will I see visible results after the transplant?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    New hair growth usually begins around <strong>3 to 4 months</strong>. 
                    Noticeable improvement becomes visible from the <strong>5th month</strong>,
                    and full results typically appear between <strong>10 to 12 months</strong>.
                </div>
            </div>

            <!-- FAQ 5 -->
            <div class="faq-item">
                <div class="faq-q">What makes AK Clinics different from other clinics in <?= esc($cityName) ?>?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Our procedures are surgeon-led, we use advanced Bio-FUE technology, 
                    maintain high graft survival, follow transparent pricing, 
                    and have over <?= esc($surgeries) ?> successful transplants supported by strong patient trust.
                </div>
            </div>

            <!-- FAQ 6 -->
            <div class="faq-item">
                <div class="faq-q">Are hair transplant results permanent?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Yes. The transplanted hair is taken from the permanent donor zone, 
                    meaning the results typically last a lifetime with proper care.
                </div>
            </div>

            <!-- FAQ 7 -->
            <div class="faq-item">
                <div class="faq-q">Do you offer EMI or 0% finance options?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Yes, we offer <strong>0% EMI</strong> and flexible finance plans to make the treatment more affordable.
                </div>
            </div>

            <!-- FAQ 8 -->
            <div class="faq-item">
                <div class="faq-q">Can patients from outside <?= esc($cityName) ?> book a consultation?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Yes. You can book a virtual consultation from anywhere in India or abroad. 
                    We also assist with planning your visit and treatment schedule if you’re travelling to <?= esc($cityName) ?>.
                </div>
            </div>

            <!-- FAQ 9 -->
            <div class="faq-item">
                <div class="faq-q">What kind of post-surgery care does AK Clinics provide?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    We provide complete post-op support, including hair wash guidance, medications, 
                    regular follow-ups, and growth monitoring for up to 12 months.
                </div>
            </div>

            <!-- FAQ 10 -->
            <div class="faq-item">
                <div class="faq-q">Which technique works better for me, Bio-FUE or DHI?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
                    </svg>
                </div>
                <div class="faq-a">
                    Both techniques give excellent results. The right choice depends on your donor area, 
                    graft requirement, and the look you want to achieve. 
                    Your surgeon will guide you on the most suitable option during your consultation.
                </div>
            </div>
            <!-- FAQ 11 -->
            <div class="faq-item">
                <div class="faq-q">What is the cost of 2000 grafts in <?= esc($cityName) ?>?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2"/>
                    </svg>
                </div>
                <div class="faq-a">
                    The cost of 2000 grafts varies for every patient because it depends on 
                    the technique used, your donor quality, and the baldness area. 
                    A scalp analysis helps determine the exact requirement and cost.
                </div>
            </div>

            <!-- FAQ 12 -->
            <div class="faq-item">
                <div class="faq-q">How much does a 2500 graft hair transplant cost?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2"/>
                    </svg>
                </div>
                <div class="faq-a">
                    The cost of 2500 grafts depends on your density goals, hairline design,
                    and the overall complexity of the case. 
                    We share accurate details after evaluating your scalp.
                </div>
            </div>

            <!-- FAQ 13 -->
            <div class="faq-item">
                <div class="faq-q">What is the cost of 3000 grafts at AK Clinics?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2"/>
                    </svg>
                </div>
                <div class="faq-a">
                    Pricing for 3000 grafts depends on donor availability, 
                    technique (Bio-FUE or DHI), and the area that needs coverage. 
                    A personalised plan is created after a proper assessment.
                </div>
            </div>

             <!-- FAQ 15 -->
            <div class="faq-item">
                <div class="faq-q">How much does a 5000 graft hair transplant cost?
                    <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2"/>
                    </svg>
                </div>
                <div class="faq-a">
                    A 5000-graft transplant is usually needed for advanced baldness. 
                    The cost varies based on technique, donor supply, and whether additional graft sources are needed. 
                    We provide a detailed plan after assessing your scalp.
                </div>
            </div>

        </div>
    </div>
</section>


    <!-- ===== Cost Calculator CTA Widget ===== -->
    <section class="cta-widget">
        <div class="container">
            <h3>Need a hair transplant and not sure where to start?</h3>
            <p>Get a quick estimate with our 3-step cost calculator. Takes under a minute.</p>
            <button class="cta-btn-white" id="openCalc">Free Cost Calculator</button>
        </div>
    </section>

    <!-- ===== Multi-step Cost Calculator Modal ===== -->
    <div class="modal-overlay" id="calcModal" aria-hidden="true">
        <div class="modal-box" role="dialog" aria-modal="true" aria-labelledby="calcTitle">
            <button class="modal-close" id="closeCalc" aria-label="Close">&times;</button>
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
                    <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">
                    <input class="input" id="ccName" placeholder="Full name*" name="name" autocomplete="name">
                    <input class="input" id="ccPhone"  type="number" placeholder="Phone*" name="mobile_no" autocomplete="tel">
                    <input class="input" id="ccCity" placeholder="City*" name="cliniccity" autocomplete="address-level2">
                    <input class="input" id="ccEmail" placeholder="Email (optional)"  name="email" autocomplete="email">
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
    <button class="calc-fab" id="calcFab" type="button" aria-label="Open cost calculator">
        Cost&nbsp;Calculator
    </button>




    <footer class="footer-slim">
        <div class="container">
            <div>© <span id="yr"></span> AK Clinics - All rights reserved</div>
            <div><em>*One of India’s most trusted names for quality hair transplants in <?= esc($cityName) ?>.</em></div>
        </div>
    </footer>


    <!-- Mobile quick actions -->
    <div class="mobile-bar">
        <a class="mobile-btn"
            href="<?= esc($wa_url) ?>"
            target="_blank" rel="noopener">WhatsApp</a>
        <a class="mobile-btn primary" href="tel:<?= esc($phone, 'attr') ?>">Call Now</a>
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
city: <?= json_encode($cityName) ?>
};
</script>
<script src="<?= esc(base_url('js/landing-tracking.js')) ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= esc(base_url('js/landing-forms.js')) ?>"></script>
<script src="<?= esc(base_url('js/landing-calculator.js')) ?>"></script>
<script type='text/javascript'>
            (function(I, L, T, i, c, k, s) {if(I.iticks) return;I.iticks = {host:c, settings:s, clientId:k, cdn:L, queue:[]};var h = T.head || T.documentElement;var e = T.createElement(i);var l = I.location;e.async = true;e.src = (L||c)+'/client/inject-v2.min.js';h.insertBefore(e, h.firstChild);I.iticks.call = function(a, b) {I.iticks.queue.push([a, b]);};})(window, 'https://cdn-v1.intelliticks.com/prod/common', document, 'script', 'https://app.intelliticks.com', 'kEEbS63MgGiojbePd_c', {});
    </script>
<script>
document.addEventListener("DOMContentLoaded", function() {
  const nameInput = document.getElementById("ccName");
  const phoneInput = document.getElementById("ccPhone");
  const cityInput = document.getElementById("ccCity");
  const continueBtn = document.getElementById("toStep2");

  if (!nameInput || !phoneInput || !cityInput || !continueBtn) return;
  continueBtn.disabled = true;
  continueBtn.classList.add("disabled");

  // Allow only numbers and one '+' at the start
  phoneInput.addEventListener("input", function() {
    this.value = this.value
      .replace(/[^\d+]/g, '')      // allow digits and '+'
      .replace(/(?!^)\+/g, '');    // only one '+' allowed at the start
  });

  function validateInputs() {
    const name = nameInput.value.trim();
    const phone = phoneInput.value.trim();
    const city = cityInput.value.trim();

    // Validate phone: between 10 and 14 digits (excluding '+')
    const phoneDigits = phone.replace(/\D/g, '');
    const isPhoneValid = phoneDigits.length >= 10 && phoneDigits.length <= 14;

    if (name !== "" && isPhoneValid && city !== "") {
      continueBtn.disabled = false;
      continueBtn.classList.remove("disabled");
    } else {
      if (!nameInput || !phoneInput || !cityInput || !continueBtn) return;
  continueBtn.disabled = true;
      continueBtn.classList.add("disabled");
    }
  }

  [nameInput, phoneInput, cityInput].forEach(input => {
    input.addEventListener("input", validateInputs);
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

</body>

</html>