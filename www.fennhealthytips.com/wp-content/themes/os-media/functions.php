<?php 
/**
 * OS media functions and definitions
 *
 * @package os_media
 * @since OS media 0.1
 *
 */

require_once(dirname(__FILE__).'/classes/class-tgm-plugin-activation.php');

// add script and stylesheet from parent theme
add_action( 'wp_enqueue_scripts', 'os_media_enqueue_from_parent_theme' );
function os_media_enqueue_from_parent_theme() {
	wp_enqueue_script( 'parent-script', get_template_directory_uri().'/js/html5.js' );
	wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

// Enable support for custom logo.
add_action( 'after_setup_theme', 'os_media_setup' );
function os_media_setup() {

	add_theme_support( 'custom-logo', array(
			'height'      => 240,
			'width'       => 240,
			'flex-height' => true,
		) 
	);

	add_theme_support( 'title-tag' );

}

//////////////////////////////// tgm-plugin-activation ////////////////////////////////////////////////
add_action( 'tgmpa_register', 'os_media_register_required_plugins' );
function os_media_register_required_plugins() {

	// Array of plugin arrays. Required keys are name and slug. If the source is NOT from the .org repo, then source is also required.
	$plugins = array(

		// include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'OS media - HTML5 Featured Video plugin',
			'slug'      => 'os-media',
			'required'  => false,
		),
		array(
			'name'      => 'Fourteen Colors',
			'slug'      => 'fourteen-colors',
			'required'  => false,
		)
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

?>