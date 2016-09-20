<div class="kopa-content-box tab-content tab-content-1" id="tab-general">

    <!--tab-logo-favicon-icon-->
    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Logo, Favicon, Apple Icon', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">

            <p class="kopa-desc"><?php printf(__('Use <a href="%s">custom header</a> to upload logo image and change site title color.', kopa_get_domain()), admin_url('themes.php?page=custom-header')); ?></p>                         
            <p class="kopa-desc"><?php _e('Logo margin', kopa_get_domain()); ?></p>
            <label class="kopa-label"><?php _e('Top margin:', kopa_get_domain()); ?> </label>
            <input type="number" value="<?php echo get_option('kopa_theme_options_logo_margin_top',25); ?>" id="kopa_theme_options_logo_margin_top" name="kopa_theme_options_logo_margin_top" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Left margin:', kopa_get_domain()); ?> </label>
            <input type="number" value="<?php echo get_option('kopa_theme_options_logo_margin_left',25); ?>" id="kopa_theme_options_logo_margin_left" name="kopa_theme_options_logo_margin_left" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Right margin:', kopa_get_domain()); ?> </label>
            <input type="number" value="<?php echo get_option('kopa_theme_options_logo_margin_right'); ?>" id="kopa_theme_options_logo_margin_right" name="kopa_theme_options_logo_margin_right" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>

            <span class="kopa-spacer"></span>

            <label class="kopa-label"><?php _e('Bottom margin:', kopa_get_domain()); ?> </label>
            <input type="number" value="<?php echo get_option('kopa_theme_options_logo_margin_bottom'); ?>" id="kopa_theme_options_logo_margin_bottom" name="kopa_theme_options_logo_margin_bottom" class=" kopa-short-input">
            <label class="kopa-label"><?php _e('px', kopa_get_domain()); ?></label>
        </div><!--kopa-element-box-->


        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Favicon', kopa_get_domain()); ?></span>

            <p class="kopa-desc"><?php _e('Upload your own favicon.', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_url(get_option('kopa_theme_options_favicon_url')); ?>" id="kopa_theme_options_favicon_url" name="kopa_theme_options_favicon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_favicon_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
        </div><!--kopa-element-box-->


        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Apple Icons', kopa_get_domain()); ?></span>

            <p class="kopa-desc"><?php _e('Iphone (57px - 57px)', kopa_get_domain()); ?></p>   
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_url(get_option('kopa_theme_options_apple_iphone_icon_url')); ?>" id="kopa_theme_options_apple_iphone_icon_url" name="kopa_theme_options_apple_iphone_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_icon_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?></i><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
            <p class="kopa-desc"><?php _e('Iphone Retina (114px - 114px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_url(get_option('kopa_theme_options_apple_iphone_retina_icon_url')); ?>" id="kopa_theme_options_apple_iphone_retina_icon_url" name="kopa_theme_options_apple_iphone_retina_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_iphone_retina_icon_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad (72px - 72px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo esc_url(get_option('kopa_theme_options_apple_ipad_icon_url')); ?>" id="kopa_theme_options_apple_ipad_icon_url" name="kopa_theme_options_apple_ipad_icon_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_icon_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>

            <p class="kopa-desc"><?php _e('Ipad Retina (144px - 144px)', kopa_get_domain()); ?></p>    
            <div class="clearfix">
                <input class="" type="text" value="<?php echo esc_url(get_option('kopa_theme_options_apple_ipad_retina_icon_url')); ?>" id="kopa_theme_options_apple_ipad_retina_icon_url" name="kopa_theme_options_apple_ipad_retina_icon_url">
                <button class="btn btn-success upload_image_button" alt="kopa_theme_options_apple_ipad_retina_icon_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
        </div><!--kopa-element-box-->


    </div><!--tab-logo-favicon-icon-->

    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Header Headline', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Header headline:', kopa_get_domain()); ?></span>            
            <?php
            $kopa_header_headline_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $kopa_header_headline_name = "kopa_theme_options_display_headline_status";
            foreach ($kopa_header_headline_status as $value => $label):
                $kopa_header_headline_status_id = $kopa_header_headline_name . "_{$value}";
                ?>
                <label  for="<?php echo $kopa_header_headline_status_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo esc_attr($value); ?>" id="<?php echo $kopa_header_headline_status_id; ?>" name="<?php echo $kopa_header_headline_name; ?>" <?php echo ($value == get_option($kopa_header_headline_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Headline title:', kopa_get_domain()); ?></span>
            <input type="text" value="<?php echo sanitize_text_field(get_option('kopa_theme_options_headline_title', __('Breaking News', kopa_get_domain()))); ?>" id="kopa_theme_options_headline_title" name="kopa_theme_options_headline_title">
        </div>
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Headline category:', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Choose category to display posts in headline', kopa_get_domain()); ?></p>
            <select name="kopa_theme_options_headline_category_id" id="kopa_theme_options_headline_category_id">
                <?php
                $kopa_current_headline_category_id = get_option('kopa_theme_options_headline_category_id');
                $kopa_headline_categories = get_terms('category');
                foreach ($kopa_headline_categories as $kopa_headline_category) :
                    ?>
                    <option value="<?php echo $kopa_headline_category->term_id; ?>" <?php selected($kopa_headline_category->term_id, $kopa_current_headline_category_id); ?>><?php echo $kopa_headline_category->name; ?></option>
<?php endforeach; ?>
            </select>
        </div>
    </div>

    <?php
    /**
     * Top Banner: Google Adsense, BSA, Advertising Code
     */
    ?>
    <div class="kopa-box-head">
<?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Top Banner', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Top Banner', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Paste your Adsense, BSA or other ad code here to show ads on top banner.', kopa_get_domain()); ?></p>    
            <textarea class="" rows="6" id="kopa_theme_options_top_banner_code" name="kopa_theme_options_top_banner_code"><?php echo htmlspecialchars_decode(stripslashes(get_option('kopa_theme_options_top_banner_code'))); ?></textarea>
        </div><!--kopa-element-box-->

    </div>

    <div class="kopa-box-head">
<?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Footer', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Footer logo', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Upload your own logo.', kopa_get_domain()); ?></p>                         
            <div class="clearfix">
                <input class="left" type="text" value="<?php echo get_option('kopa_theme_options_logo_url'); ?>" id="kopa_theme_options_logo_url" name="kopa_theme_options_logo_url">
                <button class="left btn btn-success upload_image_button" alt="kopa_theme_options_logo_url"><?php echo KopaIcon::getIcon('arrow-circle-up'); ?><?php _e('Upload', kopa_get_domain()); ?></button>
            </div>
        </div><!--kopa-element-box-->
        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Custom Left Footer', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Enter the content you want to display in your left footer (e.g. copyright text).', kopa_get_domain()); ?></p>    
            <textarea class="" rows="6" id="kopa_setting_copyrights" name="kopa_theme_options_copyright"><?php echo htmlspecialchars_decode(stripslashes(get_option('kopa_theme_options_copyright'))); ?></textarea>
        </div><!--kopa-element-box-->

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Custom Right Footer', kopa_get_domain()); ?></span>
            <p class="kopa-desc"><?php _e('Enter the content you want to display in your right footer (e.g. newsletter subscription form code).', kopa_get_domain()); ?></p>    
            <textarea class="" rows="6" id="kopa_theme_options_right_footer" name="kopa_theme_options_right_footer"><?php echo htmlspecialchars_decode(stripslashes(get_option('kopa_theme_options_right_footer'))); ?></textarea>
        </div><!--kopa-element-box-->



    </div>

</div><!--kopa-content-box-->

