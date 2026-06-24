<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div class="site-wrap">

    <!-- =====================================================
         SITE HEADER / NAVIGATION
         Matches Nav.tsx exactly:
         - Sticky header with backdrop blur
         - Logo (VENTECH / GRILLES two-line)
         - Desktop nav links with active state
         - Social icon links (email, phone, LinkedIn, Facebook)
         - Mobile hamburger with slide-down menu
         ===================================================== -->
    <header class="site-header" role="banner">
        <div class="nav-inner">

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="<?php bloginfo( 'name' ); ?> — Home">
                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/Logo.png" alt="<?php bloginfo( 'name' ); ?>" class="site-logo__img">
            </a>

            <!-- Desktop navigation -->
            <nav class="nav-links" aria-label="Primary navigation">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                   class="<?php echo ventech_active_class( '/' ); ?>"
                   <?php echo is_front_page() ? 'aria-current="page"' : ''; ?>>Home</a>

                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'about' ); ?>"
                   <?php echo is_page( 'about' ) ? 'aria-current="page"' : ''; ?>>About</a>

                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'products' ); ?>"
                   <?php echo is_page( 'products' ) ? 'aria-current="page"' : ''; ?>>Products</a>

                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'projects' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'projects' ); ?>"
                   <?php echo is_page( 'projects' ) ? 'aria-current="page"' : ''; ?>>Projects</a>

                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'contact' ); ?>"
                   <?php echo is_page( 'contact' ) ? 'aria-current="page"' : ''; ?>>Contact</a>
            </nav>

            <!-- Desktop social / contact icons -->
            <div class="nav-icons" aria-label="Contact and social links">
                <a href="mailto:sales@ventechgrilles.com.au"
                   class="nav-icon-link"
                   aria-label="Email us">
                    <?php echo ventech_icon( 'mail', 'icon icon--sm' ); ?>
                </a>
                <a href="tel:0395832400"
                   class="nav-icon-link"
                   aria-label="Call us">
                    <?php echo ventech_icon( 'phone', 'icon icon--sm' ); ?>
                </a>
                <a href="#"
                   class="nav-icon-link"
                   aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">
                    <?php echo ventech_icon( 'linkedin', 'icon icon--sm' ); ?>
                </a>
                <a href="#"
                   class="nav-icon-link"
                   aria-label="Facebook" rel="noopener noreferrer" target="_blank">
                    <?php echo ventech_icon( 'facebook', 'icon icon--sm' ); ?>
                </a>
            </div>

            <!-- Mobile hamburger button (toggled by nav.js) -->
            <button
                class="nav-hamburger"
                id="nav-hamburger-btn"
                aria-label="Toggle menu"
                aria-expanded="false"
                aria-controls="nav-mobile-panel">
                <span class="hamburger-icon">
                    <?php echo ventech_icon( 'menu', 'icon' ); ?>
                </span>
                <span class="close-icon" style="display:none;">
                    <?php echo ventech_icon( 'x', 'icon' ); ?>
                </span>
            </button>

        </div><!-- /.nav-inner -->

        <!-- Mobile nav panel (hidden by default, opened by nav.js) -->
        <div class="nav-mobile" id="nav-mobile-panel" aria-hidden="true">
            <nav aria-label="Mobile navigation">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
                   class="<?php echo ventech_active_class( '/' ); ?>">Home</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'about' ); ?>">About</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'products' ); ?>">Products</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'projects' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'projects' ); ?>">Projects</a>
                <a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>"
                   class="<?php echo ventech_active_class( 'contact' ); ?>">Contact</a>
            </nav>
        </div><!-- /#nav-mobile-panel -->

    </header><!-- /.site-header -->

    <main class="site-main" id="main-content">
