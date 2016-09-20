<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <div id="page-<?php the_ID(); ?>" <?php post_class( 'elements-box' ); ?>>
        <h2 class="element-title"><?php echo get_the_title(); ?></h2>
        <?php the_content(); ?>
    </div>

    <div class="wp-link-pages clearfix mt-20">
        <?php wp_link_pages(array(
            'before' => '<p>',
            'after'  => '</p>',
            'pagelink' => __( 'Page %', kopa_get_domain() )
        )); ?>
    </div>

    <?php comments_template(); ?>

<?php endwhile; else: ?>

<?php endif; ?>