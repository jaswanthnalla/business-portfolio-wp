<?php
/**
 * Default page template.
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
        </div>
    </section>

    <section class="page-content">
        <div class="container">
            <?php
            while ( have_posts() ) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
                </article>

                <?php if ( comments_open() || get_comments_number() ) : comments_template(); endif; ?>
            <?php endwhile; ?>
        </div>
    </section>

</main>

<?php get_footer();
