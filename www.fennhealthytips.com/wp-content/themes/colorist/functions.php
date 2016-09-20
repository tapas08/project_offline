<?php
/**
 * colorist functions and definitions
 *
 * @package colorist
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! function_exists( 'colorist_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function colorist_setup() {
	if ( ! isset( $content_width ) ) { 
	$content_width = 780; /* pixels */
}

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on colorist, use a find and replace
	 * to change 'colorist' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'colorist', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	add_editor_style( 'css/editor-style.css' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'colorist_recent-post-img', 380, 350, true);
	add_image_size( 'colorist_service-img', 100, 100, true);
	add_image_size( 'colorist-blog-full-width', 1200,350, true );
	add_image_size( 'colorist-small-featured-image-width', 450,350, true );
	add_image_size( 'colorist-large-width', 800,350, true );
 
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'colorist' ),
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

	add_theme_support( 'custom-background' );

    add_theme_support( 'custom-logo' );
   	
}
endif; // colorist_setup
add_action( 'after_setup_theme', 'colorist_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function colorist_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'colorist' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	register_sidebar( array(
		'name'          => __( 'Sidebar Left', 'colorist' ),
		'id'            => 'sidebar-left',
		'description'   => __( 'Left Sidebar', 'colorist' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Top Left', 'colorist' ),
		'id'            => 'top-left',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Top Right', 'colorist' ),
		'id'            => 'top-right',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebars( 4, array(
		'name'          => __( 'Footer %d', 'colorist' ),
		'id'            => 'footer',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Nav', 'colorist' ),
		'id'            => 'footer-nav',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'colorist_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/includes/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/includes/template-tags.php';
/**
 * Free Theme upgrade page 
 */
require get_template_directory() . '/includes/theme_upgrade.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/includes/extras.php';
/**
 * Implement the Custom Header feature.
 */
require  get_template_directory()  . '/includes/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/includes/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/includes/jetpack.php';

/**
 * Load Theme Options Panel
 */
require get_template_directory() . '/admin/theme-options.php';
/**
 * Inline style ( Theme Options )
 */
require get_template_directory() . '/includes/styles.php';

/**
 * hooks-filter
 */
require get_template_directory() . '/includes/hooks-filters.php';

/* Woocommerce support */

add_theme_support('woocommerce');

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper');
add_action('woocommerce_before_main_content', 'colorist_output_content_wrapper');


function colorist_output_content_wrapper() {
	$woocommerce_sidebar = get_theme_mod('woocommerce_sidebar',true ) ;
	if( $woocommerce_sidebar ) {
        $woocommerce_sidebar_column = 'eleven';
    }else {
        $woocommerce_sidebar_column = 'sixteen';
        remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar');
    }
	echo '<div class="site-content container" id="content"><div id="primary" class="content-area '. $woocommerce_sidebar_column .' columns">';	
}

remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end' );
add_action( 'woocommerce_after_main_content', 'colorist_output_content_wrapper_end' );

function colorist_output_content_wrapper_end () {
	echo "</div>";
}

add_action( 'init', 'colorist_remove_wc_breadcrumbs' );  
function colorist_remove_wc_breadcrumbs() {
   	remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

/* Tempalte redirect */

add_action('after_setup_theme', 'colorist_rename_template');   

if( !function_exists('colorist_rename_template') ) {
	function colorist_rename_template() {
	   $args = array(
	        'post_type' => 'page',
	        'posts_per_page' => -1
	    );

	$template_query =  new WP_Query($args);

	if( $template_query->have_posts() ) {
	   	while ( $template_query->have_posts() ) :
	   	     $template_query->the_post(); 
	   	     $old_template_name = get_post_meta( get_the_ID(), '_wp_page_template', true );
	   	    // echo $old_template_name .'</br>';
	   	     switch ( $old_template_name ) {
	       	    	case 'page-full-width.php':
	       	    		$new_template_name = 'template-full-width.php';
	       	    		break;
	   	    		case 'page-leftsidebar.php':
	   	    		   $new_template_name = 'template-leftsidebar.php';
	   	    		   break;
	   	    		case 'page-rightsidebar.php':
	   	    		    $new_template_name = 'template-rightsidebar.php';
	   	    		    break;  
	   	    		default:
	   	    		    $new_template_name = $old_template_name;
			}
			if( $old_template_name != $new_template_name) {	
			   update_post_meta( get_the_ID(), '_wp_page_template' ,$new_template_name ,$old_template_name );
			}
	     endwhile; // end of the loop. 
	}
	$template_query = null;
	wp_reset_postdata();
		
	}
}