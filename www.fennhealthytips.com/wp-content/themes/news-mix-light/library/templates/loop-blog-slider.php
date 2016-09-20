<?php 
$kopa_blog_slider_category_id = (int) get_option( 'kopa_theme_options_blog_slider_category_id' );

$kopa_blog_slider_posts = new WP_Query( array(
    'cat' => $kopa_blog_slider_category_id
) );

if ( $kopa_blog_slider_posts->have_posts() ) : while ( $kopa_blog_slider_posts->have_posts() ) : $kopa_blog_slider_posts->the_post(); 
    
    if ( has_post_thumbnail() ) :
?>
        <li>
            <article class="entry-item">
                <a href="<?php the_permalink(); ?>"><img src="<?php echo kopa_get_image_src(get_the_ID(),'kopa-image-size-6'); ?>" alt="<?php echo get_the_title(); ?>"></a>
                <h3 class="flex-caption"><a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a></h3>
            </article>
        </li>
<?php 
    endif; 
endwhile; endif;

wp_reset_postdata();
?>