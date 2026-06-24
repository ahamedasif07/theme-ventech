<?php
/**
 * Template Part: Page Header (Banner)
 *
 * Matches the <PageHeader> component from Layout.tsx.
 *
 * Usage:
 *   get_template_part( 'template-parts/page-header', null, [
 *       'title'     => 'About',
 *       'eyebrow'   => 'Our Range',   // optional
 *       'image_url' => ventech_image_url('hero-ceiling.jpg'),
 *   ] );
 *
 * @var array $args  Data passed from the parent template.
 */

defined( 'ABSPATH' ) || exit;

$title     = esc_html( $args['title']     ?? '' );
$eyebrow   = esc_html( $args['eyebrow']   ?? '' );
$image_url = esc_url(  $args['image_url'] ?? '' );
?>

<section class="page-banner">

    <?php if ( $image_url ) : ?>
        <!-- Background image at 25% opacity (matches React's opacity-25) -->
        <div
            class="page-banner__bg"
            style="background-image: url('<?php echo $image_url; ?>');"
            role="img"
            aria-label="Decorative background image"></div>
    <?php endif; ?>

    <!-- Gradient overlay: from-background/40 via-background/60 to-background -->
    <div class="page-banner__overlay" aria-hidden="true"></div>

    <div class="page-banner__content">
        <?php if ( $eyebrow ) : ?>
            <p class="page-banner__eyebrow"><?php echo $eyebrow; ?></p>
        <?php endif; ?>
        <h1 class="page-banner__title"><?php echo $title; ?></h1>
    </div>

</section>
