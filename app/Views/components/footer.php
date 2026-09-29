<?php
/**
 * Shared landing footer + mobile bar.
 *
 * @var string $cityName
 * @var string $phone
 * @var string $wa_url
 * @var string $service
 */
?>
    <footer class="footer-slim">
        <div class="container">
            <div>© <span id="yr"></span> AK Clinics - All rights reserved</div>
            <div><em>*One of India’s most trusted names for quality <?= esc(strtolower($service)) ?> in <?= esc($cityName) ?>.</em></div>
        </div>
    </footer>

    <!-- Mobile quick actions -->
    <div class="mobile-bar">
        <a class="mobile-btn"
            href="<?= esc($wa_url) ?>"
            target="_blank" rel="noopener">WhatsApp</a>
        <a class="mobile-btn primary" href="tel:<?= esc($phone, 'attr') ?>">Call Now</a>
    </div>
    <script>document.getElementById('yr') && (document.getElementById('yr').textContent = new Date().getFullYear());</script>
