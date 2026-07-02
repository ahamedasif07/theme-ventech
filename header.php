<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <div class="site-wrap">

        <header class="site-header" role="banner">
            <div class="nav-inner">

                <!-- Logo -->
                <a  href="<?php echo esc_url(home_url('/')); ?>" class="site-logo"
                    aria-label="<?php bloginfo('name'); ?> — Home">
                    <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Logo.png"
                        alt="<?php bloginfo('name'); ?>" class="site-logo__img">
                </a>

                <!-- Desktop navigation -->
                <nav class="nav-links" aria-label="Primary navigation">

                    <a href="<?php echo esc_url(home_url('/')); ?>"
                        class="<?php echo ventech_active_class('/'); ?>">Home</a>

                    <!-- Products mega-menu dropdown (desktop) -->
                    <div class="nav-item-dropdown products-dropdown">
                        <button class="nav-link-dropdown" aria-haspopup="true" aria-expanded="false">
                            Products ▾
                        </button>


                        <div class="safe-triangle" aria-hidden="true"></div>

                        <!-- .products-grid is the dropdown panel -->
                        <div class="products-grid" role="menu">
                            <?php
                            $ventech_cats = get_terms([
                                'taxonomy'   => 'product_category',
                                'hide_empty' => false,
                                'parent'     => 0,
                                'orderby'    => 'menu_order',
                                'order'      => 'ASC',
                            ]);
                            if (! is_wp_error($ventech_cats) && ! empty($ventech_cats)) :
                                foreach ($ventech_cats as $vcat) :
                                    $icon_key = get_term_meta($vcat->term_id, 'ventech_cat_icon', true);
                                    $icon_svg = function_exists('ventech_get_category_icon_svg')
                                        ? ventech_get_category_icon_svg($icon_key ?: 'custom')
                                        : '';
                                    $cat_url  = get_term_link($vcat);
                            ?>
                                    <a href="<?php echo esc_url($cat_url); ?>" role="menuitem">
                                        <?php echo $icon_svg; /* SVG আগে, text নিচে — CSS handles the layout */ ?>
                                        <?php echo esc_html($vcat->name); ?>
                                    </a>
                                <?php
                                endforeach;
                            else :
                                ?>
                                <p style="padding:1rem;color:#888;font-size:.85rem;">
                                    No categories found.
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('products'))); ?>"
                        class="<?php echo ventech_active_class('products'); ?>">Selection Tool</a>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('projects'))); ?>"
                        class="<?php echo ventech_active_class('projects'); ?>">Projects</a>

                    <!-- Resources dropdown -->
                    <div class="nav-item-dropdown">
                        <button class="nav-link-dropdown" aria-haspopup="true" aria-expanded="false">
                            Resources ▾
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <a href="<?php echo esc_url(home_url('/downloads')); ?>" role="menuitem">Downloads</a>
                            <a href="<?php echo esc_url(home_url('/calculators')); ?>" role="menuitem">Calculators</a>
                        </div>
                    </div>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>"
                        class="<?php echo ventech_active_class('about'); ?>">About</a>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>"
                        class="<?php echo ventech_active_class('contact'); ?>">Contact</a>

                </nav>

                <!-- Desktop social / contact icons -->
                <div class="nav-icons" aria-label="Contact and social links">
                    <a href="mailto:sales@ventechgrilles.com.au" class="nav-icon-link" aria-label="Email us">
                        <?php echo ventech_icon('mail', 'icon icon--sm'); ?>
                    </a>
                    <a href="tel:0395832400" class="nav-icon-link" aria-label="Call us">
                        <?php echo ventech_icon('phone', 'icon icon--sm'); ?>
                    </a>
                    <a href="#" class="nav-icon-link" aria-label="LinkedIn" rel="noopener noreferrer" target="_blank">
                        <?php echo ventech_icon('linkedin', 'icon icon--sm'); ?>
                    </a>
                    <a href="#" class="nav-icon-link" aria-label="Facebook" rel="noopener noreferrer" target="_blank">
                        <?php echo ventech_icon('facebook', 'icon icon--sm'); ?>
                    </a>
                </div>

                <!-- Mobile hamburger -->
                <button class="nav-hamburger" id="nav-hamburger-btn" aria-label="Toggle menu" aria-expanded="false"
                    aria-controls="nav-mobile-panel">
                    <span class="hamburger-icon">
                        <?php echo ventech_icon('menu', 'icon'); ?>
                    </span>
                    <span class="close-icon" style="display:none;">
                        <?php echo ventech_icon('x', 'icon'); ?>
                    </span>
                </button>

            </div><!-- /.nav-inner -->

            <!-- =============================================
                 MOBILE NAV PANEL
            ============================================= -->
            <div class="nav-mobile" id="nav-mobile-panel" aria-hidden="true">
                <nav aria-label="Mobile navigation">

                    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>

                    <!-- Products dropdown (dynamic — same PHP loop) -->
                    <div class="nav-item-dropdown products-dropdown">
                        <button class="nav-link-dropdown" type="button">Products ▾</button>
                        <div class="products-grid">
                            <?php
                            // Re-use the same query — PHP variables don't carry across scopes here
                            $ventech_cats_mob = get_terms([
                                'taxonomy'   => 'product_category',
                                'hide_empty' => false,
                                'parent'     => 0,
                                'orderby'    => 'menu_order',
                                'order'      => 'ASC',
                            ]);
                            if (! is_wp_error($ventech_cats_mob) && ! empty($ventech_cats_mob)) :
                                foreach ($ventech_cats_mob as $vcat) :
                                    $icon_key = get_term_meta($vcat->term_id, 'ventech_cat_icon', true);
                                    $icon_svg = function_exists('ventech_get_category_icon_svg')
                                        ? ventech_get_category_icon_svg($icon_key ?: 'custom')
                                        : '';
                                    $cat_url  = get_term_link($vcat);
                            ?>
                                    <a href="<?php echo esc_url($cat_url); ?>">
                                        <?php echo $icon_svg; ?>
                                        <?php echo esc_html($vcat->name); ?>
                                    </a>
                            <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('products'))); ?>">Selection Tool</a>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('projects'))); ?>">Projects</a>

                    <!-- Resources mobile dropdown -->
                    <div class="mobile-dropdown">
                        <button type="button" class="mobile-dropdown-toggle">Resources <span>▾</span></button>
                        <div class="mobile-dropdown-menu" style="display:none;">
                            <a href="<?php echo esc_url(home_url('/downloads')); ?>">Downloads</a>
                            <a href="<?php echo esc_url(home_url('/calculators')); ?>">Calculators</a>
                        </div>
                    </div>

                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('about'))); ?>">About</a>
                    <a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>">Contact</a>

                </nav>
            </div><!-- /#nav-mobile-panel -->

        </header><!-- /.site-header -->

        <main class="site-main" id="main-content">