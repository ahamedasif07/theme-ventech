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
$hero_img          = ventech_image_url('hero-ceiling.jpg');

$products = [
    [
        'name'        => 'Air Diffusers ',
        'image'       => ventech_image_url('product-diffuser.jpg'),
        'description' => 'Diffusers are devices used in HVAC systems to distribute air in a space evenly and efficiently. They are installed on the end of air ducts and work by diffusing or dispersing the air in various directions, typically upwards, downwards, or in a horizontal pattern.',
    ],
    [
        'name'        => 'Register & Grilles ',
        'image'       => ventech_image_url('product-grille.jpg'),
        'description' => 'Grilles are devices used to cover openings or vents in a buildings walls, floors, or ceilings, while allowing the passage of air or light. They are commonly used in HVAC systems to distribute air or to return it to the air handler, but they can also serve decorative or security purposes.',
    ],
    [
        'name'        => 'Dampers',
        'image'       => ventech_image_url('product-damper.jpg'),
        'description' => 'Dampers are devices used to reduce or control the movement, vibration, or oscillation of a structure or system. They work by dissipating or absorbing energy, and they can be found in a wide range of applications, from automotive suspensions to HVAC systems.',
    ],
    [
        'name'        => 'Louvres',
        'image'       => ventech_image_url('product-duct.jpg'),
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
     1. HERO SECTION
     Matches: <section className="relative overflow-hidden">
     ==================================================== -->
<section class="hero">
    <img src="<?php echo esc_url($hero_img); ?>" alt="Industrial HVAC ceiling with ventilation grilles"
        class="hero__bg" width="1920" height="1080">

    <div class="hero__overlay" aria-hidden="true"></div>

    <div class="hero__content">
        <div class="hero__inner animate-fade-up">
            <p class="hero__eyebrow">Ventech (Aust) Pty Ltd</p>

            <h1 class="hero__heading">
                <span class="text-brand-blue">Built for Performance.</span><br>
                Designed for Air.
            </h1>

            <p class="hero__desc">
                We develop new designs and technologies to achieve better product
                performance, easier installation and higher quality products year
                after year.
            </p>

            <div class="hero__ctas">
                <a href="<?php echo $about_page_url; ?>" class="btn btn--outline">
                    Learn more
                </a>
                <a href="<?php echo $products_page_url; ?>" class="btn btn--primary">
                    Our Products
                    <?php echo ventech_icon('chevron-right', 'icon icon--sm'); ?>
                </a>
            </div>
        </div>
    </div>
</section>


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
                        <img src="<?php echo esc_url($product['image']); ?>"
                            alt="<?php echo esc_attr($product['name']); ?>" loading="lazy" width="800" height="800">
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