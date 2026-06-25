<?php

/**
 * Template Name: Products Page
 *
 * Matches products.tsx exactly:
 *  1. Page Header (banner with "Our Range" eyebrow)
 *  2. Centered heading
 *  3. 4 product articles in alternating image-left/right layout (on md+)
 */

defined('ABSPATH') || exit;

get_header();

get_template_part('template-parts/page-header', null, [
    'title'     => 'Products',
    'eyebrow'   => 'Our Range',
    'image_url' => ventech_image_url('hero-ceiling.jpg'),
]);

$contact_url = esc_url(get_permalink(get_page_by_path('contact')));

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
?>

<!-- ====================================================
     PRODUCTS SECTION
     Matches: <section className="bg-background py-16">
     ==================================================== -->
<section class="section-products-page">
    <div class="container">
        <h2 class="section-heading section-heading--lg text-center">
            We specialise <span class="text-brand-blue">in manufacturing</span>
            Grilles, Diffusers, Dampers and Ducts.
        </h2>

        <div class="products-list">
            <?php foreach ($products as $index => $product) :
                // Odd-indexed items (1, 3) get the 'reverse' class
                // to swap image to the right side, matching React's
                // i % 2 === 1 ? "md:[&>div:first-child]:order-2" : ""
                $reverse_class = ($index % 2 === 1) ? 'reverse' : '';
            ?>
                <article class="product-article <?php echo $reverse_class; ?>">

                    <div class="product-article__image">
                        <img src="<?php echo esc_url($product['image']); ?>" alt="<?php echo esc_attr($product['name']); ?>"
                            loading="lazy" width="800" height="800">
                    </div>

                    <div class="product-article__body">
                        <p class="product-article__eyebrow">Our Products</p>
                        <h3 class="product-article__name">
                            <?php echo esc_html($product['name']); ?>
                        </h3>
                        <p class="product-article__desc">
                            <?php echo esc_html($product['description']); ?>
                        </p>
                        <a href="<?php echo $contact_url; ?>" class="product-article__link">
                            See more products
                            <?php echo ventech_icon('arrow-right', 'icon icon--sm'); ?>
                        </a>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>