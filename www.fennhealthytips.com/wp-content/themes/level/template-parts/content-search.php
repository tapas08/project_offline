<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Level
 */

?>
<div class="columns">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php if ( has_post_thumbnail() ) : ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
	<?php the_post_thumbnail(); ?>
	</a>

<?php endif; ?>
<footer class="entry-footer">
		<?php if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'level' ) );
		if ( $categories_list && level_categorized_blog() ) {
			printf( '<span class="cat-links">' . esc_html__( '%1$s', 'level' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}		
		} 
		?>
	</footer><!-- .entry-footer -->
	<header class="entry-header">
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->
</article><!-- #post-## -->
</div>