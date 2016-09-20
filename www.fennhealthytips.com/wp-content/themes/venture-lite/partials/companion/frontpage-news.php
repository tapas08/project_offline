<?php if ((nimbus_get_option('fp-news-toggle') == '1') || (nimbus_get_option('fp-news-toggle') == '')) { ?>
    <?php if ( get_option( 'show_on_front' ) == 'page' ) { ?>
        <section id="<?php if (nimbus_get_option('fp-news-slug')=='') {echo "news";} else {echo esc_attr(nimbus_get_option('fp-news-slug'));} ?>" class="frontpage-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (nimbus_get_option('fp-news-title') != '') { ?>
                            <div class="news-title h1"><?php echo esc_html(nimbus_get_option('fp-news-title')); ?></div>
                        <?php } ?>
                        <?php if (nimbus_get_option('fp-news-sub-title') != '') { ?>
                            <div class="news-sub-title h4"><?php echo esc_html(nimbus_get_option('fp-news-sub-title')); ?></div>
                        <?php } ?>
                        <?php
                            $posts_per_page = 4;
                            $posts_per_row = ceil($posts_per_page / 2);
                            $i = 1;
                            $custom_args = array('posts_per_page' => $posts_per_page);
                            $custom_query = new WP_Query( $custom_args );
                            if ( $custom_query->have_posts() ) {
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 left_blog_column">
                                        <?php
                                        while ( $custom_query->have_posts() ) {
                                            $custom_query->the_post();
                                            if ($i == ($posts_per_row + 1)) {
                                                echo "</div><div class='col-sm-6 right_blog_column'>";
                                            }
                                            get_template_part( 'partials/frontpage','news-layout'); 
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            } else { ?>
                                    <p><?php _e('No posts found.', 'venture-lite' ); ?></p>
                            <?php }
                            wp_reset_postdata();
                            ?>
                    </div> 
                </div>    
            </div>    
        </section>
    <?php } else { ?>
        <section id="<?php if (nimbus_get_option('fp-news-slug')=='') {echo "news";} else {echo esc_attr(nimbus_get_option('fp-news-slug'));} ?>" class="frontpage-news">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php if (nimbus_get_option('fp-news-title') != '') { ?>
                            <div class="news-title h1"><?php echo esc_html(nimbus_get_option('fp-news-title')); ?></div>
                        <?php } else { ?>
                            <div class="news-title h1"><?php _e('Latest Articles', 'venture-lite' ); ?></div>
                        <?php } ?>
                        <?php if (nimbus_get_option('fp-news-sub-title') != '') { ?>
                            <div class="news-sub-title h4"><?php echo esc_html(nimbus_get_option('fp-news-sub-title')); ?></div>
                        <?php } else { ?>
                            <div class="news-sub-title h4"><?php _e('Get up to date with the latest news from our newsroom.', 'venture-lite' ); ?></div>
                        <?php } ?>
                        <?php
                            $posts_per_page = get_option( 'posts_per_page' );
                            $post_count = $wp_query->post_count;
                            if ($posts_per_page > $post_count) {
                                $posts_per_page = $post_count;
                            }
                            $posts_per_row = ceil($posts_per_page / 2);
                            $i = 1;
                            if (have_posts()) {
                                ?>
                                <div class="row">
                                    <div class="col-sm-6 left_blog_column">
                                        <?php
                                        while (have_posts()) {
                                            the_post();
                                            if ($i == ($posts_per_row + 1)) {
                                                echo "</div><div class='col-sm-6 right_blog_column'>";
                                            }
                                            get_template_part( 'partials/frontpage','news-layout');
                                            $i++;
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="feed_pagination row">
                                    <div class="col-md-6">
                                        <?php next_posts_link(__('&laquo; Older Entries', 'venture-lite')) ?>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <?php previous_posts_link(__('Newer Entries &raquo;', 'venture-lite')) ?>
                                    </div>
                                </div>
                                <?php
                            } else { ?>
                                    <p><?php _e('No posts found.', 'venture-lite'); ?></p>
                            <?php }
                            ?>
                    </div> 
                </div>    
            </div>    
        </section>
    <?php } ?>
<?php } else if (nimbus_get_option('fp-news-toggle') == '2') {
    // Don't do anything
}  ?>