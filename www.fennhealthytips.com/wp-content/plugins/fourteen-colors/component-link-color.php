<?php
/*
 * Link color component for the Fourteen Colors plugin.
 */

/**
 * Register a setting and a contextual control for links.
 *
 * @since Fourteen Colors 1.2.1
 *
 * @return void
 */
function fourteen_colors_link_register( $wp_customize ) {
	// Add a setting. This isn't conditional, of course.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => get_theme_mod( 'accent_color' ),
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	// Add a contextual/conditional control.
	$wp_customize->add_control( 
		new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
			'section'         => 'colors',
			'priority'        => 2,
			'label'           => __( 'Link Color', 'fourteen-colors' ),
			'description'     => __( 'Since your accent color is light, you can optionally specify a different color to be used for link on a white background.', 'fourteen-colors' ),
			'active_callback' => 'fourteen_colors_maybe_do_link_option',
		)
	) );
}
add_action( 'customize_register', 'fourteen_colors_link_register' );

/**
 * Determine whether or not to show the link color option.
 *
 * Return true if we should show the link color option, false otherwise.
 * This option should only be available if the chosen color doesn't contrast well with white backgrounds.
 *
 * @since Fourteen Colors 1.2.1
 *
 * @return bool
 */
function fourteen_colors_maybe_do_link_option() {
	$accent_color = get_theme_mod( 'accent_color', '#24890d' );
	if ( '#24890d' === 'accent_color' ) {
		return false;
	}

	if ( 4.5 < fourteen_colors_contrast_ratio( $accent_color, '#fff' ) ) {
		return false;
	} else {
		return true;
	}
}

/**
 * Add the custom link color CSS to Fourteen Colors' output if needed.
 *
 * @since Fourteen Colors 1.2.1
 *
 * @return void
 */
function fourteen_colors_filter_link_color( $color ) {
	if ( ! fourteen_colors_maybe_do_link_option() ) {
		return $color;
	} else {
	// @todo only do the output if the value is customized... maybe check if it's different than the (original) accent color? Probably need to do more.
		$link_color = get_theme_mod( 'link_color', get_theme_mod( 'accent_color', '#24890d' ) );

		return $link_color;
	}
}
add_filter( 'fourteen_colors_accent_dark', 'fourteen_colors_filter_link_color' );