<?php
/**
 * Contains all the functions related to sidebar and widget.
 *
 * @package Retina Theme
 * @subpackage Madar Lite
 * @since Madar Lite
 */

add_action( 'widgets_init', 'madarlite_widgets_init');
/**
 * Function to register the widget areas(sidebar) and widgets.
 */
function madarlite_widgets_init() {

   /**
    * Registering widget areas for front page
    */
	register_sidebar(array(
	    'name'=>__('Sidebar','madar-lite'),
		'id' => 'sidebar',
		'before_widget' => '<div class="widget-area widget-sidebar">',
		'after_widget' => '</div>',
		'before_title' => '<div class="widget-header"><h3>',
		'after_title' => '</h3></div>',
	));
	//Footer widget areas
	register_sidebar( array(
			'name'          => __( 'Footer Position 1', 'madar-lite' ) ,
			'id'            => 'footer-1',
			'description'   => __( 'Put widget Here! ', 'madar-lite' ),
			'before_widget' => '<div class="footer-widget-area widget-footer">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-widget-header"><h4>',
			'after_title'   => '</h4></div>',
    ) );

    // Register Footer Position 2
    register_sidebar( array(
			'name'          => __( 'Footer Position 2', 'madar-lite' ) ,
			'id'            => 'footer-2',
			'description'   => __( 'Put widget Here! ', 'madar-lite' ),
			'before_widget' => '<div class="footer-widget-area widget-footer">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-widget-header"><h4>',
			'after_title'   => '</h4></div>',
    ) );

    // Register Footer Position 3
    register_sidebar( array(
			'name'          => __( 'Footer Position 3', 'madar-lite' ) ,
			'id'            => 'footer-3',
			'description'   => __( 'Put widget Here! ', 'madar-lite' ),
			'before_widget' => '<div class="footer-widget-area widget-footer">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-widget-header"><h4>',
			'after_title'   => '</h4></div>',
    ) );

    // Register Footer Position 4
    register_sidebar( array(
			'name'          => __( 'Footer Position 4', 'madar-lite' ) ,
			'id'            => 'footer-4',
			'description'   => __( 'Put widget Here! ', 'madar-lite' ),
			'before_widget' => '<div class="footer-widget-area widget-footer">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-widget-header"><h4>',
			'after_title'   => '</h4></div>',
    ) );
   // registering the Front Page: Content Top Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Top Section', 'madar-lite' ),
      'id'              => 'madarlite_front_page_content_top_section',
      'description'     => __( 'Content Top Section', 'madar-lite' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );


   // registering the Front Page: Content Bottom Section Sidebar
   register_sidebar( array(
      'name'            => __( 'Front Page: Content Bottom Section', 'madar-lite' ),
      'id'              => 'madarlite_front_page_content_bottom_section',
      'description'     => __( 'Content Middle Bottom Section', 'madar-lite' ),
      'before_widget'   => '<section id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</section>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );
   // Registering advertisement above footer sidebar
   register_sidebar( array(
      'name'            => __( 'Advertisement On The Front Page', 'madar-lite' ),
      'id'              => 'madarlite_advertisement_on_the_front_page',
      'description'     => __( 'Shows widgets On The Front Page, suitable for Madar Lite: 728x90 widget.', 'madar-lite' ),
      'before_widget'   => '<aside id="%1$s" class="widget %2$s clearfix">',
      'after_widget'    => '</aside>',
      'before_title'    => '<h3 class="widget-title"><span>',
      'after_title'     => '</span></h3>'
   ) );

   register_widget( "madarlite_block_posts_widget" );
   register_widget( "madarlite_list_posts_widget" );
   register_widget( "madarlite_728x90_advertisement_widget" );
   register_widget( "madarlite_300x250_advertisement_widget" );
   register_widget( "madarlite_125x125_advertisement_widget" );
   register_widget( 'madarlite_category_widgets' );
   register_widget( 'madarlite_random_post_widgets' );
   register_widget( 'madarlite_recent_comment_widgets' );
   register_widget( 'madarlite_recent_post_widget' );
}

/**
 * list block Posts widget
 */
 
 class madarlite_block_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_meta', 'description' =>__( 'Display latest posts or posts of specific category.' , 'madar-lite') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Madar Lite: Featured Block Posts', 'madar-lite' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'madar-lite' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/images/li.png'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','madar-lite' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'madar-lite' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'madar-lite' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'madar-lite' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true 
         ) );
		 $count = 0;
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
		 $count = 0;
      }
      echo $before_widget;
      ?>
		<section class="cat-box list-box madar-cat-<?php echo $category ?>">
		 <div class="cat-box-content">
      <?php
		
         if ( !empty( $title ) ) { echo '<div class="home-box-header"><h2>'. esc_html( $title ) .'</h2><div class="clearfix"></div></div>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>

         <?php if($get_featured_posts->have_posts()): ?>
				<ul>
				<?php while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); $count++ ;?>
				<?php if($count == 1) : ?>

                   <li class="first-news">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'madar-box' ); ?>
								</a>

							</div><!-- post-thumbnail /-->
						<?php endif; ?>
					
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
						  <p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						  </p>						
												
							<div class="entry">
								<p><?php the_excerpt() ?></p>
								<a class="more-link" href="<?php the_permalink() ?>"><?php __('Read More &raquo;', 'madar-lite' ); ?></a>
							</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li class="other-news">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'madar-thumbnail-mchild' ); ?></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						  <p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						  </p>						
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clearfix"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- List Box -->
      <?php echo $after_widget;
      }
}

/**
 * block Posts widget
 */
 
 
 class madarlite_list_posts_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_featured_posts widget_featured_meta', 'description' =>__( 'Display latest posts or posts of specific category.' , 'madar-lite') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Madar Lite: Featured List Post', 'madar-lite' ),$widget_ops);
   }

   function form( $instance ) {
      $tg_defaults['title'] = '';
      $tg_defaults['text'] = '';
      $tg_defaults['number'] = 4;
      $tg_defaults['type'] = 'latest';
      $tg_defaults['category'] = '';
      $instance = wp_parse_args( (array) $instance, $tg_defaults );
      $title = esc_attr( $instance[ 'title' ] );
      $text = esc_textarea($instance['text']);
      $number = $instance['number'];
      $type = $instance['type'];
      $category = $instance['category'];
      ?>
      <p><?php _e( 'Layout will be as below:', 'madar-lite' ) ?></p>
      <div style="text-align: center;"><img src="<?php echo get_template_directory_uri() . '/images/1c.png'?>"></div>
      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <?php _e( 'Description','madar-lite' ); ?>
      <textarea class="widefat" rows="5" cols="20" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo $text; ?></textarea>
      <p>
         <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e( 'Number of posts to display:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" />
      </p>

      <p><input type="radio" <?php checked($type, 'latest') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="latest"/><?php _e( 'Show latest Posts', 'madar-lite' );?><br />
       <input type="radio" <?php checked($type,'category') ?> id="<?php echo $this->get_field_id( 'type' ); ?>" name="<?php echo $this->get_field_name( 'type' ); ?>" value="category"/><?php _e( 'Show posts from a category', 'madar-lite' );?><br /></p>

      <p>
         <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Select category', 'madar-lite' ); ?>:</label>
         <?php wp_dropdown_categories( array( 'show_option_none' =>' ','name' => $this->get_field_name( 'category' ), 'selected' => $category ) ); ?>
      </p>
      <?php
   }

   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      if ( current_user_can('unfiltered_html') )
         $instance['text'] =  $new_instance['text'];
      else
         $instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) );
      $instance[ 'number' ] = absint( $new_instance[ 'number' ] );
      $instance[ 'type' ] = $new_instance[ 'type' ];
      $instance[ 'category' ] = $new_instance[ 'category' ];

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      global $post;
      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $text = isset( $instance[ 'text' ] ) ? $instance[ 'text' ] : '';
      $number = empty( $instance[ 'number' ] ) ? 4 : $instance[ 'number' ];
      $type = isset( $instance[ 'type' ] ) ? $instance[ 'type' ] : 'latest' ;
      $category = isset( $instance[ 'category' ] ) ? $instance[ 'category' ] : '';

      if( $type == 'latest' ) {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'ignore_sticky_posts'   => true
         ) );
		 $count = 0;
      }
      else {
         $get_featured_posts = new WP_Query( array(
            'posts_per_page'        => $number,
            'post_type'             => 'post',
            'category__in'          => $category
         ) );
		 $count = 0;
      }
      echo $before_widget;
      ?>
		<section class="cat-box wide-box madar-cat-<?php echo $category ?>">
		 <div class="cat-box-content">

      <?php
		
         if ( !empty( $title ) ) { echo '<div class="home-box-header"><h2>'. esc_html( $title ) .'</h2><div class="clearfix"></div></div>'; }
         if( !empty( $text ) ) { ?> <p> <?php echo esc_textarea( $text ); ?> </p> <?php } ?>
         <?php if($get_featured_posts->have_posts()): ?>
				<ul>
				<?php while ( $get_featured_posts->have_posts() ) : $get_featured_posts->the_post(); $count ++ ;?>
				<?php if($count == 1) :
				?>

               <li class="first-news">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark">
									<?php the_post_thumbnail( 'madar-box' ); ?>
								</a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>
				
						<h2 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
							  <p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						  </p>						
												
							<div class="entry">
								<p><?php the_excerpt() ?></p>
								<a class="more-link" href="<?php the_permalink() ?>"><?php __('Read More &raquo;', 'madar-lite' ); ?></a>
							</div>
					</li><!-- .first-news -->
					<?php else: ?>
					<li class="other-news">
						<?php if ( function_exists("has_post_thumbnail") && has_post_thumbnail() ) : ?>			
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'madar-thumbnail-mchild' ); ?></a>
							</div><!-- post-thumbnail /-->
						<?php endif; ?>			
						<h3 class="post-box-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						  <p class="post-meta">
							<i class="fa fa-clock-o"></i><?php the_time('F j, Y'); ?>
							<?php echo madarlite_getcomment_count(get_the_ID()); ?>
						  </p>						
					</li>
					<?php endif; ?>
				<?php endwhile;?>
				</ul>
				<div class="clearfix"></div>

					<?php endif; ?>
			</div><!-- .cat-box-content /-->
		</section><!-- List Box -->
      <?php echo $after_widget;
      }
}
/**
 * 728x90 Advertisement Ads
 */
class madarlite_728x90_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_728x90_advertisement', 'description' => __( 'Add your 728x90 Advertisement here', 'madar-lite') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Madar Lite: 728x90 Advertisement', 'madar-lite' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '728x90_image_url' => '', '728x90_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 728x90 Images Here', 'madar-lite' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'madar-lite' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'madar-lite' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'madar-lite' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';


      $image_link = '728x90_image_link';
      $image_url = '728x90_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      echo $before_widget; ?>

      <div class="advertisement_728x90">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_728x90" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="728" height="90">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="728" height="90">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}
/**
 * 300x250 Advertisement Ads
 */
class madarlite_300x250_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_300x250_advertisement', 'description' => __( 'Add your 300x250 Advertisement here', 'madar-lite') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Madar Lite: 300x250 Advertisement', 'madar-lite' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '300x250_image_url' => '', '300x250_image_link' => '') );
      $title = esc_attr( $instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
      $instance[ $image_url ] = esc_url( $instance[ $image_url ] );

      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 300x250 Images Here', 'madar-lite' ); ?></label>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'madar-lite' ); ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'madar-lite' ); ?></label>

         <?php
         if ( $instance[ $image_url ] != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[ $image_url ] . 'preview') . '"src="' . $instance[ $image_url ] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'madar-lite' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
      $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';

      $image_link = '300x250_image_link';
      $image_url = '300x250_image_url';

      $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
      $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';

      echo $before_widget; ?>

      <div class="advertisement_300x250">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_url ) ) {
               $output .= '<div class="advertisement-content">';
               if ( !empty( $image_link ) ) {
               $output .= '<a href="'.$image_link.'" class="single_ad_300x250" target="_blank" rel="nofollow">
                                    <img src="'.$image_url.'" width="300" height="250">
                           </a>';
               } else {
                  $output .= '<img src="'.$image_url.'" width="300" height="250">';
               }
               $output .= '</div>';
               echo $output;
            } ?>
      </div>
      <?php
      echo $after_widget;
   }
}
/**
 * 125x125 Advertisement Ads
 */
class madarlite_125x125_advertisement_widget extends WP_Widget {

   function __construct() {
      $widget_ops = array( 'classname' => 'widget_125x125_advertisement', 'description' => __( 'Add your 125x125 Advertisement here', 'madar-lite') );
      $control_ops = array( 'width' => 200, 'height' =>250 );
      parent::__construct( false,$name= __( 'Madar Lite: 125x125 Advertisement', 'madar-lite' ),$widget_ops);
   }

   function form( $instance ) {
      $instance = wp_parse_args( (array) $instance, array( 'title' => '', '125x125_image_url_1' => '', '125x125_image_url_2' => '', '125x125_image_url_3' => '', '125x125_image_url_4' => '', '125x125_image_url_5' => '', '125x125_image_url_6' => '', '125x125_image_link_1' => '', '125x125_image_link_2' => '', '125x125_image_link_3' => '', '125x125_image_link_4' => '', '125x125_image_link_5' => '', '125x125_image_link_6' => '') );
      $title = esc_attr( $instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url( $instance[ $image_link ] );
         $instance[ $image_url ] = esc_url( $instance[ $image_url ] );
      }
      ?>

      <p>
         <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', 'madar-lite' ); ?></label>
         <input id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <label><?php _e( 'Add your Advertisement 125x125 Images Here', 'madar-lite' ); ?></label>
      <?php
      for ( $i = 1; $i < 7 ; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;
      ?>
      <p>
         <label for="<?php echo $this->get_field_id( $image_link ); ?>"> <?php _e( 'Advertisement Image Link ', 'madar-lite' ); echo $i; ?></label>
         <input type="text" class="widefat" id="<?php echo $this->get_field_id( $image_link ); ?>" name="<?php echo $this->get_field_name( $image_link ); ?>" value="<?php echo $instance[$image_link]; ?>"/>
      </p>
      <p>
         <label for="<?php echo $this->get_field_id( $image_url ); ?>"> <?php _e( 'Advertisement Image ', 'madar-lite' ); echo $i; ?></label>

         <?php
         if ( $instance[$image_url]  != '' ) :
            echo '<img id="' . $this->get_field_id( $instance[$image_url] . 'preview') . '"src="' . $instance[$image_url] . '"style="max-width:250px;" /><br />';
         endif;
         ?>

         <input type="text" class="widefat custom_media_url" id="<?php echo $this->get_field_id( $image_url ); ?>" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php echo $instance[$image_url]; ?>" style="margin-top:5px;"/>

         <input type="button" class="button button-primary custom_media_button" id="custom_media_button" name="<?php echo $this->get_field_name( $image_url ); ?>" value="<?php _e( 'Upload Image', 'madar-lite' ); ?>" style="margin-top:5px; margin-right: 30px;" onclick="imageWidget.uploader( '<?php echo $this->get_field_id( $image_url ); ?>' ); return false;"/>
      </p>
      <?php } ?>

   <?php }
   function update( $new_instance, $old_instance ) {
      $instance = $old_instance;
      $instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $instance[ $image_link ] = esc_url_raw( $new_instance[ $image_link ] );
         $instance[ $image_url ] = esc_url_raw( $new_instance[ $image_url ] );
      }

      return $instance;
   }

   function widget( $args, $instance ) {
      extract( $args );
      extract( $instance );

      $title = isset( $instance[ 'title' ] ) ? $instance[ 'title' ] : '';
      $image_array = array();
      $link_array = array();

      for ( $i = 1; $i < 7; $i++ ) {
         $image_link = '125x125_image_link_'.$i;
         $image_url = '125x125_image_url_'.$i;

         $image_link = isset( $instance[ $image_link ] ) ? $instance[ $image_link ] : '';
         $image_url = isset( $instance[ $image_url ] ) ? $instance[ $image_url ] : '';
         if( !empty( $image_link ) ) array_push( $link_array, $image_link );
         if( !empty( $image_url ) ) array_push( $image_array, $image_url );
      }
      echo $before_widget; ?>

      <div class="advertisement_125x125">
         <?php if ( !empty( $title ) ) { ?>
            <div class="advertisement-title">
               <?php echo $before_title. esc_html( $title ) . $after_title; ?>
            </div>
         <?php }
            $output = '';
            if ( !empty( $image_array ) ) {
            $output .= '<div class="advertisement-content">';
            for ( $i = 1; $i < 7; $i++ ) {
               $j = $i - 1;
               if( !empty( $image_array[$j] ) ) {
                  if ( !empty( $link_array[$j] ) ) {
                     $output .= '<a href="'.$link_array[$j].'" class="single_ad_125x125" target="_blank" rel="nofollow">
                                 <img src="'.$image_array[$j].'" width="125" height="125">
                              </a>';
                  } else {
                     $output .= '<img src="'.$image_array[$j].'" width="125" height="125">';
                  }
               }
            }
            $output .= '</div>';
            echo $output;
         } ?>
      </div>
      <?php
      echo $after_widget;
   }
}

/****************************************************************************************/
?>