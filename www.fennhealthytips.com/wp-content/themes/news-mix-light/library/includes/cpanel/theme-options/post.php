<div id="tab-single-post" class="kopa-content-box tab-content tab-content-1">    

    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Post Thumbnail Style', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $post_thumbnail_styles = array(
                'small' => __('Small Thumbnail', kopa_get_domain()),
                'large' => __('Large Thumbnail', kopa_get_domain())
            );
            $post_thumbnail_style_name = "kopa_theme_options_post_thumbnail_style";
            foreach ($post_thumbnail_styles as $value => $label):
                $post_thumbnail_style_id = $post_thumbnail_style_name . "_{$value}";
                ?>
                <label  for="<?php echo $post_thumbnail_style_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $post_thumbnail_style_id; ?>" name="<?php echo $post_thumbnail_style_name; ?>" <?php echo ($value == get_option($post_thumbnail_style_name, 'large')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>
    </div>

    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('About Author', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $about_author_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            $about_author_name = "kopa_theme_options_post_about_author";
            foreach ($about_author_status as $value => $label):
                $about_author_id = $about_author_name . "_{$value}";
                ?>
                <label  for="<?php echo $about_author_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $about_author_id; ?>" name="<?php echo $about_author_name; ?>" <?php echo ($value == get_option($about_author_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>
    </div>
    <!-- meta data -->
     <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Post Metadata', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->
    <div class="kopa-box-body">
        <div class="kopa-element-box kopa-theme-options">            
            <?php
            $metadata_status = array(
                'show' => __('Show', kopa_get_domain()),
                'hide' => __('Hide', kopa_get_domain())
            );
            ?>
            <span class="kopa-component-title"><?php _e('Categories', kopa_get_domain()); ?></span>
            <?php
            $category_metadata_name = "kopa_theme_options_post_categories";
            foreach ($metadata_status as $value => $label):
                $category_metadata_id = $category_metadata_name . "_{$value}";
                ?>
                <label  for="<?php echo $category_metadata_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $category_metadata_id; ?>" name="<?php echo $category_metadata_name; ?>" <?php echo ($value == get_option($category_metadata_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>

        <div class="kopa-element-box kopa-theme-options"> 
         <span class="kopa-component-title"><?php _e('Post date', kopa_get_domain()); ?></span>
            <?php
            $date_metadata_name = "kopa_theme_options_post_date";
            foreach ($metadata_status as $value => $label):
                $date_metadata_id = $date_metadata_name . "_{$value}";
                ?>
                <label  for="<?php echo $date_metadata_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $date_metadata_id; ?>" name="<?php echo $date_metadata_name; ?>" <?php echo ($value == get_option($date_metadata_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>

        <div class="kopa-element-box kopa-theme-options"> 
         <span class="kopa-component-title"><?php _e('Post author', kopa_get_domain()); ?></span>
            <?php
            $author_metadata_name = "kopa_theme_options_post_author";
            foreach ($metadata_status as $value => $label):
                $author_metadata_id = $author_metadata_name . "_{$value}";
                ?>
                <label  for="<?php echo $author_metadata_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $author_metadata_id; ?>" name="<?php echo $author_metadata_name; ?>" <?php echo ($value == get_option($author_metadata_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>

        <div class="kopa-element-box kopa-theme-options"> 
         <span class="kopa-component-title"><?php _e('Comments number', kopa_get_domain()); ?></span>
            <?php
            $comment_metadata_name = "kopa_theme_options_post_comment";
            foreach ($metadata_status as $value => $label):
                $comment_metadata_id = $comment_metadata_name . "_{$value}";
                ?>
                <label  for="<?php echo $comment_metadata_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $comment_metadata_id; ?>" name="<?php echo $comment_metadata_name; ?>" <?php echo ($value == get_option($comment_metadata_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>

        <div class="kopa-element-box kopa-theme-options"> 
         <span class="kopa-component-title"><?php _e('Visited number', kopa_get_domain()); ?></span>
            <?php
            $visit_metadata_name = "kopa_theme_options_post_visit";
            foreach ($metadata_status as $value => $label):
                $visit_metadata_id = $visit_metadata_name . "_{$value}";
                ?>
                <label  for="<?php echo $visit_metadata_id; ?>" class="kopa-label-for-radio-button"><input type="radio" value="<?php echo $value; ?>" id="<?php echo $visit_metadata_id; ?>" name="<?php echo $visit_metadata_name; ?>" <?php echo ($value == get_option($visit_metadata_name, 'show')) ? 'checked="checked"' : ''; ?>><?php echo $label; ?></label>
                <?php
            endforeach;
            ?>
        </div>

    </div>

    <div class="kopa-box-head">
        <?php echo KopaIcon::getIcon('hand-right'); ?>
        <span class="kopa-section-title"><?php _e('Related Posts', kopa_get_domain()); ?></span>
    </div><!--kopa-box-head-->

    <div class="kopa-box-body">

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Get By', kopa_get_domain()); ?></span>
            <select class="" id="kopa_theme_options_post_related_get_by" name="kopa_theme_options_post_related_get_by">
                <?php
                $post_related_get_by = array(
                    'hide' => __('-- Hide --', kopa_get_domain()),
                    'post_tag' => __('Tag', kopa_get_domain()),
                    'category' => __('Category', kopa_get_domain())
                );
                foreach ($post_related_get_by as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value == get_option('kopa_theme_options_post_related_get_by', 'hide')) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </div>

        <div class="kopa-element-box kopa-theme-options">
            <span class="kopa-component-title"><?php _e('Limit', kopa_get_domain()); ?></span>
            <input type="number" value="<?php echo get_option('kopa_theme_options_post_related_limit', 5); ?>" id="kopa_theme_options_post_related_limit" name="kopa_theme_options_post_related_limit">
        </div>
    </div><!--tab-theme-skin-->  

   

</div><!--tab-container-->