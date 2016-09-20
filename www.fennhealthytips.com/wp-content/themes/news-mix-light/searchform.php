<form action="<?php echo esc_url(home_url()); ?>" method="get" class="search-form clearfix">
    <p class="input-search-form clearfix">
        <input type="text" name="s" placeholder="<?php _e( 'Search', kopa_get_domain() ); ?>" value="<?php echo get_search_query(); ?>" class="search-form-field" size="40">
        <input type="submit" value="<?php _e('Search', kopa_get_domain()); ?>" class="submit">
    </p>
</form>