<?php
/**
 * Shared landing topbar + header.
 *
 * @var array $location
 * @var string $phone
 * @var string $phoneDisplay
 * @var string $topbarCity
 * @var array $page
 */
?>
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
            <div class="brand">
                <div class="brand-badge">AK</div> AK Clinics
            </div>
            <nav class="nav" aria-label="Primary">
                <a href="#results">Results</a><a href="#treatments">Treatments</a><a href="#doctors">Doctors</a><a
                    href="#testimonials">Testimonials</a><a href="#reviews">Reviews</a><a href="#faq">FAQ</a>
            </nav>
            <a class="cta-btn" href="#assessment">Free Assessment</a>
            <button id="hamb" class="hamburger" type="button" aria-label="Menu"><span></span></button>
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
