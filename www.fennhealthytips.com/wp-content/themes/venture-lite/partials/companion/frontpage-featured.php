<?php if (nimbus_get_option('fp-featured-toggle') == '1') { ?>
   <section id="<?php if (nimbus_get_option('fp-featured-slug')=='') {echo "featured";} else {echo esc_attr(nimbus_get_option('fp-featured-slug'));} ?>" class="frontpage-featured">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-featured-title') != '') { ?>
                        <div class="featured-title h1"><?php echo esc_html(nimbus_get_option('fp-featured-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-featured-sub-title') != '') { ?>
                        <div class="featured-sub-title h4"><?php echo esc_html(nimbus_get_option('fp-featured-sub-title')); ?></div>
                    <?php } ?>
                    <div class="row row-centered">
                        <?php if ( is_active_sidebar( 'frontpage-featured-left' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-featured-left' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-featured-center-left' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-featured-center-left' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-featured-center-right' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-featured-center-right' ); ?>
                        	</div>
                        <?php } ?>
                        <?php if ( is_active_sidebar( 'frontpage-featured-right' ) ) { ?>
                        	<div class="col-sm-3 col-centered">
                        		<?php dynamic_sidebar( 'frontpage-featured-right' ); ?>
                        	</div>
                        <?php } ?>
                    </div>    
                </div> 
            </div>    
        </div>    
    </section> 
<?php } else if (nimbus_get_option('fp-featured-toggle') == '3') {
    // Don't do anything
} else { ?>  
   <section id="<?php if (nimbus_get_option('fp-featured-slug')=='') {echo "featured";} else {echo esc_attr(nimbus_get_option('fp-featured-slug'));} ?>" class="frontpage-featured">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="featured-title h1"><?php _e('Theme Features', 'venture-lite' ); ?></div>
                    <div class="featured-sub-title h4"><?php _e('Four reasons to choose Venture for your next website project!', 'venture-lite' ); ?></div>
                    <div class="row row-centered">
                        <div class="col-sm-3 col-centered">
                            <a class="featured-item" href="#" data-sr="wait 0.1s, enter top and move 50px after 1s">
                                <i class="fa fa-bitbucket"></i>
                                <h4 class="featured-item-title"><?php _e('One-Page Layout', 'venture-lite' ); ?></h4>
                                <p class="featured-item-sub-title"><?php _e('Beautiful one-page frontpage with smooth scrolling navigation.', 'venture-lite' ); ?></p>
                            </a>
                        </div>          
                        <div class="col-sm-3 col-centered">
                            <a class="featured-item" href="#" data-sr="wait 0.1s, enter top and move 50px after 1s">
                                <i class="fa fa-star"></i>
                                <h4 class="featured-item-title"><?php _e('Customizer', 'venture-lite' ); ?></h4>
                                <p class="featured-item-sub-title"><?php _e('Uses the WordPress Core customizer for easy administration.', 'venture-lite' ); ?></p>
                            </a>
                        </div> 
                        <div class="col-sm-3 col-centered">
                            <a class="featured-item" href="#" data-sr="wait 0.1s, enter top and move 50px after 1s">
                                <i class="fa fa-anchor"></i>
                                <h4 class="featured-item-title"><?php _e('Parallax Effects', 'venture-lite' ); ?></h4>
                                <p class="featured-item-sub-title"><?php _e('Graceful scroll-activated parallax effects throughout.', 'venture-lite' ); ?></p>
                            </a>
                        </div> 
                        <div class="col-sm-3 col-centered">
                            <a class="featured-item" href="#" data-sr="wait 0.1s, enter top and move 50px after 1s">
                                <i class="fa fa-bomb"></i>
                                <h4 class="featured-item-title"><?php _e('High Impact Design', 'venture-lite' ); ?></h4>
                                <p class="featured-item-sub-title"><?php _e('A beautiful multi-purpose theme with a professional design.', 'venture-lite' ); ?></p>
                            </a>
                        </div> 
                    </div>    
                </div> 
            </div>    
        </div>    
    </section> 
<?php } ?>