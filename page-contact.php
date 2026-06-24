<?php
/**
 * Template Name: Contact Page
 *
 * Matches contact.tsx exactly:
 *  1. Page Header (hero image background)
 *  2. 2-col grid: Left = contact info details, Right = dark form card
 *  3. Contact form with AJAX submission via contact-form.js
 *
 * Form submits to: admin-ajax.php?action=ventech_contact
 * Handler is registered in functions.php (ventech_handle_contact)
 */

defined( 'ABSPATH' ) || exit;

get_header();

get_template_part( 'template-parts/page-header', null, [
    'title'     => 'Contact',
    'image_url' => ventech_image_url( 'hero-ceiling.jpg' ),
] );
?>

<!-- ====================================================
     CONTACT SECTION
     Matches: <section className="bg-background py-20">
     ==================================================== -->
<section class="section-contact">
    <div class="contact-grid">

        <!-- LEFT COLUMN: Contact Info -->
        <div class="contact-info">
            <h2>
                <span class="text-brand-red">Contact</span>
                <span class="text-brand-blue"> Lines.</span>
            </h2>

            <div class="contact-info__block">

                <!-- Company Address -->
                <div>
                    <p class="contact-info__section-title">VENTECH (AUSTRALIA) PTY LTD</p>
                    <p class="contact-info__detail">
                        <?php echo ventech_icon( 'map-pin', 'icon icon--sm' ); ?>
                        14-18 Mills Street, Cheltenham, VIC 3192
                    </p>
                </div>

                <!-- VIC Sales -->
                <div>
                    <p class="contact-info__section-title">VIC For Sales and General Enquiries</p>
                    <ul class="contact-info__list">
                        <li>
                            <?php echo ventech_icon( 'phone', 'icon icon--sm' ); ?>
                            Phone: (03) 9583 2400
                        </li>
                        <li>
                            <?php echo ventech_icon( 'printer', 'icon icon--sm' ); ?>
                            Fax: (03) 9583 2400
                        </li>
                        <li>
                            <?php echo ventech_icon( 'mail', 'icon icon--sm' ); ?>
                            Email: sales@ventechgrilles.com.au
                        </li>
                    </ul>
                </div>

                <!-- Warehouse / Order Tracking -->
                <div>
                    <p class="contact-info__section-title">For Order Tracking and Warehouse</p>
                    <p class="contact-info__detail">
                        <?php echo ventech_icon( 'phone', 'icon icon--sm' ); ?>
                        Phone: (03) 9583 3922
                    </p>
                </div>

            </div>
        </div>

        <!-- RIGHT COLUMN: Contact Form Card -->
        <div class="contact-form-card">
            <h3>
                Have a question?<br>
                Write to us!
            </h3>

            <form
                class="contact-form"
                id="ventech-contact-form"
                novalidate
                aria-label="Contact enquiry form">

                <?php wp_nonce_field( 'ventech_contact_nonce', 'ventech_nonce' ); ?>

                <!-- Hidden field for AJAX action -->
                <input type="hidden" name="action" value="ventech_contact">

                <input
                    type="text"
                    name="name"
                    id="contact-name"
                    placeholder="Full name*"
                    required
                    autocomplete="name"
                    aria-label="Full name">

                <input
                    type="tel"
                    name="phone"
                    id="contact-phone"
                    placeholder="Phone*"
                    required
                    autocomplete="tel"
                    aria-label="Phone number">

                <input
                    type="email"
                    name="email"
                    id="contact-email"
                    placeholder="E-mail address*"
                    required
                    autocomplete="email"
                    aria-label="Email address">

                <textarea
                    name="message"
                    id="contact-message"
                    rows="5"
                    placeholder="Your message..."
                    required
                    aria-label="Your message"></textarea>

                <label class="contact-form__consent">
                    <input type="checkbox" name="consent" required>
                    I consent to the processing of data for the purpose of telephone contact.*
                </label>

                <!-- Error / success message area (populated by JS) -->
                <div id="contact-form-status" aria-live="polite" style="font-size:0.8rem; min-height:1.2em;"></div>

                <button
                    type="submit"
                    id="contact-submit-btn"
                    class="contact-form__submit">
                    Contact us
                </button>

            </form>
        </div>

    </div>
</section>

<?php get_footer(); ?>
