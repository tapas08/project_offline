<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Myth
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<span class="generator"><?php echo __( 'Powered by ', 'myth' ) ?><a href="<?php echo esc_url( 'http://wordpress.org/' ); ?>" rel="generator">WordPress</a></span>
			<span class="sep"> | </span>
			<span class="designer"><?php printf( esc_html__( 'Theme: %1$s by %2$s.', 'myth' ), '<a href="http://michaelvandenberg.com/portfolio/myth/" rel="theme">Myth</a>', '<a href="http://michaelvandenberg.com/" rel="designer">Michael Van Den Berg</a>' ); ?></span>
		</div><!-- .site-info -->

		<div class="social-bottom">
			<?php if ( has_nav_menu( 'social' ) ) { get_template_part( 'template-parts/navigation-social' ); } ?>
		</div><!-- .social-bottom -->
	</footer><!-- #colophon -->

	<a href="#content" class="back-to-top">Top</a>

	<?php if ( has_nav_menu( 'social' ) ) { ?>
		<div class="social-right">
			<?php get_template_part( 'template-parts/navigation-social' ); ?>
		</div><!-- .social-top -->
	<?php } ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
