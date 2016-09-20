<div id="tab-blog-slider" class="kopa-content-box tab-content tab-content-1">    
    
    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Blog Slider Settings', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Slider on Blog:', kopa_get_domain()); ?></span>            
            <?php
            $kopa_blog_slider_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $kopa_blog_slider_name = "kopa_theme_options_display_blog_slider";
            foreach ($kopa_blog_slider_status as $value => $label):
                $kopa_blog_slider_status_id = $kopa_blog_slider_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_blog_slider_status_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr( $value ); ?>" id="<?php echo $kopa_blog_slider_status_id; ?>" name="<?php echo $kopa_blog_slider_name; ?>" <?php echo ($value == get_option($kopa_blog_slider_name, 'hide')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach
            ?>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Blog Slider category:', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e( 'Choose category to display posts in blog slider', kopa_get_domain() ); ?></p>
            <select name="kopa_theme_options_blog_slider_category_id" id="kopa_theme_options_blog_slider_category_id">
                <?php 
                $kopa_current_blog_slider_category_id = get_option( 'kopa_theme_options_blog_slider_category_id' ); 
                $kopa_all_categories = get_terms( 'category' );
                foreach ( $kopa_all_categories as $kopa_category ) : ?>
                    <option value="<?php echo $kopa_category->term_id; ?>" <?php selected( $kopa_category->term_id, $kopa_current_blog_slider_category_id ); ?>><?php echo $kopa_category->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Slider Settings', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e( 'Effect', kopa_get_domain() ); ?></span>
            <select name="kopa_theme_options_blog_slider_effect" id="kopa_theme_options_blog_slider_effect">
                <?php 
                $kopa_current_blog_slider_effect = get_option( 'kopa_theme_options_blog_slider_effect', 'slide' ); 
                $kopa_blog_slider_effects = array(
                    'fade' => __( 'Fade', kopa_get_domain() ),
                    'slide' => __( 'Slide', kopa_get_domain() )
                );
                foreach ( $kopa_blog_slider_effects as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $kopa_current_blog_slider_effect ); ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e( 'Slideshow Speed (milliseconds)', kopa_get_domain() ); ?></span>
            <input type="number" min="1" value="<?php echo esc_attr(intval( get_option( 'kopa_theme_options_blog_slider_slideshow_speed', 7000 ) )); ?>" id="kopa_theme_options_blog_slider_slideshow_speed" name="kopa_theme_options_blog_slider_slideshow_speed">
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e( 'Animation Speed (milliseconds)', kopa_get_domain() ); ?></span>
            <input type="number" min="1" value="<?php echo esc_attr(intval( get_option( 'kopa_theme_options_blog_slider_animation_speed', 600 ) )); ?>" id="kopa_theme_options_blog_slider_animation_speed" name="kopa_theme_options_blog_slider_animation_speed">
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e( 'Auto Play', kopa_get_domain() ); ?></span>
            <select name="kopa_theme_options_blog_slider_autoplay" id="kopa_theme_options_blog_slider_autoplay">
                <?php 
                $kopa_current_blog_slider_autoplay = get_option( 'kopa_theme_options_blog_slider_autoplay', 'false' ); 
                $kopa_blog_slider_autoplay_status = array(
                    'true' => __( 'Enable', kopa_get_domain() ),
                    'false' => __( 'Disable', kopa_get_domain() )
                );
                foreach ( $kopa_blog_slider_autoplay_status as $value => $label ) : ?>
                    <option value="<?php echo esc_attr( $value ); ?>" <?php selected( $value, $kopa_current_blog_slider_autoplay ); ?>><?php echo $label; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

</div><!--tab-container-->