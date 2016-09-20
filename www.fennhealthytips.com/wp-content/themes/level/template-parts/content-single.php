<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Level
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php level_posted_on(); if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'level' ) );
		if ( $categories_list && level_categorized_blog() ) {
			printf( '<span class="cat-links single">' . esc_html__( '%1$s', 'level' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}		
		} 
		?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'level' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php level_entry_footer(); ?>
	</footer><!-- .entry-footer -->
<?php if(get_theme_mod('level_author_profile') !=='disable' ){?>
<div class="row author-bio">
<div class="small-3 columns"><?php  echo get_avatar( get_the_author_meta('ID'), 120 ); ?></div>
<div class="small-9 columns">
<div class="author-title"> <?php _e('Article By :', 'level'); ?> <?php the_author_posts_link(); ?></div>
	<?php echo esc_html(the_author_meta('description')); ?>
	<div class="author-meta">
	 <?php if( get_the_author_meta('facebook')): ?>
	  <a href="<?php esc_url(the_author_meta('facebook')); ?>"><i class="fa fa-facebook-official"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('youtube')): ?>
	 <a href="<?php esc_url(the_author_meta('youtube')); ?>"><i class="fa fa-youtube-square"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('twitter')): ?>
	 <a href="<?php esc_url(the_author_meta('twitter')); ?>"><i class="fa fa-twitter-square"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('pinterest')): ?>
	 <a href="<?php esc_url(the_author_meta('pinterest')); ?>"><i class="fa fa-pinterest-square"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('googleplus')): ?>
	 <a href="<?php esc_url(the_author_meta('googleplus')); ?>"><i class="fa fa-google-plus-square"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('instagram')): ?>
	 <a href="<?php esc_url(the_author_meta('instagram')); ?>"><i class="fa fa-instagram"></i></a>
	 <?php else : endif; ?>
	 <?php if( get_the_author_meta('rss')): ?>
	 <a href="<?php esc_url(the_author_meta('rss')); ?>"><i class="fa fa-rss-square"></i></a>
	 <?php else : endif; ?>
	</div>
</div>
</div><?php } ?>
</article><!-- #post-## -->	
<?php if ( is_active_sidebar( 'content-end' ) ) { ?>
<div id="secondary" class="widget-area" role="complementary">
<?php dynamic_sidebar( 'content-end' ); ?>
</div><!-- #secondary -->
<?php } ?>
<?php if(get_theme_mod('random_post') !=='disable' ){ get_template_part('template-parts/random-posts');} ?>