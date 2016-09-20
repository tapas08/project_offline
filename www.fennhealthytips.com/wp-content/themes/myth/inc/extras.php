<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Myth
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function myth_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class if header image has not been set.
	if ( ! has_header_image() ) {
		$classes[] = 'no-header-img';
	}

	// Adds a class depending on whether sidebar is active and the selection in the customizer.
	if ( ! is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'no-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-1' ) && ! is_active_sidebar( 'sidebar-2' ) ) {
		$classes[] = 'left-sidebar';
	}

	elseif ( is_active_sidebar( 'sidebar-2' ) && ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'right-sidebar';
	}

	// Remove the custom-background class from the body.
	$blacklist = array( 'custom-background' ); // The classes to be removed.
	$classes = array_diff( $classes, $blacklist ); // Remove the classes from the array.

	return $classes;
}
add_filter( 'body_class', 'myth_body_classes' );

/**
 * Add featured image as background image to post navigation elements.
 *
 * @see wp_add_inline_style()
 */
function myth_post_nav_background() {
	if ( ! is_single() ) {
		return;
	}

	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	$css      = '';

	if ( is_attachment() && 'attachment' == $previous->post_type ) {
		return;
	}

	if ( $previous &&  has_post_thumbnail( $previous->ID ) ) {
		$prevThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $previous->ID ), 'myth-navigation' );
		$css .= '
			.post-navigation .nav-previous { background-image: url(' . esc_url( $prevThumb[0] ) . '); }
		';
	}

	if ( $next && has_post_thumbnail( $next->ID ) ) {
		$nextThumb = wp_get_attachment_image_src( get_post_thumbnail_id( $next->ID ), 'myth-navigation' );
		$css .= '
			.post-navigation .nav-next { background-image: url(' . esc_url( $nextThumb[0] ) . '); }
		';
	}

	wp_add_inline_style( 'myth-style', $css );
}
add_action( 'wp_enqueue_scripts', 'myth_post_nav_background' );
