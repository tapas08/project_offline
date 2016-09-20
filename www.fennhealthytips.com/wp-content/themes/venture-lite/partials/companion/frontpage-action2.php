<?php if (nimbus_get_option('fp-action2-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-action2-slug')=='') {echo "action2";} else {echo esc_attr(nimbus_get_option('fp-action2-slug'));} ?>" class="frontpage-action2">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-action2-title') != '') { ?>
                    <div class="action2-title h2"><?php echo esc_html(nimbus_get_option('fp-action2-title')); ?></div>
                    <?php } ?>
                    <?php if ((nimbus_get_option('fp-action2-button-text') != '') && (nimbus_get_option('fp-action2-button-url') != '')) { ?>
                        <div class="action2-link-button"><a href="<?php echo esc_url(nimbus_get_option('fp-action2-button-url')); ?>"><?php echo esc_html(nimbus_get_option('fp-action2-button-text')); ?></a></div>
                    <?php } ?>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } else if (nimbus_get_option('fp-action2-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-action2-slug')=='') {echo "action2";} else {echo esc_attr(nimbus_get_option('fp-action2-slug'));} ?>" class="frontpage-action2">  
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="action2-title h2"><?php _e('Call To Action - Convince me why I should take this action.', 'venture-lite' ); ?></div>
                    <div class="action2-link-button"><a href="#"><?php _e('Go For It!', 'venture-lite' ); ?></a></div>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } ?> 

