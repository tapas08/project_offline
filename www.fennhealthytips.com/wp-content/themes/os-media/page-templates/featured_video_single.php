<?php
/**
 * Template Name: Featured video single
 *
 * @package os_media
 * @since OS media 0.1
 *
 */

get_header(); 

?>

<div id="main-content" class="main-content">

    <div id="primary" class="content-area">
        <div id="content" class="site-content" role="main">

            <?php
            $mypost = array( 'post_type' => 'osmedia_cpt', 'showposts' => 1, 'paged' => $paged /*, 'category_name' => Featured */);
            $loop = new WP_Query( $mypost );
            while ( $loop->have_posts() ) : 
                $loop->the_post();
            ?>
            
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
                  <a class="post-thumbnail" href="<?php the_permalink(); ?>">
                  <?php
                    if (has_post_thumbnail( $post->ID )) {
                      $array_img_cover_url = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' ); 
                      $img_cover_url = $array_img_cover_url[0];
                    }else{
                      $img_cover_url = get_post_meta($post->ID, 'OSvid_img', true);
                    }
                      echo '<img src='.$img_cover_url.' />';  
                  ?>
                  <img src="<?php echo get_stylesheet_directory_uri() ?>/images/OS-frame-play.png" />
                  </a>

                  <header class="entry-header">

                    <div class="entry-meta">
                      <span class="cat-links"><?php echo get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'os_media' ) ); ?></span>
                    </div><!-- .entry-meta -->

                    <?php the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">','</a></h1>' ); ?>
                  </header><!-- .entry-header -->
                </article><!-- #post-## -->

            <?php endwhile; ?>

        </div><!-- #content -->
    </div><!-- #primary -->
</div><!-- #main-content -->

<?php
get_sidebar();
get_footer();