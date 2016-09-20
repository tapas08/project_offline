<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Myth
 */

$format = get_post_format();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php

			if ( $format == 'quote' || $format == 'link' || $format == 'aside' )  {

				echo '<div class="special-content">';

				// Fetch post content
				$content = get_post_field( 'post_content', get_the_ID() );

				// Apply filters
				$content = apply_filters('the_content', $content);

				// Get content parts
				$content_parts = get_extended( $content );
				
				// Output part before <!--more--> tag
				echo $content_parts['main'];

				echo '</div>';

			}

			else {
				myth_post_thumbnail();
			}
		?>

		<div class="title-and-meta">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

			<div class="entry-meta">
				<?php myth_posted_on(); ?>
			</div><!-- .entry-meta -->
			
		</div><!-- .title-and-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php

			if ( $format == 'quote' || $format == 'link' || $format == 'aside' )  {
				
				// Output part before <!--more--> tag
				echo $content_parts['extended'];

			}

			else {
				the_content();
			}
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

	<?php
		// Previous/next post navigation.
		the_post_navigation( array(
			'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'myth' ) . '</span> ' . '<span class="screen-reader-text">' . __( 'Next post:', 'myth' ) . '</span> ' . '<span class="post-title">%title</span>',
			'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'myth' ) . '</span> ' . '<span class="screen-reader-text">' . __( 'Previous post:', 'myth' ) . '</span> ' . '<span class="post-title">%title</span>',
	) );
	?>

	<?php
		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	?>

</article><!-- #post-## -->

