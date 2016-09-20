<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Matata
 */

?>

<?php
/**
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, then let's bail early.
 */
if( !is_active_sidebar( 'matata_footer_sidebar_one' ) &&
	!is_active_sidebar( 'matata_footer_sidebar_two' ) &&
	!is_active_sidebar( 'matata_footer_sidebar_three' ) ) {
	return;
}
?>

<div class="footer-widgets clear">
	<div class="footer-widget-left">

		<?php
   			if ( !dynamic_sidebar( 'matata_footer_sidebar_one' ) ):
   			endif;
   		?>

	</div>
	<div class="footer-widgets-right">
		<div class="footer-first-widget-right">

			<?php
   				if ( !dynamic_sidebar( 'matata_footer_sidebar_two' ) ):
   				endif;
   			?>

		</div>
		<div class="footer-second-widget-right">

			<?php
   				if ( !dynamic_sidebar( 'matata_footer_sidebar_three' ) ):
   				endif;
   			?>
   			
		</div>
	</div>
</div>