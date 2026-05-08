<?php
/**
 * Minimal WordPress core shim for previewing the Business Portfolio
 * theme without a full WordPress installation. Provides just enough
 * functions, classes, and sample data for the theme's templates to
 * render in a browser via PHP's built-in server.
 *
 * This file is for LOCAL PREVIEW ONLY. The real application is the
 * WordPress theme at wp-content/themes/business-portfolio/.
 */

if ( ! defined( 'ABSPATH' ) ) {
    define( 'ABSPATH', __DIR__ . '/' );
}

/* -------------------------------------------------------------------------
 * Theme path setup
 * ------------------------------------------------------------------------- */
$GLOBALS['bp_theme_dir'] = realpath( __DIR__ . '/../wp-content/themes/business-portfolio' );
$GLOBALS['bp_theme_uri'] = '/wp-content/themes/business-portfolio';
$GLOBALS['bp_home_url']  = '';

function get_template_directory()      { return $GLOBALS['bp_theme_dir']; }
function get_template_directory_uri()  { return $GLOBALS['bp_theme_uri']; }
function get_stylesheet_directory()    { return $GLOBALS['bp_theme_dir']; }
function get_stylesheet_uri()          { return $GLOBALS['bp_theme_uri'] . '/style.css'; }

/* -------------------------------------------------------------------------
 * Sample site data
 * ------------------------------------------------------------------------- */
$GLOBALS['bp_site'] = array(
    'name'        => 'Business Portfolio',
    'description' => 'Professional Web Solutions for Modern Businesses',
    'admin_email' => 'contact@example.com',
    'charset'     => 'UTF-8',
);

$GLOBALS['bp_theme_mods'] = array(
    'bp_hero_title'      => 'Building Digital Excellence',
    'bp_hero_subtitle'   => 'Professional Web Solutions for Modern Businesses',
    'bp_contact_email'   => 'contact@businessportfolio.com',
    'bp_contact_phone'   => '+1 (555) 123-4567',
    'bp_contact_address' => '123 Business Ave, Tech City, TC 90210',
    'bp_social_twitter'  => 'https://twitter.com/example',
    'bp_social_linkedin' => 'https://linkedin.com/company/example',
    'bp_social_github'   => 'https://github.com/example',
);

$GLOBALS['bp_services'] = array(
    array( 'id' => 1, 'title' => 'Web Development',  'icon' => '⚡',  'excerpt' => 'Custom websites built with the latest technologies to ensure performance and scalability.' ),
    array( 'id' => 2, 'title' => 'UI/UX Design',     'icon' => '🎨',  'excerpt' => 'User-centric design interfaces that convert visitors into loyal customers.' ),
    array( 'id' => 3, 'title' => 'Digital Marketing','icon' => '📈',  'excerpt' => 'Strategic SEO and marketing campaigns to grow your online presence.' ),
    array( 'id' => 4, 'title' => 'E-Commerce',       'icon' => '🛒',  'excerpt' => 'Robust online store solutions. Payments, inventory, and customer management.' ),
    array( 'id' => 5, 'title' => 'Mobile Apps',      'icon' => '📱',  'excerpt' => 'Native and hybrid mobile application development for iOS and Android platforms.' ),
    array( 'id' => 6, 'title' => 'Cloud Hosting',    'icon' => '☁️',  'excerpt' => 'Secure and fast hosting solutions tailored to your business needs.' ),
);

$GLOBALS['bp_portfolio'] = array(
    array( 'id' => 101, 'title' => 'Acme Corp Website',   'excerpt' => 'A complete redesign with a focus on conversion and brand consistency.' ),
    array( 'id' => 102, 'title' => 'Lumen E-Commerce',    'excerpt' => 'High-performance storefront built on a custom WordPress theme.' ),
    array( 'id' => 103, 'title' => 'NovaSaaS Dashboard',  'excerpt' => 'Admin dashboard with role-based access and real-time analytics.' ),
);

$GLOBALS['bp_testimonials'] = array(
    array( 'id' => 201, 'title' => 'Game-changing partnership', 'content' => 'They delivered beyond expectations. Our traffic doubled within three months of launch.', 'author' => 'Sarah Chen',     'role' => 'CEO, Acme Corp' ),
    array( 'id' => 202, 'title' => 'True craftsmanship',         'content' => 'Pixel-perfect execution and clean code. They take pride in the work, and it shows.',  'author' => 'Marcus Patel',   'role' => 'CTO, Lumen' ),
    array( 'id' => 203, 'title' => 'Reliable from day one',      'content' => 'Communication, deadlines, and quality — all top-tier. We have hired them three times.','author' => 'Jessica Rivera', 'role' => 'Founder, NovaSaaS' ),
);

$GLOBALS['bp_team'] = array(
    array( 'id' => 301, 'title' => 'Alex Morgan',  'role' => 'Founder & Lead Developer', 'linkedin' => '#' ),
    array( 'id' => 302, 'title' => 'Priya Shah',   'role' => 'Senior UI/UX Designer',    'linkedin' => '#' ),
    array( 'id' => 303, 'title' => 'David Kim',    'role' => 'Backend Engineer',         'linkedin' => '#' ),
    array( 'id' => 304, 'title' => 'Lena Hoffman', 'role' => 'Marketing Strategist',     'linkedin' => '#' ),
);

/** Current "post" being looped over; mutated by have_posts/the_post. */
$GLOBALS['bp_current'] = null;

/* -------------------------------------------------------------------------
 * URL & page helpers
 * ------------------------------------------------------------------------- */
function home_url( $path = '/' )         { return rtrim( $GLOBALS['bp_home_url'], '/' ) . '/' . ltrim( $path, '/' ); }
function get_home_url()                  { return home_url(); }
function site_url( $path = '/' )         { return home_url( $path ); }

function bloginfo( $key = 'name' )       { echo get_bloginfo( $key ); }
function get_bloginfo( $key = 'name', $filter = 'display' ) {
    $map = array(
        'name'         => $GLOBALS['bp_site']['name'],
        'description'  => $GLOBALS['bp_site']['description'],
        'admin_email'  => $GLOBALS['bp_site']['admin_email'],
        'charset'      => $GLOBALS['bp_site']['charset'],
        'pingback_url' => home_url( '/xmlrpc.php' ),
        'url'          => home_url(),
    );
    return isset( $map[ $key ] ) ? $map[ $key ] : '';
}

function language_attributes()            { echo 'lang="en-US"'; }
function body_class( $class = '' )        { $cls = trim( 'page ' . $class ); echo 'class="' . htmlspecialchars( $cls ) . '"'; }
function post_class( $class = '' )        { $cls = trim( 'post ' . ( is_array( $class ) ? implode( ' ', $class ) : $class ) ); echo 'class="' . htmlspecialchars( $cls ) . '"'; }
function get_post_class( $class = '' )    { $cls = trim( 'post ' . ( is_array( $class ) ? implode( ' ', $class ) : $class ) ); return array( $cls ); }

/* -------------------------------------------------------------------------
 * Escaping & translation helpers
 * ------------------------------------------------------------------------- */
function esc_html( $t )      { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_attr( $t )      { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_url( $t )       { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_url_raw( $t )   { return (string) $t; }
function esc_textarea( $t )  { return htmlspecialchars( (string) $t, ENT_QUOTES, 'UTF-8' ); }
function esc_html_e( $t, $d = '' ) { echo esc_html( $t ); }
function esc_attr_e( $t, $d = '' ) { echo esc_attr( $t ); }
function esc_html__( $t, $d = '' ) { return esc_html( $t ); }
function esc_attr__( $t, $d = '' ) { return esc_attr( $t ); }
function __( $t, $d = '' )         { return $t; }
function _e( $t, $d = '' )         { echo $t; }
function _x( $t, $c = '', $d = '') { return $t; }
function _n( $s, $p, $n, $d = '' ) { return $n == 1 ? $s : $p; }
function wp_kses_post( $t )  { return $t; }
function wp_strip_all_tags( $t ) { return trim( strip_tags( (string) $t ) ); }
function wp_trim_words( $t, $n = 55, $more = '…' ) {
    $words = preg_split( "/\s+/", strip_tags( (string) $t ) );
    if ( count( $words ) > $n ) {
        $words = array_slice( $words, 0, $n );
        return implode( ' ', $words ) . $more;
    }
    return implode( ' ', $words );
}
function wpautop( $t )       { return '<p>' . str_replace( "\n\n", "</p><p>", trim( (string) $t ) ) . '</p>'; }
function sanitize_text_field( $t )      { return is_string( $t ) ? trim( strip_tags( $t ) ) : ''; }
function sanitize_textarea_field( $t )  { return is_string( $t ) ? trim( strip_tags( $t ) ) : ''; }
function sanitize_email( $t )           { return filter_var( (string) $t, FILTER_SANITIZE_EMAIL ); }
function is_email( $t )                 { return (bool) filter_var( (string) $t, FILTER_VALIDATE_EMAIL ); }
function wp_unslash( $v )               { return is_string( $v ) ? stripslashes( $v ) : $v; }
function wp_parse_args( $args, $defaults = array() ) { return is_array( $args ) ? array_merge( $defaults, $args ) : $defaults; }
function wp_generate_password( $n = 12, $special = false ) { return bin2hex( random_bytes( max( 4, (int) ( $n / 2 ) ) ) ); }
function wp_nonce_field( $a, $b = '_wpnonce' ) {
    printf( '<input type="hidden" name="%s" value="preview-nonce">', esc_attr( $b ) );
}
function wp_verify_nonce( $n, $a ) { return $n === 'preview-nonce' ? 1 : false; }
function wp_safe_redirect( $url ) { header( 'Location: ' . $url ); }
function wp_get_referer()         { return isset( $_SERVER['HTTP_REFERER'] ) ? $_SERVER['HTTP_REFERER'] : home_url( '/' ); }
function add_query_arg( $k, $v, $url ) {
    $sep = ( strpos( $url, '?' ) === false ) ? '?' : '&';
    return $url . $sep . $k . '=' . $v;
}
function wp_mail( $to, $subj, $body, $headers = array() ) { return false; } // no email in preview
function set_transient( $k, $v, $exp ) { $_SESSION['_t_' . $k] = $v; return true; }
function get_transient( $k )           { return isset( $_SESSION['_t_' . $k] ) ? $_SESSION['_t_' . $k] : false; }
function delete_transient( $k )        { unset( $_SESSION['_t_' . $k] ); return true; }
function get_option( $k, $d = false )  { return $k === 'admin_email' ? $GLOBALS['bp_site']['admin_email'] : $d; }
function update_option( $k, $v )       { return true; }

/* -------------------------------------------------------------------------
 * Theme mods
 * ------------------------------------------------------------------------- */
function get_theme_mod( $key, $default = '' ) {
    return isset( $GLOBALS['bp_theme_mods'][ $key ] ) ? $GLOBALS['bp_theme_mods'][ $key ] : $default;
}
function set_theme_mod( $k, $v ) { $GLOBALS['bp_theme_mods'][ $k ] = $v; return true; }

/* -------------------------------------------------------------------------
 * Header/footer/sidebar includes
 * ------------------------------------------------------------------------- */
function get_header()  { include get_template_directory() . '/header.php'; }
function get_footer()  { include get_template_directory() . '/footer.php'; }
function get_sidebar() { include get_template_directory() . '/sidebar.php'; }
function wp_head()     {
    $css = get_stylesheet_uri();
    $mt  = @filemtime( get_template_directory() . '/style.css' ) ?: time();
    echo '<link rel="stylesheet" href="' . $css . '?v=' . $mt . '">' . "\n";
}
function wp_footer()   { /* no-op */ }
function wp_body_open(){ /* no-op */ }
function wp_enqueue_style() {}
function wp_enqueue_script() {}
function add_action( $a, $b, $p = 10, $c = 1 ) {}
function add_filter( $a, $b, $p = 10, $c = 1 ) {}
function add_theme_support( $a, $b = null ) {}
function register_nav_menus( $a ) {}
function load_theme_textdomain( $a, $b = '' ) {}
function did_action( $a ) { return 0; }
function register_post_type( $a, $b = array() ) {}
function register_taxonomy( $a, $b, $c ) {}
function register_sidebar( $a ) {}
function add_meta_box() {}
function dynamic_sidebar( $id ) { return false; }
function is_active_sidebar( $id ) { return false; }
function flush_rewrite_rules() {}

/* -------------------------------------------------------------------------
 * Logos, menus, custom logo
 * ------------------------------------------------------------------------- */
function has_custom_logo()  { return false; }
function the_custom_logo()  { /* no-op */ }
function has_nav_menu( $loc ) { return false; }
function wp_nav_menu( $args ) {
    if ( isset( $args['fallback_cb'] ) && function_exists( $args['fallback_cb'] ) ) {
        return call_user_func( $args['fallback_cb'] );
    }
    if ( function_exists( 'business_portfolio_default_menu' ) ) {
        return business_portfolio_default_menu();
    }
}

/* -------------------------------------------------------------------------
 * Conditional tags / context helpers
 * ------------------------------------------------------------------------- */
function is_singular( $t = '' )         { return false; }
function is_home()                      { return $GLOBALS['bp_route'] === 'blog'; }
function is_front_page()                { return $GLOBALS['bp_route'] === 'home'; }
function is_archive()                   { return false; }
function is_tax( $t = '', $term = '' )  { return false; }
function is_post_type_archive( $t = '' ){ return $GLOBALS['bp_route'] === 'portfolio_archive'; }
function comments_open()                { return false; }
function get_comments_number()          { return 0; }
function comments_template()            { /* no-op */ }
function pings_open()                   { return false; }
function post_password_required()       { return false; }
function single_post_title()            { echo 'Blog'; }
function the_archive_title()            { echo 'Archive'; }
function the_archive_description()      {}
function get_search_query()             { return isset( $_GET['s'] ) ? $_GET['s'] : ''; }
function get_search_form()              { include get_template_directory() . '/searchform.php'; }
function get_post_type_archive_link($t) { return home_url( '/portfolio' ); }
function get_post_type_object( $t )     { $o = new stdClass(); $o->labels = (object) array( 'singular_name' => ucfirst( $t ) ); return $o; }
function get_post_type()                { return 'post'; }
function has_category()                 { return false; }
function has_tag()                      { return false; }
function get_the_category_list( $sep ) { return ''; }
function get_the_tag_list( $b, $sep, $a = '' ) { return ''; }
function get_previous_post_link( $f = '%link', $l = '%title' ) { return ''; }
function get_next_post_link( $f = '%link', $l = '%title' )     { return ''; }
function the_posts_navigation( $a = array() ) {}
function the_posts_pagination( $a = array() ) {}
function the_comments_pagination( $a = array() ) {}
function comment_form()                  {}
function wp_list_comments( $a = array() ){}
function wp_link_pages( $a = array() )    {}
function get_terms( $args = array() )    { return array(); }
function get_term_link( $t )              { return '#'; }
function shortcode_exists( $t )           { return false; }
function do_shortcode( $t )               { return $t; }
function date_i18n( $f, $t = false )      { return date( $f, $t ?: time() ); }
function number_format_i18n( $n )         { return number_format( $n ); }
function sprintf_i18n() { return call_user_func_array( 'sprintf', func_get_args() ); }

/* -------------------------------------------------------------------------
 * The Loop & post functions — driven by $GLOBALS['bp_loop']
 * ------------------------------------------------------------------------- */
function _bp_set_loop( $items ) {
    $GLOBALS['bp_loop']     = $items;
    $GLOBALS['bp_loop_idx'] = 0;
    $GLOBALS['bp_current']  = null;
}
function have_posts() {
    return isset( $GLOBALS['bp_loop'] ) && $GLOBALS['bp_loop_idx'] < count( $GLOBALS['bp_loop'] );
}
function the_post() {
    $GLOBALS['bp_current'] = $GLOBALS['bp_loop'][ $GLOBALS['bp_loop_idx']++ ];
}
function wp_reset_postdata() { $GLOBALS['bp_current'] = null; }

function get_the_ID()        { return isset( $GLOBALS['bp_current']['id'] ) ? $GLOBALS['bp_current']['id'] : 0; }
function the_ID()             { echo (int) get_the_ID(); }
function get_the_title( $id = 0 ) { return isset( $GLOBALS['bp_current']['title'] ) ? $GLOBALS['bp_current']['title'] : ''; }
function the_title( $before = '', $after = '', $echo = true ) {
    $out = $before . esc_html( get_the_title() ) . $after;
    if ( $echo ) echo $out; else return $out;
}
function get_the_excerpt() {
    return isset( $GLOBALS['bp_current']['excerpt'] ) ? $GLOBALS['bp_current']['excerpt']
        : ( isset( $GLOBALS['bp_current']['content'] ) ? $GLOBALS['bp_current']['content'] : '' );
}
function the_excerpt() { echo wpautop( get_the_excerpt() ); }
function get_the_content() {
    return isset( $GLOBALS['bp_current']['content'] ) ? $GLOBALS['bp_current']['content']
        : ( isset( $GLOBALS['bp_current']['excerpt'] ) ? $GLOBALS['bp_current']['excerpt'] : '' );
}
function the_content() { echo wpautop( get_the_content() ); }
function get_the_date( $f = 'F j, Y' ) { return date( $f ); }
function get_the_author()              { return 'Demo Author'; }
function the_permalink()               { echo get_permalink(); }
function get_permalink( $id = 0 ) {
    $route = isset( $GLOBALS['bp_current']['slug'] ) ? $GLOBALS['bp_current']['slug'] : '';
    return home_url( '/' . $route );
}
function has_post_thumbnail( $id = 0 ) { return false; }
function the_post_thumbnail( $size = 'thumbnail', $attrs = array() ) {}
function get_post_meta( $id, $key, $single = true ) {
    foreach ( $GLOBALS['bp_loop'] as $item ) {
        if ( ( isset( $item['id'] ) ? $item['id'] : 0 ) == $id ) {
            $map = array(
                '_service_icon'        => isset( $item['icon'] ) ? $item['icon'] : '',
                '_testimonial_author'  => isset( $item['author'] ) ? $item['author'] : '',
                '_testimonial_role'    => isset( $item['role'] ) ? $item['role'] : '',
                '_team_role'           => isset( $item['role'] ) ? $item['role'] : '',
                '_team_linkedin'       => isset( $item['linkedin'] ) ? $item['linkedin'] : '',
                '_project_client'      => isset( $item['client'] ) ? $item['client'] : '',
                '_project_url'         => isset( $item['url'] ) ? $item['url'] : '',
            );
            return isset( $map[ $key ] ) ? $map[ $key ] : '';
        }
    }
    return '';
}
function update_post_meta( $id, $k, $v ) { return true; }
function wp_insert_post( $a ) { return rand( 1000, 9999 ); }
function get_page_by_path( $s ) { return null; }
function single_term_title()                {}

/* -------------------------------------------------------------------------
 * WP_Query stub
 * ------------------------------------------------------------------------- */
class WP_Query {
    public $posts = array();
    private $idx = 0;
    public $post = null;
    public function __construct( $args = array() ) {
        $type = isset( $args['post_type'] ) ? $args['post_type'] : 'post';
        $limit = isset( $args['posts_per_page'] ) ? (int) $args['posts_per_page'] : -1;
        $map = array(
            'service'      => $GLOBALS['bp_services'],
            'portfolio'    => $GLOBALS['bp_portfolio'],
            'testimonial'  => $GLOBALS['bp_testimonials'],
            'team_member'  => $GLOBALS['bp_team'],
        );
        $items = isset( $map[ $type ] ) ? $map[ $type ] : array();
        if ( $limit > 0 ) {
            $items = array_slice( $items, 0, $limit );
        }
        $this->posts = $items;
    }
    public function have_posts() {
        $has = $this->idx < count( $this->posts );
        if ( $has ) {
            $GLOBALS['bp_loop']     = $this->posts;
            $GLOBALS['bp_loop_idx'] = $this->idx;
        }
        return $has;
    }
    public function the_post() {
        $this->post = $this->posts[ $this->idx ];
        $GLOBALS['bp_current']  = $this->post;
        $GLOBALS['bp_loop']     = $this->posts;
        $GLOBALS['bp_loop_idx'] = $this->idx + 1;
        $this->idx++;
    }
}

/* -------------------------------------------------------------------------
 * Helpers used by the theme (re-defined to avoid loading functions.php's
 * full setup path which adds actions to non-existent WP hook system).
 * ------------------------------------------------------------------------- */
if ( ! function_exists( 'business_portfolio_default_menu' ) ) {
    function business_portfolio_default_menu() {
        $items = array(
            '/'         => 'Home',
            '/about'    => 'About',
            '/services' => 'Services',
            '/blog'     => 'Blog',
            '/contact'  => 'Contact',
        );
        echo '<ul id="primary-menu" class="menu">';
        foreach ( $items as $path => $label ) {
            $active = $GLOBALS['bp_route'] === trim( $path, '/' ) ||
                      ( $path === '/' && $GLOBALS['bp_route'] === 'home' );
            printf(
                '<li class="%s"><a href="%s">%s</a></li>',
                $active ? 'current-menu-item' : '',
                esc_url( home_url( $path ) ),
                esc_html( $label )
            );
        }
        echo '</ul>';
    }
}

if ( ! function_exists( 'business_portfolio_excerpt' ) ) {
    function business_portfolio_excerpt( $length = 25 ) {
        $excerpt = get_the_excerpt();
        if ( ! $excerpt ) {
            $excerpt = wp_strip_all_tags( get_the_content() );
        }
        return wp_trim_words( $excerpt, $length, '…' );
    }
}

if ( ! function_exists( 'bp_contact_token' ) ) {
    function bp_contact_token() {
        if ( ! session_id() && ! headers_sent() ) { @session_start(); }
        if ( empty( $_SESSION['bp_token'] ) ) { $_SESSION['bp_token'] = wp_generate_password( 12 ); }
        return $_SESSION['bp_token'];
    }
}

if ( ! function_exists( 'business_portfolio_render_contact_messages' ) ) {
    function business_portfolio_render_contact_messages() {
        if ( ! isset( $_GET['bp_sent'] ) ) { return; }
        printf(
            '<div class="form-message form-message--success">%s</div>',
            esc_html( 'Thanks! Your message has been received. (Preview mode — no email is actually sent.)' )
        );
    }
}
