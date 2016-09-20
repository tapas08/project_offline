
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        
    <div class="entry-thumb">
        <?php 
        //$gallery = kopa_content_get_gallery( get_the_content() );
        //if ( isset( $gallery[0] ) ) {
        //    $gallery = $gallery[0];

        //    if ( isset( $gallery['shortcode'] ) ) {
        //        echo do_shortcode( $gallery['shortcode'] );
        //    }
        //} else {
            if(has_post_thumbnail() ){
                $kopa_post_thumbnail_size = 'kopa-image-size-6'; // 665x363           
                ?>
                <img src=<?php echo kopa_get_image_src(get_the_ID(),$kopa_post_thumbnail_size); ?> alt="<?php echo get_the_title( ); ?>" >
                <?php
            }
        //}
        ?>
    </div>

    <header>
        <h4 class="entry-title"><?php echo get_the_title(); ?></h4>
        <span class="entry-categories"><?php the_category(', '); ?></span>
        <span class="entry-date"><span class="kopa-minus"></span><?php the_time( get_option( 'date_format' ) ) ?></span>
        <span class="entry-author">, <?php _e('by', kopa_get_domain()); ?> <?php the_author_posts_link(); ?></span>
        <span class="entry-comments"><?php echo KopaIcon::getIcon('comment','span'); ?><?php comments_popup_link(); ?></span>
        <span class="entry-view"><?php echo KopaIcon::getIcon('view','span'); ?><?php //echo kopa_get_view_count( get_the_ID() ); ?></span>
    </header>

    <div class="clear"></div>

    <div class="elements-box mt-20">
        <?php //$content = get_the_content(); 
        //$content = preg_replace('/\[gallery.*]/', '', $content);
        //$content = apply_filters( 'the_content', $content );
        //$content = str_replace(']]>', ']]&gt;', $content);
        //echo $content;
		the_content();
        ?>
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