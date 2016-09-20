<?php get_header(); ?>
<?php get_template_part( 'partials/subpage','banner'); ?>
<div class="sub-background">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="post-detail" id="singular-<?php the_ID(); ?>">
                    <?php if ( have_posts() ) :  ?> 
                        <?php while ( have_posts() ) : 
                            the_post(); ?>
                            <div class="archive-singular-wrap" id="singular-<?php the_ID(); ?>">
                                <?php get_template_part( 'partials/img','750x420'); ?>
                                <div>
                                    <?php get_template_part( 'partials/meta'); ?>
                                    <div class="full-detail"><?php the_content(); ?></div>
                	                <?php wp_link_pages(); ?>
                                    <?php if (is_page()){ wp_link_pages( array( 'before' => '<div class="wp_link_pages">' . __( 'Pages:', 'venture-lite' ),'after'  => '</div>',) ); } ?>
                                    <?php if ( has_tag() ) { ?>
                                        <hr>
                                        <?php the_tags( '<div class="tags"><span class="tag">', '</span><span class="tag">','</span></div>' ); ?> 
                                    <?php } ?>
                                    <?php if ( comments_open() || get_comments_number() != 0 ) { ?>
                                        <hr>
                                        <?php comments_template(); ?>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                    <p><?php _e('No posts found.', 'venture-lite' ); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-4 sidebar-primary">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>
