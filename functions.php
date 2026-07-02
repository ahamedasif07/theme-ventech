<?php

/**
 * Ventech Grilles — functions.php
 *
 * Theme setup, asset enqueuing, menu registration,
 * and AJAX contact form handler.
 */

defined('ABSPATH') || exit;

/* ============================================================
   1. THEME SETUP
   ============================================================ */
function ventech_setup()
{
    // Enable <title> tag management by WordPress
    add_theme_support('title-tag');

    // Enable featured images on posts/pages
    add_theme_support('post-thumbnails');

    // Register custom image sizes
    add_image_size('ventech-hero',    1920, 1080, true);
    add_image_size('ventech-product', 800,  800,  false);

    // HTML5 semantic markup support
    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ]);

    // Register navigation menus
    register_nav_menus([
        'primary-menu' => __('Primary Navigation', 'ventech-grilles'),
    ]);
}
add_action('after_setup_theme', 'ventech_setup');



/* ============================================================
   2. ENQUEUE STYLES & SCRIPTS
   ============================================================ */
function ventech_assets()
{
    $version = wp_get_theme()->get('Version');
    $uri     = get_template_directory_uri();

    // Main stylesheet (contains Google Fonts @import + all CSS)
    wp_enqueue_style(
        'ventech-style',
        get_stylesheet_uri(),
        [],
        $version
    );

    // Nav hamburger toggle

    wp_enqueue_style(
        'ventech-nav-style',
        $uri . '/assets/css/nav.css',
        [],
        $version
    );
    wp_enqueue_script(
        'ventech-nav',
        $uri . '/assets/js/nav.js',
        [],
        $version,
        true   // load in footer
    );

    // Enqueue GSAP
    wp_enqueue_script(
        'gsap',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js',
        [],
        '3.12.5',
        true
    );

    // Enqueue GSAP ScrollTrigger
    wp_enqueue_script(
        'gsap-scrolltrigger',
        'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js',
        ['gsap'],
        '3.12.5',
        true
    );

    // Enqueue Custom Animations
    wp_enqueue_script(
        'ventech-animations',
        $uri . '/assets/js/animations.js',
        ['gsap', 'gsap-scrolltrigger'],
        $version,
        true
    );
    // Enqueue download.js
    wp_enqueue_script(
        'ventech-download',
        $uri . '/assets/js/download.js',

        true
    );
    // Enqueue calculator.js
    wp_enqueue_script(
        'ventech-calculator',
        $uri . '/assets/js/calculators.js',

        true
    );

    // Projects region filter (only on the projects page)
    if (is_page('projects')) {
        wp_enqueue_script(
            'ventech-projects-filter',
            $uri . '/assets/js/projects-filter.js',
            [],
            $version,
            true
        );
    }

    // Contact form AJAX (only on the contact page)
    if (is_page('contact')) {
        wp_enqueue_script(
            'ventech-contact-form',
            $uri . '/assets/js/contact-form.js',
            [],
            $version,
            true
        );

        // Pass AJAX URL and nonce to JS
        wp_localize_script('ventech-contact-form', 'ventechAjax', [
            'ajaxUrl' => admin_url('admin-ajax.php'),
            'nonce'   => wp_create_nonce('ventech_contact_nonce'),
        ]);
    }
}
add_action('wp_enqueue_scripts', 'ventech_assets');


/* ============================================================
   3a. FEATURED SLIDES — CUSTOM POST TYPE
   Dashboard: Featured Slides  (slug: ventech_slide)
   ============================================================ */
function ventech_register_slide_cpt()
{
    $labels = [
        'name'               => 'Featured Slides',
        'singular_name'      => 'Featured Slide',
        'add_new'            => 'Add New Slide',
        'add_new_item'       => 'Add New Featured Slide',
        'edit_item'          => 'Edit Featured Slide',
        'new_item'           => 'New Featured Slide',
        'view_item'          => 'View Featured Slide',
        'search_items'       => 'Search Featured Slides',
        'not_found'          => 'No featured slides found',
        'not_found_in_trash' => 'No featured slides found in Trash',
        'menu_name'          => 'Featured Slides',
    ];

    register_post_type('ventech_slide', [
        'labels'              => $labels,
        'public'              => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-images-alt2',
        'supports'            => ['title', 'thumbnail'],
        'capability_type'     => 'post',
        'has_archive'         => false,
        'rewrite'             => false,
        'show_in_rest'        => true,
    ]);
}
add_action('init', 'ventech_register_slide_cpt');


/* ── Meta box for slide content fields ─────────────────── */
function ventech_slide_meta_box()
{
    add_meta_box(
        'ventech_slide_fields',
        'Slide Content',
        'ventech_slide_meta_box_html',
        'ventech_slide',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'ventech_slide_meta_box');

function ventech_slide_meta_box_html($post)
{
    wp_nonce_field('ventech_slide_save', 'ventech_slide_nonce');
    $eyebrow  = get_post_meta($post->ID, '_vc_eyebrow',   true);
    $desc     = get_post_meta($post->ID, '_vc_desc',      true);
    $btn1_lbl = get_post_meta($post->ID, '_vc_btn1_lbl',  true);
    $btn1_url = get_post_meta($post->ID, '_vc_btn1_url',  true);
    $btn2_lbl = get_post_meta($post->ID, '_vc_btn2_lbl',  true);
    $btn2_url = get_post_meta($post->ID, '_vc_btn2_url',  true);
    $order    = get_post_meta($post->ID, '_vc_order',     true);
    ?>
    <style>
        .vc-meta-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; margin-bottom:14px; }
        .vc-meta-field label { display:block; font-weight:600; margin-bottom:4px; }
        .vc-meta-field input,
        .vc-meta-field textarea { width:100%; padding:6px 8px; border:1px solid #ddd; border-radius:4px; }
        .vc-meta-field textarea { min-height:80px; resize:vertical; }
        .vc-meta-hint { color:#888; font-size:0.8rem; margin-top:3px; }
    </style>

    <div class="vc-meta-grid">
        <div class="vc-meta-field">
            <label for="vc_eyebrow">Eyebrow Label</label>
            <input type="text" id="vc_eyebrow" name="vc_eyebrow"
                   value="<?php echo esc_attr($eyebrow); ?>"
                   placeholder="e.g. Our Products">
            <p class="vc-meta-hint">Small text above the heading</p>
        </div>
        <div class="vc-meta-field">
            <label for="vc_order">Display Order</label>
            <input type="number" id="vc_order" name="vc_order"
                   value="<?php echo esc_attr($order ?: 0); ?>" min="0" step="1">
            <p class="vc-meta-hint">Lower number = appears first</p>
        </div>
    </div>

    <div class="vc-meta-field" style="margin-bottom:14px;">
        <label for="vc_desc">Slide Description</label>
        <textarea id="vc_desc" name="vc_desc"><?php echo esc_textarea($desc); ?></textarea>
        <p class="vc-meta-hint">Paragraph text shown beneath the heading.</p>
    </div>

    <p><strong>Button 1 (Primary)</strong></p>
    <div class="vc-meta-grid" style="margin-bottom:14px;">
        <div class="vc-meta-field">
            <label for="vc_btn1_lbl">Button 1 Label</label>
            <input type="text" id="vc_btn1_lbl" name="vc_btn1_lbl"
                   value="<?php echo esc_attr($btn1_lbl); ?>"
                   placeholder="e.g. Learn More">
        </div>
        <div class="vc-meta-field">
            <label for="vc_btn1_url">Button 1 URL</label>
            <input type="url" id="vc_btn1_url" name="vc_btn1_url"
                   value="<?php echo esc_attr($btn1_url); ?>"
                   placeholder="https://...">
        </div>
    </div>

    <p><strong>Button 2 (Outline, optional)</strong></p>
    <div class="vc-meta-grid">
        <div class="vc-meta-field">
            <label for="vc_btn2_lbl">Button 2 Label</label>
            <input type="text" id="vc_btn2_lbl" name="vc_btn2_lbl"
                   value="<?php echo esc_attr($btn2_lbl); ?>"
                   placeholder="e.g. Contact">
        </div>
        <div class="vc-meta-field">
            <label for="vc_btn2_url">Button 2 URL</label>
            <input type="url" id="vc_btn2_url" name="vc_btn2_url"
                   value="<?php echo esc_attr($btn2_url); ?>"
                   placeholder="https://...">
        </div>
    </div>
    <?php
}

function ventech_slide_save_meta($post_id)
{
    // Nonce check
    if (
        ! isset($_POST['ventech_slide_nonce']) ||
        ! wp_verify_nonce($_POST['ventech_slide_nonce'], 'ventech_slide_save')
    ) {
        return;
    }

    // Autosave check
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;

    // Capability check
    if (! current_user_can('edit_post', $post_id)) return;

    $fields = [
        '_vc_eyebrow'  => 'vc_eyebrow',
        '_vc_desc'     => 'vc_desc',
        '_vc_btn1_lbl' => 'vc_btn1_lbl',
        '_vc_btn1_url' => 'vc_btn1_url',
        '_vc_btn2_lbl' => 'vc_btn2_lbl',
        '_vc_btn2_url' => 'vc_btn2_url',
        '_vc_order'    => 'vc_order',
    ];

    foreach ($fields as $meta_key => $post_key) {
        if (isset($_POST[$post_key])) {
            $value = $meta_key === '_vc_desc'
                ? sanitize_textarea_field($_POST[$post_key])
                : sanitize_text_field($_POST[$post_key]);
            update_post_meta($post_id, $meta_key, $value);
        }
    }
}
add_action('save_post_ventech_slide', 'ventech_slide_save_meta');


/* ── Enqueue carousel.js on front page only ────────────── */
function ventech_carousel_assets()
{
    if (! is_front_page()) return;

    wp_enqueue_script(
        'ventech-carousel',
        get_template_directory_uri() . '/assets/js/carousel.js',
        [],
        wp_get_theme()->get('Version'),
        true   // load in footer
    );
}
add_action('wp_enqueue_scripts', 'ventech_carousel_assets');



/* ============================================================
   3. CONTACT FORM AJAX HANDLER
   ============================================================ */

/**
 * Handle contact form submission (for both logged-in and
 * non-logged-in users via wp_ajax_nopriv_).
 */
function ventech_handle_contact()
{
    // Verify nonce
    if (! check_ajax_referer('ventech_contact_nonce', 'nonce', false)) {
        wp_send_json_error(['message' => 'Security check failed.'], 403);
        return;
    }

    // Sanitize fields
    $name    = sanitize_text_field($_POST['name']    ?? '');
    $phone   = sanitize_text_field($_POST['phone']   ?? '');
    $email   = sanitize_email($_POST['email']   ?? '');
    $message = sanitize_textarea_field($_POST['message'] ?? '');

    // Basic validation
    if (! $name || ! $email || ! $message) {
        wp_send_json_error(['message' => 'Please fill in all required fields.'], 422);
        return;
    }

    if (! is_email($email)) {
        wp_send_json_error(['message' => 'Please enter a valid email address.'], 422);
        return;
    }

    // Build email
    $to      = 'sales@ventechgrilles.com.au';
    $subject = 'Website Enquiry from ' . $name;
    $body    = "Name: {$name}\nPhone: {$phone}\nEmail: {$email}\n\nMessage:\n{$message}";
    $headers = [
        'Content-Type: text/plain; charset=UTF-8',
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
    ];

    $sent = wp_mail($to, $subject, $body, $headers);

    if ($sent) {
        wp_send_json_success(['message' => 'Message sent successfully.']);
    } else {
        wp_send_json_error(['message' => 'Could not send email. Please try again later.'], 500);
    }
}
add_action('wp_ajax_ventech_contact',        'ventech_handle_contact');
add_action('wp_ajax_nopriv_ventech_contact', 'ventech_handle_contact');


/* ============================================================
   4. HELPER FUNCTIONS
   ============================================================ */

/**
 * Return the URI of a theme image asset.
 *
 * @param  string $filename  Filename inside /assets/images/ (e.g. 'hero-ceiling.jpg')
 * @return string            Full URL
 */
function ventech_image_url(string $filename): string
{
    return get_template_directory_uri() . '/assets/images/' . $filename;
}

/**
 * Inline SVG icons used throughout the theme.
 * Avoids a separate icon library dependency.
 *
 * @param  string $name  Icon identifier.
 * @param  string $class Additional CSS classes.
 * @return string        SVG markup (safe to echo directly).
 */
function ventech_icon(string $name, string $class = ''): string
{
    $class_attr = $class ? ' class="' . esc_attr($class) . '"' : '';

    $icons = [
        'arrow-right'   => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>',
        'chevron-right' => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m9 18 6-6-6-6"/></svg>',
        'map-pin'       => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>',
        'phone'         => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07A19.5 19.5 0 0 1 4.69 12a19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 3.62 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>',
        'printer'       => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"/><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"/><rect width="12" height="8" x="6" y="14"/></svg>',
        'mail'          => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>',
        'check-circle'  => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><path d="m9 11 3 3L22 4"/></svg>',
        'linkedin'      => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>',
        'facebook'      => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>',
        'menu'          => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><line x1="4" x2="20" y1="12" y2="12"/><line x1="4" x2="20" y1="6" y2="6"/><line x1="4" x2="20" y1="18" y2="18"/></svg>',
        'x'             => '<svg' . $class_attr . ' xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>',
    ];

    return $icons[$name] ?? '';
}


/* ============================================================
   5. ACTIVE PAGE HELPER FOR NAV
   ============================================================ */

/**
 * Return 'current-page' CSS class string if the given page
 * slug matches the currently viewed page.
 *
 * @param  string $slug  Page slug OR '/' for front page.
 * @return string
 */
function ventech_active_class(string $slug): string
{
    if ($slug === '/') {
        return is_front_page() ? 'current-page' : '';
    }
    return is_page($slug) ? 'current-page' : '';
}
