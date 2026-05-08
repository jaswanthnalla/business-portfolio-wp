<?php
/**
 * The template for displaying single blog posts.
 */

get_header();
?>

<main id="primary" class="site-main">

    <div class="container blog-layout">
        <div class="blog-main">
            <?php while ( have_posts() ) : the_post(); ?>

                <article id="post-<?php the_ID(); ?>" <?php post_class( 'single-post' ); ?>>
                    <header class="entry-header">
                        <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                        <p class="entry-meta">
                            <?php
                            printf(
                                esc_html__( 'Posted on %1$s by %2$s', 'business-portfolio' ),
                                esc_html( get_the_date() ),
                                esc_html( get_the_author() )
                            );
                            ?>
                        </p>
                    </header>

                    <?php if ( has_post_thumbnail() ) : ?>
                        <div class="post-thumbnail"><?php the_post_thumbnail( 'large' ); ?></div>
                    <?php endif; ?>

                    <div class="entry-content">
                        <?php
                        the_content();
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'business-portfolio' ),
                            'after'  => '</div>',
                        ) );
                        ?>
                    </div>

                    <?php if ( has_category() || has_tag() ) : ?>
                        <footer class="entry-footer">
                            <?php
                            if ( has_category() ) {
                                printf( '<span class="cat-links">%s %s</span>', esc_html__( 'Categories:', 'business-portfolio' ), get_the_category_list( ', ' ) );
                            }
                            if ( has_tag() ) {
                                printf( '<span class="tag-links">%s %s</span>', esc_html__( 'Tags:', 'business-portfolio' ), get_the_tag_list( '', ', ' ) );
                            }
                            ?>
                        </footer>
                    <?php endif; ?>
                </article>

                <nav class="post-navigation">
                    <?php
                    $prev = get_previous_post_link( '<div class="prev">%link</div>', '« %title' );
                    $next = get_next_post_link( '<div class="next">%link</div>', '%title »' );
                    echo $prev . $next;
                    ?>
                </nav>

                <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>

            <?php endwhile; ?>
        </div>
        <?php get_sidebar(); ?>
    </div>

</main>

<?php get_footer();
