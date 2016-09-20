<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-thumb">
        <?php
        $audio = kopa_content_get_audio(get_the_content());
        if (isset($audio[0])) {
            $audio = $audio[0];

            if (isset($audio['shortcode'])) {
                echo do_shortcode($audio['shortcode']);
            }
        }
        ?>
    </div>

    <header>
        <h4 class="entry-title"><?php echo get_the_title(); ?></h4>
        <span class="entry-categories"><?php the_category(', '); ?></span>
        <span class="entry-date"><span class="kopa-minus"></span><?php the_time(get_option('date_format')) ?></span>
        <span class="entry-author">, <?php _e('by', kopa_get_domain()); ?> <?php the_author_posts_link(); ?></span>
        <span class="entry-comments"><?php echo KopaIcon::getIcon('comment', 'span'); ?><?php comments_popup_link(); ?></span>
        <span class="entry-view"><?php echo KopaIcon::getIcon('view', 'span'); ?><?php //echo kopa_get_view_count(get_the_ID()); ?></span>
    </header>

    <div class="clear"></div>

    <div class="elements-box mt-20">
        <?php
        $content = get_the_content();
        $content = preg_replace("/\[audio.*].*\[\/audio]/", '', $content);
        $content = preg_replace( '/\[audio.*]/', '', $content );
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]&gt;', $content);
        echo $content;
        ?>
    </div>

    <div class="wp-link-pages clearfix mt-20">
        <?php
        wp_link_pages(array(
            'before' => '<p>',
            'after' => '</p>',
            'pagelink' => __('Page %', kopa_get_domain())
        ));
        ?>
    </div>


    <footer class="clearfix">
<?php get_template_part('library/templates/template', 'post-navigation'); ?>
    </footer>

</div><!--entry-box-->