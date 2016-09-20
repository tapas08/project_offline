<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Level
 */

get_header(); ?>
<div class="row">
  <div class="large-8 columns">
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
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'level' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'level' ); ?></p>

					<?php get_search_form(); ?>
<?php load_template (get_template_directory() . '/template-parts/random-posts.php'); ?>
					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<?php if ( level_categorized_blog() ) : // Only show the widget if site has multiple categories. ?>
					<div class="widget widget_categories">
						<h2 class="widget-title"><?php esc_html_e( 'Most Used Categories', 'level' ); ?></h2>
						<ul>
						<?php
							wp_list_categories( array(
								'orderby'    => 'count',
								'order'      => 'DESC',
								'show_count' => 1,
								'title_li'   => '',
								'number'     => 10,
							) );
						?>
						</ul>
					</div><!-- .widget -->
					<?php endif; ?>

					<?php
						/* translators: %1$s: smiley */
						$archive_content = '<p>' . sprintf( esc_html__( 'Try looking in the monthly archives. %1$s', 'level' ), convert_smilies( ':)' ) ) . '</p>';
						the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
</div></div>
		</main><!-- #main -->
	</div><!-- #primary -->
	</div><!-- #column -->
<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>