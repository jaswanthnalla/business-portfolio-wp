<?php
/**
 * Business Portfolio — Theme Functions
 *
 * A complete, self-contained business portfolio theme built with pure
 * WordPress + PHP. No external plugins or JavaScript frameworks required.
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

define( 'BUSINESS_PORTFOLIO_VERSION', '2.0.0' );

/* -------------------------------------------------------------------------
 * 1. Theme Setup
 * ------------------------------------------------------------------------- */
if ( ! function_exists( 'business_portfolio_setup' ) ) {
    function business_portfolio_setup() {
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
        add_theme_support( 'custom-logo', array(
            'height'      => 80,
            'width'       => 240,
            'flex-width'  => true,
            'flex-height' => true,
        ) );
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script',
        ) );
        add_theme_support( 'custom-background', array(
            'default-color' => 'ffffff',
        ) );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'align-wide' );

        register_nav_menus( array(
            'primary' => __( 'Primary Menu', 'business-portfolio' ),
            'footer'  => __( 'Footer Menu', 'business-portfolio' ),
            'social'  => __( 'Social Links Menu', 'business-portfolio' ),
        ) );

        load_theme_textdomain( 'business-portfolio', get_template_directory() . '/languages' );
    }
}
add_action( 'after_setup_theme', 'business_portfolio_setup' );

/* -------------------------------------------------------------------------
 * 2. Enqueue Styles
 * ------------------------------------------------------------------------- */
function business_portfolio_scripts() {
    wp_enqueue_style(
        'business-portfolio-style',
        get_stylesheet_uri(),
        array(),
        BUSINESS_PORTFOLIO_VERSION
    );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}
add_action( 'wp_enqueue_scripts', 'business_portfolio_scripts' );

/* -------------------------------------------------------------------------
 * 3. Widget Areas
 * ------------------------------------------------------------------------- */
function business_portfolio_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'business-portfolio' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Sidebar shown on blog and archive pages.', 'business-portfolio' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'Footer Column %d', 'business-portfolio' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => __( 'Add widgets to your footer.', 'business-portfolio' ),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ) );
    }
}
add_action( 'widgets_init', 'business_portfolio_widgets_init' );

/* -------------------------------------------------------------------------
 * 4. Custom Post Types — Portfolio, Services, Testimonials, Team
 * ------------------------------------------------------------------------- */
function business_portfolio_register_cpts() {
    // Portfolio
    register_post_type( 'portfolio', array(
        'labels' => array(
            'name'          => __( 'Portfolio', 'business-portfolio' ),
            'singular_name' => __( 'Project', 'business-portfolio' ),
            'add_new_item'  => __( 'Add New Project', 'business-portfolio' ),
            'edit_item'     => __( 'Edit Project', 'business-portfolio' ),
            'menu_name'     => __( 'Portfolio', 'business-portfolio' ),
        ),
        'public'       => true,
        'has_archive'  => true,
        'menu_icon'    => 'dashicons-portfolio',
        'menu_position'=> 5,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
        'rewrite'      => array( 'slug' => 'portfolio' ),
        'show_in_rest' => true,
    ) );

    register_taxonomy( 'portfolio_category', 'portfolio', array(
        'labels' => array(
            'name'          => __( 'Project Categories', 'business-portfolio' ),
            'singular_name' => __( 'Category', 'business-portfolio' ),
        ),
        'hierarchical' => true,
        'public'       => true,
        'show_in_rest' => true,
        'rewrite'      => array( 'slug' => 'portfolio-category' ),
    ) );

    // Services
    register_post_type( 'service', array(
        'labels' => array(
            'name'          => __( 'Services', 'business-portfolio' ),
            'singular_name' => __( 'Service', 'business-portfolio' ),
            'add_new_item'  => __( 'Add New Service', 'business-portfolio' ),
            'menu_name'     => __( 'Services', 'business-portfolio' ),
        ),
        'public'       => true,
        'has_archive'  => false,
        'menu_icon'    => 'dashicons-screenoptions',
        'menu_position'=> 6,
        'supports'     => array( 'title', 'editor', 'thumbnail', 'excerpt', 'page-attributes' ),
        'rewrite'      => array( 'slug' => 'services' ),
        'show_in_rest' => true,
    ) );

    // Testimonials
    register_post_type( 'testimonial', array(
        'labels' => array(
            'name'          => __( 'Testimonials', 'business-portfolio' ),
            'singular_name' => __( 'Testimonial', 'business-portfolio' ),
            'menu_name'     => __( 'Testimonials', 'business-portfolio' ),
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-format-quote',
        'menu_position'=> 7,
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
    ) );

    // Team
    register_post_type( 'team_member', array(
        'labels' => array(
            'name'          => __( 'Team', 'business-portfolio' ),
            'singular_name' => __( 'Team Member', 'business-portfolio' ),
            'menu_name'     => __( 'Team', 'business-portfolio' ),
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-groups',
        'menu_position'=> 8,
        'supports'     => array( 'title', 'editor', 'thumbnail' ),
    ) );
}
add_action( 'init', 'business_portfolio_register_cpts' );

/* -------------------------------------------------------------------------
 * 5. Custom Meta Boxes — Service icon, Testimonial author, Team role
 * ------------------------------------------------------------------------- */
function business_portfolio_meta_boxes() {
    add_meta_box( 'service_icon', __( 'Service Icon (emoji or text)', 'business-portfolio' ),
        'business_portfolio_service_icon_cb', 'service', 'side' );
    add_meta_box( 'testimonial_meta', __( 'Author Details', 'business-portfolio' ),
        'business_portfolio_testimonial_cb', 'testimonial', 'normal' );
    add_meta_box( 'team_meta', __( 'Member Details', 'business-portfolio' ),
        'business_portfolio_team_cb', 'team_member', 'normal' );
    add_meta_box( 'portfolio_meta', __( 'Project Details', 'business-portfolio' ),
        'business_portfolio_project_cb', 'portfolio', 'normal' );
}
add_action( 'add_meta_boxes', 'business_portfolio_meta_boxes' );

function business_portfolio_service_icon_cb( $post ) {
    wp_nonce_field( 'bp_save_meta', 'bp_meta_nonce' );
    $icon = get_post_meta( $post->ID, '_service_icon', true );
    printf(
        '<input type="text" name="service_icon" value="%s" style="width:100%%;" placeholder="e.g. ⚡ or WD" />',
        esc_attr( $icon )
    );
}

function business_portfolio_testimonial_cb( $post ) {
    wp_nonce_field( 'bp_save_meta', 'bp_meta_nonce' );
    $author  = get_post_meta( $post->ID, '_testimonial_author', true );
    $role    = get_post_meta( $post->ID, '_testimonial_role', true );
    printf( '<p><label>Author Name<br><input type="text" name="testimonial_author" value="%s" style="width:100%%;" /></label></p>', esc_attr( $author ) );
    printf( '<p><label>Role / Company<br><input type="text" name="testimonial_role" value="%s" style="width:100%%;" /></label></p>', esc_attr( $role ) );
}

function business_portfolio_team_cb( $post ) {
    wp_nonce_field( 'bp_save_meta', 'bp_meta_nonce' );
    $role     = get_post_meta( $post->ID, '_team_role', true );
    $linkedin = get_post_meta( $post->ID, '_team_linkedin', true );
    printf( '<p><label>Role<br><input type="text" name="team_role" value="%s" style="width:100%%;" /></label></p>', esc_attr( $role ) );
    printf( '<p><label>LinkedIn URL<br><input type="url" name="team_linkedin" value="%s" style="width:100%%;" /></label></p>', esc_attr( $linkedin ) );
}

function business_portfolio_project_cb( $post ) {
    wp_nonce_field( 'bp_save_meta', 'bp_meta_nonce' );
    $client = get_post_meta( $post->ID, '_project_client', true );
    $url    = get_post_meta( $post->ID, '_project_url', true );
    printf( '<p><label>Client<br><input type="text" name="project_client" value="%s" style="width:100%%;" /></label></p>', esc_attr( $client ) );
    printf( '<p><label>Project URL<br><input type="url" name="project_url" value="%s" style="width:100%%;" /></label></p>', esc_attr( $url ) );
}

function business_portfolio_save_meta( $post_id ) {
    if ( ! isset( $_POST['bp_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bp_meta_nonce'], 'bp_save_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    $fields = array(
        'service_icon'        => '_service_icon',
        'testimonial_author'  => '_testimonial_author',
        'testimonial_role'    => '_testimonial_role',
        'team_role'           => '_team_role',
        'team_linkedin'       => '_team_linkedin',
        'project_client'      => '_project_client',
        'project_url'         => '_project_url',
    );

    foreach ( $fields as $field => $key ) {
        if ( isset( $_POST[ $field ] ) ) {
            $value = ( strpos( $field, 'linkedin' ) !== false || strpos( $field, 'url' ) !== false )
                ? esc_url_raw( $_POST[ $field ] )
                : sanitize_text_field( $_POST[ $field ] );
            update_post_meta( $post_id, $key, $value );
        }
    }
}
add_action( 'save_post', 'business_portfolio_save_meta' );

/* -------------------------------------------------------------------------
 * 6. Theme Customizer — Hero, contact info, social links
 * ------------------------------------------------------------------------- */
function business_portfolio_customize_register( $wp_customize ) {
    // Hero Section
    $wp_customize->add_section( 'bp_hero', array(
        'title'    => __( 'Homepage Hero', 'business-portfolio' ),
        'priority' => 30,
    ) );
    $wp_customize->add_setting( 'bp_hero_title', array(
        'default'           => 'Building Digital Excellence',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bp_hero_title', array(
        'label'   => __( 'Hero Title', 'business-portfolio' ),
        'section' => 'bp_hero',
        'type'    => 'text',
    ) );
    $wp_customize->add_setting( 'bp_hero_subtitle', array(
        'default'           => 'Professional Web Solutions for Modern Businesses',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'bp_hero_subtitle', array(
        'label'   => __( 'Hero Subtitle', 'business-portfolio' ),
        'section' => 'bp_hero',
        'type'    => 'text',
    ) );

    // Contact Info
    $wp_customize->add_section( 'bp_contact', array(
        'title'    => __( 'Contact Information', 'business-portfolio' ),
        'priority' => 40,
    ) );
    $defaults = array(
        'bp_contact_email'   => 'contact@example.com',
        'bp_contact_phone'   => '+1 (555) 123-4567',
        'bp_contact_address' => '123 Business Ave, Tech City, TC 90210',
    );
    foreach ( $defaults as $id => $default ) {
        $wp_customize->add_setting( $id, array(
            'default'           => $default,
            'sanitize_callback' => 'sanitize_text_field',
        ) );
        $wp_customize->add_control( $id, array(
            'label'   => ucfirst( str_replace( array( 'bp_contact_', '_' ), array( '', ' ' ), $id ) ),
            'section' => 'bp_contact',
            'type'    => 'text',
        ) );
    }

    // Social Links
    $wp_customize->add_section( 'bp_social', array(
        'title'    => __( 'Social Links', 'business-portfolio' ),
        'priority' => 50,
    ) );
    $socials = array( 'twitter', 'facebook', 'linkedin', 'instagram', 'github' );
    foreach ( $socials as $s ) {
        $wp_customize->add_setting( 'bp_social_' . $s, array(
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ) );
        $wp_customize->add_control( 'bp_social_' . $s, array(
            'label'   => ucfirst( $s ) . ' URL',
            'section' => 'bp_social',
            'type'    => 'url',
        ) );
    }
}
add_action( 'customize_register', 'business_portfolio_customize_register' );

/* -------------------------------------------------------------------------
 * 7. Built-in Contact Form Handler — Pure PHP, no plugin required
 * ------------------------------------------------------------------------- */
function business_portfolio_handle_contact_form() {
    if ( ! isset( $_POST['bp_contact_submit'] ) ) {
        return;
    }

    if ( ! isset( $_POST['bp_contact_nonce'] ) ||
         ! wp_verify_nonce( $_POST['bp_contact_nonce'], 'bp_contact_form' ) ) {
        set_transient( 'bp_contact_msg_' . bp_contact_token(), array(
            'type' => 'error',
            'text' => __( 'Security check failed. Please try again.', 'business-portfolio' ),
        ), 60 );
        return;
    }

    // Honeypot (silent reject)
    if ( ! empty( $_POST['bp_website'] ) ) {
        return;
    }

    $name    = isset( $_POST['bp_name'] ) ? sanitize_text_field( wp_unslash( $_POST['bp_name'] ) ) : '';
    $email   = isset( $_POST['bp_email'] ) ? sanitize_email( wp_unslash( $_POST['bp_email'] ) ) : '';
    $subject = isset( $_POST['bp_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['bp_subject'] ) ) : '';
    $message = isset( $_POST['bp_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['bp_message'] ) ) : '';

    $errors = array();
    if ( '' === $name )                 { $errors[] = __( 'Name is required.', 'business-portfolio' ); }
    if ( ! is_email( $email ) )         { $errors[] = __( 'A valid email is required.', 'business-portfolio' ); }
    if ( strlen( $message ) < 10 )      { $errors[] = __( 'Message must be at least 10 characters.', 'business-portfolio' ); }

    $token = bp_contact_token();

    if ( ! empty( $errors ) ) {
        set_transient( 'bp_contact_msg_' . $token, array(
            'type' => 'error',
            'text' => implode( ' ', $errors ),
            'data' => compact( 'name', 'email', 'subject', 'message' ),
        ), 60 );
        return;
    }

    $to       = get_option( 'admin_email' );
    $headers  = array(
        'Content-Type: text/html; charset=UTF-8',
        sprintf( 'From: %s <%s>', get_bloginfo( 'name' ), $to ),
        sprintf( 'Reply-To: %s <%s>', $name, $email ),
    );
    $subj     = $subject ? sprintf( '[%s] %s', get_bloginfo( 'name' ), $subject )
                         : sprintf( '[%s] New contact message', get_bloginfo( 'name' ) );
    $body     = sprintf(
        "<p><strong>From:</strong> %s &lt;%s&gt;</p><p><strong>Subject:</strong> %s</p><hr><p>%s</p>",
        esc_html( $name ),
        esc_html( $email ),
        esc_html( $subject ),
        nl2br( esc_html( $message ) )
    );

    $sent = wp_mail( $to, $subj, $body, $headers );

    // Save submission as private CPT entry for record keeping
    wp_insert_post( array(
        'post_type'    => 'bp_message',
        'post_status'  => 'private',
        'post_title'   => $subject ? $subject : sprintf( 'Message from %s', $name ),
        'post_content' => $message,
        'meta_input'   => array(
            '_bp_msg_name'  => $name,
            '_bp_msg_email' => $email,
            '_bp_msg_sent'  => $sent ? 1 : 0,
        ),
    ) );

    set_transient( 'bp_contact_msg_' . $token, array(
        'type' => $sent ? 'success' : 'warning',
        'text' => $sent
            ? __( 'Thanks! Your message has been sent. We will be in touch soon.', 'business-portfolio' )
            : __( 'Your message was saved but email delivery failed. We will still review it.', 'business-portfolio' ),
    ), 60 );

    wp_safe_redirect( add_query_arg( 'bp_sent', '1', wp_get_referer() ) );
    exit;
}
add_action( 'init', 'business_portfolio_handle_contact_form' );

/** Per-session token for contact-form transient messages. */
function bp_contact_token() {
    if ( ! session_id() && ! headers_sent() ) {
        @session_start();
    }
    if ( empty( $_SESSION['bp_token'] ) ) {
        $_SESSION['bp_token'] = wp_generate_password( 12, false );
    }
    return $_SESSION['bp_token'];
}

/** Register a private CPT to log contact messages in admin. */
function business_portfolio_register_message_cpt() {
    register_post_type( 'bp_message', array(
        'labels' => array(
            'name'          => __( 'Messages', 'business-portfolio' ),
            'singular_name' => __( 'Message', 'business-portfolio' ),
            'menu_name'     => __( 'Contact Messages', 'business-portfolio' ),
        ),
        'public'       => false,
        'show_ui'      => true,
        'menu_icon'    => 'dashicons-email',
        'menu_position'=> 9,
        'supports'     => array( 'title', 'editor' ),
        'capabilities' => array(
            'create_posts' => 'do_not_allow',
        ),
        'map_meta_cap' => true,
    ) );
}
add_action( 'init', 'business_portfolio_register_message_cpt' );

/* -------------------------------------------------------------------------
 * 8. Auto-create Required Pages on Theme Activation
 * ------------------------------------------------------------------------- */
function business_portfolio_create_pages() {
    $pages = array(
        'home'     => array( 'title' => 'Home',     'template' => 'front-page.php'   ),
        'about'    => array( 'title' => 'About',    'template' => 'page-about.php'   ),
        'services' => array( 'title' => 'Services', 'template' => 'page-services.php'),
        'contact'  => array( 'title' => 'Contact',  'template' => 'page-contact.php' ),
        'blog'     => array( 'title' => 'Blog',     'template' => ''                 ),
    );

    foreach ( $pages as $slug => $info ) {
        if ( ! get_page_by_path( $slug ) ) {
            $page_id = wp_insert_post( array(
                'post_title'   => $info['title'],
                'post_name'    => $slug,
                'post_status'  => 'publish',
                'post_type'    => 'page',
                'post_content' => '',
            ) );
            if ( $page_id && $info['template'] ) {
                update_post_meta( $page_id, '_wp_page_template', $info['template'] );
            }
        }
    }

    $home = get_page_by_path( 'home' );
    $blog = get_page_by_path( 'blog' );
    if ( $home && $blog ) {
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home->ID );
        update_option( 'page_for_posts', $blog->ID );
    }

    // Default primary menu
    $menu_name = 'Primary Menu';
    if ( ! wp_get_nav_menu_object( $menu_name ) ) {
        $menu_id = wp_create_nav_menu( $menu_name );
        foreach ( array( 'home', 'about', 'services', 'blog', 'contact' ) as $s ) {
            $page = get_page_by_path( $s );
            if ( $page ) {
                wp_update_nav_menu_item( $menu_id, 0, array(
                    'menu-item-title'     => $page->post_title,
                    'menu-item-object'    => 'page',
                    'menu-item-object-id' => $page->ID,
                    'menu-item-type'      => 'post_type',
                    'menu-item-status'    => 'publish',
                ) );
            }
        }
        $locations = get_theme_mod( 'nav_menu_locations', array() );
        $locations['primary'] = $menu_id;
        $locations['footer']  = $menu_id;
        set_theme_mod( 'nav_menu_locations', $locations );
    }

    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'business_portfolio_create_pages' );

/* -------------------------------------------------------------------------
 * 9. Helpers used in templates
 * ------------------------------------------------------------------------- */

/** Render a styled fallback menu when no menu is assigned. */
function business_portfolio_default_menu() {
    $items = array(
        '/'         => __( 'Home', 'business-portfolio' ),
        '/about'    => __( 'About', 'business-portfolio' ),
        '/services' => __( 'Services', 'business-portfolio' ),
        '/blog'     => __( 'Blog', 'business-portfolio' ),
        '/contact'  => __( 'Contact', 'business-portfolio' ),
    );
    echo '<ul id="primary-menu" class="menu">';
    foreach ( $items as $path => $label ) {
        printf(
            '<li><a href="%s">%s</a></li>',
            esc_url( home_url( $path ) ),
            esc_html( $label )
        );
    }
    echo '</ul>';
}

/** Output stored contact-form messages, then clear them. */
function business_portfolio_render_contact_messages() {
    $token = bp_contact_token();
    $msg   = get_transient( 'bp_contact_msg_' . $token );
    if ( ! $msg ) {
        return null;
    }
    delete_transient( 'bp_contact_msg_' . $token );
    printf(
        '<div class="form-message form-message--%s">%s</div>',
        esc_attr( $msg['type'] ),
        esc_html( $msg['text'] )
    );
    return $msg;
}

/** Excerpt with custom length. */
function business_portfolio_excerpt( $length = 25 ) {
    $excerpt = get_the_excerpt();
    if ( ! $excerpt ) {
        $excerpt = wp_strip_all_tags( get_the_content() );
    }
    return wp_trim_words( $excerpt, $length, '…' );
}

/** Pingback header. */
function business_portfolio_pingback_header() {
    if ( is_singular() && pings_open() ) {
        printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
    }
}
add_action( 'wp_head', 'business_portfolio_pingback_header' );
