<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <?php get_template_part( 'library/templates/content-single', get_post_format() ); ?>

    <div class="tag-box">
        <?php the_tags('', ' '); ?>
    </div><!--tag-box-->
    
    <?php if ( get_option( 'kopa_theme_options_post_about_author', 'show' ) == 'show' ) : ?>
        <div class="about-author clearfix">
            <h3><?php _e( 'Author', kopa_get_domain() ); ?></h3>
            <div class="about-author-detail clearfix">
                <a class="avatar-thumb" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php echo get_avatar( get_the_author_meta( 'ID' ), 82 ); ?></a>                                
                <div class="author-content">
                    <header>                                
                        <a class="author-name" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta( 'display_name' ); ?></a>                                        
                    </header>
                    <p><?php the_author_meta( 'description' ); ?></p>
                    <ul class="social-link clearfix">
                        <?php 
                        $author_facebook = esc_url( get_the_author_meta( 'facebook' ) );
                        $author_twitter = esc_url( get_the_author_meta( 'twitter' ) );
                        $author_gplus = esc_url( get_the_author_meta( 'google-plus' ) );
                        $author_flickr = esc_url( get_the_author_meta( 'flickr' ) );
                        ?>
                        <?php if ( $author_facebook ) : ?>
                            <li><a href="<?php echo $author_facebook; ?>" ><?php echo KopaIcon::getIcon('facebook'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_twitter ) : ?>
                            <li><a href="<?php echo $author_twitter; ?>" ><?php echo KopaIcon::getIcon('twitter'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_gplus ) : ?>
                            <li><a href="<?php echo $author_gplus; ?>" ><?php echo KopaIcon::getIcon('google-plus'); ?></a></li>
                        <?php endif; ?>
                        
                        <?php if ( $author_flickr ) : ?>
                            <li><a href="<?php echo $author_flickr; ?>" ><?php echo KopaIcon::getIcon('flickr'); ?></a></li>
                        <?php endif; ?>
                    </ul>                                
                </div><!--author-content-->
            </div><!--about-author-detail-->
        </div><!--about-author-->
    <?php endif; ?>

    <?php kopa_get_related_articles(); ?>

    
    <?php if(comments_open()){ ?>
    <?php comments_template(); ?>
    <?php } ?>

<?php endwhile; else : ?>

<?php endif; ?>