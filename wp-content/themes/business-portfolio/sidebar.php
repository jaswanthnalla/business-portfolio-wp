<?php
/**
 * The sidebar containing the main widget area.
 */

if ( ! is_active_sidebar( 'sidebar-blog' ) ) {
    return;
}
?>

<aside id="secondary" class="widget-area" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'business-portfolio' ); ?>">
    <?php dynamic_sidebar( 'sidebar-blog' ); ?>
</aside>
