<?php
/**
 * Matata functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Matata
 */

if ( ! function_exists( 'matata_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function matata_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Matata, use a find and replace
	 * to change 'matata' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'matata', get_template_directory() . '/languages' );

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

	// Cropping the images to different sizes to be used in the theme
	add_image_size( 'matata-featured', 702, 390, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'matata' ),
		'secondary' => esc_html__( 'Secondary', 'matata' )
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

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'matata_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	add_theme_support( 'custom-logo');
}
endif;
add_action( 'after_setup_theme', 'matata_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function matata_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'matata_content_width', 640 );
}
add_action( 'after_setup_theme', 'matata_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function matata_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'matata' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar one
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar One', 'matata' ),
		'id' 					=> 'matata_footer_sidebar_one',
		'description'   	=> __( 'Shows widgets at footer sidebar one.', 'matata' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar two
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Two', 'matata' ),
		'id' 					=> 'matata_footer_sidebar_two',
		'description'   	=> __( 'Shows widgets at footer sidebar two.', 'matata' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	// Registering footer sidebar three
	register_sidebar( array(
		'name' 				=> __( 'Footer Sidebar Three', 'matata' ),
		'id' 					=> 'matata_footer_sidebar_three',
		'description'   	=> __( 'Shows widgets at footer sidebar three.', 'matata' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'matata_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function matata_scripts() {
	wp_enqueue_style( 'matata-style', get_stylesheet_uri() );

	wp_enqueue_style( 'matata_google_fonts', '//fonts.googleapis.com/css?family=Open+Sans' );

	wp_enqueue_style( 'matata-fontawesome', get_template_directory_uri().'/fontawesome/css/font-awesome.css', array(), '4.5.0' );

	wp_enqueue_script( 'matata-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'matata-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if (is_page_template( 'template-parts/homepage.php' ) && get_theme_mod('matata_home_slider', 0) == 1  && !is_paged()) {
		wp_register_script( 'matata-bxslider', get_template_directory_uri(). '/js/jquery.bxslider.min.js', array( 'jquery' ), '4.1.2', true );
		wp_enqueue_style( 'matata-slider-css', get_template_directory_uri(). '/layouts/jquery.bxslider.css');
		wp_enqueue_script( 'matata-slider', get_template_directory_uri(). '/js/matata-slider-setting.js', array( 'matata-bxslider' ), false, true );
   }
}
add_action( 'wp_enqueue_scripts', 'matata_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

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
