<?php
/**
 * The template for displaying category-slider 
 *
 * display slider
 *
 * @package colorist
 */

$colorist_slider_cat = get_theme_mod( 'slider_cat', '' );
$colorist_slider_count = get_theme_mod( 'slider_count', 5 );
$colorist_slider_posts = array(
	'cat' => absint($colorist_slider_cat),
	'posts_per_page' => absint($colorist_slider_count)
);

	if ($colorist_slider_cat) {

		$colorist_query = new WP_Query($colorist_slider_posts);
			if( $colorist_query->have_posts()) : ?>
				<div class="flexslider">
					<ul class="slides">
						<?php while($colorist_query->have_posts()) :
								$colorist_query->the_post();
								if( has_post_thumbnail() ) : ?>
								    <li>
								    	<div class="flex-image">
								    		<?php the_post_thumbnail('full'); ?>
								    	</div>
								    	<div class="flex-caption">
								    		<?php the_content(); ?>
								    	</div>
								    </li>
								<?php endif; ?>
						<?php endwhile; ?>
					</ul>
				</div>
			<?php endif; ?>
			<?php  
				$colorist_query = null;
				wp_reset_postdata();	
	}elseif( current_user_can('manage_options') ) {	?>	
		 <div class="flexslider">  
				<ul class="slides">	          
					<li>   	
						<div class="flex-image">
							<?php echo '<img src="' . get_template_directory_uri() . '/images/slider.jpg" alt="" >';?>	
						</div>
						<?php	$slide_description = sprintf( __('<h1> Slider Setting </h1><p>You haven\'t created any slider yet. Create a post, set your slider image as Post\'s featured image ( Recommended image size 1280*450 ) ). Go to Customizer and click colorist Options => Home and select Slider Post Category and No.of Sliders.<p><a href="%1$s"target="_blank"> Customizer </a></p>', 'colorist'),  admin_url('customize.php') );?>
						<div class="flex-caption"> <?php echo $slide_description;?></div>
					</li>
				</ul>
			</div><!-- flex-slider end -->	<?php
	}