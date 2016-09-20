<?php get_header(); ?>

<?php kopa_breadcrumb(); ?>

<div class="row-fluid">
    <div class="span12">
        <?php get_template_part( 'library/templates/loop', 'page' ); ?>
    </div>
</div>    

<div class="clear"></div>

<?php get_footer(); ?>