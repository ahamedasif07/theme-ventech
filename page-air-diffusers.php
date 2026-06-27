<?php

/**
 * Template Name: Air-diffusers page
 *
 * Matches about.tsx exactly:
 *  1. Page Header (banner with hero image background)
 *  2. Intro paragraph (centered, with blue highlight)
 *  3. "Why Choose Us" blue section (2-col card grid)
 *  4. Head Office info (address, phone, email)
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'title'     => 'About',
    'image_url' => ventech_image_url('hero-ceiling.jpg'),
]);
?>


<!-- ====================================================
     SECTION 2: INTRO PARAGRAPH
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section class="section-about-intro">
    <div class="container">
        <p>
            Ventech (Aust) Pty Ltd is one of the leading manufacturers in
            Australia&nbsp;<span class="text-brand-blue">which specialises in manufacturing Grilles, Diffusers, Dampers
                and Cushion Boxes</span>&nbsp;with fast turnaround times.
        </p>
    </div>
</section>


<!-- ====================================================
     SECTION 3: WHY CHOOSE US
     Matches: <section className="bg-brand-blue py-20">
     ==================================================== -->
<section class="section-why-us">
    <div class="container container--wide">
        <h2>Why choose us</h2>

        <div class="why-us-grid">

            <!-- Card 1: Fast Turnaround -->
            <div class="why-us-card">
                <h3>Your Deadline, Our Priority — Fast Turnaround Guaranteed</h3>
                <p>
                    At Ventech, we are committed to offering our clients services
                    and products with competitive prices, great quality and mostly
                    importantly,&nbsp;<span style="font-weight:600; color: var(--brand-red);">fast turnaround
                        time.</span>
                </p>
            </div>

            <!-- Card 2: Warranty -->
            <div class="why-us-card">
                <h3>Our Warranty against Defects</h3>
                <p>
                    Ventech Engineers are regularly seeking to develop new designs
                    and technologies to achieve better product performance, easier
                    installation and higher quality products YEAR AFTER YEAR.
                </p>
                <p class="we-will-label">We will:</p>
                <ul>
                    <?php
                    $warranty_points = [
                        'Repair or replace the goods promptly.',
                        'Replace or rectify the services.',
                        'Wholly or partly compensate the customer.',
                    ];
                    foreach ($warranty_points as $point) : ?>
                        <li>
                            <?php echo ventech_icon('check-circle', 'icon icon--sm'); ?>
                            <span><?php echo esc_html($point); ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>
</section>


<!-- ====================================================
     SECTION 4: HEAD OFFICE
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section class="section-head-office">
    <div class="container container--wide">
        <h2>Head Office</h2>

        <div class="office-info-grid">

            <!-- Address -->
            <div class="office-info-item">
                <?php echo ventech_icon('map-pin', 'icon icon--md'); ?>
                <div>
                    <p>Address</p>
                    <p>14-18 Mills Street, Cheltenham, 3192</p>
                </div>
            </div>

            <!-- Phone -->
            <div class="office-info-item">
                <?php echo ventech_icon('phone', 'icon icon--md'); ?>
                <div>
                    <p>Phone</p>
                    <p><a href="tel:0395832400">(03) 9583 2400</a></p>
                </div>
            </div>

            <!-- Email -->
            <div class="office-info-item">
                <?php echo ventech_icon('mail', 'icon icon--md'); ?>
                <div>
                    <p>Email</p>
                    <p><a href="mailto:sales@ventechgrilles.com.au">sales@ventechgrilles.com.au</a></p>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer(); ?>