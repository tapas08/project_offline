<?php
$kopa_setting = kopa_get_template_setting();
$sidebars = $kopa_setting['sidebars'];
?>

<?php get_header(); ?>

<?php kopa_breadcrumb(); ?>

<div id="main-col">

    <?php
    if (get_option('kopa_theme_options_display_blog_slider', 'hide') == 'show') :
        $kopa_blog_slider_settings = array(
            'animation' => get_option('kopa_theme_options_blog_slider_effect', 'slide'),
            'slideshow_speed' => (int) get_option('kopa_theme_options_blog_slider_slideshow_speed', 7000),
            'animation_speed' => (int) get_option('kopa_theme_options_blog_slider_animation_speed', 600),
            'autoplay' => get_option('kopa_theme_options_blog_slider_autoplay', 'false')
        );
        ?>
        <div class="kopa-blog-slider flexslider" data-animation="<?php echo $kopa_blog_slider_settings['animation']; ?>" data-slideshow_speed="<?php echo ($kopa_blog_slider_settings['slideshow_speed']>0) ? $kopa_blog_slider_settings['slideshow_speed']: 1000; ?>" data-animation_speed="<?php echo ($kopa_blog_slider_settings['animation_speed']>0)? $kopa_blog_slider_settings['animation_speed']: 1000; ?>" data-autoplay="<?php echo $kopa_blog_slider_settings['autoplay']; ?>">
            <ul class="slides">

    <?php get_template_part('library/templates/loop', 'blog-slider'); ?>

            </ul><!--slides-->
            
        </div><!--kopa-blog-slider-->
<?php endif; ?>


    <ul class="article-list">

<?php get_template_part('library/templates/loop', 'blog'); ?>

    </ul><!--article-list-->

<?php get_template_part('library/templates/template', 'pagination'); ?>

</div><!--main-col-->

<div class="widget-area-3 sidebar">
    <?php
    if (is_active_sidebar($sidebars[0])) {
        dynamic_sidebar($sidebars[0]);
    }
    ?>
</div><!--widget-area-3-->

<div class="clear"></div>

<?php get_footer(); ?>