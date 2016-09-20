<?php
/**
 * Template Name: Homepage with Slider
 *
 * @package Matata
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if (get_theme_mod('matata_home_slider', 0) == 1 && !is_paged()) { get_template_part( 'inc/home-slider' ); }?>

		<?php

		if ( get_query_var( 'paged' ) ) { $paged = get_query_var( 'paged' ); }
		elseif ( get_query_var( 'page' ) ) { $paged = get_query_var( 'page' ); }
		else { $paged = 1; }

		$the_query = new WP_Query('post_type=post&paged=' . $paged);

		if ( $the_query->have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( $the_query->have_posts() ) : $the_query->the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			?>

			<nav class="navigation posts-navigation" role="navigation">
				<h2 class="screen-reader-text">Posts navigation</h2>
				<div class="nav-links">
					<div class="nav-previous"><?php next_posts_link(__('&laquo; Older Entries', 'matata'), $the_query->max_num_pages); ?></div>
					<div class="nav-next"><?php previous_posts_link(__('Newer Entries &raquo;', 'matata')); ?></div>
				</div>
			</nav>

			<?php

			wp_reset_postdata();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
matata_sidebar_select();
get_footer();
