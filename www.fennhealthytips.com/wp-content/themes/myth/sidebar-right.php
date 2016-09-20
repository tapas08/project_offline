<?php
/**
 * The sidebar containing the right widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Myth
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<div id="tertiary" class="widget-area" role="complementary">
	<div id="tertiary-inner" class="widget-container">
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #tertiary-inner -->
</div><!-- #tertiary -->
