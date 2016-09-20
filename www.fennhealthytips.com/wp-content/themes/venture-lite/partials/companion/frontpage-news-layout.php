<div id="post-<?php the_ID(); ?>" <?php post_class('blog_small_wrap'); ?>>
    <?php get_template_part( 'partials/img','652x411'); ?>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php get_template_part( 'partials/meta'); ?>
    <p class="excerpt"><?php echo get_the_excerpt(); ?></p>
</div>