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
        <h1>Regain your hair. <br>Regain your confidence.</h1>
        <p>Say goodbye to thinning hair and hair fall worries. At AK Clinics, we help you address the root cause of hair loss with the right treatments - not just temporary fixes.</p>
        <ul class="hero-list">
          <li>American Board Certified Doctors</li>
          <li>20+ Years of Hair Restoration Expertise</li>
          <li>Customized Hair Loss Solutions (PRP | GFC | Medical | Transplant)</li>
          <li>Transparent pricing & 0% Easy EMI</li>


        </ul>
      </div>
      <aside class="form-card" id="assessment">
        <h3>Get Your Free Hair Assessment Now!</h3>
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
                        <?php foreach ($clinic_options as $slug => $opt): ?>
                        <option value="<?= esc($opt['city_api'], 'attr') ?>" <?= $location_slug === $slug ? 'selected' : '' ?>><?= esc($opt['label']) ?></option>
                        <?php endforeach; ?>
                    </select>

          <label class="consent-label" style="display:flex;gap:8px;align-items:flex-start;font-size:13px;line-height:1.4;cursor:pointer;color:#444">
            <input type="checkbox" name="contact_consent" value="1" required style="margin-top:3px;flex-shrink:0">
            <span>I agree to be contacted by AK Clinics via call, SMS, WhatsApp, or email regarding my enquiry.</span>
          </label>
          <label id="contact_consent-error" class="error contact-consent-error" for="contact_consent" style="display:none"></label>

          <button type="submit" class="btn-primary">Submit Now<i class="fas fa-arrow-right"></i></button>
        </form>
        <div id="sendlead-show" style="display:none;">Thank you! Your lead is submitted.</div>
        <div class="form-note">Get best hair treatments in <?= esc($cityName) ?>. T&C apply.</div>
      </aside>
    </div>
    <div class="ticker">
      <div class="container">
        <div class="t-track">
          <div class="t-item"><span class="t-icon">✔</span>No.1 Hair Growth Clinic</div>
          <div class="t-item"><span class="t-icon">✔</span>Say Goodbye to Hair Loss</div>
          <div class="t-item"><span class="t-icon">✔</span>100% Safe & Pain-Free</div>
          <div class="t-item"><span class="t-icon">✔</span>Experienced Dermatologists</div>
          <div class="t-item"><span class="t-icon">✔</span>Personalised Treatments</div>
          <div class="t-item"><span class="t-icon">✔</span>Life-Changing Results</div>
          <div class="t-item"><span class="t-icon">✔</span>Book Free Consultation Now</div>
        </div>
      </div>
    </div>
  </section>

  <!-- Tabs / RESULTS -->
  <section class="section" id="results">
    <div class="container">
      <div class="section-head">
        <h2 class="section-title">Celebrity-Trusted | <?= esc($loc['possessive']) ?> Best Clinic for Hair Loss Treatment</h2>
      </div>
      <p class="lead">5,000+ Successful Hair Restorations • 20+ Years of Expertise • Advanced Treatment Techniques</p>

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
            <h2 style="margin:0 0 10px">#1 Hair Loss Treatment Clinic in <?= esc($topbarCity) ?></h3>
              <p style="margin:0 0 10px; color:#667085;">Choosing the right clinic is the first step toward stopping hair fall and restoring hair health. At AK Clinics, <?= esc($cityName) ?>, we focus on treating hair loss from the root cause using medically proven and dermatologist-led solutions. Every treatment is designed to deliver long-lasting, natural results with complete safety and care.</p>
              <p style="margin:0 0 10px; color:#667085;"><?= esc($addressPhrase) ?> center is one of India’s most trusted names for advanced hair restoration. Backed by 20+ years of expertise and 10,000+ successful patient journeys, our team of experienced dermatologists offers a wide range of solutions, from medical therapy and PRP/GFC treatments to advanced hair restoration techniques.</p>
              <p style="margin:0 0 10px; color:#667085;">With a success rate of over 95% and thousands of happy patients, including celebrities and professionals, AK Clinics has become a trusted destination for anyone looking to regain healthy, fuller hair.</p>
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
                At AK Clinics, we believe every patient deserves a treatment plan designed specifically for their hair concerns. Whether it’s early-stage hair fall or advanced hair loss, our team focuses on safe, effective, and result-driven solutions, without any hidden costs.

              </p>
              <ul class="ul-check">
                <li>India’s Leading Hair Loss & Hair Restoration Clinics</li>
                <li>Treatments Performed by Experienced Dermatologists</li>
                <li>20+ Years of Expertise & 10,000+ Happy Patients</li>
                <li>Advanced PRP, GFC & Medical Hair Restoration Techniques</li>
                <li>Trusted by Celebrities & Recommended by Patients Across India & Abroad</li>
                <li>Transparent Pricing with 0% EMI Options</li>
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
                At AK Clinics, we believe every patient deserves a treatment plan designed specifically for their hair concerns. Whether it’s early-stage hair fall or advanced hair loss, our team focuses on safe, effective, and result-driven solutions, without any hidden costs.

              </p>
              <ul class="ul-check">
                <li>India’s Leading Hair Loss & Hair Restoration Clinics</li>
                <li>Treatments Performed by Experienced Dermatologists</li>
                <li>20+ Years of Expertise & 10,000+ Happy Patients</li>
                <li>Advanced PRP, GFC & Medical Hair Restoration Techniques</li>
                <li>Trusted by Celebrities & Recommended by Patients Across India & Abroad</li>
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
      <h2 class="section-title">Advanced Hair Loss Treatments in <?= esc($cityName) ?></h2>
      <p class="lead">Dermatologist-led solutions to stop hair fall and boost natural hair growth.</p>


      <!-- 4 fixed tabs -->
      <ul class="svc-tabs" role="tablist" aria-label="HL Services">
        <li role="presentation">
          <button class="svc-tab active" id="tab-hl" role="tab" aria-selected="true" aria-controls="panel-hl" data-target="panel-hl">
            <img src="<?= esc($asset_base) ?>image/serv-icon-1.png" alt="">
            <span>PRP</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-prp" role="tab" aria-selected="false" aria-controls="panel-prp" tabindex="-1" data-target="panel-prp">
            <img src="<?= esc($asset_base) ?>image/serv-icon-2.png" alt="">
            <span>GFC</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-gfc" role="tab" aria-selected="false" aria-controls="panel-gfc" tabindex="-1" data-target="panel-gfc">
            <img src="<?= esc($asset_base) ?>image/serv-icon-3.png" alt="">
            <span>Hair Transplant</span>
          </button>
        </li>
        <li role="presentation">
          <button class="svc-tab" id="tab-other" role="tab" aria-selected="false" aria-controls="panel-other" tabindex="-1" data-target="panel-other">
            <img src="<?= esc($asset_base) ?>image/serv-icon-4.png" alt="">
            <span>Others</span>
          </button>
        </li>
      </ul>

      <!-- Panels: same content + ONE image -->
      <div class="svcs-panels" id="svcs-panels">
        <!-- Panel 1 -->
        <section class="svcs-panel active" id="panel-hl" role="tabpanel" aria-labelledby="tab-hl">

          <div class="svc-card">
            <div class="svc-copy">
              <h3>PRP Hair Treatments in <?= esc($cityName) ?></h3>
              <p>PRP is one of the most effective and natural solutions to control hair fall and boost hair growth without surgery. It uses your body’s own growth factors to rejuvenate hair follicles and improve hair density. At AK Clinics, PRP treatments are performed by experienced dermatologists using advanced protocols to ensure safe, long-lasting results.</p>
              <h4>Who Are the Ideal Candidates for PRP Hair Treatment?</h4>
              <p>PRP works best for men and women with early to moderate hair loss, thinning hair, or receding hairlines. It’s also great for seasonal hair fall and post-transplant support.</p>
              <h4>Why Avail Hair Transplant Surgery At AK Clinics?</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>Safe, non-surgical procedure</li>
                  <li>Boosts natural hair growth</li>
                  <li>Quick sessions with no downtime</li>
                </ul>
                <ul class="svc-list">
                  <li>Performed by experienced dermatologists</li>
                  <li>Trusted by 10,000+ happy patients</li>
                </ul>

              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="/landing/hair-transplant/Dummy/image/prp.jpg" alt="Clinic infrastructure">
            </figure>
          </div>
        </section>

        <!-- Panel 2 (same content) -->
        <section class="svcs-panel" id="panel-prp" role="tabpanel" aria-labelledby="tab-prp" hidden>
          <div class="svc-card">
            <div class="svc-copy">
              <h3>GFC Hair Treatments in <?= esc($cityName) ?></h3>
              <p>
                GFC (Growth Factor Concentrate) is a next-generation regenerative therapy designed to target hair thinning and weak roots.
                By delivering a high concentration of pure growth factors, it accelerates follicle repair and stimulates stronger, denser hair growth.
                <strong>At AK Clinics</strong>, this procedure is performed under strict dermatological protocols to ensure safety, precision, and visible results.
              </p>
              <h4>Who Are the Ideal Candidates for GFC Hair Treatment?</h4>
              <p>
                GFC works best for individuals with early to moderate hair thinning, reduced density, or slow hair growth.
                It’s also suitable for those who want to strengthen hair without surgery.
              </p>
              <h4>Why Choose GFC Hair Treatment At AK Clinics?</h4>
              <div class="svc-listgrid">
                <ul class="svc-list">
                  <li>High concentration of growth factors for faster results</li>
                  <li>Strengthens hair roots and boosts density</li>
                  <li>Painless, minimally invasive procedure</li>
                </ul>
                <ul class="svc-list">
                  <li>Expert dermatologists with advanced protocols</li>
                  <li>Trusted by 10,000+ happy patients</li>
                </ul>
              </div>
              <div class="cta-wrap"><button class="svc-cta" type="button" id="get-free-assement-btn1">Get Free Assessment →</button></div>
            </div>
            <figure class="svc-figure">
              <img src="/landing/hair-transplant/Dummy/image/gfc.jpg" alt="Clinic infrastructure">
            </figure>
          </div>

        </section>

        <!-- Panel 3 (same content) -->
        <section class="svcs-panel" id="panel-gfc" role="tabpanel" aria-labelledby="tab-gfc" hidden>
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

        </section>

        <!-- Panel 4 (same content) -->
        <section class="svcs-panel" id="panel-other" role="tabpanel" aria-labelledby="tab-other" hidden>
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

        </section>
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
      <p class="lead">Hear from real patients who regained confidence through advanced hair restoration treatments at AK Clinics.</p>

      <div class="swiper" id="videoSwiper">
        <div class="swiper-wrapper">



          <div class="swiper-slide">
            <div class="vcard">
              <div class="vthumb" data-video="vJkS50da1YE">
                <img
                  src="<?= esc($asset_base) ?>image/gfc-result.webp"
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
              <div class="vthumb" data-video="-ps-T39RGeQ">
                <img
                  src="<?= esc($asset_base) ?>image/Hairfall-Bglr.webp"
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
                <p class="vtxt">PRP Therapy Hair Treatments at AK Clinics</p>
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
          <div class="faq-q">What hair loss treatments are available at AK Clinics, <?= esc($cityName) ?>?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">We offer PRP therapy, GFC treatment, medical management, and advanced hair transplant techniques like Bio-FUE and DHT. The right treatment depends on your hair loss stage and overall scalp health.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How do I know which treatment is right for me?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Our dermatologists perform a detailed scalp and hair analysis to assess your condition and recommend a personalized treatment plan — starting with medical or non-surgical options for early hair loss and transplants for advanced cases.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How soon can I expect to see results from hair loss treatments?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Most patients notice visible improvement within 3 to 4 months. PRP and GFC may require multiple sessions, while hair transplant results develop fully over 9 to 12 months.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Are PRP and GFC treatments painful?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">These are minimally invasive treatments performed under local anesthesia or numbing. Most patients experience little to no discomfort and can resume normal activities the same day.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Can early hair loss be treated without surgery?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. For early hair thinning or hair fall, treatments like PRP, GFC, and medical management can deliver excellent results without the need for surgery.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Who performs the treatments at AK Clinics?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">All treatments are performed by experienced dermatologists and hair restoration surgeons. Every procedure is doctor-led to ensure safety and natural-looking outcomes.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Is there any downtime after PRP or GFC sessions?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">No. You can return to your routine activities immediately after the session. Mild redness may occur temporarily but subsides quickly.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How many sessions will I need?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">It depends on the treatment and hair loss severity. PRP and GFC usually need 3–6 sessions. Medical treatment is ongoing, while transplant is typically a single procedure.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Are the results of hair loss treatments permanent?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">PRP and GFC results last as long as follicles remain healthy and can be maintained with follow-ups. Hair transplant results are permanent, though maintenance care is advised for existing hair.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Do you offer EMI or 0% finance options?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes, we offer easy EMI and 0% finance options to make treatments more affordable and accessible.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Can patients from outside <?= esc($cityName) ?> book a consultation?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. We offer both in-clinic and online consultations for patients from across India and abroad.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Are these treatments safe for both men and women?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Yes. All hair loss treatments at AK Clinics are clinically safe and suitable for both men and women.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">Is hair transplant the only option for advanced baldness?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">For significant baldness, a hair transplant is often the most effective and permanent solution. Our doctors assess candidacy before recommending surgery.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">What kind of post-treatment care do you provide?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">We provide structured follow-up care, including scalp check-ups, home care guidance, and maintenance support to ensure lasting results.</div>
        </div>

        <div class="faq-item">
          <div class="faq-q">How much does hair loss treatment cost at AK Clinics?
            <svg class="chev" width="18" height="18" viewBox="0 0 24 24" fill="none">
              <path d="M6 9l6 6 6-6" stroke="#111" stroke-width="2" />
            </svg>
          </div>
          <div class="faq-a">Cost depends on the treatment type, hair loss severity, and sessions required. PRP and GFC are charged per session, while transplant costs depend on the number of grafts. A personalized quote is shared after consultation.</div>
        </div>

      </div>
    </div>
  </section>


  <!-- ===== Cost Calculator CTA Widget ===== -->
  <section class="cta-widget">
    <div class="container">
      <h3>Not sure which hair loss treatment is right for you?</h3>
      <p>Get a personalized treatment estimate in 3 quick steps.</p>
      <button class="cta-btn-white" id="openCalc">Get Free consultation</button>
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
            <input class="input" id="ccPhone" type="number" placeholder="Phone*" name="mobile_no" autocomplete="tel">
            <input class="input" id="ccCity" placeholder="City*" name="cliniccity" autocomplete="address-level2">
            <input class="input" id="ccEmail" placeholder="Email (optional)" name="email" autocomplete="email">
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
        <!-- <p class="modal-sub">
            Based on your selection (<strong>Norwood <span id="nwStage"></span></strong>), here is the possible requirement in your case:
            <strong><span id="graftCount"></span></strong>
          </p> -->

        <p class="modal-sub" id="treatmentMessage"></p>

        <p class="modal-sub" id="disclaimer">
          <strong> Your details have been submitted successfully.
            Our patient advisor will contact you within 24 hours to discuss the best hair loss treatment options tailored just for you.</strong>
        </p>

        <div class="modal-actions">
          <button class="btn primary" id="closeDone">Close</button>
        </div>
      </div>
    </div>
  </div>
  <button class="calc-fab" id="calcFab" type="button" aria-label="Open cost calculator">
    Get Free consultation
  </button>
  <footer class="footer-slim">
    <div class="container">
      <div>© <span id="yr"></span> AK Clinics - All rights reserved</div>
      <div><em>*One of India’s most trusted names for quality hair treatments in <?= esc($cityName) ?>.</em></div>
    </div>
  </footer>


  <!-- Mobile quick actions -->
  <div class="mobile-bar">
    <a class="mobile-btn wa"
      href="<?= esc($wa_url) ?>"
      target="_blank" rel="noopener"><svg class="wa-icon" viewBox="0 0 24 24" width="20" height="20" aria-hidden="true" focusable="false"><path fill="currentColor" d="M17.47 14.38c-.3-.15-1.76-.87-2.03-.97-.27-.1-.47-.15-.67.15-.2.3-.77.97-.94 1.17-.17.2-.35.22-.65.07-.3-.15-1.26-.46-2.4-1.48-.89-.79-1.49-1.77-1.66-2.07-.17-.3-.02-.46.13-.61.13-.13.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.62-.92-2.22-.24-.58-.49-.5-.67-.51h-.57c-.2 0-.52.07-.8.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.08.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.23 1.36.2 1.87.12.57-.09 1.76-.72 2.01-1.41.25-.7.25-1.29.17-1.41-.07-.13-.27-.2-.57-.35M12.05 21.79h-.01a9.87 9.87 0 0 1-5.03-1.38l-.36-.21-3.74.98 1-3.65-.24-.37a9.86 9.86 0 0 1-1.51-5.26c0-5.45 4.44-9.88 9.89-9.88 2.64 0 5.12 1.03 6.99 2.9a9.82 9.82 0 0 1 2.89 6.99c0 5.45-4.44 9.88-9.89 9.88m8.41-18.3A11.81 11.81 0 0 0 12.05 0C5.5 0 .16 5.34.16 11.89c0 2.1.55 4.14 1.59 5.95L.06 24l6.3-1.65a11.88 11.88 0 0 0 5.68 1.45h.01c6.55 0 11.89-5.34 11.89-11.89 0-3.18-1.24-6.16-3.48-8.41"/></svg><span>WhatsApp</span></a>
    <a class="mobile-btn primary" href="tel:<?= esc($phone, 'attr') ?>">Call Now</a>
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- ✅ jQuery Validation Plugin -->
  <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
  <script defer src="https://unpkg.com/swiper@9/swiper-bundle.min.js"></script>
  <script src="<?= esc($script_url) ?>?v=1"></script>

  
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
document.addEventListener("DOMContentLoaded", function () {
  const tabs = document.querySelectorAll(".svc-tab");
  const panels = document.querySelectorAll(".svcs-panel");

  tabs.forEach(tab => {
    tab.addEventListener("click", function () {
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