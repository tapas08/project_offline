<?php
add_action('widgets_init', 'kopa_widgets_init');

function kopa_widgets_init() {
   
    register_widget('Kopa_Widget_Flexslider');
    register_widget('Kopa_Widget_Articles_List');
    register_widget('Kopa_Widget_Articles_Carousel');
    register_widget('Kopa_Widget_Articles_Tabs_List');
    register_widget('Kopa_Widget_Entry_List');   
}

add_action('admin_enqueue_scripts', 'kopa_widget_admin_enqueue_scripts');

function kopa_widget_admin_enqueue_scripts($hook) {
    if ('widgets.php' === $hook) {
        $dir = get_template_directory_uri() . '/library';
        wp_enqueue_style('kopa_widget_admin', "{$dir}/css/widget.css");
        wp_enqueue_script('kopa_widget_admin', "{$dir}/js/widget.js", array('jquery'));
    }
}

function kopa_widget_article_build_query($query_args = array()) {
    $args = array(
        'post_type' => array('post'),
        'posts_per_page' => $query_args['number_of_article']
    );

    $tax_query = array();

    if ($query_args['categories']) {
        $tax_query[] = array(
            'taxonomy' => 'category',
            'field' => 'id',
            'terms' => $query_args['categories']
        );
    }
    if ($query_args['tags']) {
        $tax_query[] = array(
            'taxonomy' => 'post_tag',
            'field' => 'id',
            'terms' => $query_args['tags']
        );
    }
    if ($query_args['relation'] && count($tax_query) == 2) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ($tax_query) {
        $args['tax_query'] = $tax_query;
    }

    switch ($query_args['orderby']) {
        case 'popular':
            $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
            $args['orderby'] = 'meta_value_num';
            break;
        case 'most_comment':
            $args['orderby'] = 'comment_count';
            break;
        case 'random':
            $args['orderby'] = 'rand';
            break;
        default:
            $args['orderby'] = 'date';
            break;
    }
    if (isset($query_args['post__not_in']) && $query_args['post__not_in']) {
        $args['post__not_in'] = $query_args['post__not_in'];
    }
    return new WP_Query($args);
}

function kopa_widget_posttype_build_query( $query_args = array() ) {
    $default_query_args = array(
        'post_type'      => 'post',
        'posts_per_page' => -1,
        'post__not_in'   => array(),
        'ignore_sticky_posts' => 1,
        'categories'     => array(),
        'tags'           => array(),
        'relation'       => 'OR',
        'orderby'        => 'lastest',
        'cat_name'       => 'category',
        'tag_name'       => 'post_tag'
    );

    $query_args = wp_parse_args( $query_args, $default_query_args );

    $args = array(
        'post_type'           => $query_args['post_type'],
        'posts_per_page'      => $query_args['posts_per_page'],
        'post__not_in'        => $query_args['post__not_in'],
        'ignore_sticky_posts' => $query_args['ignore_sticky_posts']
    );

    $tax_query = array();

    if ( $query_args['categories'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['cat_name'],
            'field'    => 'id',
            'terms'    => $query_args['categories']
        );
    }
    if ( $query_args['tags'] ) {
        $tax_query[] = array(
            'taxonomy' => $query_args['tag_name'],
            'field'    => 'id',
            'terms'    => $query_args['tags']
        );
    }
    if ( $query_args['relation'] && count( $tax_query ) == 2 ) {
        $tax_query['relation'] = $query_args['relation'];
    }

    if ( $tax_query ) {
        $args['tax_query'] = $tax_query;
    }

    switch ( $query_args['orderby'] ) {
    case 'popular':
        $args['meta_key'] = 'kopa_' . kopa_get_domain() . '_total_view';
        $args['orderby'] = 'meta_value_num';
        break;
    case 'most_comment':
        $args['orderby'] = 'comment_count';
        break;
    case 'random':
        $args['orderby'] = 'rand';
        break;
    default:
        $args['orderby'] = 'date';
        break;
    }

    return new WP_Query( $args );
}


/**
 * Flexslider Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Flexslider extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'home-slider-widget', 'description' => __('A Posts Slider Widget', kopa_get_domain()));
        $control_ops = array('width' => '500', 'height' => 'auto');
        parent::__construct('kopa_widget_flexslider', __('Kopa Flexslider', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args = array();
        $query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
        $query_args['relation'] = isset($instance['relation']) ? $instance['relation'] : 'OR' ;
        $query_args['tags'] = empty($instance['tags']) ? array() : $instance['tags'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;

        echo $before_widget;

        if ( ! empty( $title ) ) :
            ?>
            <h3 class="widget-title clearfix">
                <span class="title-text"><?php echo $title; ?>
                    <span class="triangle-right"></span>
                    <span class="triangle-left"></span>
                    <span class="triangle-bottom"></span>
                </span>
                <span class="title-right"></span>
            </h3>
        <?php 
        endif;

        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) : ?>

            <div class="home-slider flexslider" data-animation="<?php echo isset($instance['animation']) ? $instance['animation'] : 'slide' ; ?>" data-direction="<?php echo isset($instance['direction']) ? $instance['direction'] : 'horizontal' ; ?>" data-slideshow_speed="<?php echo ($instance['slideshow_speed']>0)? $instance['slideshow_speed']:1000; ?>" data-animation_speed="<?php echo ($instance['animation_speed']>0)? $instance['animation_speed']:1000; ?>" data-autoplay="<?php echo isset($instance['is_auto_play']) ? $instance['is_auto_play'] : 'true'; ?>">
                <ul class="slides">
                    <?php while ( $posts->have_posts() ) : $posts->the_post();
                        $thumbnail_id = get_post_thumbnail_id();
                        $thumbnail = wp_get_attachment_image( $thumbnail_id, 'kopa-image-size-0' ); // 446 x 411
                    ?>
                    <li>
                        <article class="entry-item">
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
                            <?php if ( has_post_thumbnail() ) { 
                                echo '<a href="'.get_permalink().'">'.$thumbnail.'</a>';
                            } ?>
                        </article>
                    </li>
                    <?php endwhile; ?>
                </ul><!--slides-->
            </div><!--home-slider-->

        <?php
        endif; // endif $posts->have_posts()

        wp_reset_postdata();
        
        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title' => __( 'Hot News', kopa_get_domain() ),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 10,
            'orderby' => 'lastest',
            'animation' => 'slide',
            'direction' => 'horizontal',
            'slideshow_speed' => '7000',
            'animation_speed' => '600',
            'is_auto_play' => 'true'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['animation'] = $instance['animation'];
        $form['direction'] = $instance['direction'];
        $form['slideshow_speed'] = (int) $instance['slideshow_speed'];
        $form['animation_speed'] = (int) $instance['animation_speed'];
        $form['is_auto_play'] = $instance['is_auto_play'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <div class="kopa-one-half">
            <p>
                <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $categories = get_categories();
                    foreach ($categories as $category) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>

            </p>
            <p>
                <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                    <?php
                    $relation = array(
                        'AND' => __('And', kopa_get_domain()),
                        'OR' => __('Or', kopa_get_domain())
                    );
                    foreach ($relation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                    <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                    <?php
                    $tags = get_tags();
                    foreach ($tags as $tag) {
                        printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
                <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
            </p>
            <p>
                <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                    <?php
                    $orderby = array(
                        'lastest' => __('Lastest', kopa_get_domain()),
                        'popular' => __('Popular by View Count', kopa_get_domain()),
                        'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                        'random' => __('Random', kopa_get_domain()),
                    );
                    foreach ($orderby as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>
        </div>
        <div class="kopa-one-half last">
            <p>
                <label for="<?php echo $this->get_field_id('animation'); ?>"><?php _e('Animation:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('animation'); ?>" name="<?php echo $this->get_field_name('animation'); ?>" autocomplete="off">
                    <?php
                    $animation = array(
                        'fade' => __('Fade', kopa_get_domain()),
                        'slide' => __('Slide', kopa_get_domain())
                    );
                    foreach ($animation as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['animation']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('direction'); ?>"><?php _e('Direction:', kopa_get_domain()); ?></label>                
                <select class="widefat" id="<?php echo $this->get_field_id('direction'); ?>" name="<?php echo $this->get_field_name('direction'); ?>" autocomplete="off">
                    <?php
                    $direction = array(
                        'horizontal' => __('Horizontal', kopa_get_domain())
                    );
                    foreach ($direction as $value => $title) {
                        printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['direction']) ? 'selected="selected"' : '');
                    }
                    ?>
                </select>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('slideshow_speed'); ?>"><?php _e('Speed of the slideshow cycling:', kopa_get_domain()); ?></label> 
                <input class="widefat" id="<?php echo $this->get_field_id('slideshow_speed'); ?>" name="<?php echo $this->get_field_name('slideshow_speed'); ?>" type="number" value="<?php echo $form['slideshow_speed']; ?>" />
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('animation_speed'); ?>"><?php _e('Speed of animations:', kopa_get_domain()); ?></label>                
                <input class="widefat" id="<?php echo $this->get_field_id('animation_speed'); ?>" name="<?php echo $this->get_field_name('animation_speed'); ?>" type="number" value="<?php echo $form['animation_speed']; ?>" />
            </p>

            <p>
                <input class="" id="<?php echo $this->get_field_id('is_auto_play'); ?>" name="<?php echo $this->get_field_name('is_auto_play'); ?>" type="checkbox" value="true" <?php echo ('true' === $form['is_auto_play']) ? 'checked="checked"' : ''; ?> />
                <label for="<?php echo $this->get_field_id('is_auto_play'); ?>"><?php _e('Auto Play', kopa_get_domain()); ?></label>                                
            </p>
        </div>
        <div class="kopa-clear"></div>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['animation'] = $new_instance['animation'];
        $instance['direction'] = $new_instance['direction'];
        $instance['slideshow_speed'] = (int) $new_instance['slideshow_speed'];
        $instance['animation_speed'] = (int) $new_instance['animation_speed'];
        $instance['is_auto_play'] = isset($new_instance['is_auto_play']) ? $new_instance['is_auto_play'] : 'false';

        return $instance;
    }
} // end Kopa_Widget_Flexslider



/**
 * Articles List Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Articles_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-featured-widget', 'description' => __('A Featured Articles Widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_articles_list', __('Kopa Articles List', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args = array();
        $query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
        $query_args['relation'] = isset($instance['relation']) ? $instance['relation'] : 'OR' ;
        $query_args['tags'] = empty($instance['tags']) ? array() : $instance['tags'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title;
        }

        if ( $instance['style'] == 'style1' ) { // only show and float left the first post thumbnail
            $this->show_articles_list_style_1( $query_args );
        } elseif ( $instance['style'] == 'style2' ) { // show all post thumbnails
            $this->show_articles_list_style_2( $query_args );
        }

        echo $after_widget;
    }

    public function show_articles_list_style_1( $query_args ) {
        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) :

            $post_index = 1;

            while ( $posts->have_posts() ) : $posts->the_post();

                if ( $post_index == 1 ) : 
            ?>
                    <article class="entry-item">
                        <header>
                            <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                            <span class="entry-date"><span class="kopa-minus"></span> <?php the_time( get_option( 'date_format' ) ); ?></span>
                        </header>
                        <div class="entry-thumb">
                            <?php if ( get_post_format() == 'gallery' ) : ?>

                                <div class="entry-thumb-slider flexslider">
                                    <ul class="slides">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <li><img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1');  ?>" alt="<?php echo get_the_title(); ?>"></li>
                                        <?php endif;

                                        $gallery = kopa_content_get_gallery( get_the_content() );
                                        
                                        if (isset( $gallery[0] )) {
                                            $gallery = $gallery[0];
                                        } else {
                                            $gallery = '';
                                        } 

                                        if ( isset($gallery['shortcode']) ) {
                                            $shortcode = $gallery['shortcode'];
                                        } else {
                                            $shortcode = '';
                                        } 

                                        // get gallery string ids
                                        preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
                                        if ( isset( $gallery_string_ids[0][0] ) ) {
                                            $gallery_string_ids = $gallery_string_ids[0][0];
                                        } else {
                                            $gallery_string_ids = '';
                                        } 

                                        // get array of image id
                                        preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
                                        if ( isset( $gallery_ids[0] ) ) {
                                            $gallery_ids = $gallery_ids[0];
                                        } else {
                                            $gallery_ids = '';
                                        } 

                                        if ( ! empty( $gallery_ids ) ) :
                                            foreach ( $gallery_ids as $gallery_id ) :
                                                if ( wp_attachment_is_image( $gallery_id ) ) {
                                                    echo '<li>' . wp_get_attachment_image( $gallery_id, 'kopa-image-size-1' ) . '</li>';
                                                }
                                            endforeach;
                                        endif;
                                        
                                        ?>
                                    </ul><!--slides-->
                                </div><!--entry-thumb-slider-->

                            <?php elseif ( get_post_format() == 'video' ) : 
                                    $video = kopa_content_get_video( get_the_content() );
                                    if ( isset( $video[0] ) ) :
                                        $video = $video[0];

                                        if ( isset( $video['url'] ) && ! empty( $video['url'] ) ) :
                            ?>
                                            <a class="play-icon" href="<?php echo esc_url( $video['url'] ); ?>" rel="prettyPhoto[<?php echo $this->get_field_id( 'video' ); ?>]"></a>
                            <?php 
                                        endif;
                                    endif; // endif isset( $video[0] )
                            ?>
                                    <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) {?>
                                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php
                                    
                                    } elseif ( isset( $video['url'] ) && isset( $video['type'] ) ) {
                                        echo '<img src="'.kopa_get_video_thumbnails_url( $video['type'], $video['url'] ).'" alt="'.get_the_title().'">';
                                    } ?></a>

                            <?php

                            else : ?>

                                <a href="<?php the_permalink(); ?>">
                                    <?php if (has_post_thumbnail()) {  ?>
                                       <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1');  ?>" alt="<?php echo get_the_title(); ?>">
                                  <?php  } ?></a>
                                
                            <?php endif; ?>
                        </div>
                        <div class="entry-content"><?php the_excerpt(); ?></div>
                    </article><!--entry-item-->
                    <ul class="older-post">
            <?php 
                else :
            ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                    </li>
            <?php
                endif; // endif ( $post_index == 1 ) 

                $post_index++; // increase post index
            endwhile;
                    
            echo '</ul>';
        endif; // endif $posts->have_posts()

        wp_reset_postdata();
    }

    public function show_articles_list_style_2( $query_args ) {
        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) :
        ?>
        
        <div class="kopa-video-widget">
            <ul>
                <?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
                    <li>
                        <article class="entry-item">
                            <header>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </header>
                                <?php if ( get_post_format() == 'gallery' ) : ?>
                                    <div class="entry-thumb">
                                        <div class="entry-thumb-slider flexslider">
                                            <ul class="slides">
                                                <?php if ( has_post_thumbnail() ) : ?>
                                                    <li><img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1'); ?>" alt="<?php echo get_the_title(); ?>"></li>
                                                <?php endif;

                                                $gallery = kopa_content_get_gallery( get_the_content() );
                                                
                                                if (isset( $gallery[0] )) {
                                                    $gallery = $gallery[0];
                                                } else {
                                                    $gallery = '';
                                                } 

                                                if ( isset($gallery['shortcode']) ) {
                                                    $shortcode = $gallery['shortcode'];
                                                } else {
                                                    $shortcode = '';
                                                } 

                                                // get gallery string ids
                                                preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
                                                if ( isset( $gallery_string_ids[0][0] ) ) {
                                                    $gallery_string_ids = $gallery_string_ids[0][0];
                                                } else {
                                                    $gallery_string_ids = '';
                                                } 

                                                // get array of image id
                                                preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
                                                if ( isset( $gallery_ids[0] ) ) {
                                                    $gallery_ids = $gallery_ids[0];
                                                } else {
                                                    $gallery_ids = '';
                                                } 

                                                if ( ! empty( $gallery_ids ) ) :
                                                    foreach ( $gallery_ids as $gallery_id ) :
                                                        if ( wp_attachment_is_image( $gallery_id ) ) {
                                                            
                                                            echo '<li>' . wp_get_attachment_image( $gallery_id, 'kopa-image-size-1' ) . '</li>';
                                                        }
                                                    endforeach;
                                                endif;
                                                
                                                ?>
                                            </ul><!--slides-->
                                        </div><!--entry-thumb-slider-->
                                    </div> <!-- entry-thumb -->
                                <?php endif; ?>
                            
                            <div class="entry-content">
                                <div class="entry-thumb">
                                <?php if ( get_post_format() == 'video' ) : 
                                    $video = kopa_content_get_video( get_the_content() );
                                    if ( isset( $video[0] ) ) :
                                        $video = $video[0];

                                        if ( isset( $video['url'] ) && ! empty( $video['url'] ) ) :
                                ?>
                                            <a class="play-icon" href="<?php echo esc_url( $video['url'] ); ?>" rel="prettyPhoto[<?php echo $this->get_field_id( 'video' ); ?>]"></a>
                                <?php 
                                        endif;
                                    endif; // endif isset $video[0]
                                ?>
                                    <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) { ?>
                                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1');  ?>" alt="<?php echo get_the_title(); ?>">
                                   <?php  } elseif ( isset( $video['url'] ) && isset( $video['type'] ) ) {
                                        echo '<img src="'.kopa_get_video_thumbnails_url( $video['type'], $video['url'] ).'" alt="'.get_the_title().'">';
                                    } ?></a>
                                <?php
                                endif; // endif video post format

                                if ( has_post_thumbnail() && get_post_format() != 'gallery' && get_post_format() != 'video' ): ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-1');  ?>" alt="<?php echo get_the_title(); ?>">
                                    </a>
                                <?php endif; ?> 
                                </div>
                            </div>
                        </article>
                    </li>
                <?php endwhile; ?>
            </ul>
        </div> <!-- .kopa-video-widget -->

        <?php
        else : 
            _e( 'No Posts Found', kopa_get_domain() );
        endif;
    }

    function form($instance) {
        $defaults = array(
            'title' => __( 'Popular', kopa_get_domain() ),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 5,
            'orderby' => 'lastest',
            'style' => 'style1' // only show first post thumbnail
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['style'] = $instance['style'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Lastest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain()),
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('style'); ?>"><?php _e( 'Thumbnail Style', kopa_get_domain() ); ?></label>
            <select class="widefat" name="<?php echo $this->get_field_name('style'); ?>" id="<?php echo $this->get_field_id('style'); ?>">
                <?php 
                $styles = array(
                    'style1' => __( 'Only show first post thumbnail', kopa_get_domain() ),
                    'style2' => __( 'All posts thumbnail with the same size', kopa_get_domain() )
                );
                foreach ($styles as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['style']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['style'] = $new_instance['style'];

        return $instance;
    }
}

/**
 * Articles Carousel Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Articles_Carousel extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-carousel-widget', 'description' => __('An Articles Carousel Widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_articles_carousel', __('Kopa Articles Carousel', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args = array();
        $query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
        $query_args['relation'] = isset($instance['relation']) ? $instance['relation'] : 'OR' ;
        $query_args['tags'] = empty($instance['tags']) ? array() : $instance['tags'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;

        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;
        
        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) : ?>
            <div class="list-carousel responsive" >
                <ul class="kopa-featured-news-carousel" data-prev-id="#<?php echo $this->get_field_id('prev-1'); ?>" data-next-id="#<?php echo $this->get_field_id('next-1'); ?>" data-pagination-id="#<?php echo $this->get_field_id('pager2') ?>" data-scroll-items="<?php echo $instance['scroll_items'] ?>">

                    <?php while ( $posts->have_posts() ) : $posts->the_post(); 
                        $thumbnail_id = get_post_thumbnail_id();
                        $thumbnail = wp_get_attachment_image( $thumbnail_id, 'kopa-image-size-2' ); // 234 x 169
                    ?>
                    <li>
                        <article class="entry-item clearfix">
                            <div class="entry-thumb">
                                <a href="<?php the_permalink(); ?>">
                                    <?php if ( get_post_format() == 'video' ) : 
                                        $video = kopa_content_get_video( get_the_content() );

                                        if ( isset( $video[0] ) ) {
                                            $video = $video[0];
                                        } else {
                                            $video = '';
                                        }

                                        if ( has_post_thumbnail() ) {
                                            echo $thumbnail;
                                        } elseif ( isset( $video['type'] ) && isset( $video['url'] ) ) {
                                            echo '<img src="'.kopa_get_video_thumbnails_url( $video['type'], $video['url'] ).'">';
                                        }
                                    ?>

                                    <?php elseif ( get_post_format() == 'gallery' ) : 

                                        if ( has_post_thumbnail() ) {
                                            echo $thumbnail;
                                        } else {
                                            $gallery = kopa_content_get_gallery( get_the_content() );

                                            if (isset( $gallery[0] )) 
                                                $gallery = $gallery[0];
                                            else 
                                                $gallery = '';

                                            if ( isset($gallery['shortcode']) ) 
                                                $shortcode = $gallery['shortcode'];
                                            else 
                                                $shortcode = '';

                                            // get gallery string ids
                                            preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
                                            if ( isset( $gallery_string_ids[0][0] ) )
                                                $gallery_string_ids = $gallery_string_ids[0][0];
                                            else 
                                                $gallery_string_ids = '';

                                            // get array of image id
                                            preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
                                            if ( isset( $gallery_ids[0] ) )
                                                $gallery_ids = $gallery_ids[0];
                                            else 
                                                $gallery_ids = '';

                                            if ( ! empty( $gallery_ids ) ) {
                                                foreach ( $gallery_ids as $gallery_id ) {
                                                    if ( wp_attachment_is_image( $gallery_id ) ) {
                                                        echo wp_get_attachment_image( $gallery_id, 'kopa-image-size-2' ); // 234x169
                                                        break;
                                                    }
                                                }
                                            } 
                                        }
                                    ?>

                                    <?php else : ?>
                                        <?php if ( has_post_thumbnail() ) {
                                            echo $thumbnail;
                                        } ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                            <div class="entry-content">
                                <header>
                                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                    <span class="entry-date"><span class="kopa-minus"></span> <?php the_time( get_option('date_format') ); ?></span>
                                </header>
                                <?php the_excerpt(); ?>
                            </div><!--entry-content-->
                        </article><!--entry-item-->
                    </li>
                    <?php endwhile; ?>
                </ul><!--kopa-featured-news-carousel-->
                <div class="clearfix"></div>
                <div class="carousel-nav clearfix">
                    <a id="<?php echo $this->get_field_id('prev-1'); ?>" class="carousel-prev" href="#">&lt;</a>
                    <a id="<?php echo $this->get_field_id('next-1'); ?>" class="carousel-next" href="#">&gt;</a>
                </div>
                <div id="<?php echo $this->get_field_id('pager2'); ?>" class="pager"></div>
            </div><!--list-carousel-->
            <?php
        endif; // endif $posts->have_posts()

        wp_reset_postdata();
        
        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title' => __( 'Popular', kopa_get_domain() ),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 8,
            'orderby' => 'lastest',
            'scroll_items' => 1
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['scroll_items'] = $instance['scroll_items'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Lastest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain())
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('scroll_items'); ?>"><?php _e('Scroll Items:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="1" id="<?php echo $this->get_field_id('scroll_items'); ?>" name="<?php echo $this->get_field_name('scroll_items'); ?>" value="<?php echo esc_attr( $form['scroll_items'] ); ?>">
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['scroll_items'] = (int) $new_instance['scroll_items'];

        return $instance;
    }
}


/**
 * Articles Tabs List Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Articles_Tabs_List extends WP_Widget {
    
    function __construct() {
        $widget_ops = array('classname' => 'kopa-article-list-widget', 'description' => __('Display tabs of posts for each selected categories', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_articles_tabs_list', __('Kopa Articles Tabs List', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );	
		$query_args = array();
        $query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;
		
        $display_type = isset($instance['display_type']) ? $instance['display_type'] : 'ranking' ;
        $categories = get_terms( 'category' );
            
        echo $before_widget;
        if ( ! empty( $title ) )
            echo $before_title . $title . $after_title;

        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( ! empty( $instance['categories'] ) && $posts->have_posts() ) : ?>

            <div class="list-container-1">
                <ul class="tabs-1 clearfix">
                    <?php 
                    $cat_index = 1;
                    foreach ( $categories as $category ) :
                        if ( in_array($category->term_id, $instance['categories']) ) : ?>
                        <li <?php echo ( $cat_index == 1 ? ' class="active"' : '' ); ?>><a href="#<?php echo $this->get_field_id( 'tab' ) . '-' . $category->term_id; ?>"><?php echo $category->name; ?></a></li>
                    <?php 
                        endif;
                        $cat_index++; // increase category index by 1
                    endforeach; ?>
                </ul><!--tabs-1-->
            </div>
            <div class="tab-container-1">
                <?php foreach ( $instance['categories'] as $cat_ID ) : 
                    $cat_posts = new WP_Query( array(
                        'cat' => $cat_ID,
                        'posts_per_page' => $instance['number_of_article']
                    ) );

                    if ( $cat_posts->have_posts() ) :
                ?>
                    <div class="tab-content-1 kp-post-format <?php echo ( $display_type == 'thumbnail' ? 'kp-thumbnail-style' : '' ); ?>" id="<?php echo $this->get_field_id('tab') . '-' . $cat_ID; ?>">                        
                        <ul>
                            <?php $post_index = 1; 
                            while ( $cat_posts->have_posts() ) : $cat_posts->the_post(); 

                                $thumbnail = wp_get_attachment_image( get_post_thumbnail_id(), 'kopa-image-size-3' );

                                if ( $post_index == 1 )
                                    $index_class = 'kp-1st-post';
                                elseif ( $post_index == 2 )
                                    $index_class = 'kp-2nd-post';
                                elseif ( $post_index == 3 )
                                    $index_class = 'kp-3rd-post';
                                else
                                    $index_class = 'kp-nth-post';
                            ?>
                                <li>
                                    <article class="entry-item clearfix">
                                        
                                        <?php if ( $display_type == 'ranking' ) : ?>
                                            <span class="entry-thumb <?php echo $index_class; ?>"><?php echo $post_index; ?></span>
                                        <?php else : ?>
                                            <span class="entry-thumb"><a href="<?php the_permalink(); ?>"><?php if ( has_post_thumbnail() )
                                                    echo $thumbnail; // 53 x 53
                                            ?></a></span>
                                        <?php endif; // endif $display_type == ranking ?>

                                        <div class="entry-content">
                                            <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                            <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>

                                            <?php if ( get_post_format() == 'video' ) : 
                                                echo KopaIcon::getIcon('video-icon fa fa-video-camera','span'); 
                                             endif; ?>
                                        </div>

                                    </article>
                                </li>
                            <?php $post_index++; // increase post index by 1 
                            endwhile; ?>
                        </ul>

                    </div><!--tab-content-1-->
                    <?php endif; 
                    wp_reset_postdata();
                endforeach; ?>
            </div><!--tab-container-1-->
            
            <?php
        endif; // endif $posts->have_posts()

        wp_reset_postdata();

        echo $after_widget;
    }

    function form($instance) {
        $defaults = array(
            'title' => __( 'Trending Now', kopa_get_domain() ),
            'categories' => array(),
            'number_of_article' => 5,
            'orderby' => 'lastest',
            'display_type' => 'ranking'
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        $form['display_type'] = $instance['display_type'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of articles on each tab:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Lastest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain())
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'display_type' ); ?>"><?php _e( 'Display type', kopa_get_domain() ); ?></label>
            <select name="<?php echo $this->get_field_name( 'display_type' ) ?>" id="<?php echo $this->get_field_id( 'display_type' ); ?>">
                <?php 
                $display_types = array(
                    'ranking' => __( 'Ranking Numbers', kopa_get_domain() ),
                    'thumbnail' => __( 'Thumbnail', kopa_get_domain() )
                );

                foreach ( $display_types as $value => $title ) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['display_type']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        $instance['display_type'] = $new_instance['display_type'];

        return $instance;
    }

}

/**
 * Entry List Widget Class
 * @since News Mix 1.0
 */
class Kopa_Widget_Entry_List extends WP_Widget {
    function __construct() {
        $widget_ops = array('classname' => 'kopa-entry-list-widget clearfix', 'description' => __('A Featured Articles Widget', kopa_get_domain()));
        $control_ops = array('width' => 'auto', 'height' => 'auto');
        parent::__construct('kopa_widget_entry_list', __('Kopa Entry List', kopa_get_domain()), $widget_ops, $control_ops);
    }

    function widget( $args, $instance ) {
        extract( $args );
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
        $query_args = array();
        $query_args['categories'] = empty($instance['categories']) ? array() : $instance['categories'] ;
        $query_args['relation'] = isset($instance['relation']) ? $instance['relation'] : 'OR' ;
        $query_args['tags'] = empty($instance['tags']) ? array() : $instance['tags'] ;
        $query_args['posts_per_page'] = isset($instance['number_of_article']) ? $instance['number_of_article'] : -1 ;
        $query_args['orderby'] = isset($instance['orderby']) ? $instance['orderby'] : 'latest' ;


        

        echo $before_widget;

        if ( ! empty( $title ) ) {
            echo $before_title . $title . $after_title; 
        }
        
        
            // only show and float left the first post thumbnail
            $this->show_entry_list_style_1( $query_args );
        

        echo $after_widget;

    }

    function show_entry_list_style_1( $query_args ) {
        $posts = kopa_widget_posttype_build_query( $query_args );

        if ( $posts->have_posts() ) : 
            $post_index = 1;
            while ( $posts->have_posts() ) : $posts->the_post();
                if ( $post_index == 1 ) : // show the thumbnail of the first post
        ?>
                    <article class="entry-item">
                        <div class="entry-thumb">
                            <?php if ( get_post_format() == 'gallery' ) : ?>

                                <div class="entry-thumb-slider flexslider">
                                    <ul class="slides">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <li><img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-4'); ?>" alt="<?php echo get_the_title(); ?>"></li>
                                        <?php endif;

                                        $gallery = kopa_content_get_gallery( get_the_content() );
                                        
                                        if (isset( $gallery[0] )) 
                                            $gallery = $gallery[0];
                                        else 
                                            $gallery = '';

                                        if ( isset($gallery['shortcode']) ) 
                                            $shortcode = $gallery['shortcode'];
                                        else 
                                            $shortcode = '';

                                        // get gallery string ids
                                        preg_match_all('/ids=\"(?:\d+,*)+\"/', $shortcode, $gallery_string_ids);
                                        if ( isset( $gallery_string_ids[0][0] ) )
                                            $gallery_string_ids = $gallery_string_ids[0][0];
                                        else 
                                            $gallery_string_ids = '';

                                        // get array of image id
                                        preg_match_all('/\d+/', $gallery_string_ids, $gallery_ids);
                                        if ( isset( $gallery_ids[0] ) )
                                            $gallery_ids = $gallery_ids[0];
                                        else 
                                            $gallery_ids = '';

                                        if ( ! empty( $gallery_ids ) ) :
                                            foreach ( $gallery_ids as $gallery_id ) :
                                                if ( wp_attachment_is_image( $gallery_id ) )
                                                    echo '<li>' . wp_get_attachment_image( $gallery_id, 'kopa-image-size-4' ) . '</li>';
                                            endforeach;
                                        endif;
                                        
                                        ?>
                                    </ul><!--slides-->
                                </div><!--entry-thumb-slider-->

                            <?php elseif ( get_post_format() == 'video' ) : 
                                    $video = kopa_content_get_video( get_the_content() );
                                    if ( isset( $video[0] ) ) :
                                        $video = $video[0];

                                        if ( isset( $video['url'] ) && ! empty( $video['url'] ) ) :
                            ?>
                                            <a class="play-icon" href="<?php echo esc_url( $video['url'] ); ?>" rel="prettyPhoto[<?php echo $this->get_field_id( 'video' ); ?>]"></a>
                            <?php 
                                        endif; // endif isset( $video['url']
                                    endif; // endif isset( $video[0] )
                            ?>
                                    <a href="<?php the_permalink(); ?>"><?php if (has_post_thumbnail()) { ?>
                                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                                    <?php } elseif ( isset( $video['url'] ) && isset( $video['type'] ) ) {
                                        echo '<img src="'.kopa_get_video_thumbnails_url( $video['type'], $video['url'] ).'">';
                                    } ?></a>
                            <?php 
                            else : ?>
                                <?php if ( has_post_thumbnail() ) : ?> 
                                    <a href="<?php the_permalink(); ?>">
                                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="entry-content">
                            <header>
                                <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h4>
                                <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ); ?></span>
                            </header>
                            <?php the_excerpt(); ?>
                        </div>
                    </article><!--entry-item-->

        <?php 
                    echo ( $posts->post_count > 1 ) ? '<ul class="older-post">' : ''; 

                else : // $post_index != 1 ( the rest posts )
        ?>
                    <li>
                        <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                        <?php the_excerpt(); ?>
                    </li>
        <?php 
                endif; // endif $post_index == 1

                $post_index++; // increase post index by 1

            endwhile; // endwhile $posts->have_posts()
            
            echo ( $posts->post_count > 1 ) ? '</ul><!-- .older-post -->' : '';  

        else : // if ! $posts->have_posts()

            _e( 'No Posts Found', kopa_get_domain() );

        endif;

        wp_reset_postdata();
    }

   
    function form($instance) {
        $defaults = array(
            'title' => __( 'News', kopa_get_domain() ),
            'categories' => array(),
            'relation' => 'OR',
            'tags' => array(),
            'number_of_article' => 4,
            'orderby' => 'lastest',
           
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = strip_tags( $instance['title'] );

        $form['categories'] = $instance['categories'];
        $form['relation'] = esc_attr($instance['relation']);
        $form['tags'] = $instance['tags'];
        $form['number_of_article'] = (int) $instance['number_of_article'];
        $form['orderby'] = $instance['orderby'];
        
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', kopa_get_domain()); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('categories'); ?>"><?php _e('Categories:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('categories'); ?>" name="<?php echo $this->get_field_name('categories'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $categories = get_categories();
                foreach ($categories as $category) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $category->term_id, $category->name, $category->count, (in_array($category->term_id, $form['categories'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>

        </p>
        <p>
            <label for="<?php echo $this->get_field_id('relation'); ?>"><?php _e('Relation:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('relation'); ?>" name="<?php echo $this->get_field_name('relation'); ?>" autocomplete="off">
                <?php
                $relation = array(
                    'AND' => __('And', kopa_get_domain()),
                    'OR' => __('Or', kopa_get_domain())
                );
                foreach ($relation as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['relation']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('tags'); ?>"><?php _e('Tags:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('tags'); ?>" name="<?php echo $this->get_field_name('tags'); ?>[]" multiple="multiple" size="5" autocomplete="off">
                <option value=""><?php _e('-- None --', kopa_get_domain()); ?></option>
                <?php
                $tags = get_tags();
                foreach ($tags as $tag) {
                    printf('<option value="%1$s" %4$s>%2$s (%3$s)</option>', $tag->term_id, $tag->name, $tag->count, (in_array($tag->term_id, $form['tags'])) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('number_of_article'); ?>"><?php _e('Number of article:', kopa_get_domain()); ?></label>                
            <input class="widefat" type="number" min="2" id="<?php echo $this->get_field_id('number_of_article'); ?>" name="<?php echo $this->get_field_name('number_of_article'); ?>" value="<?php echo esc_attr( $form['number_of_article'] ); ?>">
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Orderby:', kopa_get_domain()); ?></label>                
            <select class="widefat" id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>" autocomplete="off">
                <?php
                $orderby = array(
                    'lastest' => __('Lastest', kopa_get_domain()),
                    'popular' => __('Popular by View Count', kopa_get_domain()),
                    'most_comment' => __('Popular by Comment Count', kopa_get_domain()),
                    'random' => __('Random', kopa_get_domain()),
                );
                foreach ($orderby as $value => $title) {
                    printf('<option value="%1$s" %3$s>%2$s</option>', $value, $title, ($value === $form['orderby']) ? 'selected="selected"' : '');
                }
                ?>
            </select>
        </p>
        
        <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['categories'] = (empty($new_instance['categories'])) ? array() : array_filter($new_instance['categories']);
        $instance['relation'] = $new_instance['relation'];
        $instance['tags'] = (empty($new_instance['tags'])) ? array() : array_filter($new_instance['tags']);
        $instance['number_of_article'] = $new_instance['number_of_article'];
        $instance['orderby'] = $new_instance['orderby'];
        

        return $instance;
    }
}

/**
 * Twitter Widget Class
 * @since News Mix 1.0
 */

/**
 * Entry Tabs List Widget Class
 * @since News Mix 1.0
 */

/**
 * Toggle Categories Widget Class
 * @since News Mix 1.0
 */

/**
 * Audio Post Format Widget Class
 * @since News Mix 1.0
 */

/**
 * Advertising Widget Class
 * @since News Mix 1.0
 */

/**
 * Subscribe Widget Class
 * @since News Mix 1.0
 */

/**
 * Kopa Posts Rating Widget Class
 * @since News Mix 1.0
 */


/**
 * Kopa Videos Widget Class
 * @since News Mix 1.0
 */

/**
 * Kopa Videos Widget Class
 * @since News Mix 1.0
 */

/**
 * Kopa Divider Widget Class
 * @since News Mix 1.0.2
 */

