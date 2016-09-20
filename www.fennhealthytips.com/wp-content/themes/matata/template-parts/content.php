<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Matata
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(esc_attr(get_theme_mod('matata_post_style', 'matata-magazine'))); ?>>

	<?php if ( has_post_thumbnail() ) { ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail('matata-featured'); ?></a>
	<?php } ?>

	<header class="entry-header">
		<?php

		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php matata_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			the_excerpt();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'matata' ),
				'after'  => '</div>',
			) );
		?>
		<a href="<?php the_permalink(); ?>" class="more-link" ><?php echo __('Read More', 'matata'); ?></a>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
