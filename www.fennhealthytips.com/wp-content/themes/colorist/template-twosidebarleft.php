<?php
/**
 * Template Name: 2 Sidebar Left( Sidebar-Sidebar-Main )
 */

get_header(); get_template_part('breadcrumb'); ?>	


<div id="content" class="site-content">
	<div class="container">

 	<?php get_sidebar('left'); 
 	 get_sidebar(); ?>

        <div id="primary" class="content-area eight columns">
			
			<main id="main" class="site-main" role="main">
				
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

				<?php endwhile; // end of the loop. ?>

			</main><!-- #main -->
		</div><!-- #primary -->
	
		<?php
			// If comments are open or we have at least one comment, load up the comment template
			if ( comments_open() || '0' != get_comments_number() ) :
				comments_template();
			endif;
		?>
	    
	    
		<?php get_footer(); ?>