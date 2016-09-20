  <?php get_sidebar(); ?>
 <div class="large-8 columns">
 <?php do_action('level_before_single_post_title'); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
  <div class="row">
 <?php
if ( is_active_sidebar( 'post-widget-1' ) ) {
?>  <div class="medium-3 columns">
<div id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'post-widget-1' ); ?>
</div><!-- #secondary -->
  </div>
 <div class="medium-9 columns">
<?php } 
else { echo '<div class="large-12 columns">';}?>

  <?php while ( have_posts() ) : the_post(); ?>


			<?php get_template_part( 'template-parts/content', 'single' ); ?>

			<?php the_post_navigation(); ?>
		</div>
</div>
			<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>

		<?php endwhile; // End of the loop. ?>
		
		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- #column -->