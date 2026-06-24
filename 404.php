<?php
/**
 * 404 Template
 *
 * Matches the NotFoundComponent from __root.tsx exactly:
 * - Large "404" number
 * - "Page not found" heading
 * - Descriptive paragraph
 * - "Go home" button
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="page-404">
    <div class="page-404__inner">
        <h1 class="page-404__number">404</h1>
        <h2 class="page-404__title">Page not found</h2>
        <p class="page-404__desc">
            The page you're looking for doesn't exist or has been moved.
        </p>
        <div class="page-404__cta">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn--primary">
                Go home
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
