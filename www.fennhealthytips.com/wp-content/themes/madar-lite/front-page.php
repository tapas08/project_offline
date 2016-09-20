<?php

?>

<?php get_header();
 if ( 'posts' == get_option( 'show_on_front' ) ) {
	
    include( get_home_template() );
	
} else {
    if ( get_theme_mod('breaking_enable') ) : 
        madarlite_breaking();
     endif; ?>
<div class="content">
    <?php 
	if ( get_theme_mod('slider_enable') ) : ?>
		<?php madarlite_flexslider(); ?>
    <?php endif; ?>
    <?php if ( get_theme_mod('recent-carousel') ) : ?>
		<?php get_template_part( 'template-parts/recentbox' ); ?>
    <?php endif; ?>
	         <?php
         if( is_active_sidebar( 'madarlite_front_page_content_top_section' ) ) {
            if ( !dynamic_sidebar( 'madarlite_front_page_content_top_section' ) ):
            endif;
         }?>
         <div class="clearfix"></div>
         <?php

         if( is_active_sidebar( 'madarlite_front_page_content_bottom_section' ) ) {
            if ( !dynamic_sidebar( 'madarlite_front_page_content_bottom_section' ) ):
            endif;
         }?>
   <?php if ( is_active_sidebar('madarlite_advertisement_on_the_front_page') ) { ?>
      <div class="advertisement_in_front">
            <?php dynamic_sidebar('madarlite_advertisement_on_the_front_page'); ?>
      </div>
   <?php } ?>
</div><!--end of content-->
<?php get_sidebar(); ?>
<?php
}
get_footer(); ?>