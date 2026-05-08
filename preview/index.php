<?php
/**
 * Preview router — entry point for PHP's built-in server.
 * Maps URLs to the appropriate theme template.
 */

@session_start();

$uri = parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH );
$uri = $uri ?: '/';

/* Serve static asset requests directly (style.css and any future asset). */
if ( preg_match( '#^/wp-content/themes/business-portfolio/(.+)$#', $uri, $m ) ) {
    $file = realpath( __DIR__ . '/../wp-content/themes/business-portfolio/' . $m[1] );
    $base = realpath( __DIR__ . '/../wp-content/themes/business-portfolio' );
    if ( $file && $base && strpos( $file, $base ) === 0 && is_file( $file ) ) {
        $mime_map = array(
            'css'  => 'text/css',
            'js'   => 'application/javascript',
            'png'  => 'image/png',
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'svg'  => 'image/svg+xml',
            'webp' => 'image/webp',
            'ico'  => 'image/x-icon',
            'woff' => 'font/woff',
            'woff2'=> 'font/woff2',
        );
        $ext = strtolower( pathinfo( $file, PATHINFO_EXTENSION ) );
        if ( isset( $mime_map[ $ext ] ) ) {
            header( 'Content-Type: ' . $mime_map[ $ext ] );
        }
        readfile( $file );
        exit;
    }
}

require __DIR__ . '/wp-shim.php';

/* Map URL → route key + template file. */
$path  = trim( $uri, '/' );
$path  = $path === '' ? 'home' : $path;
$route = $path;

$theme = get_template_directory();
$template_map = array(
    'home'      => $theme . '/front-page.php',
    'about'     => $theme . '/page-about.php',
    'services'  => $theme . '/page-services.php',
    'contact'   => $theme . '/page-contact.php',
    'portfolio' => $theme . '/archive-portfolio.php',
    'blog'      => $theme . '/archive.php',
);

if ( ! isset( $template_map[ $route ] ) ) {
    http_response_code( 404 );
    $route = '404';
    $GLOBALS['bp_route'] = $route;
    include $theme . '/404.php';
    exit;
}

if ( $route === 'portfolio' ) {
    $GLOBALS['bp_route'] = 'portfolio_archive';
    _bp_set_loop( $GLOBALS['bp_portfolio'] );
} elseif ( $route === 'blog' ) {
    $GLOBALS['bp_route'] = 'blog';
    _bp_set_loop( array() );
} elseif ( $route === 'contact' ) {
    $GLOBALS['bp_route'] = 'contact';
    // Inline contact form handler for preview (real version lives in functions.php).
    if ( ! empty( $_POST['bp_contact_submit'] ) ) {
        wp_safe_redirect( add_query_arg( 'bp_sent', '1', home_url( '/contact' ) ) );
        exit;
    }
    _bp_set_loop( array( array( 'id' => 1, 'title' => 'Contact', 'content' => '' ) ) );
} elseif ( $route === 'about' ) {
    $GLOBALS['bp_route'] = 'about';
    _bp_set_loop( array( array(
        'id' => 1, 'title' => 'About',
        'content' => '<p>Founded with a vision to revolutionize the digital workspace, Business Portfolio has grown from a small startup to a leading web solutions provider. We believe in the power of technology to transform businesses.</p><p>Our team consists of industry experts who are passionate about code, design, and strategy.</p>',
    ) ) );
} elseif ( $route === 'services' ) {
    $GLOBALS['bp_route'] = 'services';
    _bp_set_loop( array() );
} else {
    $GLOBALS['bp_route'] = 'home';
    _bp_set_loop( array() );
}

include $template_map[ $route ];
