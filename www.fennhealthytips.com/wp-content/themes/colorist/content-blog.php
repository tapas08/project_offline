<?php
/**
 * Template part for displaying posts.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package colorist
 */
?>
<?php do_action('colorist_blog_layout_class_wrapper_before'); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php 
		$featured_image = get_theme_mod( 'featured_image',true );
	  
	if( $featured_image ) : ?>
		<div class="post-thumb blog-thumb">
			<?php
			if( function_exists( 'colorist_featured_image' ) ) :
				colorist_featured_image();
			endif;
			?>
	    </div>
	<?php endif; ?> 

	<?php do_action('colorist_before_entry_header'); ?>

		<header class="entry-header">
			<?php the_title( sprintf( '<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

				<?php if ( get_theme_mod('enable_single_post_top_meta', true ) ): ?>
					<footer class="entry-meta">
						<?php if(function_exists('colorist_entry_top_meta') ) {
						    colorist_entry_top_meta(); 
						} ?> 
					</footer><!-- .entry-footer -->
				<?php endif;?>  
		</header><!-- .entry-header -->

	<?php do_action('colorist_after_entry_header'); ?>
	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content();
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'colorist' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

<?php do_action('colorist_before_entry_footer'); ?>
	<?php if ( get_theme_mod('enable_single_post_bottom_meta', true ) ): ?>
		<footer class="entry-footer">
			<?php if(function_exists('colorist_entry_bottom_meta') ) {
			     colorist_entry_bottom_meta();
			} ?>
		</footer><!-- .entry-footer -->
	<?php endif;?>
<?php do_action('colorist_after_entry_footer'); ?>

</article><!-- #post-## -->

<?php do_action('colorist_blog_layout_class_wrapper_after'); ?>