<?php
/**
 * Template Name: About Page
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'About Us', 'business-portfolio' ); ?></h1>
            <p><?php esc_html_e( 'Crafting digital experiences that move businesses forward.', 'business-portfolio' ); ?></p>
        </div>
    </section>

    <section class="about-content">
        <div class="container about-grid">
            <div class="about-grid__text">
                <h2><?php esc_html_e( 'Our Story', 'business-portfolio' ); ?></h2>
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $content = get_the_content();
                        if ( trim( $content ) ) {
                            the_content();
                        } else {
                            ?>
                            <p><?php esc_html_e( 'Founded with a vision to revolutionize the digital workspace, Business Portfolio has grown from a small startup to a leading web solutions provider. We believe in the power of technology to transform businesses.', 'business-portfolio' ); ?></p>
                            <p><?php esc_html_e( 'Our team consists of industry experts who are passionate about code, design, and strategy.', 'business-portfolio' ); ?></p>
                            <?php
                        }
                    endwhile;
                endif;
                ?>
            </div>
            <div class="about-grid__visual">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail( 'large' );
                } else {
                    echo '<div class="placeholder-box"><span>' . esc_html__( 'Your story, in a picture.', 'business-portfolio' ) . '</span></div>';
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Mission & Values -->
    <section class="mission-values">
        <div class="container">
            <h2 class="section-title section-title--inverse"><?php esc_html_e( 'Our Mission & Values', 'business-portfolio' ); ?></h2>
            <div class="values-grid">
                <div class="value-item">
                    <h3><?php esc_html_e( 'Innovation', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'We constantly push boundaries to deliver cutting-edge solutions.', 'business-portfolio' ); ?></p>
                </div>
                <div class="value-item">
                    <h3><?php esc_html_e( 'Integrity', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'We build trust through transparent and honest relationships.', 'business-portfolio' ); ?></p>
                </div>
                <div class="value-item">
                    <h3><?php esc_html_e( 'Excellence', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'We strive for perfection in every pixel and line of code.', 'business-portfolio' ); ?></p>
                </div>
                <div class="value-item">
                    <h3><?php esc_html_e( 'Partnership', 'business-portfolio' ); ?></h3>
                    <p><?php esc_html_e( 'We treat your goals as our own. Your success is our metric.', 'business-portfolio' ); ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team -->
    <?php
    $team = new WP_Query( array(
        'post_type'      => 'team_member',
        'posts_per_page' => 8,
    ) );
    if ( $team->have_posts() ) : ?>
    <section class="team-section">
        <div class="container">
            <h2 class="section-title"><?php esc_html_e( 'Meet the Team', 'business-portfolio' ); ?></h2>
            <div class="team-grid">
                <?php while ( $team->have_posts() ) : $team->the_post();
                    $role     = get_post_meta( get_the_ID(), '_team_role', true );
                    $linkedin = get_post_meta( get_the_ID(), '_team_linkedin', true );
                ?>
                    <article class="team-card">
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="team-card__photo"><?php the_post_thumbnail( 'medium' ); ?></div>
                        <?php else : ?>
                            <div class="team-card__photo team-card__photo--initials">
                                <span><?php echo esc_html( strtoupper( substr( get_the_title(), 0, 1 ) ) ); ?></span>
                            </div>
                        <?php endif; ?>
                        <h3><?php the_title(); ?></h3>
                        <?php if ( $role ) : ?><p class="team-card__role"><?php echo esc_html( $role ); ?></p><?php endif; ?>
                        <?php if ( $linkedin ) : ?>
                            <a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" rel="noopener">LinkedIn</a>
                        <?php endif; ?>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <!-- CTA -->
    <section class="cta-section">
        <div class="container">
            <h2><?php esc_html_e( 'Want to work with us?', 'business-portfolio' ); ?></h2>
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn btn--inverse"><?php esc_html_e( 'Get in Touch', 'business-portfolio' ); ?></a>
        </div>
    </section>

</main>

<?php get_footer();
