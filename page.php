<?php
/**
 * Generic Page Template
 *
 * Fallback for any WordPress page that doesn't have
 * a specific template (page-about.php, etc.).
 * Renders a basic page with title and content from the editor.
 */

defined( 'ABSPATH' ) || exit;

get_header();

if ( have_posts() ) :
    while ( have_posts() ) :
        the_post();

        // Page header banner using the page title
        get_template_part( 'template-parts/page-header', null, [
            'title'     => get_the_title(),
            'image_url' => ventech_image_url( 'hero-ceiling.jpg' ),
        ] );
        ?>

        <section class="section-about-intro">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </section>

        <?php
    endwhile;
endif;

get_footer();
