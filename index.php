<?php
/**
 * index.php — The fallback template.
 *
 * WordPress requires this file. It serves as the ultimate
 * fallback when no other template matches the request.
 * For this site, the front page uses front-page.php and
 * inner pages use their specific page-*.php templates.
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<section class="section-about-intro">
    <div class="container">
        <?php if ( have_posts() ) : ?>
            <?php while ( have_posts() ) : the_post(); ?>
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <p>No content found.</p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
