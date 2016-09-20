<?php
/**
 * coral-dark functions and definitions
 *
 * @package coral-dark
 */

/* Launch the Hybrid Core framework. 
require_once( trailingslashit( get_template_directory() ) . 'hybrid-core/hybrid.php' );
new Hybrid(); */
 
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}

if ( ! function_exists( 'coral_dark_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function coral_dark_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on coral-dark, use a find and replace
	 * to change 'coral-dark' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'coral-dark', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );
	/*
	 * This theme styles the visual editor to resemble the theme style
	 */	
	add_editor_style( 'css/editor-style.css' );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	/*
	 * Enable support for custom logo.
	 */
	add_theme_support( 'custom-logo', array( 'flex-height' => true, 'flex-width' => true, ) );
	
	set_post_thumbnail_size( 210, 210 );
	add_image_size( 'coral-dark-medium-large-2x', 1536 );
	add_image_size( 'coral-dark-large-2x', 1960 );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'coral-dark' ),
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'coral_dark_custom_background_args', array(
		'default-color' => '000000',
		'default-image' => '',
	) ) );
	
	// Woocommerce 
    add_theme_support( 'woocommerce' );

}
endif; // coral_dark_setup
add_action( 'after_setup_theme', 'coral_dark_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function coral_dark_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'coral-dark' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer', 'coral-dark' ),
		'id'            => 'footer-copyright',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'coral_dark_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function coral_dark_scripts() {

	$logoheight = absint(get_theme_mod('coral_dark_logoheight_setting', '100'));
	$title_font = wp_kses(get_theme_mod('title_font_setting', 'Default font'), array(), array());
	$tagline_font = wp_kses(get_theme_mod('tagline_font_setting', 'Default font'), array(), array());
	$body_font = wp_kses(get_theme_mod('body_font_setting', 'Default font'), array(), array());
	$heading_font = wp_kses(get_theme_mod('heading_font_setting', 'Default font'), array(), array());
	
	$search_offset = intval(get_theme_mod('coral_dark_searchoffset_setting', '42'));
	$social_offset = intval(get_theme_mod('coral_dark_socialoffset_setting', '47'));
	$menu_offset = intval(get_theme_mod('coral_dark_menuoffset_setting', '15'));
	$title_offset = intval(get_theme_mod('coral_dark_titleoffset_setting', '25'));
	$tagline_offset = intval(get_theme_mod('coral_dark_taglineoffset_setting', '-5'));
	$title_fontsize = absint(get_theme_mod('coral_dark_titlesize_setting', '36'));	
	$tagline_fontsize = absint(get_theme_mod('coral_dark_taglinesize_setting', '14'));
	$title_color = '#' . get_theme_mod('title_color_setting', 'eeeeee');
	$title_color = ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $title_color )) ? $title_color : '#eeeeee';
	$tagline_color = '#' . get_theme_mod('tagline_color_setting', '999999');
	$tagline_color = ( preg_match('|^#([A-Fa-f0-9]{3}){1,2}$|', $tagline_color )) ? $tagline_color : '#999999';	
	$body_fontsize = absint(get_theme_mod('body_fontsize_setting', '14'));
	
	$slider_effect = wp_kses(get_theme_mod('slider_effect_setting','fade'), array(), array());
	$slider_animspeed = absint(get_theme_mod('slide_animspeed_setting','500'));	
	$slider_pausetime = absint(get_theme_mod('slide_pausetime_setting','5000'));
	$slider_array = array(
		'effect' => $slider_effect,
		'animspeed' => $slider_animspeed,
		'pausetime' => $slider_pausetime
	);	

	$css = "";
	if ("Default font" != $body_font && "0" != $body_font) {
		$css .= "body, button, input, select, textarea {	font-family: {$body_font};}
		";
	}
	if ("Default font" != $heading_font && "0" != $heading_font) {
		$css .= "h1, h2, h3, h4, h5, h6 { font-family: {$heading_font};}
		";
	}
	if ("Default font" != $title_font && "0" != $title_font) {
		$css .= "h1.site-title, h3.site-title { font-family: {$title_font};}
		";
	}
	if ("Default font" != $tagline_font && "0" != $tagline_font) {
		$css .= "h2.site-description, h4.site-description { font-family: {$tagline_font};}
		";
	}

	$css .= "
		body, button, input, select, textarea {	font-size: {$body_fontsize}px;}
		h1.site-title, h3.site-title {
			margin-top: {$title_offset}px; 
			font-size: {$title_fontsize}px; 
		}
		h1.site-title a,
		h1.site-title a:visited,
		h1.site-title a:hover,
		h1.site-title a:active,
		h1.site-title a:focus,
		h3.site-title a,
		h3.site-title a:visited,
		h3.site-title a:hover,
		h3.site-title a:active,
		h3.site-title a:focus {
			color: {$title_color} !important;
		}
		
		h2.site-description, h4.site-description {
			margin-top: {$tagline_offset}px;
			font-size: {$tagline_fontsize}px;
			color: {$tagline_color};
		}
		.custom-logo {max-height: {$logoheight}px;}
		@media screen and (min-width: 768px) {
			.main-navigation {margin-top: {$menu_offset}px;}
			#search1 {margin-top: {$search_offset}px;}
			#social1 {margin-top: {$social_offset}px;}
		}
	";

	wp_enqueue_style( 'coral-dark-style', get_stylesheet_uri() );
	wp_add_inline_style( 'coral-dark-style', $css );

	wp_enqueue_script( 'smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.min.js', array('jquery'), '0.9.7', true );
	
	wp_enqueue_script( 'nivo-slider', get_template_directory_uri() . '/js/jquery.nivo.slider.pack.js', array('jquery'), '3.2' );

	wp_enqueue_script( 'coral-dark-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	
	wp_enqueue_script( 'coral-dark-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20160427', true );

	wp_localize_script( 'coral-dark-script', 'nivoSliderParams', $slider_array );	
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'coral_dark_scripts' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Create the required classes for the logo
 */
function coral_dark_logo_class() {
	$logowidth = absint(get_theme_mod('coral_dark_logowidth_setting', '35'));
	$class=" grid-". $logowidth ." tablet-grid-". $logowidth ." mobile-grid-100";
	echo $class;
}	
function coral_dark_social_class() {
	$searchwidth = absint(get_theme_mod('coral_dark_searchwidth_setting', '40'));
	$showsearch = absint(get_theme_mod('coral_dark_showsearch_setting', '1'));
	if ( '0' == $showsearch ) $searchwidth = 0;
	$socialwidth= 100 - $searchwidth;
	if ( 0 == $socialwidth ) {
		$class=" hide-on-desktop hide-on-tablet hide-on-mobile";
	} else {
		if (34 == $socialwidth || 67 == $socialwidth) $socialwidth = $socialwidth -1;
		$class=" grid-". $socialwidth ." tablet-grid-". $socialwidth ." mobile-grid-100";
	}
	echo $class;
}	
function coral_dark_search_class() {
	$searchwidth = absint(get_theme_mod('coral_dark_searchwidth_setting', '40'));
	$showsearch = absint(get_theme_mod('coral_dark_showsearch_setting', '1'));
	if ( '0' == $showsearch ) $searchwidth = 0;
	if ( 0 == $searchwidth ) {
		$class=" hide-on-desktop hide-on-tablet hide-on-mobile";
	} else {	
		$class=" grid-". $searchwidth ." tablet-grid-". $searchwidth ." mobile-grid-100";
	}
	echo $class;
}	
/**
 * Create the required classes for the header widget area
 */
function coral_dark_header_right_class() {
	$logowidth = absint(get_theme_mod('coral_dark_logowidth_setting', '35'));
	$areawidth = 100 - $logowidth;
	if ( 0 != $areawidth) {
		if (34 == $areawidth || 67 == $areawidth) $areawidth = $areawidth -1;
		$class=" grid-". $areawidth ." tablet-grid-". $areawidth ." mobile-grid-100";
	} else {
		$class=" hide-on-desktop hide-on-tablet hide-on-mobile";
	}
	echo $class;
}	

/**
 * Create the required classes for the site columns
 */
function coral_dark_column_class($column) {

		$sidebarwidth = absint(get_theme_mod('coral_dark_sidebarwidth_setting', '30'));
		$contentwidth = 100 - $sidebarwidth;
		if (34 == $contentwidth || 67 == $contentwidth) $contentwidth = $contentwidth -1;
		switch ($column) {
			case "content":
				$class=" grid-". $contentwidth ." tablet-grid-". $contentwidth ." mobile-grid-100 push-". $sidebarwidth ." tablet-push-". $sidebarwidth;
				break;
			case "sidebar1":
				$class=" grid-". $sidebarwidth ." tablet-grid-". $sidebarwidth ." mobile-grid-100 pull-". $contentwidth ." tablet-pull-". $contentwidth;
				break;
		}	
		echo $class;
}

/**
 * Create the required classes for the footer copyright widget
 */
function coral_dark_copyright_class() {
	$class=" grid-70 tablet-grid-70 mobile-grid-100";
	echo $class;
}	
/**
 * Create the required classes for the footer link
 */
function coral_dark_footer_link_class() {
	$class=" grid-30 tablet-grid-30 mobile-grid-100";
	echo $class;
}	


// Nivoslider
if ( ! function_exists( "coral_dark_nivoslider" )) :
function coral_dark_nivoslider() {

  $front_page = ( '1' == get_theme_mod('front_page_setting','')) ? '1' : '';
  $allpages = ( '1' == get_theme_mod('allpages','')) ? '1' : '';
  $ids = get_theme_mod('post_id_setting','-999999');
  $arrids = explode(',', $ids);
  foreach($arrids as $key => $val) {
    $arrids[$key] = intval($val);
  }

  if (($front_page && is_front_page()) || $allpages || is_single($arrids) || is_page($arrids)) {
  echo '<div id="myslideshow" class="myslideshow grid-container">
			<div class="slider-wrapper theme-default grid-100 tablet-grid-100 mobile-grid-100">
			<div id="slider" class="nivoSlider">';
			for ($i=1;$i<5;$i++) { 
				$slider_image = get_theme_mod('slider_image'.$i, '');
				$slide_page = absint(get_theme_mod('slide_title'.$i,'0'));
				if (0 != $slide_page) {
					$slide_title = get_the_title($slide_page);
				} else {
					$slide_title = '';
				}
				if ($slider_image) {
					if ($slide_title) { 
					echo '<img src="'. esc_url($slider_image) .'" alt="" title="#htmlcaption'.$i.'">';
					} else {
					echo '<img src="'. esc_url($slider_image) .'" alt="">';
					}
				}
			} 
		echo '</div>';
			for ($i=1;$i<5;$i++) { 
				$slider_image = get_theme_mod('slider_image'.$i, '');
				$slide_page = absint(get_theme_mod('slide_title'.$i,'0'));
				if (0 != $slide_page) {
					$slide_title = get_the_title($slide_page);
					$slide_link = get_permalink($slide_page);
				} else {
					$slide_title = '';
				}
				if ($slider_image && $slide_title) {
					echo '<div id="htmlcaption'.$i.'" class="nivo-html-caption">
							<a href="'.esc_url($slide_link).'">'.$slide_title.'</a>
						 </div>'; 
				}
			} 		
	echo '</div>
		</div>';
  }
}
add_action( 'coral_dark_slider', 'coral_dark_nivoslider' );
endif;

/* Change attachment page image size*/
if ( ! function_exists( "coral_dark_prepend_attachment" )) :
function coral_dark_prepend_attachment($p) {
return wp_get_attachment_link(0, 'large', false);
}
add_filter('prepend_attachment', 'coral_dark_prepend_attachment');
endif;


/* Fallback for wp_nav_menu */
function coral_dark_wp_page_menu_mine( $args = array() ) {
	$defaults = array('sort_column' => 'menu_order, post_title', 'menu_class' => 'menu', 'echo' => true, 'link_before' => '', 'link_after' => '');
	$args = wp_parse_args( $args, $defaults );

	/**
	 * Filter the arguments used to generate a page-based menu.
	 *
	 * @since 2.7.0
	 *
	 * @see wp_page_menu()
	 *
	 * @param array $args An array of page menu arguments.
	 */
	$args = apply_filters( 'wp_page_menu_args', $args );

	$menu = '';

	$list_args = $args;

	// Show Home in the menu
	if ( ! empty($args['show_home']) ) {
		if ( true === $args['show_home'] || '1' === $args['show_home'] || 1 === $args['show_home'] )
			$text = __('Home', 'coral-dark');
		else
			$text = $args['show_home'];
		$class = '';
		if ( is_front_page() && !is_paged() )
			$class = 'class="current_page_item"';
		$menu .= '<li ' . $class . '><a href="' . esc_url( home_url( '/' ) ) . '">' . $args['link_before'] . $text . $args['link_after'] . '</a></li>';
		// If the front page is a page, add it to the exclude list
		if (get_option('show_on_front') == 'page') {
			if ( !empty( $list_args['exclude'] ) ) {
				$list_args['exclude'] .= ',';
			} else {
				$list_args['exclude'] = '';
			}
			$list_args['exclude'] .= get_option('page_on_front');
		}
	}

	$list_args['echo'] = false;
	$list_args['title_li'] = '';
	$menu .= str_replace( array( "\r", "\n", "\t" ), '', wp_list_pages($list_args) );

	if ( $menu ) {
		$menu = '<ul id="main-menu" class="sm sm-clean collapsed">' . $menu . '</ul>';
	}
	$menu = '<div class="' . esc_attr($args['menu_class']) . '">' . $menu . "</div>\n";

	/**
	 * Filter the HTML output of a page-based menu.
	 *
	 * @since 2.7.0
	 *
	 * @see wp_page_menu()
	 *
	 * @param string $menu The HTML output.
	 * @param array  $args An array of arguments.
	 */
	$menu = apply_filters( 'wp_page_menu', $menu, $args );
	if ( $args['echo'] )
		echo $menu;
	else
		return $menu;
}
/* Woocommerce support */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'coral_dark_theme_wrapper_start', 10);
add_action('woocommerce_after_main_content', 'coral_dark_theme_wrapper_end', 10);

function coral_dark_theme_wrapper_start() {
  echo '<div id="primary" class="content-area egrid'; coral_dark_column_class('content'); echo '">
		<main id="main" class="site-main" role="main">';
}

function coral_dark_theme_wrapper_end() {
  echo '</main>	</div>';
}

// Woocommerce breadcrumbs removal
add_action( 'init', 'coral_dark_remove_wc_breadcrumbs' );
function coral_dark_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}
// Modification of max_srcset_image_width
if ( ! function_exists( "coral_dark_max_srcset_image_width" )) :
function coral_dark_max_srcset_image_width( $max_width, $size_array ) {
    $width = $size_array[0];
 
    if ( $width > 800 ) {
        $max_width = 1960;
    }
 
    return $max_width;
}
add_filter( 'max_srcset_image_width', 'coral_dark_max_srcset_image_width', 10, 2 );
endif;
/**
 * Add custom image sizes attribute to enhance responsive image functionality
 * for content images
 *
 *
 * @param string $sizes A source size value for use in a 'sizes' attribute.
 * @param array  $size  Image size. Accepts an array of width and height
 *                      values in pixels (in that order).
 * @return string A source size value for use in a content image 'sizes' attribute.
 */
function coral_dark_content_image_sizes_attr( $sizes, $size ) {
	$width = $size[0];

	if ( 980 > $width ) {
		$sizes = '(max-width: ' . $width . 'px) 100vw, ' . $width . 'px';
	} else {
		$sizes = '(max-width: 980px) 100vw, 980px';
	}

	return $sizes;
}
add_filter( 'wp_calculate_image_sizes', 'coral_dark_content_image_sizes_attr', 10 , 2 );

// make your custom sizes selectable from your WordPress admin
add_filter( 'image_size_names_choose', 'coral_dark_my_custom_sizes' );
 
function coral_dark_my_custom_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'medium_large' => __( 'Medium-Large', 'coral-dark' ),
    ) );
}