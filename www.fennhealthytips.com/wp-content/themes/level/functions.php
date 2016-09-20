<?php
	include_once 'inc/installs.php';
	include_once('inc/core/core.php');

/**
 * Level functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Level
 */

if ( ! function_exists( 'level_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function level_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Level, use a find and replace
	 * to change 'level' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'level', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	//WooCommerce Support
	add_theme_support( 'woocommerce' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 296, 210, true );
	add_theme_support( 'custom-logo', array(
   'height'      => 47,
   'width'       => 219,
   'header-text' => array( 'site-title', 'site-description' ),
   'flex-width' => true,
) );
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'level' ),
		'mobile' => esc_html__( 'Mobile Menu', 'level' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'link',
	) );
      /*
	 * This theme styles the visual editor to resemble the theme style,
	 * specifically font, colors, icons, and column width.
	 */
	add_editor_style( array( 'css/editor-style.css') );
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'level_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // level_setup
add_action( 'after_setup_theme', 'level_setup' );
 function level_search_form( $form ) {
	$form = '<div class="input-group"><form role="search" method="get" id="searchform" class="searchform" action="' .esc_url(home_url( '/' )). '" >
	<div><label class="screen-reader-text" for="s">' . __( 'Search for:','level' ) . '</label>
	<input type="text" class="input-group-field" placeholder="'. __( 'Search..','level' ) .'" value="' . get_search_query() . '" name="s" id="s" />
	<input class="input-group-button button" type="submit" id="searchsubmit" value="'. esc_attr__( 'Go','level' ) .'" />
	</div>
	</div>
	</form>';

	return $form;
}

add_filter( 'get_search_form', 'level_search_form' );

//jetpack related posts
function level_more_related_posts( $options ) {
    $options['size'] = 6;
    return $options;
}
add_filter( 'jetpack_relatedposts_filter_options', 'level_more_related_posts' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function level_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'level_content_width', 640 );
}
add_action( 'after_setup_theme', 'level_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function level_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'level' ),
		'id'            => 'sidebar-1',
		'description'   => __('Sidebar widget for all pages included Post, Pages','level'),
		'before_widget' => '<aside id="sidebarid %1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Post Widget', 'level' ),
		'id'            => 'post-widget-1',
		'description'   => __('This will aside post content and show widgets ','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Below Top Navigation', 'level' ),
		'id'            => 'below-navi',
		'description'   => __('This widget show just above content and below main navigation','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Post and Pages footer', 'level' ),
		'id'            => 'content-end',
		'description'   => __('After post content and above comment','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );	
register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'level' ),
		'id'            => 'footer-1',
		'description'   => __('Footer widget area first from left','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'level' ),
		'id'            => 'footer-2',
		'description'   => __('Footer widget area Second from left','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'level' ),
		'id'            => 'footer-3',
		'description'   => __('Footer widget area Third from left','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'level' ),
		'id'            => 'footer-4',
		'description'   => __('Footer widget area fourth from left','level'),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'level_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function level_scripts() {
	wp_enqueue_style( 'level-style', get_stylesheet_uri() );
	wp_enqueue_script( 'level-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'level-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
     wp_enqueue_script( 'foundation-offcanvas', get_template_directory_uri() . '/foundation/js/foundation.offcanvas.js', false, null, true);
   wp_enqueue_script( 'foundation-core', get_template_directory_uri() . '/foundation/js/foundation.core.js', false, null, true);
   wp_enqueue_style('level-body-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('level_body_font', 'Helvetica Neue') ).':100,300,400,700' );
   wp_enqueue_style('level-title-font', '//fonts.googleapis.com/css?family='.str_replace(" ", "+", get_theme_mod('level_title_font', 'Open Sans') ).':100,300,400,700' );
    wp_enqueue_script( 'foundation', get_template_directory_uri() . '/foundation/js/foundation.js', false, null, true);
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/foundation/css/foundation.min.css' );
	wp_enqueue_style( 'level-customcss', get_template_directory_uri() . '/css/custom.css' );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'level_scripts' );

function level_custom_customize_enqueue() {
	wp_enqueue_style( 'level-customizer-css', get_template_directory_uri() . '/css/customizer-css.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'level_custom_customize_enqueue' );


function level_footerscript() {
    wp_enqueue_script(
        'level-loadscripts',
        get_template_directory_uri() . '/js/loadscripts.js',
        array('jquery'),
        '1.0',
        true
    );
}
add_action('wp_enqueue_scripts', 'level_footerscript',10);


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
 * Custom function and codes
 */
require get_template_directory() . '/inc/custom-function.php';
/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';
/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';