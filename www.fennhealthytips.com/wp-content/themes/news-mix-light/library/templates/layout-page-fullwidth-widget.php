<?php 
$kopa_setting = kopa_get_template_setting(); 
$sidebars = $kopa_setting['sidebars'];
get_header(); ?>

<?php kopa_breadcrumb(); ?>

<div class="row-fluid">
    <div class="span12">
        <div class="widget-area-12">
            <?php 
            if ( is_active_sidebar( $sidebars[0] ) ) {
                dynamic_sidebar( $sidebars[0] );
            }
            ?>
        </div>
    </div>
</div>    

<div class="clear"></div>

<?php get_footer(); ?>