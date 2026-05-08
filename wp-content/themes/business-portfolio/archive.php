<?php
/**
 * Generic archive template (categories, tags, dates, blog index).
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title">
                <?php
                if ( is_home() && ! is_front_page() ) {
                    single_post_title();
                } else {
                    the_archive_title();
                }
                ?>
            </h1>
            <?php the_archive_description( '<p>', '</p>' ); ?>
        </div>
    </section>

    <section class="blog-section">
        <div class="container blog-layout">
            <div class="blog-main">
                <?php if ( have_posts() ) : ?>
                    <div class="post-list">
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <a class="post-card__thumb" href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'medium_large' ); ?></a>
                                <?php endif; ?>
                                <div class="post-card__body">
                                    <h2 class="post-card__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    <p class="post-card__meta">
                                        <?php
                                        printf(
                                            /* translators: 1: post date 2: post author */
                                            esc_html__( 'Posted on %1$s by %2$s', 'business-portfolio' ),
                                            esc_html( get_the_date() ),
                                            esc_html( get_the_author() )
                                        );
                                        ?>
                                    </p>
                                    <p><?php echo esc_html( business_portfolio_excerpt( 35 ) ); ?></p>
                                    <a class="post-card__link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read more →', 'business-portfolio' ); ?></a>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>
                    <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
                <?php else : ?>
                    <p><?php esc_html_e( 'No posts found.', 'business-portfolio' ); ?></p>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </section>

</main>

<?php get_footer();
