<?php if ((is_front_page() && is_paged()) || !is_front_page()) { get_template_part( 'partials/subpage','banner'); } ?>
<div class="sub-background">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <div class="post-detail">
                <?php if ( have_posts() ) :  ?>	
                	<?php while ( have_posts() ) : 
                        the_post(); ?>
                        <div class="archive-singular-wrap" id="singular-<?php the_ID(); ?>">
                            <?php get_template_part( 'partials/img','750x420'); ?>
                            <div>
                                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <?php get_template_part( 'partials/meta'); ?>
                                <?php if (nimbus_get_option('full-excerpt')=="2") { ?>
                                    <p class="excerpt"> <?php echo get_the_excerpt() ?></p>
                                    <p class="archive-link-button"><a href="<?php the_permalink(); ?>"><?php _e('Read More >>', 'venture-lite' ); ?></a></p>                       
                                <?php } else { ?>
                                    <div class="full-detail"><?php the_content(); ?></div> 
                                <?php } ?>
                            </div>
                        </div>
                	<?php endwhile; ?>
                	<div class="paginate_links_wrap">
                	<?php 
                	global $wp_query;
                    $big = 999999999;
                    echo paginate_links( array(
                    	'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                    	'format' => '?paged=%#%',
                    	'current' => max( 1, get_query_var('paged') ),
                    	'total' => $wp_query->max_num_pages
                    ) ); ?>
                    </div>
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