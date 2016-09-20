<?php if (nimbus_get_option('fp-action1-toggle') == '1') { ?>
    <section id="<?php if (nimbus_get_option('fp-action1-slug')=='') {echo "action1";} else {echo esc_attr(nimbus_get_option('fp-action1-slug'));} ?>" class="frontpage-action1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php if (nimbus_get_option('fp-action1-title') != '') { ?>
                        <div class="action1-title h1"><?php echo esc_html(nimbus_get_option('fp-action1-title')); ?></div>
                    <?php } ?>
                    <?php if (nimbus_get_option('fp-action1-sub-title') != '') { ?>
                        <div class="action1-sub-title h4"><?php echo esc_html(nimbus_get_option('fp-action1-sub-title')); ?></div>
                    <?php } ?>
                    <?php if ((nimbus_get_option('fp-action1-button-text') != '') && (nimbus_get_option('fp-action1-button-url') != '')) { ?>
                        <div class="action1-link-button"><a href="<?php echo esc_url(nimbus_get_option('fp-action1-button-url')); ?>"><?php echo esc_html(nimbus_get_option('fp-action1-button-text')); ?></a></div>
                    <?php } ?>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } else if (nimbus_get_option('fp-action1-toggle') == '3') {
    // Don't do anything
} else { ?>  
    <section id="<?php if (nimbus_get_option('fp-action1-slug')=='') {echo "action1";} else {echo esc_attr(nimbus_get_option('fp-action1-slug'));} ?>" class="frontpage-action1">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="action1-title h1"><?php _e('Call To Action', 'venture-lite' ); ?></div>
                    <div class="action1-sub-title h4"><?php _e('Convince me why I should take this action.', 'venture-lite' ); ?></div>
                    <div class="action1-link-button"><a href="#"><?php _e('Go For It!', 'venture-lite' ); ?></a></div>
                </div> 
            </div>    
        </div>    
    </section> 
<?php } ?> 

