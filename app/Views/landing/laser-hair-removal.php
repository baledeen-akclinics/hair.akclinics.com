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
    html {
      box-sizing: border-box
    }

    *,
    *:before,
    *:after {
      box-sizing: inherit
    }

    body {
      margin: 0;
      background: #fff;
      color: #0f172a;
      font: 400 16px/1.45 system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif
    }

    img {
      max-width: 100%;
      height: auto;
      display: block
    }

    a {
      color: inherit;
      text-decoration: none
    }

    h1 {
      font-size: 28px;
      font-weight: 800;
      line-height: 1.2;
      margin: 12px 0 8px
    }

    h2 {
      font-size: 22px;
      font-weight: 700;
      margin: 10px 0 6px
    }

    h3 {
      font-size: 18px;
      font-weight: 700;
      margin: 10px 0 6px
    }

    p {
      margin: 8px 0
    }

    .container {
      max-width: 1040px;
      margin: 0 auto;
      padding: 12px 16px
    }

    .site-header {
      position: sticky;
      top: 0;
      background: #fff;
      z-index: 50
    }

    .hero {
      padding: 16px 16px 20px
    }

    .points {
      list-style: none;
      padding: 0;
      margin: 8px 0
    }

    .points li {
      margin: 6px 0
    }

    .form-card {
      background: #fff;
      border: 1px solid #e6e8ee;
      border-radius: 12px;
      padding: 12px;
      box-shadow: 0 8px 24px rgba(2, 8, 20, .06)
    }

    .input,
    select {
      width: 100%;
      padding: 12px;
      border: 1px solid #d9dee8;
      border-radius: 10px
    }

    .fonts-loaded body {
      font-family: "Inter", system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif
    }

    .fonts-loaded h1,
    .fonts-loaded h2,
    .fonts-loaded h3 {
      letter-spacing: -.01em
    }



    #hl-services {
      --hl-brand: #fd7e14;
      --hl-ink: #0f172a;
      --hl-muted: #667085;
      --hl-card: #fff;
      --hl-bd: #e9edf4;
      --hl-shadow: 0 10px 26px rgba(2, 8, 20, .06);
      --hl-pill: #ffffff;
      --hl-pill-bd: #e6ebf2;
      --hl-pill-shadow: 0 6px 14px rgba(2, 8, 20, .06);
    }

    /* Header */
    #hl-services .section-head {
      display: flex;
      justify-content: space-between;
      align-items: baseline;
      gap: 16px;
      margin-bottom: 16px
    }

    #hl-services .section-title {
      margin: 0;
      font-size: 24px;
      font-weight: 800;
      color: var(--hl-ink)
    }

    #hl-services .treat-help {
      margin: 0;
      color: var(--hl-muted);
      font-size: 14px
    }

    @media (max-width:640px) {
      #hl-services .section-head {
        flex-direction: column;
        align-items: flex-start
      }

      #hl-services .treat-help {
        font-size: 13px
      }
    }

    /* ---------- Fixed Tab Bar (4 columns desktop, 2x2 mobile) ---------- */
    #hl-services .svc-tabs {
      list-style: none;
      margin: 0 0 18px;
      padding: 0;
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 18px;
    }

    @media (max-width:720px) {
      #hl-services .svc-tabs {
        grid-template-columns: repeat(2, 1fr)
      }
    }

    #hl-services .svc-tabs li {
      margin: 0;
      padding: 0
    }

    /* Pill buttons */
    #hl-services .svc-tab {
      width: 100%;
      height: 64px;
      border: 1px solid var(--hl-pill-bd);
      border-radius: 16px;
      background: var(--hl-pill);
      box-shadow: var(--hl-pill-shadow);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      cursor: pointer;
      padding: 10px 12px;
      transition: transform .08s, border-color .2s, box-shadow .2s, background .2s;
    }

    #hl-services .svc-tab:focus-visible {
      outline: 3px solid rgba(253, 126, 20, .35);
      outline-offset: 2px
    }

    #hl-services .svc-tab:hover {
      border-color: var(--hl-brand)
    }

    #hl-services .svc-tab img {
      width: 22px;
      height: 22px;
      object-fit: contain;
      opacity: .9
    }

    #hl-services .svc-tab span {
      font-size: 15px;
      font-weight: 700;
      line-height: 1.1;
      color: var(--hl-ink);
      text-align: center;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis
    }

    #hl-services .svc-tab.active {
      background: var(--hl-brand);
      border-color: var(--hl-brand);
      box-shadow: 0 10px 22px rgba(253, 126, 20, .22)
    }

    #hl-services .svc-tab.active span {
      color: #fff
    }

    #hl-services .svc-tab.active img {
      filter: invert(1) brightness(10)
    }

    /* Panels */
    #hl-services .svcs-panels {
      position: relative
    }

    #hl-services .svcs-panel {
      display: none
    }

    #hl-services .svcs-panel.active {
      display: block
    }

    /* ===== Card (match screenshot: balanced L/R padding, soft shadow, rounded) ===== */
    #hl-services .svc-card {
      display: grid;
      grid-template-columns: 1.1fr .9fr;
      /* slightly wider copy column like screenshot */
      gap: 22px;
      border: 1px solid var(--hl-bd);
      border-radius: 18px;
      background: var(--hl-card);
      padding: 22px;
      box-shadow: var(--hl-shadow)
    }

    @media (max-width:900px) {
      #hl-services .svc-card {
        grid-template-columns: 1fr
      }
    }

    /* Typography close to reference */
    #hl-services .svc-copy h3 {
      font-size: 22px;
      font-weight: 800;
      margin: 0 0 10px;
      color: var(--hl-ink)
    }

    #hl-services .svc-copy h4 {
      font-size: 16px;
      font-weight: 800;
      margin: 12px 0 6px;
      color: var(--hl-ink)
    }

    #hl-services .svc-copy p {
      margin: 0 0 10px;
      color: #475569
    }

    /* Two-column bullets like the screenshot */
    #hl-services .svc-listgrid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 12px;
      margin: 8px 0 12px
    }

    #hl-services .svc-list {
      margin: 0;
      padding-left: 18px
    }

    #hl-services .svc-list li {
      margin: 6px 0
    }

    @media (max-width:720px) {
      #hl-services .svc-listgrid {
        grid-template-columns: 1fr
      }
    }

    /* CTA — centered on desktop, full-width on mobile */
    #hl-services .cta-wrap {
      display: flex;
      justify-content: center;
      margin-top: 8px
    }

    #hl-services .svc-cta {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      background: var(--hl-brand);
      color: #fff;
      padding: 12px 18px;
      border-radius: 12px;
      font-weight: 700;
      box-shadow: 0 10px 22px rgba(253, 126, 20, .22);
      border: none;
      cursor: pointer
    }

    #hl-services .svc-cta:hover {
      filter: brightness(.95)
    }

    @media (max-width:720px) {
      #hl-services .cta-wrap {
        justify-content: stretch
      }

      #hl-services .svc-cta {
        width: 100%
      }
    }

    /* Right image — single item, rounded like reference */
    #hl-services .svc-figure {
      display: block
    }

    #hl-services .svc-figure img {
      width: 100%;
      height: auto;
      border-radius: 14px;
      border: 1px solid #eef2f7;
      object-fit: cover
    }
  </style>

  <!-- ✅ Fonts async -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="preload" as="style"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
  <link rel="stylesheet" media="print" onload="this.media='all'"
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
  <noscript>
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap">
  </noscript>
  <!-- ✅ Async site CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper@9/swiper-bundle.min.css" media="print" onload="this.media='all'">
  <link rel="preload" href="<?= esc($css_url) ?>" as="style" onload="this.onload=null;this.rel='stylesheet'">
  <noscript>
    <link rel="stylesheet" href="<?= esc($css_url) ?>">
  </noscript>

  <!-- ✅ Prevent text flash when font loads -->
  <script>
    if ('fonts' in document) {
      document.fonts.ready.then(function() {
        document.documentElement.classList.add('fonts-loaded');
      });
    }
  </script>

  <!-- ✅ Google Ads / GA4 (deferred + idle init + load-fired page_view) -->
  <link rel="preconnect" href="https://www.googletagmanager.com" crossorigin>
  <script defer src="https://www.googletagmanager.com/gtag/js?id=G-LV9XNCGB6Q"></script>


  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }

    (function initAnalytics() {
      function runConfig() {
        // No auto page_view to avoid layout work during critical path
        var baseCfg = {
          send_page_view: false,
          transport_type: 'beacon'
        };

        gtag('js', new Date());
        gtag('config', 'AW-1014342854', baseCfg); // Google Ads
        gtag('config', 'G-LV9XNCGB6Q', baseCfg); // GA4 (primary)
        gtag('config', 'G-1C8G5MSX42', baseCfg); // GA4 (secondary, if used)

        // Fire page_view after load -> avoids reflow during initial render
        window.addEventListener('load', function() {
          gtag('event', 'page_view');
        }, {
          once: true
        });
      }

      // Delay config until the browser is idle (fallback to small timeout)
      if ('requestIdleCallback' in window) {
        requestIdleCallback(runConfig, {
          timeout: 3000
        });
      } else {
        setTimeout(runConfig, 1500);
      }
    })();
  </script>

  <script>
    function gtag_report_conversion(url) {
      var callback = function() {
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

<body class="">


  <!-- Topbar -->
  <div class="topbar">
    <div class="container">
      <div>#1 <?= esc($page['service']) ?> in <?= esc($topbarCity) ?></div>
      <div><a href="tel:<?= esc($phone, 'attr') ?>">Call: <?= esc($phoneDisplay) ?></a></div>
    </div>
  </div>

  <!-- Header -->
  <header class="header">
    <div class="container row">
      <!-- <div class="brand">
        <div class="brand-badge">AK</div> AK Clinics
      </div> -->
      <div class="brand" style="display: flex; align-items: center; gap: 8px;">
        <img src="<?= esc($asset_base) ?>image/download.png" alt="AK Clinics Logo" style="height: 40px; width: auto;">
      </div>
      <nav class="nav" aria-label="Primary">
        <a href="#results">Results</a><a href="#hl-services">Treatments</a><a href="#doctors">Doctors</a><a
          href="#testimonials">Testimonials</a><a href="#reviews">Reviews</a><a href="#faq">FAQ</a>
      </nav>
      <a class="cta-btn" href="#assessment">Free Assessment</a>
      <button id="hamb" class="hamburger"><span></span></button>
    </div>
    <nav id="mnav" class="mnav">
      <a href="#results" onclick="toggleMenu(false)">Results</a>
      <a href="#hl-services" onclick="toggleMenu(false)">Treatments</a>
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
        <h1>Full Body Laser Hair Removal<br /> in <?= esc($cityName) ?></h1>
        <p>Say goodbye to waxing and shaving forever. At AK Clinics, <?= esc($cityName) ?>, our dermatologist-supervised full body laser offers Zero Waxing Pain and Long-Term Results with advanced US-FDA approved technology.</p>
        <ul class="hero-list">
          <li>US-FDA Approved Full Body Laser</li>
          <li>Safe for All Indian Skin Types</li>
          <li>Dermatologist-Supervised Laser Sessions</li>
          <li>Transparent Pricing & 0% Easy EMI</li>


        </ul>
      </div>
      <aside class="form-card" id="assessment">
        <h3>Start Your Smooth Skin Journey!</h3>
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
        <div class="form-note">Full body laser hair removal in <?= esc($cityName) ?>. T&C apply.</div>
      </aside>
    </div>
    <div class="ticker">
      <div class="container">
        <div class="t-track">
          <div class="t-item"><span class="t-icon">✔</span>NNo.1 Laser Hair Removal Clinic</div>
          <div class="t-item"><span class="t-icon">✔</span>Say Goodbye to Waxing Pain</div>
          <div class="t-item"><span class="t-icon">✔</span>100% Safe & Skin-Friendly</div>
          <div class="t-item"><span class="t-icon">✔</span>Dermatologist-Supervised Sessions</div>
          <div class="t-item"><span class="t-icon">✔</span>Personalised Laser Settings</div>
          <div class="t-item"><span class="t-icon">✔</span>Life-Changing Results</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tabs / RESULTS -->
  <section class="section" id="results">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title"><?= esc($loc['possessive']) ?> Most Trusted Clinic for Full Body Laser Hair Removal</h2>
      </div>
      <p class="lead">30,000+ Laser Sessions Completed • 12+ Years of Dermatology Expertise • US-FDA Approved Laser</p>

      <div class="tabbar">
        <button class="pill active" data-tab="tab-r">Results</button>
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
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/1-before.jpg" alt="before">
                  </div>
                  <div class="im">
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/1-After.jpg" alt="after">
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
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/2-before.jpg" alt="before">
                  </div>
                  <div class="im">
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/2-after.jpg" alt="after">
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
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/3-before.jpg" alt="before">
                  </div>
                  <div class="im">
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/3-after.jpg" alt="after">
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
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/4-before.jpg" alt="Clinic facade">
                  </div>
                  <div class="im">
                    <img loading="lazy" src="<?= esc($asset_base) ?>image/4-after.jpg" alt="Clinic facade">
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
        <div class="grid-2"><img
            src="<?= esc($asset_base) ?>image/lhr3.png"
            alt="Why choose AK Clinics" loading="lazy"
            style="display:block;width:100%;border-radius:14px;overflow:hidden" />
          <div>
            <h2 style="margin:0 0 10px">Why Choose AK Clinics for Laser Hair Removal?</h3>
              <p style="margin:0 0 10px; color:#667085;">
                At AK Clinics, we believe every patient deserves a treatment plan designed specifically for their skin and hair type. Whether it’s full body laser or targeted-area laser, our dermatologists focus on safe, effective and result-driven solutions using advanced laser technology with no hidden costs.

              </p>
              <ul class="ul-check">
                <li>US-FDA Approved Laser Technology</li>
                <li>Treatments Performed by Experienced Dermatologists</li>
                <li>20+ Years of Expertise & 10,000+ Successful Laser Sessions</li>
                <li>Pain-Reduced Laser with Advanced Cooling System</li>
                <li>Safe for All Indian Skin Types with Hygienic Private Rooms</li>
                <li>Transparent Pricing with 0% EMI Options</li>
              </ul>

          </div>
        </div>
      </div>

      <!-- WHY Choose -->
      <div id="tab-t" class="tabp" style="display:none">
        <div class="grid-2"><img
            src="<?= esc($asset_base) ?>image/lhr3.png"
            alt="Why choose AK Clinics" loading="lazy"
            style="display:block;width:100%;border-radius:14px;overflow:hidden" />
          <div>
            <h2 style="margin:0 0 10px">Why Choose AK Clinics for Laser Hair Removal?</h3>
              <p style="margin:0 0 10px; color:#667085;">
                At AK Clinics, we believe every patient deserves a treatment plan designed specifically for their skin and hair type. Whether it’s full body laser or targeted-area laser, our dermatologists focus on safe, effective and result-driven solutions using advanced laser technology with no hidden costs.
              </p>
              <ul class="ul-check">
                <li>US-FDA Approved Laser Technology</li>
                <li>Treatments Performed by Experienced Dermatologists</li>
                <li>20+ Years of Expertise & 10,000+ Successful Laser Sessions</li>
                <li>Pain-Reduced Laser with Advanced Cooling System</li>
                <li>Safe for All Indian Skin Types with Hygienic Private Rooms</li>
                <li>Transparent Pricing with 0% EMI Options</li>
              </ul>
          </div>
        </div>
      </div>

    </div>
  </section>

  <!-- TREATMENTS -->
  <section class="section" id="hl-services">
    <div class="container">
      <h2 class="section-title">Advanced Laser Hair Removal Treatments in <?= esc($cityName) ?></h2>
      <p class="lead">Safe, Painless & Effective Laser Hair Removal for All Skin Types.</p>


      <!-- 4 fixed tabs -->
      <!-- <ul class="svc-tabs" role="tablist" aria-label="HL Services">
        <li role="presentation">
          <button class="svc-tab active" id="tab-hl" role="tab" aria-selected="true" aria-controls="panel-hl" data-target="panel-hl">
            <img src="<?= esc($asset_base) ?>image/serv-icon-1.png" alt="">
            <span>Full Body Laser</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-prp" role="tab" aria-selected="false" aria-controls="panel-prp" tabindex="-1" data-target="panel-prp">
            <img src="<?= esc($asset_base) ?>image/serv-icon-2.png" alt="">
            <span>Underarms</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-gfc" role="tab" aria-selected="false" aria-controls="panel-gfc" tabindex="-1" data-target="panel-gfc">
            <img src="<?= esc($asset_base) ?>image/serv-icon-3.png" alt="">
            <span>Face / Chin</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-other" role="tab" aria-selected="false" aria-controls="panel-other" tabindex="-1" data-target="panel-other">
            <img src="<?= esc($asset_base) ?>image/serv-icon-4.png" alt="">
            <span>Bikini / Brazilian</span>
          </button>
        </li>
      </ul> -->

      <!-- Panels: same content + ONE image -->
      <div class="svcs-panels" id="svcs-panels">
        <!-- Panel 1 -->
        <section class="svcs-panel active" id="panel-hl" role="tabpanel" aria-labelledby="tab-hl">

          <div class="svc-card">
            <div class="svc-copy">
              <p>Get long-lasting smooth, hair-free skin with Advanced Full Body Laser at AK Clinics. Our US-FDA approved lasers work faster, target deeper hair roots, and keep the skin cool throughout the session for safe and consistent results.</p>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>Safe, painless & skin-friendly procedure</li>
                  <li>Covers large body areas quickly</li>
                  <li>No downtime</li>
                </ul>
                <ul class="svc-list">
                  <li>Reduces ingrown hair & razor bumps</li>
                  <li>Improves overall skin texture</li>
                </ul>

              </div>

              <h4>Areas Covered in Full Body Laser Hair Removal</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>Face & Neck</li>
                  <li>Arms</li>
                  <li>Torso</li>
                </ul>
                <ul class="svc-list">
                  <li>Legs</li>
                  <li>Bikini Area</li>
                </ul>

              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="<?= esc($asset_base) ?>image/lhr-2.png" alt="Clinic infrastructure">
            </figure>
          </div>
        </section>

        <!-- Panel 2 (same content) -->
        <!-- <section class="svcs-panel" id="panel-prp" role="tabpanel" aria-labelledby="tab-prp" hidden>
          <div class="svc-card">
            <div class="svc-copy">
             <h4>Underarm Laser Hair Removal in <?= esc($cityName) ?></h4>
                <p>Underarm Laser is one of the quickest and most effective ways to achieve smooth, clean and brighter-looking underarms. It helps you avoid the pain of waxing, the stubble from shaving, and the dark patches caused by friction and repeated hair removal.</p>
            <h4>Who Are the Ideal Candidates for Underarm Laser Hair Removal?</h4>
              <p>
                Underarm Laser works best for people who deal with ingrown hair, underarm darkness, frequent sweating, or irritation caused by shaving or waxing. It’s perfect for those who want long-term smoothness with minimal maintenance.</p>
              <h4>Why Choose Underarm Laser at AK Clinics?</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                 <li>Safe for all Indian skin types</li>
                <li>Quick 10-minute, pain-reduced sessions</li>
                <li>Helps lighten pigmentation caused by waxing/shaving</li>
                </ul>
                <ul class="svc-list">
                   <li>Minimal discomfort with advanced cooling tips</li>
                    <li>Performed under dermatologist supervision</li>
                    <li>Visible reduction with every session</li>
                </ul>
              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn1">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="/landing/hair-transplant/Dummy/image/gfc.jpg" alt="Clinic infrastructure">
            </figure>
          </div>

        </section> -->

        <!-- Panel 3 (same content) -->
        <!-- <section class="svcs-panel" id="panel-gfc" role="tabpanel" aria-labelledby="tab-gfc" hidden>
          <div class="svc-card">
            <div class="svc-copy">
              <h3>Hair Transplant in <?= esc($cityName) ?></h3>
              <p>
                Hair Transplant is a permanent and natural solution to restore hair in areas affected by baldness or severe thinning.
                Using advanced techniques like <strong>Bio-FUE and DHT</strong>, healthy hair follicles are transplanted to thinning areas, ensuring long-lasting and natural-looking results.
                <strong>At AK Clinics</strong>, all procedures are performed by expert surgeons with years of experience in hair restoration.
              </p>
              <h4>Who Are the Ideal Candidates for Hair Transplant?</h4>
              <p>
                Ideal candidates include individuals with advanced hair loss or baldness (Grade 3 to 7), a stable donor area, and realistic expectations.
                It is also suitable for those who want a permanent solution after trying medical treatments.
              </p>
              <h4>Why Choose Hair Transplant At AK Clinics?</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>Permanent & natural hair restoration</li>
                  <li>Bio-FUE & DHT techniques for best results</li>
                  <li>Minimal downtime & fast recovery</li>
                </ul>
                <ul class="svc-list">
                  <li>Performed by globally trained surgeons</li>
                  <li>10,000+ successful hair transplant cases</li>
                </ul>
              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn2">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="/landing/hair-treatments/image/male-hair-transplant-1080.webp" alt="Hair transplant at AK Clinics">
            </figure>
          </div>

        </section> -->

        <!-- Panel 4 (same content) -->
        <!-- <section class="svcs-panel" id="panel-other" role="tabpanel" aria-labelledby="tab-other" hidden>
          <div class="svc-card">
            <div class="svc-copy">
              <h3>Medical Management of Hair Loss</h3>
              <p>
                For patients in the initial stages of hair loss, our dermatologists begin with a thorough scalp evaluation to identify the root cause.
                Based on the findings, we create a personalised medical management plan that may include clinically proven oral medications, topical solutions, serums, and supportive therapies.
                This approach helps control hair fall, strengthen existing hair, and delay or prevent the need for advanced procedures.
              </p>
              <h4>Who Are the Ideal Candidates for Medical Hair Loss Treatments?</h4>
              <p>
                Medical management is best suited for individuals with <strong>early to mild hair thinning</strong> or increased hair fall, especially those who do not yet require PRP, GFC, or transplant procedures.
              </p>
              <h4>Why Choose Medical Hair Loss Treatments At AK Clinics?</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>Best for early-stage hair loss</li>
                  <li>Doctor-prescribed medications & solutions</li>
                  <li>Non-surgical and easy to follow</li>
                </ul>
                <ul class="svc-list">
                  <li>Personalised treatment plans</li>
                  <li>Trusted by 10,000+ happy patients</li>
                </ul>
              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn3">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="/landing/hair-treatments/image/others.jpg" alt="Dermatologist consultation at AK Clinics">
            </figure>
          </div>

        </section> -->
      </div>

    </div>
  </section>



  <!-- DOCTORS -->
  <section class="section" id="doctors">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title">Best Dermatologists & Surgeons at AK Clinics, <?= esc($cityName) ?></h2>
      </div>
      <div class="swiper" id="docSwiper">
        <div class="swiper-wrapper">
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
          <!--<div class="swiper-slide">-->
          <!--  <div class="d-card">-->
          <!--    <div class="d-media"><img loading="lazy" src="<?= esc($asset_base) ?>image/dr-bhawna.webp" alt="Dr. Bhawna Bhardwaj"></div>-->
          <!--    <div class="d-body">-->
          <!--      <h3 style="margin:0 0 6px">Dr. Bhawana Bhardwaj</h3> <strong>Dermatologist & Hair Transplant Surgeon</strong>-->
          <!--      <ul>-->
          <!--        <li>MBBS, DVDL (Skin & VD)</li>-->
          <!--        <li>Member of IADVL and AHRS India</li>-->
          <!--        <li>Hair Restoration Expert</li>-->
          <!--      </ul>-->
          <!--    </div>-->
          <!--  </div>-->
          <!--</div>-->

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
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/1.png" alt="Clinic facade">
        </div>

        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/2.png" alt="Clinic facade">
        </div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/3.png" alt="Procedure room">
        </div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/4.png"
            alt="Consultation room"></div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/5.png" alt="Recovery suite">
        </div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/7.png" alt="Equipment">
        </div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/8.png" alt="Waiting area">
        </div>
        <div class="tile"><img loading="lazy"
            src="<?= esc($asset_base) ?>image/9.png" alt="OT standards">
        </div>
      </div>
    </div>
  </section>


  <!-- VIDEO TESTIMONIALS -->
  <section class="section" id="testimonials">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title">Real Patients. Real Results. Real Stories.</h2>
      </div>
      <p class="lead">Hear from real patients who achieved smooth, hair-free skin with advanced laser treatments at AK Clinics.</p>

      <div class="swiper" id="videoSwiper">
        <div class="swiper-wrapper">



          <div class="swiper-slide">
            <div class="vcard">
              <div class="vthumb" data-video="TuoM3sL6cmA">
                <img
                  src="<?= esc($asset_base) ?>image/thb-1.png"
                  alt="GFC Treatment Result Testimonial"
                  loading="lazy"
                  decoding="async"
                  width="740"
                  height="740"
                  style="width:100%;height:auto;object-fit:cover;">
                <div class="play-yt"></div>
              </div>
              <div class="vbody">
                <p class="vtxt">GFC (Growth Factor Concentrate) Hair Treatment Results at AK Clinics</p>
              </div>
            </div>
          </div>


          <div class="swiper-slide">
            <div class="vcard">
              <div class="vthumb" data-video="NZF8uC9hEbs">
                <img
                  src="<?= esc($asset_base) ?>image/thb-2.png"
                  alt="GFC Treatment Result Testimonial"
                  loading="lazy"
                  decoding="async"
                  width="740"
                  height="740"
                  style="width:100%;height:auto;object-fit:cover;">
                <div class="play-yt"></div>
              </div>
              <div class="vbody">
                <p class="vtxt">Mesotherapy for Hair Loss Treatment at AK Clinics</p>
              </div>
            </div>
          </div>



          <div class="swiper-slide">
            <div class="vcard">
              <div class="vthumb" data-video="5N28rVS-pJE">
                <img
                  src="<?= esc($asset_base) ?>image/thb-3.png"
                  alt="GFC Treatment Result Testimonial"
                  loading="lazy"
                  decoding="async"
                  width="740"
                  height="740"
                  style="width:100%;height:auto;object-fit:cover;">
                <div class="play-yt"></div>
              </div>
              <div class="vbody">
                <p class="vtxt">PRP Therapy Hair Treatments at AK Clinics</p>
              </div>
            </div>
          </div>




          <div class="swiper-slide">
            <div class="vcard">
              <div class="vthumb" data-video="VjSsh6-t1IE">
                <img
                  src="<?= esc($asset_base) ?>image/thb-4.png"
                  alt="GFC Treatment Result Testimonial"
                  loading="lazy"
                  decoding="async"
                  width="740"
                  height="740"
                  style="width:100%;height:auto;object-fit:cover;">
                <div class="play-yt"></div>
              </div>
              <div class="vbody">
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
        <h2 class="section-title">Laser Hair Removal Reviews – AK Clinics <?= esc($cityName) ?></h2>
      </div>

      <div class="swiper" id="revSwiper" style="margin-top:12px">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div class="review">
              <strong>Harpreet Singh</strong> ★★★★★<br>
              “Did <b>full back + shoulders laser</b>. Cooling made it comfortable and sessions were quick.
              Hair growth is now very fine after 4 sittings. Clean clinic and dermatologist-led.”
            </div>
          </div>

          <div class="swiper-slide">
            <div class="review">
              <strong>Simran Kaur</strong> ★★★★★<br>
              “I chose <b>underarms + bikini laser</b>. Virtually painless, super hygienic rooms, and
              no ingrown hair now. Noticeable reduction by the 2nd session.”
            </div>
          </div>

          <div class="swiper-slide">
            <div class="review">
              <strong>Vikram Arora</strong> ★★★★★<br>
              “Great results with <b>full legs laser</b>. Staff explained gaps between sessions and aftercare.
              Faster than waxing and no downtime—went to work right after.”
            </div>
          </div>

          <div class="swiper-slide">
            <div class="review">
              <strong>Neha Sharma</strong> ★★★★★<br>
              “Facial hair due to PCOS—went for a <b>face & neck package</b>. Doctors set parameters
              for my skin tone; texture improved and growth slowed considerably.”
            </div>
          </div>

          <div class="swiper-slide">
            <div class="review">
              <strong>Rahul Mehta</strong> ★★★★★<br>
              “<b>Chest + abdomen laser</b> at the <?= esc($cityName) ?> centre. US-FDA machine, quick passes,
              and clear pre/post care. Highly recommend for long-term reduction.”
            </div>
          </div>

          <div class="swiper-slide">
            <div class="review">
              <strong>Amandeep K.</strong> ★★★★★<br>
              “Took the <b>full body package</b>. Sessions were on time and comfortable with cooling gel.
              Ingrown hair gone and skin feels smoother.”
            </div>
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
          <div class="faq-q">Which areas can be treated with laser hair removal?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Face & neck, underarms, arms, chest, abdomen, back, bikini/Brazilian, thighs, calves, hands, and feet. Full body packages are available.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Is laser hair removal safe for Indian skin tones?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. We use US-FDA approved systems and dermatologist-set parameters suitable for melanin-rich skin to minimize risks like pigmentation.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Does it hurt?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Most patients describe a mild snap/tingle. Cooling tips and gels keep sessions comfortable.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How many sessions will I need?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Typically 6–8 sessions spaced 4–6 weeks apart, depending on hair thickness, area, and growth cycle. Maintenance may be advised.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">What results can I expect and how soon?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">You’ll notice slower regrowth and finer hair after 2–3 sessions, with long-term reduction after completing the plan.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Is there any downtime after a session?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">No. Mild redness can appear temporarily and settles quickly. You can resume routine activities the same day.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How should I prepare before my appointment?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Shave the area 24 hours prior. Avoid waxing/epilators 3–4 weeks before, and limit sun exposure or active tanning.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Can I do laser if I have PCOS or hormonal hair growth?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. It’s effective for reduction; some patients may need additional maintenance sessions due to hormonal triggers.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Are there any side effects?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Temporary redness or warmth is common. Rare risks are minimized with dermatologist supervision and proper aftercare.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">What aftercare should I follow?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Use soothing gels/sunscreen, avoid hot showers, scrubs, and direct sun for 24–48 hours, and don’t wax between sessions.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How much does laser hair removal cost at AK Clinics <?= esc($cityName) ?> NCR?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Pricing depends on the area(s) treated and the number of sessions. Full body and combo packages are available. A personalized quote is shared after consultation.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Do you offer EMI / 0% finance options?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes, easy EMI and 0% finance options are available.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Can patients from outside <?= esc($cityName) ?> book a consultation?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. We offer both in-clinic and online consultations for patients across India and abroad.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Who performs the procedure?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">All sessions are performed by trained therapists under dermatologist supervision with doctor-set parameters.</div>
        </div>

      </div>
    </div>
  </section>


  <!-- ===== Cost Calculator CTA Widget ===== -->
  <section class="cta-widget">
    <div class="container">
      <h3>Get Gentle, quick, long-lasting hair reduction</h3>
      <p>Minimal discomfort, zero downtime. See if you’re a good candidate.</p>
      <button class="cta-btn-white" id="openCalc">Am I Eligible?</button>
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
          <p class="modal-sub">We’ll use this detail to send your personalized laser hair removal plan (sessions & cost).</p>
          <div class="row">
            <input type="hidden" name="lp_url" value="<?= esc(base_url()) ?>" />
<input type="hidden" name="lead_source" value="<?= esc($campaign_id ?? $source_id, 'attr') ?>">
                    <input type="hidden" name="page_type" value="<?= esc($page_type, 'attr') ?>">
                    <input type="hidden" name="location_slug" value="<?= esc($location_slug, 'attr') ?>">
            <input type="hidden" name="service" value="<?= esc($service, 'attr') ?>">
            <input type="hidden" name="paid_lead" value="yes">
            <input type="hidden" name="page_url" value="<?= esc($landing_page) ?>">
            <input class="input" id="ccName" placeholder="Full name*" name="name" autocomplete="name" required>
            <input class="input" id="ccPhone" type="number" placeholder="Phone*" name="mobile_no" autocomplete="tel" required>
            <input class="input" id="ccCity" placeholder="City*" name="cliniccity" autocomplete="address-level2" required>
            <input type="email" class="input" id="ccEmail" placeholder="Email (optional)" name="email" autocomplete="email">
          </div>
          <div class="modal-actions">
            <button type="submit" class="btn primary">Submit</button>
          </div>
        </div>

        <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>
      </form>
    </div>
  </div>

  <button class="calc-fab" id="calcFab" type="button" aria-label="Open cost calculator">
    Get Free Quotes
  </button>
  <footer class="footer-slim">
    <div class="container">
      <div>© <span id="yr"></span> AK Clinics - All rights reserved</div>
      <div><em>*One of India’s most trusted names for quality Laser hair Removal in <?= esc($cityName) ?> NCR.</em></div>
    </div>
  </footer>


  <!-- Mobile quick actions -->
  <div class="mobile-bar">
    <a class="mobile-btn"
      href="<?= esc($wa_url) ?>"_blank" rel="noopener">WhatsApp</a>
    <a class="mobile-btn primary" href="tel:<?= esc($phone, 'attr') ?>">Call Now</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
  

  <!-- ✅ jQuery Validation Plugin -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script defer src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
  <script src="<?= esc($script_url) ?>?v=1"></script>

  
<script>
window.AK_LANDING = {
  submitUrl: <?= json_encode($submit_url) ?>,
  pageType: <?= json_encode($page_type) ?>,
  locationSlug: <?= json_encode($location_slug) ?>,
city: <?= json_encode($cityName) ?>
};
</script>
<script src="<?= esc(base_url('js/landing-tracking.js')) ?>"></script>
<script src="<?= esc(base_url('js/landing-forms.js')) ?>"></script>
<script src="<?= esc(base_url('js/landing-calculator.js')) ?>"></script>
<script type='text/javascript'>
    (function(I, L, T, i, c, k, s) {
      if (I.iticks) return;
      I.iticks = {
        host: c,
        settings: s,
        clientId: k,
        cdn: L,
        queue: []
      };
      var h = T.head || T.documentElement;
      var e = T.createElement(i);
      var l = I.location;
      e.async = true;
      e.src = (L || c) + '/client/inject-v2.min.js';
      h.insertBefore(e, h.firstChild);
      I.iticks.call = function(a, b) {
        I.iticks.queue.push([a, b]);
      };
    })(window, 'https://cdn-v1.intelliticks.com/prod/common', document, 'script', 'https://app.intelliticks.com', 'kEEbS63MgGiojbePd_c', {});
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
          .replace(/[^\d+]/g, '') // allow digits and '+'
          .replace(/(?!^)\+/g, ''); // only one '+' allowed at the start
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
  <script>
    /* HL Services – 4 fixed tabs (same content), scoped switching */
    (function() {
      const root = document.getElementById('hl-services');
      if (!root) return;
      const $ = sel => root.querySelector(sel);
      const $$ = sel => Array.from(root.querySelectorAll(sel));

      const tabs = $$('.svc-tab');
      const panels = $$('#svcs-panels .svcs-panel');
      const isMobile = () => matchMedia('(max-width:720px)').matches;

      function setActive(id) {
        panels.forEach(p => {
          const on = p.id === id;
          p.classList.toggle('active', on);
          p.toggleAttribute('hidden', !on);
        });
        tabs.forEach(t => {
          const on = (t.dataset.target || '') === id;
          t.classList.toggle('active', on);
          t.setAttribute('aria-selected', on);
          t.setAttribute('tabindex', on ? '0' : '-1');
        });
      }

      function scrollToPanel(id) {
        const pane = $('#' + id);
        if (pane) pane.scrollIntoView({
          behavior: 'smooth',
          inline: 'start',
          block: 'nearest'
        });
      }

      tabs.forEach(tab => {
        tab.addEventListener('click', () => {
          const id = tab.dataset.target;
          if (!id) return;
          if (isMobile()) scrollToPanel(id);
          else setActive(id);
        });
      });

      // Ensure first tab is active
      if (tabs[0]?.dataset.target) setActive(tabs[0].dataset.target);
    })();
  </script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const tabs = document.querySelectorAll(".svc-tab");
      const panels = document.querySelectorAll(".svcs-panel");

      tabs.forEach(tab => {
        tab.addEventListener("click", function() {
          // Remove active states from all tabs
          tabs.forEach(t => {
            t.classList.remove("active");
            t.setAttribute("aria-selected", "false");
          });

          // Hide all panels
          panels.forEach(p => {
            p.classList.remove("active");
            p.setAttribute("hidden", true);
          });

          // Activate clicked tab
          this.classList.add("active");
          this.setAttribute("aria-selected", "true");

          // Show related panel
          const targetId = this.getAttribute("data-target");
          const targetPanel = document.getElementById(targetId);
          if (targetPanel) {
            targetPanel.classList.add("active");
            targetPanel.removeAttribute("hidden");
          }
        });
      });
    });
  </script>


  <style>
    .svcs-panel {
      display: none;
    }

    .svcs-panel.active {
      display: block;
    }

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