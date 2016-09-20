<?php 
/**
 * The front page template file.
 *
 *
 * @package Colorist
 */
	if( 'posts' == get_option('show_on_front') ) {
		include get_home_template();
	} else {	
  
  get_header(); 
	if ( get_theme_mod('page-builder',false ) ) { 
		if( get_theme_mod('flexslider') ) {   
			echo do_shortcode( get_theme_mod('flexslider'));
		} ?>

		<div id="content" class="site-content">
		   <div class="container">
			<?php  if( get_theme_mod('home_sidebar',false ) ) { ?>
				<div id="primary" class="content-area eleven columns">
			<?php }else { ?>
			    <div id="primary" class="content-area sixteen columns">
			<?php } ?>
				<main id="main" class="site-main" role="main">
					<?php
						while ( have_posts() ) : the_post();
							the_content();
						endwhile;
					?>
					
			     </main><!-- #main -->
		     </div><!-- #primary -->
<?php	} else {
		
		$home_slider = get_theme_mod('enable_slider',true); 
	    if( $home_slider ) {
	    	get_template_part('category-slider');
		} ?>
		
	<div id="content" class="site-content free-home">
		<div class="container">		
	  <?php  if( get_theme_mod('home_sidebar',false ) ) { ?>
				<div id="primary" class="content-area eleven columns">
			<?php }else { ?>
			    <div id="primary" class="content-area sixteen columns">
			<?php } ?>	
		<main id="main" class="site-main" role="main">
			<?php
			do_action('colorist_service_content_before');
	    if(get_theme_mod('enable_service',true) ) {
			$service = get_theme_mod('service_count',3);
			    $service_pages = array();
			    for ( $i = 1 ; $i <= $service ; $i++ ) {
					$service_page = absint(get_theme_mod('service_'.$i));
					if( $service_page ){
                        $service_pages[] = $service_page;
					}
			    }
			if( $service_pages && !empty( $service_pages ) ) {
				$args = array(
							'post_type' => 'page',
							'post__in' => $service_pages,
							'posts_per_page' => -1 ,
							'orderby' => 'post__in'
						);
			}else {  ?>
			 		<div class="services-wrapper">   
				        <div class="one-third column">						 
							<img src="<?php echo get_template_directory_uri(); ?>/images/page.png" />								    		
							<h2><?php _e('Service Page - 1','colorist');?></h2>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click Colorist Options => Home => Service Section #1 and select page from  dropdown page list.','colorist'), admin_url('customize.php') ) ;?></p>						    	
		   				</div> 
		   				<div class="one-third column">						 
							<img src="<?php echo get_template_directory_uri(); ?>/images/page.png" />								    		
							<h2><?php _e('Service Page - 2','colorist');?></h2>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click Colorist Options => Home => Service Section #2 and select page from  dropdown page list.','colorist'), admin_url('customize.php') ) ;?></p>						    	
		   				</div> 
		   				<div class="one-third column">						 
							<img src="<?php echo get_template_directory_uri(); ?>/images/page.png" />								    		
							<h3><?php _e('Service Page - 3','colorist');?></h3>
							<p><?php printf( __('You haven\'t created any service page yet. Create Page. Go to <a href="%1$s"target="_blank"> Customizer </a> and click Colorist Options => Home => Service Section #3 and select page from  dropdown page list.','colorist'), admin_url('customize.php') ) ;?></p>						    	
		   				</div> 
		   			</div>		
		  <?php  }

		    if( isset($args) ) :
				$query = new WP_Query($args);
				if( $query->have_posts()) : ?>
					<div class="services-wrapper ">
					    <?php while($query->have_posts()) :
							$query->the_post(); ?>
							    <div class="one-third column">
							    	<?php if( has_post_thumbnail() ) : ?>
							    		<a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_post_thumbnail('full'); ?></a>
							    	<?php endif; ?>
							    	<?php the_content(); ?>
							    </div>
					   <?php endwhile; ?>
					</div>
				<?php endif; ?>
				<?php  
					$query = null;
					wp_reset_postdata();
		    endif;
		} 
		
	do_action('colorist_service_content_after');
	if(get_theme_mod('enable_recent_post_service',true)  ) {
		colorist_recent_posts(); 
	 } 
    if( get_theme_mod('enable_home_default_content',false ) ) {  ?>
		<div class="container default-home-page"><?php
			while ( have_posts() ) : the_post();       
				the_content();
			endwhile; ?>
        </div>    
    <?php } ?>
		</main><!-- #main -->
	</div><!-- #primary -->
<?php
}
if( get_theme_mod('home_sidebar',false ) ) { 
   get_sidebar();
}
get_footer();
} ?>