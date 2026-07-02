<?php

/**
 * Template Name: Front Page
 *
 * Home page — matches index.tsx exactly.
 *
 * Sections:
 *  1. Hero Slider
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

/* ----------------------------------------------------------
 * HERO SLIDER SLIDES
 * Notun slide add korte: niche array-e ekta notun item add korun.
 * Slide remove korte: shudhu oi item ta delete kore din.
 * Image gola 'assets/images/' folder theke load hobe (ventech_image_url()).
 * ---------------------------------------------------------- */
$hero_slides = [
    [
        'eyebrow'     => 'Holyoake Air Management Solutions',
        'title'       => 'Introducing Our New High-Performance Plastic: POLYMAX',
        'description' => 'Engineered for durability and performance — POLYMAX brings next-level strength and finish to our range of grilles and diffusers.',
        'button_text' => 'Learn More',
        'button_url'  => '#',
        'image'       => ventech_image_url('grilles.png'),
    ],
    [
        'eyebrow'     => 'Ventech (Aust) Pty Ltd',
        'title'       => 'Built for Performance. Designed for Air.',
        'description' => 'We develop new designs and technologies to achieve better product performance, easier installation and higher quality products.',
        'button_text' => 'Contact Us',
        'button_url'  => $contact_page_url,
        'image'       => ventech_image_url('diffuser.png'),
    ],
    [
        'eyebrow'     => 'New Arrival',
        'title'       => 'Explore Our Full Product Range',
        'description' => 'Grilles, Diffusers, Dampers, Louvres and Ducts — manufactured with fast turnaround times across Australia.',
        'button_text' => 'View Products',
        'button_url'  => $products_page_url,
        'image'       => ventech_image_url('dempers.png'),
    ],
];

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
     · Slides come from the $hero_slides array above
     ==================================================== -->
<?php if (!empty($hero_slides)) : ?>
<section class="hero-slider" id="heroSlider" data-autoplay="6000">

    <div class="hero-slider__track">
        <?php foreach ($hero_slides as $i => $slide) : ?>
            <div class="hero-slider__slide <?php echo $i === 0 ? 'is-active' : ''; ?>" data-slide-index="<?php echo esc_attr($i); ?>">
                <div class="hero-slider__inner">

                    <!-- LEFT: Content -->
                    <div class="hero-slider__content">
                        <?php if (!empty($slide['eyebrow'])) : ?>
                            <p class="hero-slider__eyebrow"><?php echo esc_html($slide['eyebrow']); ?></p>
                        <?php endif; ?>

                        <h2 class="hero-slider__title"><?php echo esc_html($slide['title']); ?></h2>

                        <?php if (!empty($slide['description'])) : ?>
                            <p class="hero-slider__desc"><?php echo esc_html($slide['description']); ?></p>
                        <?php endif; ?>

                        <?php if (!empty($slide['button_text']) && !empty($slide['button_url'])) : ?>
                            <a href="<?php echo esc_url($slide['button_url']); ?>" class="hero-slider__btn">
                                <?php echo esc_html($slide['button_text']); ?>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- RIGHT: Image -->
                    <div class="hero-slider__image-wrap">
                        <img src="<?php echo esc_url($slide['image']); ?>"
                             alt="<?php echo esc_attr($slide['title']); ?>"
                             loading="<?php echo $i === 0 ? 'eager' : 'lazy'; ?>">
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (count($hero_slides) > 1) : ?>
        <!-- NAV: arrows + dots -->
        <div class="hero-slider__nav">
            <button type="button" class="hero-slider__arrow hero-slider__arrow--prev" aria-label="Previous slide">
                <span aria-hidden="true">&#8592;</span>
            </button>

            <div class="hero-slider__dots">
                <?php foreach ($hero_slides as $i => $slide) : ?>
                    <button type="button"
                            class="hero-slider__dot <?php echo $i === 0 ? 'is-active' : ''; ?>"
                            data-goto="<?php echo esc_attr($i); ?>"
                            aria-label="Go to slide <?php echo esc_attr($i + 1); ?>"></button>
                <?php endforeach; ?>
            </div>

            <button type="button" class="hero-slider__arrow hero-slider__arrow--next" aria-label="Next slide">
                <span aria-hidden="true">&#8594;</span>
            </button>
        </div>
    <?php endif; ?>

</section>
<?php endif; ?>


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