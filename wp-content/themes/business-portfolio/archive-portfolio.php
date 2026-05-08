<?php
/**
 * Archive template for the "portfolio" custom post type.
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Portfolio', 'business-portfolio' ); ?></h1>
            <p><?php esc_html_e( 'A selection of recent projects we\'re proud of.', 'business-portfolio' ); ?></p>
        </div>
    </section>

    <section class="portfolio-archive">
        <div class="container">

            <?php
            // Category filter
            $terms = get_terms( array( 'taxonomy' => 'portfolio_category', 'hide_empty' => true ) );
            if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) :
            ?>
                <nav class="portfolio-filter" aria-label="<?php esc_attr_e( 'Project categories', 'business-portfolio' ); ?>">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'portfolio' ) ); ?>"
                       class="<?php echo is_post_type_archive( 'portfolio' ) && ! is_tax() ? 'is-active' : ''; ?>">
                        <?php esc_html_e( 'All', 'business-portfolio' ); ?>
                    </a>
                    <?php foreach ( $terms as $term ) : ?>
                        <a href="<?php echo esc_url( get_term_link( $term ) ); ?>"
                           class="<?php echo is_tax( 'portfolio_category', $term->slug ) ? 'is-active' : ''; ?>">
                            <?php echo esc_html( $term->name ); ?>
                        </a>
                    <?php endforeach; ?>
                </nav>
            <?php endif; ?>

            <?php if ( have_posts() ) : ?>
                <div class="portfolio-grid">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class( 'portfolio-card' ); ?>>
                            <a href="<?php the_permalink(); ?>" class="portfolio-card__link">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <div class="portfolio-card__thumb"><?php the_post_thumbnail( 'medium_large' ); ?></div>
                                <?php else : ?>
                                    <div class="portfolio-card__thumb portfolio-card__thumb--empty">
                                        <span><?php echo esc_html( mb_substr( get_the_title(), 0, 1 ) ); ?></span>
                                    </div>
                                <?php endif; ?>
                                <div class="portfolio-card__body">
                                    <h2 class="portfolio-card__title"><?php the_title(); ?></h2>
                                    <p><?php echo esc_html( business_portfolio_excerpt( 18 ) ); ?></p>
                                </div>
                            </a>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => __( '« Previous', 'business-portfolio' ),
                    'next_text' => __( 'Next »', 'business-portfolio' ),
                ) );
                ?>
            <?php else : ?>
                <p class="text-center"><?php esc_html_e( 'No projects yet. Check back soon!', 'business-portfolio' ); ?></p>
            <?php endif; ?>

        </div>
    </section>

</main>

<?php get_footer();
