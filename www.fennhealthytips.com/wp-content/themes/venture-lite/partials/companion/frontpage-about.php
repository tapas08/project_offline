<?php if (nimbus_get_option('fp-about-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-about-slug')=='') {echo "about";} else {echo esc_attr(nimbus_get_option('fp-about-slug'));} ?>" class="frontpage-about">   
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-about-title') != '') { ?>
                        <div class="about-title h1"><?php echo esc_html(nimbus_get_option('fp-about-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-about-sub-title') != '') { ?>
                        <div class="about-sub-title h4"><?php echo esc_html(nimbus_get_option('fp-about-sub-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-about-description') != '') { ?>
                        <p class="about-desc"><?php echo esc_html(nimbus_get_option('fp-about-description')); ?></p>
                    <?php } ?>
                    <?php if ( is_active_sidebar( 'frontpage-about' ) ) { ?>
                    	<?php dynamic_sidebar( 'frontpage-about' ); ?>
                    <?php } ?>
                </div> 
            </div>    
        </div>    
     </section>
<?php } else if (nimbus_get_option('fp-about-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-about-slug')=='') {echo "about";} else {echo esc_attr(nimbus_get_option('fp-about-slug'));} ?>" class="frontpage-about">   
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="about-title h1"><?php _e('About Us', 'venture-lite'); ?></div>
                    <div class="about-sub-title h4"><?php _e('A little bit of background on our fabulous company.', 'venture-lite'); ?></div>
                    <p class="about-desc"><?php _e('Uenatis mattis non vitae augue. Nullam congue commodo lorem vitae facilisis. Suspendisse malesuada id turpis interdum dictum.Cum sociis natoque penatibus.', 'venture-lite'); ?></p>
                    <div class="row frontpage-about-row" data-sr="enter left and move 50px after 1s">
                        <div class="col-sm-6">
                            <i class="fa fa-bitbucket"></i><h4><?php _e('BRAND &amp; IDENTITY', 'venture-lite'); ?></h4><p><?php _e('Praesent faucibus nisl sit amet nulla sollicitudin pretium a sed purus. Nullam bibendum porta magna.', 'venture-lite'); ?></p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-bitbucket"></i><h4><?php _e('BRAND &amp; IDENTITY', 'venture-lite'); ?></h4><p><?php _e('Praesent faucibus nisl sit amet nulla sollicitudin pretium a sed purus. Nullam bibendum porta magna.', 'venture-lite'); ?></p>
                        </div>   
                    </div>
                    <div class="row frontpage-about-row"  data-sr="enter left and move 50px after 1s">
                        <div class="col-sm-6">
                            <i class="fa fa-bitbucket"></i><h4><?php _e('BRAND &amp; IDENTITY', 'venture-lite'); ?></h4><p><?php _e('Praesent faucibus nisl sit amet nulla sollicitudin pretium a sed purus. Nullam bibendum porta magna.', 'venture-lite'); ?></p>
                        </div>
                        <div class="col-sm-6">
                            <i class="fa fa-bitbucket"></i><h4><?php _e('BRAND &amp; IDENTITY', 'venture-lite'); ?></h4><p><?php _e('Praesent faucibus nisl sit amet nulla sollicitudin pretium a sed purus. Nullam bibendum porta magna.', 'venture-lite'); ?></p>
                        </div>   
                    </div>
                </div> 
            </div>    
        </div>    
     </section>
<?php } ?> 