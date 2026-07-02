<?php

/**
 * Template Name: Front Page
 *
 * Home page — matches index.tsx exactly.
 *
 * Sections:
 *  1. Hero
 *  2. Welcome
 *  3. Products (4-card 2-col grid)
 *  4. Projects / Regions (3-col region cards)
 *  5. Contact CTA band
 */

defined('ABSPATH') || exit;

get_header();

$products_page_url = esc_url(get_permalink(get_page_by_path('products')));
$about_page_url    = esc_url(get_permalink(get_page_by_path('about')));
$projects_page_url = esc_url(get_permalink(get_page_by_path('projects')));
$contact_page_url  = esc_url(get_permalink(get_page_by_path('contact')));

$products = [
    [
        'name'        => 'Air Diffusers ',
        'image'       => ventech_image_url('diffuser.png'),
        'description' => 'Diffusers are devices used in HVAC systems to distribute air in a space evenly and efficiently. They are installed on the end of air ducts and work by diffusing or dispersing the air in various directions, typically upwards, downwards, or in a horizontal pattern.',
    ],
    [
        'name'        => 'Register & Grilles ',
        'image'       => ventech_image_url('grilles.png'),
        'description' => 'Grilles are devices used to cover openings or vents in a buildings walls, floors, or ceilings, while allowing the passage of air or light. They are commonly used in HVAC systems to distribute air or to return it to the air handler, but they can also serve decorative or security purposes.',
    ],
    [
        'name'        => 'Dampers',
        'image'       => ventech_image_url('dempers.png'),
        'description' => 'Dampers are devices used to reduce or control the movement, vibration, or oscillation of a structure or system. They work by dissipating or absorbing energy, and they can be found in a wide range of applications, from automotive suspensions to HVAC systems.',
    ],
    [
        'name'        => 'Louvres',
        'image'       => ventech_image_url('louvres.png'),
        'description' => 'Louvres, also known as louvers, are a type of window or ventilation system that consists of horizontal slats or blades angled to allow air and light to enter a building while blocking out rain, direct sunlight, and noise.',
    ],
];

$regions = [
    ['name' => 'Victoria',         'image' => ventech_image_url('region-vic.jpg')],
    ['name' => 'New South Wales',  'image' => ventech_image_url('region-nsw.jpg')],
    ['name' => 'Queensland',       'image' => ventech_image_url('region-qld.jpg')],
];
?>

<!-- ====================================================
     1. HERO SLIDER
     · Background: white
     · Content: LEFT  |  Image: RIGHT
     · 3 default slides (editable via Dashboard → Featured Slides)
     · Add / remove / reorder slides from the dashboard
     ==================================================== -->
<?php

/* ── Pull slides from database ─────────────────────────── */
$slide_query = new WP_Query([
    'post_type'      => 'ventech_slide',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'meta_key'       => '_vc_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
]);

/* ── 3 built-in default slides (shown when DB is empty) ─── */
$default_slides = [
    [
        'eyebrow'   => 'Ventech (Aust) Pty Ltd',
        'title'     => '<span class="vc-highlight">Built for Performance.</span><br>Designed for Air.',
        'desc'      => 'We develop new designs and technologies to achieve better product performance, easier installation and higher quality products year after year.',
        'btn1_lbl'  => 'Learn More',
        'btn1_url'  => $about_page_url,
        'btn2_lbl'  => 'Contact Us',
        'btn2_url'  => $contact_page_url,
        'image'     => ventech_image_url('diffuser.png'),
    ],
    [
        'eyebrow'   => 'Our Products',
        'title'     => 'Grilles &amp; <span class="vc-highlight">Diffusers</span><br>Built to Last.',
        'desc'      => 'Ventech specialises in manufacturing high-quality Grilles, Diffusers, Dampers, Cushion Boxes and Ducts with fast turnaround times across Australia.',
        'btn1_lbl'  => 'View Products',
        'btn1_url'  => $products_page_url,
        'btn2_lbl'  => '',
        'btn2_url'  => '',
        'image'     => ventech_image_url('grilles.png'),
    ],
    [
        'eyebrow'   => 'Our Projects',
        'title'     => 'Trusted Across<br><span class="vc-highlight">Australia.</span>',
        'desc'      => 'From Victoria to Queensland, Ventech supplies HVAC solutions to commercial and industrial projects of all sizes. Discover our regional project portfolio.',
        'btn1_lbl'  => 'See Projects',
        'btn1_url'  => $projects_page_url,
        'btn2_lbl'  => 'Contact Us',
        'btn2_url'  => $contact_page_url,
        'image'     => ventech_image_url('louvres.png'),
    ],
];

$use_db_slides = $slide_query->have_posts();
?>

<section class="vc-hero-slider" role="region" aria-label="Hero slider" tabindex="0">

    <!-- ARIA live region -->
    <div class="vc-live-region" aria-live="polite" aria-atomic="true"></div>

    <!-- Slide track -->
    <div class="vc-carousel-track">

        <?php if ($use_db_slides) : ?>
            <?php while ($slide_query->have_posts()) : $slide_query->the_post(); ?>
            <?php
                $sid      = get_the_ID();
                $eyebrow  = get_post_meta($sid, '_vc_eyebrow',  true);
                $desc     = get_post_meta($sid, '_vc_desc',     true);
                $btn1_lbl = get_post_meta($sid, '_vc_btn1_lbl', true);
                $btn1_url = get_post_meta($sid, '_vc_btn1_url', true);
                $btn2_lbl = get_post_meta($sid, '_vc_btn2_lbl', true);
                $btn2_url = get_post_meta($sid, '_vc_btn2_url', true);
                $img_src  = has_post_thumbnail($sid)
                    ? get_the_post_thumbnail_url($sid, 'ventech-hero')
                    : ventech_image_url('diffuser.png');
            ?>
            <article class="vc-slide" aria-label="<?php echo esc_attr(get_the_title()); ?>">
                <div class="vc-slide__content">
                    <?php if ($eyebrow) : ?>
                    <p class="vc-slide__eyebrow"><?php echo esc_html($eyebrow); ?></p>
                    <?php endif; ?>
                    <h1 class="vc-slide__title"><?php echo wp_kses_post(get_the_title()); ?></h1>
                    <?php if ($desc) : ?>
                    <p class="vc-slide__desc"><?php echo esc_html($desc); ?></p>
                    <?php endif; ?>
                    <?php if ($btn1_lbl && $btn1_url) : ?>
                    <div class="vc-slide__ctas">
                        <a href="<?php echo esc_url($btn1_url); ?>" class="btn btn--primary">
                            <?php echo esc_html($btn1_lbl); ?>
                            <?php echo ventech_icon('chevron-right', 'icon icon--sm'); ?>
                        </a>
                        <?php if ($btn2_lbl && $btn2_url) : ?>
                        <a href="<?php echo esc_url($btn2_url); ?>" class="btn btn--outline">
                            <?php echo esc_html($btn2_lbl); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div><!-- /.vc-slide__content -->

                <div class="vc-slide__image-wrap">
                    <img src="<?php echo esc_url($img_src); ?>"
                         alt="<?php echo esc_attr(get_the_title()); ?>"
                         loading="eager" width="1200" height="900">
                </div><!-- /.vc-slide__image-wrap -->
            </article>
            <?php endwhile; wp_reset_postdata(); ?>

        <?php else : ?>
            <?php foreach ($default_slides as $slide) : ?>
            <article class="vc-slide" aria-label="<?php echo esc_attr(wp_strip_all_tags($slide['title'])); ?>">
                <div class="vc-slide__content">
                    <?php if ($slide['eyebrow']) : ?>
                    <p class="vc-slide__eyebrow"><?php echo esc_html($slide['eyebrow']); ?></p>
                    <?php endif; ?>
                    <h1 class="vc-slide__title"><?php echo wp_kses_post($slide['title']); ?></h1>
                    <?php if ($slide['desc']) : ?>
                    <p class="vc-slide__desc"><?php echo esc_html($slide['desc']); ?></p>
                    <?php endif; ?>
                    <?php if ($slide['btn1_lbl'] && $slide['btn1_url']) : ?>
                    <div class="vc-slide__ctas">
                        <a href="<?php echo esc_url($slide['btn1_url']); ?>" class="btn btn--primary">
                            <?php echo esc_html($slide['btn1_lbl']); ?>
                            <?php echo ventech_icon('chevron-right', 'icon icon--sm'); ?>
                        </a>
                        <?php if ($slide['btn2_lbl'] && $slide['btn2_url']) : ?>
                        <a href="<?php echo esc_url($slide['btn2_url']); ?>" class="btn btn--outline">
                            <?php echo esc_html($slide['btn2_lbl']); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div><!-- /.vc-slide__content -->

                <div class="vc-slide__image-wrap">
                    <img src="<?php echo esc_url($slide['image']); ?>"
                         alt="<?php echo esc_attr(wp_strip_all_tags($slide['title'])); ?>"
                         loading="eager" width="1200" height="900">
                </div><!-- /.vc-slide__image-wrap -->
            </article>
            <?php endforeach; ?>
        <?php endif; ?>

    </div><!-- /.vc-carousel-track -->

    <!-- Controls: prev · dots · next -->
    <div class="vc-controls" role="group" aria-label="Slider controls">
        <button class="vc-btn-prev" type="button" aria-label="Previous slide">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
        </button>

        <div class="vc-dots" role="tablist" aria-label="Slide navigation"></div>

        <button class="vc-btn-next" type="button" aria-label="Next slide">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
        </button>
    </div><!-- /.vc-controls -->

    <!-- Progress bar -->
    <div class="vc-progress" aria-hidden="true">
        <div class="vc-progress-bar"></div>
    </div>

</section><!-- /.vc-hero-slider -->


<!-- ====================================================
     2. WELCOME SECTION
     Matches: <section className="border-b border-border bg-background py-20">
     ==================================================== -->
<section class="section-welcome">
    <div class="section-welcome__inner">
        <h2>
            Welcome <span class="text-brand-blue">to Ventech</span>
        </h2>
        <p>
            Ventech (Aust) Pty Ltd is one of the leading manufacturers in
            Australia which specialises in manufacturing Grilles, Diffusers,
            Dampers, Cushion Boxes and Ducts with fast turnaround times.
        </p>
        <a href="<?php echo $about_page_url; ?>" class="btn btn--blue-outline btn--sm">
            Read more
        </a>
    </div>
</section>


<!-- ====================================================
     3. PRODUCTS SECTION
     Matches: <section className="bg-surface-soft py-20">
     ==================================================== -->
<section class="section-products-home">
    <div class="container">
        <div class="section-products-home__header">
            <span class="badge-pill">Our Products</span>
            <h2 class="section-heading section-heading--lg section-heading--center mt-6">
                We specialise <span class="text-brand-blue">in manufacturing</span>
                Grilles, Diffusers, Dampers and Ducts.
            </h2>
        </div>

        <div class="products-grid-home">
            <?php foreach ($products as $product) : ?>
                <article class="product-card-home">

                    <div class="product-card-home__body">
                        <p class="product-card-home__eyebrow">Our Products</p>
                        <h3 class="product-card-home__name">
                            <?php echo esc_html($product['name']); ?>
                        </h3>
                        <p class="product-card-home__desc">
                            <?php echo esc_html($product['description']); ?>
                        </p>
                        <a href="<?php echo $products_page_url; ?>" class="product-card-home__link">
                            See all products
                            <?php echo ventech_icon('arrow-right', 'icon icon--sm'); ?>
                        </a>
                    </div>

                    <div class="product-card-home__image-wrap">
                        <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['name']); ?>"
                            loading="lazy" width="800" height="800">
                    </div>

                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ====================================================
     4. PROJECTS / REGIONS SECTION
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section class="section-projects-home">
    <div class="container">
        <h2 class="section-heading section-heading--lg text-center">
            Discover <span class="text-brand-blue">our projects</span>
        </h2>

        <div class="regions-grid">
            <?php foreach ($regions as $region) : ?>
                <a href="<?php echo $projects_page_url; ?>" class="region-card">
                    <img src="<?php echo esc_url($region['image']); ?>" alt="<?php echo esc_attr($region['name']); ?>"
                        loading="lazy" width="1200" height="800">

                    <div class="region-card__overlay" aria-hidden="true"></div>

                    <div class="region-card__footer">
                        <h3 class="region-card__name">
                            <?php echo esc_html($region['name']); ?>
                        </h3>
                        <span class="region-card__icon" aria-hidden="true">
                            <?php echo ventech_icon('arrow-right', 'icon icon--sm'); ?>
                        </span>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</section>


<!-- ====================================================
     5. CONTACT CTA BAND
     Matches: <section className="bg-brand-blue">
     ==================================================== -->
<section class="section-contact-cta">
    <div class="contact-cta-inner">
        <h2>
            Contact us <span class="opacity-80">to</span><br>
            <span class="opacity-80">hear</span> from us
        </h2>
        <p>
            We will be very excited to meet with you and discuss your projects
            at your own convenience.
        </p>
        <a href="<?php echo $contact_page_url; ?>" class="btn btn--white">
            Contact us
        </a>
    </div>
</section>

<?php get_footer(); ?>