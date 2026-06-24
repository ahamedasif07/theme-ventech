    </main><!-- /#main-content -->

    <!-- =====================================================
         SITE FOOTER
         Matches Footer.tsx exactly:
         - 4-column grid (Logo+contact | Quick Links | Products | Newsletter)
         - Blue copyright bar
         ===================================================== -->
    <footer class="site-footer" role="contentinfo">
        <div class="footer-grid">

            <!-- Column 1: Logo + Address -->
            <div class="footer-col">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" aria-label="Ventech Grilles — Home">
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/Logo.png" alt="Ventech Grilles" class="site-logo__img">
                </a>
                <address class="footer-address">
                    <p>14-18 Mills Street, Cheltenham, VIC 3192.</p>
                    <p>
                        <a href="mailto:sales@ventechgrilles.com.au">
                            sales@ventechgrilles.com.au
                        </a>
                    </p>
                    <p>
                        <a href="tel:0395832400">(03) 9583 2400</a>
                    </p>
                </address>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>">Home</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'about' ) ) ); ?>">About</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>">Products</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'contact' ) ) ); ?>">Contact</a></li>
                </ul>
            </div>

            <!-- Column 3: Products -->
            <div class="footer-col">
                <h4>Products</h4>
                <ul>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>">Dampers</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>">Diffusers</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>">Grilles</a></li>
                    <li><a href="<?php echo esc_url( get_permalink( get_page_by_path( 'products' ) ) ); ?>">Louvres</a></li>
                </ul>
            </div>

            <!-- Column 4: Newsletter -->
            <div class="footer-col">
                <h4>Subscribe to our newsletter</h4>
                <form class="footer-newsletter" onsubmit="return false;" aria-label="Newsletter subscription">
                    <input
                        type="email"
                        name="newsletter_email"
                        placeholder="Enter Email"
                        required
                        aria-label="Email address">
                    <button type="submit">Subscribe</button>
                </form>
            </div>

        </div><!-- /.footer-grid -->

        <!-- Copyright bar -->
        <div class="footer-copyright">
            Copyright &copy; <?php echo esc_html( date( 'Y' ) ); ?> VenTech All Rights Reserved.
        </div>

    </footer><!-- /.site-footer -->

</div><!-- /.site-wrap -->

<?php wp_footer(); ?>
</body>
</html>
