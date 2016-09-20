<?php
/**
 * Implements a custom header for Madar Lite.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package Retina Theme
 * @subpackage Madar Lite
 * @since Madar Lite 1.0
 */

/**
 * Setup the WordPress core custom header feature.
 */
function madarlite_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'madarlite_custom_header_args', array(
		'default-image'          => '',
		'header-text'				 => '',
		'default-text-color'     => '',
		'width'                  => 1200,
		'height'                 => 150,
		'flex-width'		     => true,
		'flex-height'            => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => 'madarlite_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'madarlite_custom_header_setup' );

if ( ! function_exists( 'madarlite_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 */
function madarlite_admin_header_image() {
?>
	<div id="headimg">
		<?php if ( get_header_image() ) : ?>
		<img src="<?php header_image(); ?>" alt="<?php bloginfo( 'name' ); ?>">
		<?php endif; ?>
	</div>
<?php
}
endif; // madarlite_admin_header_image