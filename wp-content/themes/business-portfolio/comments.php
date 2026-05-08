<?php
/**
 * Comments template.
 */

if ( post_password_required() ) { return; }
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h2 class="comments-title">
            <?php
            $count = get_comments_number();
            printf(
                esc_html( _n( '%s response', '%s responses', $count, 'business-portfolio' ) ),
                esc_html( number_format_i18n( $count ) )
            );
            ?>
        </h2>

        <ol class="comment-list">
            <?php
            wp_list_comments( array(
                'style'      => 'ol',
                'short_ping' => true,
                'avatar_size'=> 48,
            ) );
            ?>
        </ol>

        <?php the_comments_pagination(); ?>
    <?php endif; ?>

    <?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
        <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'business-portfolio' ); ?></p>
    <?php endif; ?>

    <?php comment_form(); ?>

</div>
