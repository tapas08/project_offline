<?php 
$kopa_setting = kopa_get_template_setting(); 
$sidebars = $kopa_setting['sidebars'];
?>

<?php get_header(); ?>

<?php kopa_breadcrumb(); ?>

<div id="main-col">
    
    <ul class="article-list">

        <?php get_template_part('library/templates/loop', 'blog'); ?>
    
    </ul><!--article-list-->
    
    <?php get_template_part('library/templates/template', 'pagination'); ?>
    
</div><!--main-col-->

<div class="widget-area-3 sidebar">
    <?php 
    if ( is_active_sidebar( $sidebars[0] ) ) {
        dynamic_sidebar( $sidebars[0] );
    }    
    ?>
</div><!--widget-area-3-->

<div class="clear"></div>

<?php get_footer(); ?>