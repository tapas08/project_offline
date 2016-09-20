<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package os_media
 * @since OS media 0.1
 * 
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
				<a href="<?php echo esc_url( __( 'http://mariomarino.eu/', 'os_media' ) ); ?>">
					<?php printf( __( 'OS media: Twenty Fourteen Wordpress child theme for video content created by %s', 'os_media' ), 'Mario Marino' ); ?>
				</a>
			</div><!-- .site-info -->


		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php wp_footer(); ?>
</body>
</html>