<?php
add_action('after_setup_theme', 'kopa_front_after_setup_theme');
function kopa_front_after_setup_theme()
{
    add_theme_support('post-formats', array('gallery', 'audio', 'video'));
    add_theme_support('post-thumbnails');
    add_theme_support('loop-pagination');
    add_theme_support('automatic-feed-links');
    add_theme_support('editor_style');
    add_editor_style('editor-style.css');
    global $content_width;
    if (!isset($content_width))
        $content_width = 1016;
    register_nav_menus(array(
        'main-nav' => __('Main Menu', kopa_get_domain()),
        'footer-nav' => __('Footer Menu', kopa_get_domain())
    ));
    if (!is_admin()) {
        add_action('wp_enqueue_scripts', 'kopa_front_enqueue_scripts');
        add_action('wp_footer', 'kopa_footer');
        add_action('wp_head', 'kopa_head');
        add_filter('widget_text', 'do_shortcode');
        add_filter('the_category', 'kopa_the_category');
        add_filter('get_the_excerpt', 'kopa_get_the_excerpt');
        add_filter('post_class', 'kopa_post_class');
        add_filter('body_class', 'kopa_body_class');
        add_filter('wp_nav_menu_items', 'kopa_add_icon_home_menu', 10, 2);
// add_filter('comment_reply_link', 'kopa_comment_reply_link');
// add_filter('edit_comment_link', 'kopa_edit_comment_link');
//add_filter('wp_tag_cloud', 'kopa_tag_cloud');
        add_filter('excerpt_length', 'kopa_custom_excerpt_length');
    } else {
        add_action('show_user_profile', 'kopa_edit_user_profile');
        add_action('edit_user_profile', 'kopa_edit_user_profile');
        add_action('personal_options_update', 'kopa_edit_user_profile_update');
        add_action('edit_user_profile_update', 'kopa_edit_user_profile_update');

    }
    $sizes = array(
        'kopa-image-size-0' => array(446, 411, TRUE, __('Flexslider Post Image (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-1' => array(168, 148, TRUE, __('Featured Post Thumbnail (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-2' => array(234, 169, TRUE, __('Carousel Post Thumbnail (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-3' => array(53, 53, TRUE, __('Tabs List Widget Post Thumbnail (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-4' => array(207, 191, TRUE, __('Entry List Widget Post Thumbnail 1 (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-5' => array(307, 219, TRUE, __('Entry List Widget Post Thumbnail 2 (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-6' => array(690, 377, TRUE, __('Flexslider Post Image 2 (Kopatheme)', kopa_get_domain())),
        'kopa-image-size-7' => array(589, 392, TRUE, __('Video, Gallery Post Slider Image (Kopatheme)', kopa_get_domain()))
    );
    apply_filters('kopa_get_image_sizes', $sizes);

    foreach ($sizes as $slug => $details) {
        add_image_size($slug, $details[0], $details[1], $details[2]);
    }

}

function kopa_tag_cloud($out)
{
    $matches = array();
    $pattern = '/<a[^>]*?>([\\s\\S]*?)<\/a>/';
    preg_match_all($pattern, $out, $matches);
    $htmls = $matches[0];
    $texts = $matches[1];
    $new_html = '';
    for ($index = 0; $index < count($htmls); $index++) {
        $new_text = '<span class="kp-tag-left"></span>';
        $new_text .= '<span class="kp-tag-rounded"></span>';
        $new_text .= '<span class="kp-tag-text">' . $texts[$index] . '</span>';
        $new_text .= '<span class="kp-tag-right"></span>';
        $new_html .= preg_replace('#(<a.*?>).*?(</a>)#', '$1' . $new_text . '$2', $htmls[$index]);
    }
    return $new_html;
}

function kopa_comment_reply_link($link)
{
    return str_replace('comment-reply-link', 'comment-reply-link small-button green-button', $link);
}

function kopa_edit_comment_link($link)
{
    return str_replace('comment-edit-link', 'comment-edit-link small-button green-button', $link);
}

function kopa_post_class($classes)
{
    if (is_single()) {
        $classes[] = 'entry-box';
        $classes[] = 'clearfix';
    }
    return $classes;
}

function kopa_body_class($classes)
{
    $template_setting = kopa_get_template_setting();
    if (is_front_page()) {
        $classes[] = 'home-page';
    } else {
        $classes[] = 'sub-page';
    }
    if (get_option('kopa_theme_options_layout', 'box') == 'wide') {
        $classes[] = 'kopa-style-full';
    } else {
        $classes[] = 'kopa-style-box';
    }
    if (is_404()) {
        return $classes;
    }
    switch ($template_setting['layout_id']) {
        case 'home-page-1':
            $classes[] = 'kopa-home-1';
            break;
        case 'single-right-sidebar':
            $post_thumbnail_style = get_option('kopa_theme_options_post_thumbnail_style', 'small');
            if ($post_thumbnail_style == 'large') {
                $classes[] = 'kopa-single-2';
            }
            $queried_object = get_queried_object();
            if ('video' == get_post_format($queried_object->ID)) {
                $classes[] = 'background-red';
            }
            break;
    }
    return $classes;
}

function kopa_footer()
{
    wp_nonce_field('kopa_set_view_count', 'kopa_set_view_count_wpnonce', false);

}

function kopa_front_enqueue_scripts()
{
    if (!is_admin()) {
        global $wp_styles, $is_IE;
        $dir = get_template_directory_uri();
        /* FONTs */
        wp_enqueue_script('kopa-google-api', '//ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
        wp_enqueue_script('kopa-google-fonts', $dir . '/js/google-fonts.js', array('kopa-google-api'));
        $google_fonts = kopa_get_google_font_array();
        $current_heading_font = get_option('kopa_theme_options_heading_font_family');
        $current_content_font = get_option('kopa_theme_options_content_font_family');
        $current_main_nav_font = get_option('kopa_theme_options_main_nav_font_family');
        $current_wdg_sidebar_font = get_option('kopa_theme_options_wdg_sidebar_font_family');
        $load_font_array = array();
// heading font family
        if ($current_heading_font && !in_array($current_heading_font, $load_font_array)) {
            array_push($load_font_array, $current_heading_font);
        }
// content font family
        if ($current_content_font && !in_array($current_content_font, $load_font_array)) {
            array_push($load_font_array, $current_content_font);
        }
// main menu font family
        if ($current_main_nav_font && !in_array($current_main_nav_font, $load_font_array)) {
            array_push($load_font_array, $current_main_nav_font);
        }
// widget title font family
        if ($current_wdg_sidebar_font && !in_array($current_wdg_sidebar_font, $load_font_array)) {
            array_push($load_font_array, $current_wdg_sidebar_font);
        }
        foreach ($load_font_array as $current_font) {
            if ($current_font != '') {
                $google_font_family = $google_fonts[$current_font]['family'];
                $temp_font_name = str_replace(' ', '+', $google_font_family);
                $font_url = '//fonts.googleapis.com/css?family=' . $temp_font_name . ':300,300italic,400,400italic,700,700italic&subset=latin';
                wp_enqueue_style('Google-Font-' . $temp_font_name, $font_url);
            }
        }
        /* STYLESHEETs */
        wp_enqueue_style('kopa-bootstrap', $dir . '/css/bootstrap.css');
        wp_enqueue_style('kopa-FontAwesome', $dir . '/css/font-awesome.css');
        wp_enqueue_style('kopa-superfish', $dir . '/css/superfish.css');
        wp_enqueue_style('kopa-prettyPhoto', $dir . '/css/prettyPhoto.css');
        wp_enqueue_style('kopa-flexlisder', $dir . '/css/flexslider.css');
        wp_enqueue_style('kopa-style', get_stylesheet_uri());
        wp_enqueue_style('kopa-bootstrap-responsive', $dir . '/css/bootstrap-responsive.css');
// extra style
        wp_enqueue_style('kopa-extra-style', $dir . '/css/extra.css');

        wp_enqueue_style('kopa-responsive', $dir . '/css/responsive.css');
        if ($is_IE) {
            wp_register_style('kopa-ie', $dir . '/css/ie.css');
            $wp_styles->add_data('kopa-ie', 'conditional', 'lt IE 9');
            wp_enqueue_style('kopa-ie');
        }
        /* JAVASCRIPTs */
        wp_enqueue_script('kopa-modernizr', $dir . '/js/modernizr.custom.js');

        wp_localize_script('jquery', 'kopa_front_variable', kopa_front_localize_script());

        /**
         * Fix: Superfish conflicts with WP admin bar for WordPress < 3.6
         * @author joeldbirch
         * @link https://github.com/joeldbirch/superfish/issues/14
         * @filesource https://github.com/briancherne/jquery-hoverIntent
         */
        wp_deregister_script('hoverIntent');
        wp_register_script('hoverIntent', ('/js/jquery.hoverIntent.js'), array('jquery'), 'r7');
        wp_enqueue_script('kopa-superfish-js', $dir . '/js/superfish.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-retina', $dir . '/js/retina.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-bootstrap-js', $dir . '/js/bootstrap.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-carouFredSel', $dir . '/js/jquery.caroufredsel-6.0.4-packed.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-classie', $dir . '/js/classie.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-uisearch', $dir . '/js/uisearch.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-flexlisder-js', $dir . '/js/jquery.flexslider-min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-prettyPhoto-js', $dir . '/js/jquery.prettyPhoto.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-tweetable-js', $dir . '/js/tweetable.jquery.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-timeago-js', $dir . '/js/jquery.timeago.js', array('jquery'), NULL, TRUE);
        
        wp_enqueue_script('kopa-jquery-validate', $dir . '/js/jquery.validate.min.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('jquery-form', null, array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-set-view-count', $dir . '/js/set-view-count.js', array('jquery'), NULL, TRUE);
        wp_enqueue_script('kopa-custom', $dir . '/js/custom.js', array('jquery'), NULL, TRUE);
// send localization to frontend
        wp_localize_script('kopa-custom', 'kopa_custom_front_localization', kopa_custom_front_localization());
        if (is_single() || is_page()) {
            wp_enqueue_script('comment-reply');
        }
    }
}

function kopa_front_localize_script()
{
    $kopa_variable = array(
        'ajax' => array(
            'url' => admin_url('admin-ajax.php')
        ),
        'template' => array(
            'post_id' => (is_singular()) ? get_queried_object_id() : 0
        )
    );
    return $kopa_variable;
}

/**
 * Send form validation notices in localized format to frontend
 * @package Circle
 * @since Circle 1.12
 */
function kopa_custom_front_localization()
{
    $front_localization = array(
        'validate' => array(
            'form' => array(
                'submit' => __('Submit', kopa_get_domain()),
                'sending' => __('Sending...', kopa_get_domain())
            ),
            'name' => array(
                'required' => __('Please enter your name.', kopa_get_domain()),
                'minlength' => __('At least {0} characters required.', kopa_get_domain())
            ),
            'email' => array(
                'required' => __('Please enter your email.', kopa_get_domain()),
                'email' => __('Please enter a valid email.', kopa_get_domain())
            ),
            'url' => array(
                'required' => __('Please enter your url.', kopa_get_domain()),
                'url' => __('Please enter a valid url.', kopa_get_domain())
            ),
            'message' => array(
                'required' => __('Please enter a message.', kopa_get_domain()),
                'minlength' => __('At least {0} characters required.', kopa_get_domain())
            )
        )
    );
    return $front_localization;
}

function kopa_the_category($thelist)
{
    return $thelist;
}

/* FUNCTION */
function kopa_print_page_title()
{
    global $page, $paged;
    wp_title('|', TRUE, 'right');
    bloginfo('name');
    $site_description = get_bloginfo('description', 'display');
    if ($site_description && (is_home() || is_front_page()))
        echo " | $site_description";
    if ($paged >= 2 || $page >= 2)
        echo ' | ' . sprintf(__('Page %s', kopa_get_domain()), max($paged, $page));
}

function kopa_set_view_count($post_id)
{
    $new_view_count = 0;
    $meta_key = 'kopa_' . kopa_get_domain() . '_total_view';
    $current_views = (int)get_post_meta($post_id, $meta_key, true);
    if ($current_views) {
        $new_view_count = $current_views + 1;
        update_post_meta($post_id, $meta_key, $new_view_count);
    } else {
        $new_view_count = 1;
        add_post_meta($post_id, $meta_key, $new_view_count);
    }
    return $new_view_count;
}

function kopa_get_view_count($post_id)
{
    $key = 'kopa_' . kopa_get_domain() . '_total_view';
    return kopa_get_post_meta($post_id, $key, true, 'Int');
}

function kopa_breadcrumb()
{
    if (is_main_query()) {
        global $post, $wp_query;
        $prefix = '&nbsp;/&nbsp;';
        $current_class = 'current-page';
        $description = '';
        $breadcrumb_before = '<div class="row-fluid"><div class="span12"><div class="breadcrumb">';
        $breadcrumb_after = '</div></div></div>';
        $breadcrumb_home = '<a href="' . esc_url(home_url()) . '">' . __('Home', kopa_get_domain()) . '</a>';
        $breadcrumb = '';
        ?>
        <?php
        if (is_home()) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Blog', kopa_get_domain()));
        } else if (is_post_type_archive('product') && jigoshop_get_page_id('shop')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(jigoshop_get_page_id('shop')));
        } else if (is_tag()) {
            $breadcrumb .= $breadcrumb_home;
            $term = get_term(get_queried_object_id(), 'post_tag');
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $term->name);
        } else if (is_category()) {
            $breadcrumb .= $breadcrumb_home;
            $category_id = get_queried_object_id();
            $terms_link = explode(',', substr(get_category_parents(get_queried_object_id(), TRUE, ','), 0, (strlen(',') * -1)));
            $n = count($terms_link);
            if ($n > 1) {
                for ($i = 0; $i < ($n - 1); $i++) {
                    $breadcrumb .= $prefix . $terms_link[$i];
                }
            }
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_category_by_ID(get_queried_object_id()));
        } else if (is_tax('product_cat')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
            $parents = array();
            $parent = $term->parent;
            while ($parent):
                $parents[] = $parent;
                $new_parent = get_term_by('id', $parent, get_query_var('taxonomy'));
                $parent = $new_parent->parent;
            endwhile;
            if (!empty($parents)):
                $parents = array_reverse($parents);
                foreach ($parents as $parent):
                    $item = get_term_by('id', $parent, get_query_var('taxonomy'));
                    $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                endforeach;
            endif;
            $queried_object = get_queried_object();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_tax('product_tag')) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
            $queried_object = get_queried_object();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $queried_object->name);
        } else if (is_single()) {
            $breadcrumb .= $breadcrumb_home;
            if (get_post_type() === 'product') :
                $breadcrumb .= '<a href="' . get_page_link(jigoshop_get_page_id('shop')) . '">' . get_the_title(jigoshop_get_page_id('shop')) . '</a>';
                if ($terms = get_the_terms($post->ID, 'product_cat')) :
                    $term = apply_filters('jigoshop_product_cat_breadcrumb_terms', current($terms), $terms);
                    $parents = array();
                    $parent = $term->parent;
                    while ($parent):
                        $parents[] = $parent;
                        $new_parent = get_term_by('id', $parent, 'product_cat');
                        $parent = $new_parent->parent;
                    endwhile;
                    if (!empty($parents)):
                        $parents = array_reverse($parents);
                        foreach ($parents as $parent):
                            $item = get_term_by('id', $parent, 'product_cat');
                            $breadcrumb .= '<a href="' . get_term_link($item->slug, 'product_cat') . '">' . $item->name . '</a>';
                        endforeach;
                    endif;
                    $breadcrumb .= '<a href="' . get_term_link($term->slug, 'product_cat') . '">' . $term->name . '</a>';
                endif;
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title());
            else :
                $categories = get_the_category(get_queried_object_id());
                if ($categories) {
                    foreach ($categories as $category) {
                        $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_category_link($category->term_id), $category->name);
                    }
                }
                $post_id = get_queried_object_id();
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title($post_id));
            endif;
        } else if (is_page()) {
            if (!is_front_page()) {
                $post_id = get_queried_object_id();
                $breadcrumb .= $breadcrumb_home;
                $post_ancestors = get_post_ancestors($post);
                if ($post_ancestors) {
                    $post_ancestors = array_reverse($post_ancestors);
                    foreach ($post_ancestors as $crumb)
                        $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_permalink($crumb), get_the_title($crumb));
                }
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, get_the_title(get_queried_object_id()));
            }
        } else if (is_year() || is_month() || is_day()) {
            $breadcrumb .= $breadcrumb_home;
            $date = array('y' => NULL, 'm' => NULL, 'd' => NULL);
            $date['y'] = get_the_time('Y');
            $date['m'] = get_the_time('m');
            $date['d'] = get_the_time('j');
            if (is_year()) {
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['y']);
            }
            if (is_month()) {
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, date('F', mktime(0, 0, 0, $date['m'])));
            }
            if (is_day()) {
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_year_link($date['y']), $date['y']);
                $breadcrumb .= $prefix . sprintf('<a href="%1$s">%2$s</a>', get_month_link($date['y'], $date['m']), date('F', mktime(0, 0, 0, $date['m'])));
                $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, $date['d']);
            }
        } else if (is_search()) {
            $breadcrumb .= $breadcrumb_home;
            $s = get_search_query();
            $c = $wp_query->found_posts;
            $description = sprintf(__('<span class="%1$s">Your search for "%2$s"', kopa_get_domain()), $current_class, $s);
            $breadcrumb .= $prefix . $description;
        } else if (is_author()) {
            $breadcrumb .= $breadcrumb_home;
            $author_id = get_queried_object_id();
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</a>', $current_class, sprintf(__('Posts created by %1$s', kopa_get_domain()), get_the_author_meta('display_name', $author_id)));
        } else if (is_404()) {
            $breadcrumb .= $breadcrumb_home;
            $breadcrumb .= $prefix . sprintf('<span class="%1$s">%2$s</span>', $current_class, __('Page not found', kopa_get_domain()));
        }
        if ($breadcrumb)
            echo apply_filters('kopa_breadcrumb', $breadcrumb_before . $breadcrumb . $breadcrumb_after);
    }
}

function kopa_get_related_articles()
{
    if (is_single()) {
        $get_by = get_option('kopa_theme_options_post_related_get_by', 'hide');
        if ('hide' != $get_by) {
            $limit = (int)get_option('kopa_theme_options_post_related_limit', 4);
            if ($limit > 0) {
                global $post;
                $taxs = array();
                if ('category' == $get_by) {
                    $cats = get_the_category(($post->ID));
                    if ($cats) {
                        $ids = array();
                        foreach ($cats as $cat) {
                            $ids[] = $cat->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'category',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                } else {
                    $tags = get_the_tags($post->ID);
                    if ($tags) {
                        $ids = array();
                        foreach ($tags as $tag) {
                            $ids[] = $tag->term_id;
                        }
                        $taxs [] = array(
                            'taxonomy' => 'post_tag',
                            'field' => 'id',
                            'terms' => $ids
                        );
                    }
                }
                if ($taxs) {
                    $related_args = array(
                        'tax_query' => $taxs,
                        'post__not_in' => array($post->ID),
                        'posts_per_page' => $limit
                    );
                    $related_posts = new WP_Query($related_args);
                    $carousel_id = ($related_posts->post_count > 3) ? 'related-widget' : 'related-widget-no-carousel';
                    if ($related_posts->have_posts()):
                        ?>
                        <div class="kopa-related-post">
                            <h3><span class="title-line"></span><span
                                    class="title-text"><?php _e('Related Articles', kopa_get_domain()); ?></span></h3>
                            <ul class="clearfix">
                                <?php $post_index = 1;
                                while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                    <li>
                                        <article class="entry-item clearfix">
                                            <?php if (has_post_thumbnail()) : ?>
                                                <div class="entry-thumb">
                                                    <a href="<?php the_permalink(); ?>"><img
                                                            src="<?php echo kopa_get_image_src(get_the_ID(), 'kopa-image-size-3'); // 53x53 ?>"
                                                            alt="<?php echo get_the_title(); ?>"></a>
                                                </div>
                                            <?php endif; ?>
                                            <div class="entry-content">
                                                <h4 class="entry-title"><a
                                                        href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                                <span class="entry-date"><span
                                                        class="kopa-minus"></span><?php the_time(get_option('date_format')); ?></span>
                                            </div>
                                        </article>
                                    </li>
                                    <?php
                                    if ($post_index % 2 == 0)
                                        echo '</ul><ul class="clearfix">';
                                    $post_index++;
                                endwhile; ?>
                            </ul>
                        </div>
                    <?php
                    endif;
                    wp_reset_postdata();
                }
            }
        }
    }
}

function kopa_get_about_author()
{
    if ('show' == get_option('kopa_theme_options_post_about_author', 'hide')) {
        global $post;
        $user_id = $post->post_author;
        $description = get_the_author_meta('description', $user_id);
        $email = get_the_author_meta('user_email', $user_id);
        $name = get_the_author_meta('display_name', $user_id);
        $link = trim(get_the_author_meta('user_url', $user_id));
        ?>
        <div class="about-author clearfix">
            <a class="avatar-thumb" href="<?php echo $link; ?>"><?php echo get_avatar($email, 90); ?></a>

            <div class="author-content">
                <header class="clearfix">
                    <h4><?php _e('Posted by:', kopa_get_domain()); ?></h4>
                    <a class="author-name" href="<?php echo $link; ?>"><?php echo $name; ?></a>
                    <?php
                    $social_links['facebook'] = get_user_meta($user_id, 'facebook', true);
                    $social_links['twitter'] = get_user_meta($user_id, 'twitter', true);
                    $social_links['google-plus'] = get_user_meta($user_id, 'google-plus', true);
                    if ($social_links['facebook'] || $social_links['twitter'] || $social_links['google-plus']):
                        ?>
                        <ul class="clearfix social-link">
                            <li><?php _e('Follow:', kopa_get_domain()); ?></li>
                            <?php if ($social_links['facebook']): ?>
                                <li class="facebook-icon"><a target="_blank"
                                                             title="<?php _e('Facebook', kopa_get_domain()); ?>"
                                                             href="<?php echo $social_links['facebook']; ?>" rel="nofollow" ><?php echo KopaIcon::getIcon('facebook'); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($social_links['twitter']): ?>
                                <li class="twitter-icon"><a target="_blank"
                                                            title="<?php _e('Twitter', kopa_get_domain()); ?>"
                                                            class="twitter"
                                                            href="<?php echo $social_links['twitter']; ?>" rel="nofollow"><?php echo KopaIcon::getIcon('twitter'); ?></a>
                                </li>
                            <?php endif; ?>
                            <?php if ($social_links['google-plus']): ?>
                                <li class="gplus-icon"><a target="_blank"
                                                          title="<?php _e('Google+', kopa_get_domain()); ?>"
                                                          class="gplus"
                                                          href="<?php echo $social_links['google-plus']; ?>" rel="nofollow"><?php echo KopaIcon::getIcon('google-plus'); ?></a>
                                </li>
                            <?php endif; ?>
                        </ul><!--social-link-->
                    <?php endif; ?>
                </header>
                <div><?php echo $description; ?></div>
            </div>
            <!--author-content-->
        </div><!--about-author-->
    <?php
    }
}

function kopa_edit_user_profile($user)
{
    ?>
    <table class="form-table">
        <tr>
            <th><label for="facebook"><?php _e('Facebook', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="facebook" id="facebook"
                       value="<?php echo esc_attr(get_the_author_meta('facebook', $user->ID)); ?>"
                       class="regular-text"/><br/>
                <span class="description"><?php _e('Please enter your Facebook URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php _e('Twitter', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="twitter" id="twitter"
                       value="<?php echo esc_attr(get_the_author_meta('twitter', $user->ID)); ?>" class="regular-text"/><br/>
                <span class="description"><?php _e('Please enter your Twitter URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="google-plus"><?php _e('Google Plus', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="google-plus" id="google-plus"
                       value="<?php echo esc_attr(get_the_author_meta('google-plus', $user->ID)); ?>"
                       class="regular-text"/><br/>
                <span class="description"><?php _e('Please enter your Google Plus URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="flickr"><?php _e('Flickr', kopa_get_domain()); ?></label></th>
            <td>
                <input type="url" name="flickr" id="flickr"
                       value="<?php echo esc_attr(get_the_author_meta('flickr', $user->ID)); ?>"
                       class="regular-text"/><br/>
                <span class="description"><?php _e('Please enter your Flickr URL', kopa_get_domain()); ?></span>
            </td>
        </tr>
    </table>
<?php
}

function kopa_edit_user_profile_update($user_id)
{
    if (!current_user_can('edit_user', $user_id))
        return false;
    update_user_meta($user_id, 'facebook', $_POST['facebook']);
    update_user_meta($user_id, 'twitter', $_POST['twitter']);
    update_user_meta($user_id, 'google-plus', $_POST['google-plus']);
    update_user_meta($user_id, 'flickr', $_POST['flickr']);
}

/**
 * Make sure the_excerpt cannot strip the content inside shortcode tag
 * E.g. If an user create a post begin with dropcap character
 * the_excerpt cannot display this character (blog, search, category...)
 * @since News Mix 1.0.2
 */
function kopa_wp_trim_excerpt($text = '')
{
    $raw_excerpt = $text;
    if ('' == $text) {
        $text = get_the_content('');
        //$text = strip_shortcodes( $text ); //Comment out the part we don't want
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]&gt;', $text);
        $excerpt_length = apply_filters('excerpt_length', 55);
        $excerpt_more = apply_filters('excerpt_more', ' ' . '[...]');
        $text = wp_trim_words($text, $excerpt_length, $excerpt_more);
    }
    return apply_filters('wp_trim_excerpt', $text, $raw_excerpt);
}

function kopa_get_the_excerpt($excerpt)
{
    if (is_main_query()) {
        if (is_category() || is_tag()) {
            $limit = get_option('gs_excerpt_max_length', 100);
            if (strlen($excerpt) > $limit) {
                $break_pos = strpos($excerpt, ' ', $limit);
                $visible = substr($excerpt, 0, $break_pos);
                return balanceTags($visible);
            } else {
                return $excerpt;
            }
        } else if (is_search()) {
            //$keys = implode('|', explode(' ', get_search_query()));
            //return preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $excerpt);
            return $excerpt;
        } else {
            return $excerpt;
        }
    }
}

function kopa_highlight_search_title()
{
    $title = get_the_title();
    $keys = implode('|', explode(' ', get_search_query()));
    $title = preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $title);
    return $title;
}

function kopa_highlight_search_excerpt()
{
    $excerpt = get_the_excerpt();
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys . ')/iu', '<span class="kopa-search-keyword">\0</span>', $excerpt);
    return '<p>' . $excerpt . '</p>';
}

function kopa_get_template_setting()
{
    global $KOPA_SETTING;
    $setting = array();
    if (is_home()) {
        $setting = $KOPA_SETTING['home'];
    } else if (is_archive()) {
        if (is_category() || is_tag()) {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $KOPA_SETTING['taxonomy']);
        } else {
            $setting = get_option("kopa_category_setting_" . get_queried_object_id(), $KOPA_SETTING['archive']);
        }
    } else if (is_singular()) {
        if (is_singular('post')) {
            $setting = get_option("kopa_post_setting_" . get_queried_object_id(), $KOPA_SETTING['post']);
        } else if (is_page()) {
            $setting = get_option("kopa_page_setting_" . get_queried_object_id());
            if (!$setting) {
                if (is_front_page()) {
                    $setting = $KOPA_SETTING['home'];
                } else {
                    $setting = $KOPA_SETTING['page'];
                }
            }
        } else {
            $setting = $KOPA_SETTING['post'];
        }
    } else if (is_search()) {
        $setting = $KOPA_SETTING['search'];
    } else {
        $setting = $KOPA_SETTING['home'];
    }
    return $setting;
}

function kopa_content_get_gallery($content, $enable_multi = false)
{
    return kopa_content_get_media($content, $enable_multi, array('gallery'));
}

function kopa_content_get_video($content, $enable_multi = false)
{
    return kopa_content_get_media($content, $enable_multi, array('vimeo', 'youtube'));
}

function kopa_content_get_audio($content, $enable_multi = false)
{
    return kopa_content_get_media($content, $enable_multi, array('audio', 'soundcloud'));
}

function kopa_content_get_media($content, $enable_multi = false, $media_types = array())
{
    $media = array();
    $regex_matches = '';
    $regex_pattern = get_shortcode_regex();
    preg_match_all('/' . $regex_pattern . '/s', $content, $regex_matches);
    foreach ($regex_matches[0] as $shortcode) {
        $regex_matches_new = '';
        preg_match('/' . $regex_pattern . '/s', $shortcode, $regex_matches_new);
        if (in_array($regex_matches_new[2], $media_types)) :
            $media[] = array(
                'shortcode' => $regex_matches_new[0],
                'type' => $regex_matches_new[2],
                'url' => $regex_matches_new[5]
            );
            if (false == $enable_multi) {
                break;
            }
        endif;
    }
    return $media;
}

function kopa_get_client_IP()
{
    $IP = NULL;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        //check if IP is from shared Internet
        $IP = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        //check if IP is passed from proxy
        $ip_array = explode(",", $_SERVER['HTTP_X_FORWARDED_FOR']);
        $IP = trim($ip_array[count($ip_array) - 1]);
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        //standard IP check
        $IP = $_SERVER['REMOTE_ADDR'];
    }
    return $IP;
}

function kopa_get_post_meta($pid, $key = '', $single = false, $type = 'String', $default = '')
{
    $data = get_post_meta($pid, $key, $single);
    switch ($type) {
        case 'Int':
            $data = (int)$data;
            return ($data >= 0) ? $data : $default;
            break;
        default:
            return ($data) ? $data : $default;
            break;
    }
}

function kopa_get_like_permission($pid)
{
    $permission = 'disable';
    $key = 'kopa_' . kopa_get_domain() . '_like_by_' . kopa_get_client_IP();
    $is_voted = kopa_get_post_meta($pid, $key, true, 'Int');
    if (!$is_voted)
        $permission = 'enable';
    return $permission;
}

function kopa_get_like_count($pid)
{
    $key = 'kopa_' . kopa_get_domain() . '_total_like';
    return kopa_get_post_meta($pid, $key, true, 'Int');
}

function kopa_total_post_count_by_month($month, $year)
{
    $args = array(
        'monthnum' => (int)$month,
        'year' => (int)$year,
    );
    $the_query = new WP_Query($args);
    return $the_query->post_count;;
}

function kopa_head()
{
    $logo_margin_top = get_option('kopa_theme_options_logo_margin_top');
    $logo_margin_left = get_option('kopa_theme_options_logo_margin_left');
    $logo_margin_right = get_option('kopa_theme_options_logo_margin_right');
    $logo_margin_bottom = get_option('kopa_theme_options_logo_margin_bottom');
    $kopa_theme_options_color_code = get_option('kopa_theme_options_color_code', '#e03d3d');
    echo "<style>
        #logo-image{
        margin-top:{$logo_margin_top}px;
        margin-left:{$logo_margin_left}px;
        margin-right:{$logo_margin_right}px;
        margin-bottom:{$logo_margin_bottom}px;
        }
        </style>";
    /* =========================================================
    Main Colorscheme
    ============================================================ */

    /* ==================================================================================================
    * Custom heading color
    * ================================================================================================= */

    /* =========================================================
    Font family
    ============================================================ */
    $google_fonts = kopa_get_google_font_array();
    $current_heading_font = get_option('kopa_theme_options_heading_font_family');
    $current_content_font = get_option('kopa_theme_options_content_font_family');
    $current_main_nav_font = get_option('kopa_theme_options_main_nav_font_family');
    $current_wdg_sidebar_font = get_option('kopa_theme_options_wdg_sidebar_font_family');
    $load_font_array = array();

    if ($current_heading_font) {
        $google_font_family = $google_fonts[$current_heading_font]['family'];
        echo "<style>
        h1, h2, h3, h4, h5, h6,
        .accordion-title h3 {
        font-family: '{$google_font_family}', sans-serif;
        }
        </style>";
    }
    if ($current_content_font) {
        $google_font_family = $google_fonts[$current_content_font]['family'];
        echo "<style>
        body,
        .breadcrumb,
        .sidebar .kopa-categories-widget ul li a,
        .list-container-1 ul li a,
        .list-container-2 .tabs-2 li a,
        .bottom-sidebar .newsletter-form .submit,
        .entry-categories a,
        .pagination .page-numbers li a, .pagination .page-numbers li span,
        .error-404 .left-col p,
        .wp-link-pages, .wp-link-pages a {
        font-family: '{$google_font_family}', sans-serif;
        }
        </style>";
    }
    if ($current_main_nav_font) {
        $google_font_family = $google_fonts[$current_main_nav_font]['family'];
        echo "<style>
        #main-menu > li > a,
        #main-menu li ul li a {
        font-family: '{$google_font_family}', sans-serif;
        }
        </style>";
    }
    if ($current_wdg_sidebar_font) {
        $google_font_family = $google_fonts[$current_wdg_sidebar_font]['family'];
        echo "<style>
        .widget .widget-title,
        .kopa-related-post h3,
        #comments h3,
        #respond h3,
        #contact-box h3,
        #contact-box .title-text {
        font-family: '{$google_font_family}', sans-serif;
        }
        </style>";
    }
    /* =========================================================
    Font size
    ============================================================ */


    /* ================================================================================
    * Font weight
    ================================================================================ */

    /* ==================================================================================================
    * Custom heading color
    * ================================================================================================= */

    /* ================================================================================
    * Custom Background
    ================================================================================ */

    /* ================================================================================
    * Custom Header Background
    ================================================================================ */

    /* ==================================================================================================
    * Custom CSS
    * ================================================================================================= */
    
    /* ==================================================================================================
    * IE8 Fix CSS3
    * ================================================================================================= */
    echo "<style>
        .kp-dropcap.color,
        .kopa-carousel-widget .pager a,
        .kopa-video-widget ul li .entry-item .entry-content .entry-thumb .play-icon,
        .widget-area-12 .kopa-entry-list-widget .kopa-entry-list .play-icon,
        .kp-gallery-slider .play-icon,
        .kp-gallery-carousel .play-icon {
        behavior: url(" . get_template_directory_uri() . "/js/PIE.htc);
        }
        </style>";

    /*
    post metadata
    */
    $metadata = '';
    if(get_option('kopa_theme_options_post_categories','show') == 'hide'){
        $metadata .= '.entry-box .entry-categories{
                        display:none;
                    }';
    }
    if(get_option('kopa_theme_options_post_date','show') == 'hide'){
        $metadata .= '.entry-box .entry-date{
                        display:none;
                    }';
    }
    if(get_option('kopa_theme_options_post_author','show') == 'hide'){
        $metadata .= '.entry-box .entry-author{
                        display:none;
                    }';
    }
    if(get_option('kopa_theme_options_post_comment','show') == 'hide'){
        $metadata .= '.entry-box .entry-comments{
                        display:none;
                    }';
    }
    if(get_option('kopa_theme_options_post_visit','show') == 'hide'){
        $metadata .= '.entry-box .entry-view{
                        display:none;
                    }';
    }
    if($metadata != ''){
        echo '<style>
        '.$metadata.'
        </style>';
    }
}

/* ==============================================================================
* Mobile Menu
============================================================================= */

class kopa_mobile_menu extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0)
    {
        global $wp_query;
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $class_names = $value = '';
        $classes = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if ($depth == 0)
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . ' clearfix"' : 'class="clearfix"';
        else
            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : 'class=""';
        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';
        $output .= $indent . '<li' . $id . $value . $class_names . '>';
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
        if ($depth == 0) {
            $item_output = $args->before;
            $item_output .= '<h3><a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a></h3>';
            $item_output .= $args->after;
        } else {
            $item_output = $args->before;
            $item_output .= '<a' . $attributes . '>';
            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
        }
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "\n$indent<span>+</span><div class='clear'></div><div class='menu-panel clearfix'><ul>";
        } else {
            $output .= '<ul>'; // indent for level 2, 3 ...
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        if ($depth == 0) {
            $output .= "$indent</ul></div>\n";
        } else {
            $output .= '</ul>';
        }
    }
}

function kopa_add_icon_home_menu($items, $args)
{
    if ($args->theme_location == 'main-nav') {
        if ($args->menu_id == 'toggle-view-menu') {
            $homelink = '<li class="clearfix"><h3><a href="' . esc_url(home_url()) . '">' . __('Home', kopa_get_domain()) . '</a></h3></li>';
            $items = $homelink . $items;
        } else if ($args->menu_id == 'main-menu') {
            $homelink = '<li class="menu-home-icon' . (is_front_page() ? ' current-menu-item' : '') . '"><a href="' . esc_url(home_url()) . '">' . __('Home', kopa_get_domain()) . '</a><span></span></li>';
            $items = $homelink . $items;
        }
    }
    return $items;
}

function kopa_custom_excerpt_length($length)
{
    $length=17; 
    return $length;
}

/**
 * Convert Hex Color to RGB using PHP
 * @link http://bavotasan.com/2011/convert-hex-color-to-rgb-using-php/
 */
function kopa_hex2rgba($hex, $alpha = false)
{
    $hex = str_replace("#", "", $hex);
    if (strlen($hex) == 3) {
        $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
        $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
        $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
    } else {
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
    }
    if ($alpha)
        return array($r, $g, $b, $alpha);

    return array($r, $g, $b);
}

add_filter('kopa_icon_get_icon', 'newsmix_kopa_icon_get_icon', 10, 3);
function newsmix_kopa_icon_get_icon($html, $icon_class, $icon_tag)
{
    $classes = '';
    switch ($icon_class) {
        case 'facebook':
            $classes = 'fa fa-facebook';
            break;
        case 'facebook2':
            $classes = 'fa fa-facebook-square';
            break;
        case 'twitter':
            $classes = 'fa fa-twitter';
            break;
        case 'twitter2':
            $classes = 'fa fa-twitter-square';
            break;
        case 'google-plus':
            $classes = 'fa fa-google-plus';
            break;
        case 'google-plus2':
            $classes = 'fa fa-google-plus-square';
            break;
        case 'youtube':
            $classes = 'fa fa-youtube';
            break;
        case 'dribbble':
            $classes = 'fa fa-dribbble';
            break;
        case 'flickr':
            $classes = 'fa fa-flickr';
            break;
        case 'rss':
            $classes = 'fa fa-rss';
            break;
        case 'linkedin':
            $classes = 'fa fa-linkedin';
            break;
        case 'pinterest':
            $classes = 'fa fa-pinterest';
            break;
        case 'email':
            $classes = 'fa fa-envelope';
            break;
        case 'pencil':
            $classes = 'fa fa-pencil';
            break;
        case 'date':
            $classes = 'fa fa-clock-o';
            break;
        case 'comment':
            $classes = 'fa fa-comment';
            break;
        case 'view':
            $classes = 'fa fa-eye';
            break;
        case 'link':
            $classes = 'fa fa-link';
            break;
        case 'film':
            $classes = 'fa fa-film';
            break;
        case 'images':
            $classes = 'fa fa-picture-o';
            break;
        case 'music':
            $classes = 'fa fa-music';
            break;
        case 'long-arrow-right':
            $classes = 'fa fa-long-arrow-right';
            break;
        case 'apple':
            $classes = 'fa fa-apple';
            break;
        case 'star':
            $classes = 'fa fa-star';
            break;
        case 'star2':
            $classes = 'fa fa-star-o';
            break;
        case 'exit':
            $classes = 'fa fa-sign-out';
            break;
        case 'folder':
            $classes = 'fa fa-folder';
            break;
        case 'video':
            $classes = 'fa fa-video-camera';
            break;
        case 'play':
            $classes = 'fa fa-play';
            break;
        case 'spinner':
            $classes = 'fa fa-spinner';
            break;
        case 'bug':
            $classes = 'fa fa-bug';
            break;
        case 'tint':
            $classes = 'fa fa-tint';
            break;
        case 'pause':
            $classes = 'fa fa-pause';
            break;
        case 'crosshairs':
            $classes = 'fa fa-crosshairs';
            break;
        case 'cog':
            $classes = 'fa fa-cog';
            break;
        case 'check-circle':
            $classes = 'fa fa-check-circle-o';
            break;
        case 'hand-right':
            $classes = 'fa fa-hand-o-right';
            break;
        case 'plus-square':
            $classes = 'fa fa-plus-square';
            break;
        case 'trash':
            $classes = 'fa fa-trash-o';
            break;
        case 'arrow-circle-up':
            $classes = 'fa fa-arrow-circle-up';
            break;
        case 'volume':
            $classes = 'fa fa-volume-up';
            break;
    }
    return KopaIcon::createHtml($classes, $icon_tag);
}

function kopa_get_image_src($pid = 0, $size = 'thumbnail')
{
    $thumb = get_the_post_thumbnail($pid, $size);
    if (!empty($thumb)) {
        $_thumb = array();
        $regex = '#<\s*img [^\>]*src\s*=\s*(["\'])(.*?)\1#im';
        preg_match($regex, $thumb, $_thumb);
        $thumb = $_thumb[2];
    }
    return $thumb;
}


