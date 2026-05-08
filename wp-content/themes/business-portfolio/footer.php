<footer id="colophon" class="site-footer">
    <div class="container">

        <?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
            <div class="footer-widgets footer-widgets--cols-3">
                <div class="footer-col">
                    <?php
                    if ( is_active_sidebar( 'footer-1' ) ) {
                        dynamic_sidebar( 'footer-1' );
                    } else {
                        printf(
                            '<h4 class="widget-title">%s</h4><p>%s</p>',
                            esc_html( get_bloginfo( 'name' ) ),
                            esc_html( get_bloginfo( 'description' ) ?: __( 'Professional web solutions for modern businesses.', 'business-portfolio' ) )
                        );
                    }
                    ?>
                </div>
                <div class="footer-col">
                    <?php
                    if ( is_active_sidebar( 'footer-2' ) ) {
                        dynamic_sidebar( 'footer-2' );
                    } else {
                        echo '<h4 class="widget-title">' . esc_html__( 'Quick Links', 'business-portfolio' ) . '</h4>';
                        wp_nav_menu( array(
                            'theme_location' => 'footer',
                            'depth'          => 1,
                            'container'      => false,
                            'fallback_cb'    => 'business_portfolio_default_menu',
                        ) );
                    }
                    ?>
                </div>
                <div class="footer-col">
                    <?php
                    if ( is_active_sidebar( 'footer-3' ) ) {
                        dynamic_sidebar( 'footer-3' );
                    } else {
                        echo '<h4 class="widget-title">' . esc_html__( 'Contact', 'business-portfolio' ) . '</h4>';
                        $email = get_theme_mod( 'bp_contact_email', 'contact@example.com' );
                        $phone = get_theme_mod( 'bp_contact_phone', '+1 (555) 123-4567' );
                        printf( '<p><a href="mailto:%1$s">%1$s</a></p>', esc_attr( $email ) );
                        printf( '<p>%s</p>', esc_html( $phone ) );
                    }
                    ?>
                </div>
            </div>
        <?php endif; ?>

        <?php
        $socials = array(
            'twitter'   => '𝕏',
            'facebook'  => 'f',
            'linkedin'  => 'in',
            'instagram' => 'IG',
            'github'    => 'GH',
        );
        $has_social = false;
        foreach ( $socials as $key => $_ ) {
            if ( get_theme_mod( 'bp_social_' . $key ) ) { $has_social = true; break; }
        }
        if ( $has_social ) :
        ?>
        <div class="social-links" aria-label="<?php esc_attr_e( 'Social Media', 'business-portfolio' ); ?>">
            <?php foreach ( $socials as $key => $abbr ) :
                $url = get_theme_mod( 'bp_social_' . $key );
                if ( $url ) :
            ?>
                <a href="<?php echo esc_url( $url ); ?>" rel="noopener" target="_blank"
                   aria-label="<?php echo esc_attr( ucfirst( $key ) ); ?>"><?php echo esc_html( $abbr ); ?></a>
            <?php endif; endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="footer-bottom">
            <p class="site-info">
                &copy; <?php echo esc_html( date( 'Y' ) ); ?>
                <?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
                <?php esc_html_e( 'All rights reserved.', 'business-portfolio' ); ?>
            </p>
            <?php if ( has_nav_menu( 'footer' ) ) : ?>
                <nav class="footer-navigation" aria-label="<?php esc_attr_e( 'Footer Navigation', 'business-portfolio' ); ?>">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'depth'          => 1,
                        'container'      => false,
                    ) );
                    ?>
                </nav>
            <?php endif; ?>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
