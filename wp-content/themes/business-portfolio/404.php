<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<main id="primary" class="site-main">

    <section class="error-404 not-found" style="text-align: center; padding: 6rem 0;">
        <div class="container">
            <header class="page-header">
                <h1 class="page-title" style="font-size: 4rem; color: var(--secondary-color); margin-bottom: 1rem;">404</h1>
                <h2 style="margin-bottom: 2rem;">Oops! That page can&rsquo;t be found.</h2>
            </header>

            <div class="page-content">
                <p style="margin-bottom: 2rem;">It looks like nothing was found at this location. Maybe try a search or return home?</p>
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn">Back to Home</a>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
