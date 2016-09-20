<?php
/**
 * @package Colorist
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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

<div class="entry-content">
	<?php
			$single_featured_image = get_theme_mod( 'single_featured_image',true);
			$single_featured_image_size = get_theme_mod ('single_featured_image_size',1);
			if( $single_featured_image ) : ?>
				<div class="post-thumb blog-thumb">
				<?php if ( $single_featured_image_size == 1 ) :
						if( has_post_thumbnail() && ! post_password_required() ) :   
							the_post_thumbnail('colorist-large-width'); 
						
						endif;
					 elseif( $single_featured_image_size == 2 ) : 
					 	if( has_post_thumbnail() && ! post_password_required() ) :   
								the_post_thumbnail('colorist-small-featured-image-width');
						endif;
					endif;  ?>
				</div>			
		<?php 
		endif;  ?>
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'colorist' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_theme_mod('enable_single_post_bottom_meta', true ) ): ?>
	<footer class="entry-footer">
	<?php if(function_exists('colorist_entry_bottom_meta') ) {
		     colorist_entry_bottom_meta();
		} ?>
	</footer><!-- .entry-footer -->
<?php endif;?>

</article><!-- #post-## -->

	<?php colorist_post_nav(); ?>