<?php if ( have_posts() ) : while( have_posts() ) : the_post(); ?>

    <li id="li-post-<?php the_ID(); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('entry-item clearfix'); ?>>
            <div class="entry-thumb">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-4'); // 53x53 ?>" alt="<?php echo get_the_title(); ?>">
                    </a>
                    <div class="meta-box">
                        <span class="entry-comments"><?php echo KopaIcon::getIcon('comment','span'); ?><?php comments_popup_link(); ?></span>
                        <span class="entry-view"><?php echo KopaIcon::getIcon('view','span'); ?><?php echo kopa_get_view_count( get_the_ID() ); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            <div class="entry-content">
                <header>
                    <h4 class="entry-title"><a href="<?php the_permalink(); ?>"><?php echo (is_search())? kopa_highlight_search_title(): get_the_title(); ?></a></h4>
                    <span class="entry-categories"><?php the_category(', '); ?></span>
                    <span class="entry-date"><span class="kopa-minus"></span><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></span>
                    <span class="entry-author">, <?php _e( 'by', kopa_get_domain() ); ?> <?php the_author_posts_link(); ?></span>
                </header>
                <?php echo (is_search())? kopa_highlight_search_excerpt(): get_the_excerpt(); ?>
            </div>
        </article>
    </li>

<?php endwhile; else : ?>

    <?php get_search_form(); ?>

<?php endif; ?>