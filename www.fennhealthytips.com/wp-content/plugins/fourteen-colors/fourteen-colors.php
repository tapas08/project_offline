<?php
/**
 * Plugin Name: Fourteen Colors
 * Plugin URI: http://celloexpressions.com/plugins/fourteen-colors
 * Description: Customize the colors of the Twenty Fourteen Theme, directly within the Customizer.
 * Version: 1.4
 * Author: Nick Halsey
 * Author URI: http://celloexpressions.com/
 * Tags: Twenty Fourteen, Colors, Customizer, Custom Colors, Theme Colors
 * Text Domain: fourteen-colors
 * License: GPL

=====================================================================================
Copyright (C) 2016 Nick Halsey

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with WordPress; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
=====================================================================================
*/

// Only run if theme or parent theme is Twenty Fourteen.
if ( strtolower( get_template() ) != 'twentyfourteen' ) {
	return;
}

/**
 * Loads the plugin textdomain for translations.
 *
 * @since Fourteen Colors 0.6
 *
 * @return void
 */
function fourteen_colors_load_textdomain() {
	// This will load the WordPress-downloaded language pack if it exists, as languages are not bundled with the plugin.
	load_plugin_textdomain( 'fourteen-colors' );
}
add_action( 'plugins_loaded', 'fourteen_colors_load_textdomain' );

/**
 * Checks the plugin version and updates the cached CSS if necessary.
 *
 * Only runs on admin_init because these CSS updates tend to be less
 * important than running the version check on every front-end pageload.
 * Only updated on releases with color pattern changes.
 *
 * @since Fourteen Colors 1.0.1
 *
 * @return void
 */
function fourteen_colors_admin_init() {
	$fourteen_colors_version = '1.2';
	$db_version = get_option( 'fourteen_colors_version', false );

	if ( false === $db_version || $db_version != $fourteen_colors_version ) {
		// Build/re-build the Fourteen Colors CSS output.
		fourteen_colors_rebuild_color_patterns();

		// Update DB version.
		update_option( 'fourteen_colors_version', $fourteen_colors_version );
	}
}
add_action( 'admin_init', 'fourteen_colors_admin_init' );

/**
 * Add and modify the customizer settings and controls.
 *
 * @since Fourteen Colors 0.1
 *
 * @return void
 */
function fourteen_colors_customize_register( $wp_customize ) {
	// Add the custom accent color setting and control.
	$wp_customize->add_setting( 'accent_color', array(
		'default'           => '#24890d',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label'       => __( 'Accent Color', 'fourteen-colors' ),
		'description' => __( 'Includes links, text selection, the header search bar, and more; use vibrant colors for best results. Color variations may take a few seconds to update in the preview.', 'fourteen-colors' ),
		'section'     => 'colors',
		'priority'    => 1, // Need to push above Site Title & Background colors because running after theme's built-in options.
	) ) );

	// Add the custom contrast color setting and control.
	$wp_customize->add_setting( 'contrast_color', array(
		'default'           => '#000000',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'contrast_color', array(
		'label'       => __( 'Contrast Color', 'fourteen-colors' ),
		'description' => __( 'Header, sidebar, footer, and other details; use muted or grayscale colors for best results.', 'fouteen-colors' ),
		'section'     => 'colors',
		'priority'    => 3, // Need to push above Site Title & Background colors because running after theme's built-in options.
	) ) );

	// Partial refresh for better user experience (faster loading of changes). Available in WordPress 4.5+.
	// PostMessage will instantly update base colors, then selective refresh will update generated colors a few seconds later.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'fourteen_colors', array(
			'selector'        => '#fourteen-colors',
			'settings'        => array( 'accent_color', 'contrast_color' ),
			'render_callback' => 'fourteen_colors_generate_css',
		) );
		$wp_customize->get_setting( 'accent_color' )->transport = 'postMessage';
		$wp_customize->get_setting( 'contrast_color' )->transport = 'postMessage';
	}

	// Remove the Site Title Color control; it is confusing because the color is automatically adjusted based on the contrast color.
	// A custom-set color will still apply and it can still be changed from the Appearance -> Header page.
	$wp_customize->remove_control( 'header_textcolor' );

	add_filter( 'theme_mod_fourteen_colors_css', 'fourteen_colors_generate_css' );
}
add_action( 'customize_register', 'fourteen_colors_customize_register', 11 ); // Needs to run after theme's customize_register so that the colors section's description can be modified.

// Contains functions that generate CSS for all color modification patterns.
require( 'color-patterns.php' );

// Link color component that conditionally activates UI when it may be useful.
// require( 'component-link-color.php' );

/**
 * Returns the CSS output of Fourteen Colors.
 *
 * @since Fourteen Colors 0.5
 *
 * @return string
 */
function fourteen_colors_generate_css() {
	return fourteen_colors_contrast_css() . fourteen_colors_accent_css() . fourteen_colors_general_css();
}

/**
 * Caches the CSS output of Fourteen Colors.
 *
 * @since Fourteen Colors 0.5
 *
 * @return void
 */
function fourteen_colors_rebuild_color_patterns() {
	set_theme_mod( 'fourteen_colors_css', fourteen_colors_generate_css() );
}
// Allow Fourteen Colors to run on child themes by not hardcoding "twentyfourteen".
$fourteen_colors_theme = get_stylesheet();
add_action( "update_option_theme_mods_$fourteen_colors_theme", 'fourteen_colors_rebuild_color_patterns' );


/**
 * Binds JS handlers to make the customizer preview reload changes asynchronously.
 *
 * @since Fourteen Colors 1.4
 *
 * @return void
 */
function fourteen_colors_customize_preview_js() {
	wp_enqueue_script( 'fourteen_colors_customizer', plugins_url( '/customizer.js', __FILE__ ), array( 'customize-preview' ), '20160703', true );
}
add_action( 'customize_preview_init', 'fourteen_colors_customize_preview_js' );

/**
 * Output all dynamic custom-color CSS.
 *
 * @since Fourteen Colors 0.5
 *
 * @return void
 */
function fourteen_colors_print_output() {
	if ( is_customize_preview() ) {
		$accent = get_theme_mod( 'accent_color', '#24890d' );
		$contrast = get_theme_mod( 'contrast_color', '#000000' );
		$data = ' data-accent-color="' . $accent . '" data-contrast-color="' . $contrast . '"';
	} else {
		$data = '';
	}
	echo '<style id="fourteen-colors" type="text/css"' . $data . '>' . get_theme_mod( 'fourteen_colors_css', '/* Fourteen Colors is not yet configured. */' ) . '</style>';
}
add_action( 'wp_head', 'fourteen_colors_print_output' );