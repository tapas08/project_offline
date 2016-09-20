<?php
/**
 * Jetpack Compatibility File.
 *
 * @link https://jetpack.me/
 *
 * @package Level
 */

/**
 * Jetpack setup function.
 *
 * See: https://jetpack.me/support/infinite-scroll/
 * See: https://jetpack.me/support/responsive-videos/
 */
function level_jetpack_setup() {
	// Add theme support for Infinite Scroll.
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'level_infinite_scroll_render',
		'footer'    => 'page',
		'wrapper'	=> false,
		'posts_per_page' => get_option('posts_per_page'),
		
	) );

	// Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
} // end function level_jetpack_setup
add_action( 'after_setup_theme', 'level_jetpack_setup' );

/**
 * Custom render function for Infinite Scroll.
 */
function level_infinite_scroll_render() {
	echo '<div class="row small-up-1 medium-up-2 large-up-4 postbox">';
	while ( have_posts() ) {
		the_post();
		if ( is_search() ) :
		    get_template_part( 'template-parts/content', 'search' );
		else :
		    get_template_part( 'template-parts/content', get_post_format() );
		endif;
	}
	echo '</div>';
} // end function level_infinite_scroll_render

function level_theme_jetpack_infinite_scroll_supported() {
	return current_theme_supports( 'infinite-scroll' ) && ( is_home() || is_archive() || is_search() ) && ! is_post_type_archive( 'product' );
}
add_filter( 'infinite_scroll_archive_supported', 'level_theme_jetpack_infinite_scroll_supported' );