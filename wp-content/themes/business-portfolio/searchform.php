<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <label class="screen-reader-text" for="bp-search"><?php esc_html_e( 'Search for:', 'business-portfolio' ); ?></label>
    <input type="search" id="bp-search" class="search-field" name="s"
           placeholder="<?php esc_attr_e( 'Search…', 'business-portfolio' ); ?>"
           value="<?php echo esc_attr( get_search_query() ); ?>">
    <button type="submit" class="search-submit btn"><?php esc_html_e( 'Search', 'business-portfolio' ); ?></button>
</form>
