<?php if (nimbus_get_option('fp-banner-toggle') == '1') { ?>
    <section class="frontpage-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php if (nimbus_get_option('fp-banner-title') != '') { ?>
                        <div class="banner-title"><?php echo esc_html(nimbus_get_option('fp-banner-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-banner-sub-title') != '') { ?>
                        <div class="banner-sub-title"><?php echo esc_html(nimbus_get_option('fp-banner-sub-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-banner-button-url') != '') { ?>
                        <div class="banner-link-button"><a href="<?php echo esc_url(nimbus_get_option('fp-banner-button-url')); ?>"><?php echo esc_html(nimbus_get_option('fp-banner-button-text')); ?></a></div>
                    <?php } ?>
                </div> 
            </div>    
        </div>    
    </section>  
<?php } else { ?>
    <?php $venture_lite_pp_toggle=trim(nimbus_get_option('fp-pp-banner-toggle'));
    $p='';
    if (!empty($venture_lite_pp_toggle)){
        if ($venture_lite_pp_toggle=='post') {
            $p=intval(nimbus_get_option('fp_pp_banner_posts'));
            $custom_args = array('posts_per_page' => 1, 'post__not_in' => get_option( 'sticky_posts' ), 'p' => $p);
        } else if ($venture_lite_pp_toggle=='page') {
            $p=intval(nimbus_get_option('fp_pp_banner_page'));
            $custom_args = array('posts_per_page' => 1, 'page_id' => $p);
        }
    } else {
        $custom_args = array('posts_per_page' => 1, 'post__not_in' => get_option( 'sticky_posts' ));
    }
    $custom_query = new WP_Query( $custom_args );
    if ( $custom_query->have_posts() ) {
        while ( $custom_query->have_posts() ) {
            $custom_query->the_post(); ?>
            <section class="frontpage-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <?php the_title('<div class="banner-title">','</div>'); ?>
                            <div class="banner-sub-title"><?php $content = get_the_content(); echo wp_trim_words( $content , '5' ); ?></div>
                            <div class="banner-link-button"><a href="<?php the_permalink(); ?>"><?php _e('Learn More', 'venture-lite' ); ?></a></div>
                        </div> 
                    </div>    
                </div>    
            </section> 
        <?php  }      
    }
    wp_reset_postdata();
} ?>