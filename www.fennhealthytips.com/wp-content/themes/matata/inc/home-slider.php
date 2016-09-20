<?php 
/**
 * Home Slider
 *
 * @package JusThemes
 * @subpackage Matata
 * @since Matata 1.0
 */

$slidecat = esc_attr(get_theme_mod('matata_slide_categories'));
$count = esc_attr(get_theme_mod('matata_slide_number', 3));

if ($slidecat !== 'default'){
   $slider_posts = new WP_Query( array( 
      'category_name' => $slidecat, 
      'posts_per_page' => $count, 
      'meta_query' => array(array('key' => '_thumbnail_id')) 
      ));
}else{
   $slider_posts = new WP_Query( array(
      'posts_per_page' =>  $count,
      'meta_query' => array(array('key' => '_thumbnail_id'))
      ));
}

?>

<?php if ( $slider_posts->have_posts() ): ?>

   <ul class="bxslider">

      <?php while ( $slider_posts->have_posts() ) : $slider_posts->the_post(); 

         echo '<li>';
         the_post_thumbnail( 'matata-featured' );
         ?>

         <div class="slide-content">
            <h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_title(); ?></a></h3>
            <div class="entry-meta">
               <span><i class="fa fa-calendar-o"></i> <?php echo get_the_date(); ?></span> 
               <span><i class="fa fa-folder-o"></i> <?php the_category(', '); ?></span>
            </div>
         </div>

         <?php
         echo '</li>';
         ?>
      
      <?php endwhile; ?>

   </ul>

<?php else : _e('Home Slider is enabled but you have no posts with thumbnails.','matata');

endif; ?>

<?php wp_reset_postdata(); ?>