<?php 
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
get_header(); ?>

<?php kopa_breadcrumb(); ?>

<div id="main-col">
    
    <?php get_template_part( 'library/templates/loop', 'single' ); ?>
    
</div><!--main-col-->

<div class="widget-area-3 sidebar">
   
    <?php if ( is_active_sidebar( $sidebars[0] ) ) {
        dynamic_sidebar( $sidebars[0] );
    } ?>
    
</div><!--widget-area-3-->

<div class="clear"></div>

<?php get_footer(); ?>