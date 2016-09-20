<?php
/**
 * Myth functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Myth
 */

if ( ! function_exists( 'myth_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function myth_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Myth, use a find and replace
	 * to change 'myth' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'myth', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 720, 9999, false );
	add_image_size( 'myth-navigation', 720, 160, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'	=> esc_html__( 'Primary Menu', 'myth' ),
		'social'	=> esc_html__( 'Social Links Menu', 'myth' ),
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
		'quote',
		'link',
		'aside',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'myth_custom_background_args', array(
		'default-color'			=> '666666',
		//'default-image' 		=> get_stylesheet_directory_uri() . '/images/default-background3.jpg',
		'default-repeat'		=> 'no-repeat',
		'default-position-x' 	=> 'center',
		'default-attachment'	=> 'scroll',
	) ) );
}
endif; // myth_setup
add_action( 'after_setup_theme', 'myth_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function myth_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'myth_content_width', 800 );
}
add_action( 'after_setup_theme', 'myth_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function myth_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Left', 'myth' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Right', 'myth' ),
		'id'            => 'sidebar-2',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'myth_widgets_init' );

if ( ! function_exists( 'myth_fonts_url' ) ) :
/**
 * Register Google fonts for Myth.
 *
 * @since Myth 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function myth_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Fjalla One font: on or off', 'myth' ) ) {
		$fonts[] = 'Fjalla One';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Noto Serif, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'myth' ) ) {
		$fonts[] = 'Open Sans:400,700,400italic,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/**
 * Enqueue scripts and styles.
 */
function myth_scripts() {
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'myth-fonts', myth_fonts_url(), array(), null );

	// Add Genericons, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/genericons/genericons.css', array(), '3.4.1' );

	// Load the theme main stylesheet.
	wp_enqueue_style( 'myth-style', get_stylesheet_uri() );

	// Load the theme custom script file.
	wp_enqueue_script( 'myth-script', get_stylesheet_directory_uri() . '/js/myth.js', array( 'jquery' ), '20151029', true );

	// Loead the skip-link-focus script file.
	wp_enqueue_script( 'myth-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'myth_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customized widgets for this theme.
 */
require get_template_directory() . '/inc/custom-widgets.php';

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
