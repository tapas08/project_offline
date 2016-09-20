<?php
/**
 * @package coral-dark
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php coral_dark_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<?php 
			coral_dark_excerpt();
			coral_dark_post_thumbnail();
			the_content();
			if (is_attachment() && !empty( $post->post_excerpt )) {
				echo '<div class="entry-caption">';
				the_excerpt();
				echo '</div>';
			}
		?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'coral-dark' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php coral_dark_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
