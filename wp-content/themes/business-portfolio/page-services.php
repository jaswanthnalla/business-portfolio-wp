<?php
/**
 * Template Name: Services Page
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Our Services', 'business-portfolio' ); ?></h1>
            <p><?php esc_html_e( 'End-to-end solutions designed to deliver measurable results.', 'business-portfolio' ); ?></p>
        </div>
    </section>

    <section class="services-section services-section--page">
        <div class="container">
            <div class="services-grid">
                <?php
                $services = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => -1,
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
                            <h3><?php the_title(); ?></h3>
                            <div class="service-card__body"><?php echo wp_kses_post( wpautop( business_portfolio_excerpt( 30 ) ) ); ?></div>
                            <a class="service-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Learn more →', 'business-portfolio' ); ?></a>
                        </article>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    $defaults = array(
                        array( '⚡', 'Web Development', 'Full-stack development services including WordPress, React, and custom PHP solutions. We build secure and scalable websites.' ),
                        array( '🎨', 'UI/UX Design', 'Creating intuitive and engaging user experiences. We focus on conversion optimization and brand consistency.' ),
                        array( '🔍', 'SEO Optimization', 'Improve your search engine rankings with our technical and content SEO strategies. Drive organic traffic to your site.' ),
                        array( '🛒', 'E-Commerce', 'Robust online store solutions using WooCommerce. We handle payments, inventory, and customer management setups.' ),
                        array( '📱', 'Mobile Apps', 'Native and hybrid mobile application development for iOS and Android platforms.' ),
                        array( '☁️', 'Cloud Hosting', 'Secure and fast hosting solutions tailored to your business needs, ensuring 99.9% uptime.' ),
                    );
                    foreach ( $defaults as $card ) {
                        printf(
                            '<article class="service-card"><div class="service-icon">%s</div><h3>%s</h3><div class="service-card__body"><p>%s</p></div></article>',
                            esc_html( $card[0] ),
                            esc_html__( $card[1], 'business-portfolio' ),
                            esc_html__( $card[2], 'business-portfolio' )
                        );
                    }
                endif;
                ?>
            </div>
        </div>
    </section>

    <section class="process-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e( 'How We Work', 'business-portfolio' ); ?></h2>
            <ol class="process-list">
                <li>
                    <h3><?php esc_html_e( 'Discover', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'We start by understanding your goals, audience, and constraints.', 'business-portfolio' ); ?></p>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Design', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'Wireframes, prototypes, and visual systems before a single line of code.', 'business-portfolio' ); ?></p>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Develop', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'Clean, performant code with rigorous testing and review.', 'business-portfolio' ); ?></p>
                </li>
                <li>
                    <h3><?php esc_html_e( 'Deliver', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'Smooth deployment, training, and ongoing support after launch.', 'business-portfolio' ); ?></p>
                </li>
            </ol>
        </div>
    </section>

    <section class="cta-section">
        <div class="container">
            <h2><?php esc_html_e( 'Need a Custom Solution?', 'business-portfolio' ); ?></h2>
            <p><?php esc_html_e( 'Tell us about your project and we’ll send a tailored proposal.', 'business-portfolio' ); ?></p>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--inverse"><?php esc_html_e( 'Get in Touch', 'business-portfolio' ); ?></a>
        </div>
    </section>

</main>

<?php get_footer();
