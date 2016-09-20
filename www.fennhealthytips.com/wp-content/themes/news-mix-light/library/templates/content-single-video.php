<?php $kopa_post_thumbnail_style = get_option('kopa_theme_options_post_thumbnail_style', 'large');
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <?php if ( has_post_thumbnail() ) : ?>
        <div class="entry-thumb">
            <?php // switch between two post thumbnail styles 
            if ( $kopa_post_thumbnail_style == 'small' ) {
                $kopa_post_thumbnail_size = 'kopa-image-size-4'; // 207x191;
            } else {
                $kopa_post_thumbnail_size = 'kopa-image-size-6'; // 665x363
            }
            ?>
            <img src="<?php echo kopa_get_image_src(get_the_ID(), $kopa_post_thumbnail_size ); ?>" alt="<?php echo get_the_title(); ?>">
            <?php
            ?>

            <?php if ( $kopa_post_thumbnail_style == 'small' ) : ?>
                <div class="meta-box">
                    <span class="entry-comments"><?php echo KopaIcon::getIcon('comment','span'); ?><?php comments_popup_link(); ?></span>
                    <span class="entry-view"><?php echo KopaIcon::getIcon('view','span'); ?><?php //echo kopa_get_view_count( get_the_ID() ); ?></span>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <header>
        <h4 class="entry-title"><?php echo get_the_title(); ?></h4>
        <span class="entry-categories"><?php the_category(', '); ?></span>
        <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ) ?></span>
        <span class="entry-author">, <?php _e('by', kopa_get_domain()); ?> <?php the_author_posts_link(); ?></span>

        <?php if ( $kopa_post_thumbnail_style == 'large' ) : ?>

            <span class="entry-comments"><?php echo KopaIcon::getIcon('comment','span'); ?><?php comments_popup_link(); ?></span>
            <span class="entry-view"><?php echo KopaIcon::getIcon('view','span'); ?><?php //echo kopa_get_view_count( get_the_ID() ); ?></span>

        <?php endif; ?>
    </header>

    <div class="elements-box mt-20">
        <?php the_content(); ?>
    </div>

    <div class="wp-link-pages clearfix mt-20">
        <?php wp_link_pages(array(
            'before' => '<p>',
            'after'  => '</p>',
            'pagelink' => __( 'Page %', kopa_get_domain() )
        )); ?>
    </div>
    
    

    <footer class="clearfix">
        <?php get_template_part( 'library/templates/template', 'post-navigation' ); ?>
    </footer>
    
</div><!--entry-box-->