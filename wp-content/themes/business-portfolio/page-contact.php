<?php
/**
 * Template Name: Contact Page
 *
 * Includes a fully-functional contact form built with pure PHP. No
 * Contact Form 7 or other plugin required. The form is processed in
 * functions.php (business_portfolio_handle_contact_form).
 */

get_header();

$email   = get_theme_mod( 'bp_contact_email',   'contact@example.com' );
$phone   = get_theme_mod( 'bp_contact_phone',   '+1 (555) 123-4567' );
$address = get_theme_mod( 'bp_contact_address', '123 Business Ave, Tech City, TC 90210' );

// Pull last submission data if validation failed (so user doesn't lose typed text).
$token = bp_contact_token();
$msg   = get_transient( 'bp_contact_msg_' . $token );
$old   = ( $msg && ! empty( $msg['data'] ) ) ? $msg['data'] : array();
$old   = wp_parse_args( $old, array( 'name' => '', 'email' => '', 'subject' => '', 'message' => '' ) );
?>

<main id="primary" class="site-main">

    <section class="page-header">
        <div class="container">
            <h1 class="page-title"><?php esc_html_e( 'Contact Us', 'business-portfolio' ); ?></h1>
            <p><?php esc_html_e( 'We\'d love to hear from you. Send us a message below.', 'business-portfolio' ); ?></p>
        </div>
    </section>

    <section class="contact-section">
        <div class="container contact-grid">

            <aside class="contact-info">
                <h2><?php esc_html_e( 'Get in touch', 'business-portfolio' ); ?></h2>
                <ul class="contact-info-list">
                    <li>
                        <span class="contact-info-label"><?php esc_html_e( 'Email', 'business-portfolio' ); ?></span>
                        <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                    </li>
                    <li>
                        <span class="contact-info-label"><?php esc_html_e( 'Phone', 'business-portfolio' ); ?></span>
                        <span><?php echo esc_html( $phone ); ?></span>
                    </li>
                    <li>
                        <span class="contact-info-label"><?php esc_html_e( 'Address', 'business-portfolio' ); ?></span>
                        <span><?php echo esc_html( $address ); ?></span>
                    </li>
                </ul>

                <h3><?php esc_html_e( 'Office Hours', 'business-portfolio' ); ?></h3>
                <p>
                    <?php esc_html_e( 'Monday – Friday', 'business-portfolio' ); ?><br>
                    <?php esc_html_e( '9:00 AM – 6:00 PM', 'business-portfolio' ); ?>
                </p>
            </aside>

            <div class="contact-form-wrapper">
                <h2><?php esc_html_e( 'Send a Message', 'business-portfolio' ); ?></h2>

                <?php business_portfolio_render_contact_messages(); ?>

                <form action="<?php echo esc_url( get_permalink() ); ?>" method="post" class="bp-contact-form" novalidate>
                    <?php wp_nonce_field( 'bp_contact_form', 'bp_contact_nonce' ); ?>

                    <div class="form-row">
                        <label for="bp_name"><?php esc_html_e( 'Your Name', 'business-portfolio' ); ?> <span aria-hidden="true">*</span></label>
                        <input type="text" id="bp_name" name="bp_name" required value="<?php echo esc_attr( $old['name'] ); ?>">
                    </div>

                    <div class="form-row">
                        <label for="bp_email"><?php esc_html_e( 'Your Email', 'business-portfolio' ); ?> <span aria-hidden="true">*</span></label>
                        <input type="email" id="bp_email" name="bp_email" required value="<?php echo esc_attr( $old['email'] ); ?>">
                    </div>

                    <div class="form-row">
                        <label for="bp_subject"><?php esc_html_e( 'Subject', 'business-portfolio' ); ?></label>
                        <input type="text" id="bp_subject" name="bp_subject" value="<?php echo esc_attr( $old['subject'] ); ?>">
                    </div>

                    <div class="form-row">
                        <label for="bp_message"><?php esc_html_e( 'Your Message', 'business-portfolio' ); ?> <span aria-hidden="true">*</span></label>
                        <textarea id="bp_message" name="bp_message" rows="6" required><?php echo esc_textarea( $old['message'] ); ?></textarea>
                    </div>

                    <!-- Honeypot field (hidden from real users) -->
                    <div class="form-row form-row--honeypot" aria-hidden="true">
                        <label for="bp_website">Leave this field empty</label>
                        <input type="text" id="bp_website" name="bp_website" tabindex="-1" autocomplete="off" value="">
                    </div>

                    <div class="form-row form-row--actions">
                        <button type="submit" name="bp_contact_submit" class="btn btn--primary">
                            <?php esc_html_e( 'Send Message', 'business-portfolio' ); ?>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>

</main>

<?php get_footer();
