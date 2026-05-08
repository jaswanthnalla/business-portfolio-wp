<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo esc_attr( get_bloginfo( 'description' ) ); ?>">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'business-portfolio' ); ?></a>

<header id="masthead" class="site-header">
    <div class="container header-inner">
        <div class="site-branding">
            <?php
            if ( has_custom_logo() ) {
                the_custom_logo();
            } else {
                printf(
                    '<h1 class="site-title"><a href="%s" rel="home">%s</a></h1>',
                    esc_url( home_url( '/' ) ),
                    esc_html( get_bloginfo( 'name' ) )
                );
                $description = get_bloginfo( 'description', 'display' );
                if ( $description ) {
                    printf( '<p class="site-description">%s</p>', esc_html( $description ) );
                }
            }
            ?>
        </div>

        <input type="checkbox" id="menu-toggle" class="menu-toggle-checkbox" aria-hidden="true">
        <label for="menu-toggle" class="menu-toggle-label" aria-label="<?php esc_attr_e( 'Toggle navigation', 'business-portfolio' ); ?>">
            <span></span><span></span><span></span>
        </label>

        <nav id="site-navigation" class="main-navigation" aria-label="<?php esc_attr_e( 'Primary navigation', 'business-portfolio' ); ?>">
            <?php
            if ( has_nav_menu( 'primary' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                    'container'      => false,
                    'fallback_cb'    => 'business_portfolio_default_menu',
                ) );
            } else {
                business_portfolio_default_menu();
            }
            ?>
        </nav>

        <div class="header-cta">
            <a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn"><?php esc_html_e( 'Get a Quote', 'business-portfolio' ); ?></a>
        </div>
    </div>
</header>
