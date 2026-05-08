<?php
/**
 * Template Name: Home Page
 *
 * Dynamic homepage built from theme customizer values and Service /
 * Portfolio / Testimonial custom post types.
 */

get_header();
?>

<main id="primary" class="site-main">

    <!-- Hero -->
    <section class="hero-section">
        <div class="container hero-content">
            <h1><?php echo esc_html( get_theme_mod( 'bp_hero_title', 'Building Digital Excellence' ) ); ?></h1>
            <p class="hero-subtitle">
                <?php echo esc_html( get_theme_mod( 'bp_hero_subtitle', 'Professional Web Solutions for Modern Businesses' ) ); ?>
            </p>
            <div class="hero-actions">
                <a href="<?php echo esc_url( home_url( '/services' ) ); ?>" class="btn"><?php esc_html_e( 'Our Services', 'business-portfolio' ); ?></a>
                <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--ghost"><?php esc_html_e( 'Talk to Us', 'business-portfolio' ); ?></a>
            </div>
        </div>
    </section>

    <!-- Services -->
    <section class="services-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e( 'What We Do', 'business-portfolio' ); ?></h2>
            <p class="section-subtitle"><?php esc_html_e( 'A focused set of services to help your business grow online.', 'business-portfolio' ); ?></p>

            <div class="services-grid">
                <?php
                $services = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => 6,
                    'orderby'        => 'menu_order',
                    'order'          => 'ASC',
                ) );

                if ( $services->have_posts() ) :
                    while ( $services->have_posts() ) :
                        $services->the_post();
                        $icon = get_post_meta( get_the_ID(), '_service_icon', true );
                ?>
                    <article class="service-card">
                        <?php if ( $icon ) : ?>
                            <div class="service-icon"><?php echo esc_html( $icon ); ?></div>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p><?php echo esc_html( business_portfolio_excerpt( 22 ) ); ?></p>
                    </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    // Fallback static cards
                    $defaults = array(
                        array( '⚡', __( 'Web Development', 'business-portfolio' ), __( 'Custom websites built with the latest technologies to ensure performance and scalability.', 'business-portfolio' ) ),
                        array( '🎨', __( 'UI/UX Design', 'business-portfolio' ),     __( 'User-centric design interfaces that convert visitors into loyal customers.', 'business-portfolio' ) ),
                        array( '📈', __( 'Digital Marketing', 'business-portfolio' ), __( 'Strategic SEO and marketing campaigns to grow your online presence.', 'business-portfolio' ) ),
                    );
                    foreach ( $defaults as $card ) {
                        printf(
                            '<article class="service-card"><div class="service-icon">%s</div><h3>%s</h3><p>%s</p></article>',
                            esc_html( $card[0] ), esc_html( $card[1] ), esc_html( $card[2] )
                        );
                    }
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Featured Portfolio -->
    <?php
    $portfolio = new WP_Query( array(
        'post_type'      => 'portfolio',
        'posts_per_page' => 3,
    ) );
    if ( $portfolio->have_posts() ) : ?>
    <section class="portfolio-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e( 'Featured Work', 'business-portfolio' ); ?></h2>
            <div class="portfolio-grid">
                <?php while ( $portfolio->have_posts() ) : $portfolio->the_post(); ?>
                    <article class="portfolio-card">
                        <a href="<?php the_permalink(); ?>" class="portfolio-card__link">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <div class="portfolio-card__thumb"><?php the_post_thumbnail( 'medium_large' ); ?></div>
                            <?php else : ?>
                                <div class="portfolio-card__thumb portfolio-card__thumb--empty">
                                    <span><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="portfolio-card__body">
                                <h3><?php the_title(); ?></h3>
                                <p><?php echo esc_html( business_portfolio_excerpt( 18 ) ); ?></p>
                            </div>
                        </a>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <p class="text-center">
                <a class="btn" href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"><?php esc_html_e( 'See All Projects', 'business-portfolio' ); ?></a>
            </p>
        </div>
    </section>
    <?php endif; ?>

    <!-- About preview -->
    <section class="about-preview">
        <div class="container about-preview__inner">
            <h2 class="section-title"><?php esc_html_e( 'Who We Are', 'business-portfolio' ); ?></h2>
            <p>
                <?php esc_html_e( 'We are a team of dedicated professionals committed to delivering top-tier digital solutions. With years of experience in the industry, we help businesses transform their digital landscape.', 'business-portfolio' ); ?>
            </p>
            <a href="<?php echo esc_url( home_url( '/about' ) ); ?>" class="btn btn--primary"><?php esc_html_e( 'Learn More About Us', 'business-portfolio' ); ?></a>
        </div>
    </section>

    <!-- Testimonials -->
    <?php
    $testimonials = new WP_Query( array(
        'post_type'      => 'testimonial',
        'posts_per_page' => 3,
    ) );
    if ( $testimonials->have_posts() ) : ?>
    <section class="testimonials-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e( 'What Clients Say', 'business-portfolio' ); ?></h2>
            <div class="testimonials-grid">
                <?php while ( $testimonials->have_posts() ) : $testimonials->the_post();
                    $author = get_post_meta( get_the_ID(), '_testimonial_author', true );
                    $role   = get_post_meta( get_the_ID(), '_testimonial_role', true );
                ?>
                    <figure class="testimonial-card">
                        <blockquote><?php echo wp_kses_post( wpautop( get_the_content() ) ); ?></blockquote>
                        <figcaption>
                            <strong><?php echo esc_html( $author ?: get_the_title() ); ?></strong>
                            <?php if ( $role ) : ?><span><?php echo esc_html( $role ); ?></span><?php endif; ?>
                        </figcaption>
                    </figure>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- Final CTA -->
    <section class="cta-section">
        <div class="container">
            <h2><?php esc_html_e( 'Ready to Start Your Project?', 'business-portfolio' ); ?></h2>
            <p><?php esc_html_e( "Let's discuss how we can help your business grow.", 'business-portfolio' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--inverse"><?php esc_html_e( 'Contact Us Today', 'business-portfolio' ); ?></a>
        </div>
    </section>

</main>

<?php
get_footer();
