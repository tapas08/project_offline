<?php

/**
 * The Author template for our theme.
 *
 *
 * @package level
 */
get_header(); ?>
 <div class="row">
  <div class="large-8 columns">
<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">


<!-- This sets the $curauth variable -->
<div class="row author-bio">

    <?php 
    
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
     echo '<div class="small-3 columns">'; echo get_avatar( get_the_author_meta( 'ID' ), 160 ); echo '</div>';
	 echo '<div class="small-9 columns">';
	 echo '<h2>'; _e('About: ','level');  
     echo esc_attr($curauth->nickname); echo '</h2>';
    
     if($curauth->first_name){echo '('.esc_attr($curauth->first_name) .' '. esc_attr($curauth->last_name).')';}
     if($curauth->description) { echo '</p>'.esc_html($curauth->description);}
	 echo '<div class="author-meta">';
if($curauth->facebook) { echo '<a href="'.esc_url($curauth->facebook).'"><i class="fa fa-facebook-official"></i></a>';}
if($curauth->youtube) { echo '<a href="'.esc_url($curauth->youtube).'"><i class="fa fa-youtube-square"></i></a>';}
if($curauth->twitter) { echo '<a href="'.esc_url($curauth->twitter).'"><i class="fa fa-twitter-square"></i></a>';}
if($curauth->pinterest) { echo '<a href="'.esc_url($curauth->pinterest).'"><i class="fa fa-pinterest-square"></i></a>';}
if($curauth->googleplus) { echo '<a href="'.esc_url($curauth->googleplus).'"><i class="fa fa-google-plus-square"></i></a>';}
if($curauth->instagram) { echo '<a href="'.esc_url($curauth->instagram).'"><i class="fa fa-instagram"></i></a>';}
if($curauth->rss) { echo '<a href="'.esc_url($curauth->rss).'"><i class="fa fa-rss-square"></i></a>';}

	 echo '</div></div>';
        
 ?>
<!-- The Loop -->
</div>
    <div class="row medium-up-3 postbox">
		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title titlepage"><i class="fa fa-user"></i> ', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<?php

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_format() );
				?>

			<?php endwhile; ?>

			
			<?php if( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) {
				the_posts_navigation(); 
				} 
				else {
					level_paging_nav();
				}
				?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>
</div>
		</main><!-- #main -->
	</div><!-- #primary -->
		</div><!-- #column -->
<?php get_sidebar(); ?></div>
<?php get_footer(); ?>
                                                   