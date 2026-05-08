<?php
/**
 * Search results template.
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                printf(
                    /* translators: %s: search query */
                    esc_html__( 'Results for: %s', 'business-portfolio' ),
                    '<em>' . esc_html( get_search_query() ) . '</em>'
                );
                ?>
            </h1>
            <?php get_search_form(); ?>
        </div>
    </section>

    <section class="search-results">
        <div class="container blog-layout">
            <div class="blog-main">
                <?php if ( have_posts() ) : ?>
                    <div class="post-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                                <div class="post-card__body">
                                    <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p class="post-card__meta"><?php echo esc_html( get_post_type_object( get_post_type() )->labels->singular_name ); ?> · <?php echo esc_html( get_the_date() ); ?></p>
                                    <p><?php echo esc_html( business_portfolio_excerpt( 30 ) ); ?></p>
                                    <a class="post-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'View →', 'business-portfolio' ); ?></a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'No matches found. Try a different search term.', 'business-portfolio' ); ?></p>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </section>

</main>

<?php get_footer();
