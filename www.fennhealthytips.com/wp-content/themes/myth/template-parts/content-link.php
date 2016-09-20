<?php
/**
 * Template part for displaying posts with the Link post format.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Myth
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<div class="special-content">
		<?php	
			// Fetch post content
			$content = get_post_field( 'post_content', get_the_ID() );

			// Apply filters
			$content = apply_filters('the_content', $content);

			// Get content parts
			$content_parts = get_extended( $content );
			
			// Output part before <!--more--> tag
			echo $content_parts['main'];
		?>
		</div><!-- .special-content -->
		
		<div class="title-and-meta">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php myth_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
		</div><!-- .title-and-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			// Output part after <!--more--> tag
			echo $content_parts['extended'];
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'myth' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php myth_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
