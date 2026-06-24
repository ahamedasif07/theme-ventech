<?php
/**
 * Template Name: Products Page
 *
 * Matches products.tsx exactly:
 *  1. Page Header (banner with "Our Range" eyebrow)
 *  2. Centered heading
 *  3. 4 product articles in alternating image-left/right layout (on md+)
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/page-header', null, [
    'title'     => 'Products',
    'eyebrow'   => 'Our Range',
    'image_url' => ventech_image_url( 'hero-ceiling.jpg' ),
] );

$contact_url = esc_url( get_permalink( get_page_by_path( 'contact' ) ) );

$products = [
    [
        'name'        => 'Grilles',
        'image'       => ventech_image_url( 'product-grille.jpg' ),
        'description' => 'Grilles are devices used to cover openings or vents in a building\'s walls, floors, or ceilings, while allowing the passage of air or light. They are commonly used in HVAC systems to distribute air or to return it to the air handler, but they can also serve decorative or security purposes.',
    ],
    [
        'name'        => 'Diffusers',
        'image'       => ventech_image_url( 'product-diffuser.jpg' ),
        'description' => 'Diffusers distribute conditioned air evenly throughout a space, ensuring consistent comfort and performance in HVAC systems.',
    ],
    [
        'name'        => 'Dampers',
        'image'       => ventech_image_url( 'product-damper.jpg' ),
        'description' => 'Dampers regulate and control the flow of air within HVAC ducts, helping balance system performance and energy efficiency.',
    ],
    [
        'name'        => 'Ducts',
        'image'       => ventech_image_url( 'product-duct.jpg' ),
        'description' => 'At Ventech, we are committed to excellence. Our sheet metal products are meticulously crafted from high-quality materials, ensuring they stand the test of time.',
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
            <?php foreach ( $products as $index => $product ) :
                // Odd-indexed items (1, 3) get the 'reverse' class
                // to swap image to the right side, matching React's
                // i % 2 === 1 ? "md:[&>div:first-child]:order-2" : ""
                $reverse_class = ( $index % 2 === 1 ) ? 'reverse' : '';
            ?>
                <article class="product-article <?php echo $reverse_class; ?>">

                    <div class="product-article__image">
                        <img
                            src="<?php echo esc_url( $product['image'] ); ?>"
                            alt="<?php echo esc_attr( $product['name'] ); ?>"
                            loading="lazy"
                            width="800"
                            height="800">
                    </div>

                    <div class="product-article__body">
                        <p class="product-article__eyebrow">Our Products</p>
                        <h3 class="product-article__name">
                            <?php echo esc_html( $product['name'] ); ?>
                        </h3>
                        <p class="product-article__desc">
                            <?php echo esc_html( $product['description'] ); ?>
                        </p>
                        <a href="<?php echo $contact_url; ?>" class="product-article__link">
                            See more products
                            <?php echo ventech_icon( 'arrow-right', 'icon icon--sm' ); ?>
                        </a>
                    </div>

                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
