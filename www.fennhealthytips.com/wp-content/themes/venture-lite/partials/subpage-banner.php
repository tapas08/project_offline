<div id="subpage-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                    <h1 class="banner-sub-title">
                    	<?php 
                    	if (is_home()){
                    		echo get_the_title( get_option('page_for_posts', true) );
                    	} else if (is_singular()){
                    		echo get_the_title();
                    	} else if (is_archive()) {
                    		if (is_date()){
								if ( is_day() ) { 
									echo get_the_date(); 
								} else if ( is_month() ){ 
									echo  get_the_date('F, Y'); 
								} else if ( is_year() ){ 
									echo  get_the_date('Y'); 
								}
                    		} else if (is_author()) {
                    			echo __('Posts by: ', 'venture-lite' ) . get_query_var('author_name');
                    		} else if (is_category()) {
                    			single_cat_title( '', true );
                    		} else if (is_tag()) {
                    			single_tag_title();
                    		}
                    	} else if (is_404()){
                    		_e('404', 'venture-lite' );
                    	} else if (is_search()){
                    		echo __('Results for: ', 'venture-lite' ) . get_search_query();
                    	}
                    	?>
                    </h1>
            </div> 
        </div>    
    </div>    
</div>  
