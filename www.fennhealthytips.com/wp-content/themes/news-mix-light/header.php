<!DOCTYPE html>
<html <?php language_attributes(); ?>>              
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">                   
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php kopa_print_page_title(); ?></title>     
        <link rel="profile" href="http://gmpg.org/xfn/11">           
        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">       
        <link rel="shortcut icon" type="image/x-icon"  href="<?php echo get_option('kopa_theme_options_favicon_url'); ?>">
        <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_option('kopa_theme_options_apple_iphone_icon_url'); ?>">
        <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_option('kopa_theme_options_apple_ipad_icon_url'); ?>">
        <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_option('kopa_theme_options_apple_iphone_retina_icon_url'); ?>">
        <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_option('kopa_theme_options_apple_ipad_retina_icon_url'); ?>">
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
            <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
            <script src="<?php echo get_template_directory_uri(); ?>/js/PIE_IE678.js"></script>
        <![endif]-->        
        <?php wp_head(); ?>
    </head>    
    <body <?php body_class(); ?>>



        <div class="wrapper kopa-shadow">

            <div class="row-fluid">

                <div class="span12 clearfix">



                    <header id="page-header">

                        <div id="header-top" class="clearfix">

                            <div class="kp-headline-wrapper clearfix">
                                <?php if ('show' == get_option('kopa_theme_options_display_headline_status', 'show')) { ?>
                                    <h6 class="kp-headline-title"><?php echo get_option('kopa_theme_options_headline_title', __('Breaking News', kopa_get_domain())); ?><span></span></h6>
                                <?php } // endif ?>
                                <div class="kp-headline clearfix">                        
                                    <dl class="ticker-1 clearfix">
                                        <?php
                                        if ('show' == get_option('kopa_theme_options_display_headline_status', 'show')) {
                                            $kopa_headline_category_id = (int) get_option('kopa_theme_options_headline_category_id');

                                            if ($kopa_headline_category_id) {
                                                $kopa_headline_posts = new WP_Query(array(
                                                    'cat' => $kopa_headline_category_id
                                                ));

                                                if ($kopa_headline_posts->have_posts()) {
                                                    while ($kopa_headline_posts->have_posts()) {
                                                        $kopa_headline_posts->the_post();
                                                        echo '<dd><a href="' . get_permalink() . '">' . get_the_title() . '</a></dd>';
                                                    }
                                                }

                                                wp_reset_postdata();
                                            } // endif
                                        } // endif
                                        ?>
                                    </dl><!--ticker-1-->
                                </div><!--kp-headline-->
                            </div><!--kp-headline-wrapper-->

                            <div class="social-search-box">
                                <?php
                                $kopa_facebook_url = esc_url(get_option('kopa_theme_options_social_links_facebook_url'));
                                $kopa_twitter_url = esc_url(get_option('kopa_theme_options_social_links_twitter_url'));
                                $kopa_youtube_url = esc_url(get_option('kopa_theme_options_social_links_youtube_url'));
                                $kopa_dribbble_url = esc_url(get_option('kopa_theme_options_social_links_dribbble_url'));
                                $kopa_flickr_url = esc_url(get_option('kopa_theme_options_social_links_flickr_url'));
                                $kopa_rss_url = get_option('kopa_theme_options_social_links_rss_url');
                                ?>

                                <ul class="social-links clearfix">
                                    <!-- facebook -->
                                    <?php
                                    if ($kopa_facebook_url) :
                                        echo sprintf('<li><a title="Facebook" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('facebook'), $kopa_facebook_url);
                                    endif;
                                    ?>

                                    <!-- twitter -->
                                    <?php
                                    if ($kopa_twitter_url) :
                                        echo sprintf('<li><a title="Twitter" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('twitter'), $kopa_twitter_url);
                                    endif;
                                    ?>

                                    <!-- youtube -->
                                    <?php
                                    if ($kopa_youtube_url) :
                                        echo sprintf('<li><a title="Youtube" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('youtube'), $kopa_youtube_url);
                                    endif;
                                    ?>

                                    <!-- dribbble -->
                                    <?php
                                    if ($kopa_dribbble_url) :
                                        echo sprintf('<li><a title="Dribbble" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('dribbble'), $kopa_dribbble_url);
                                    endif;
                                    ?>

                                    <!-- flickr -->
                                    <?php
                                    if ($kopa_flickr_url) :
                                        echo sprintf('<li><a title="Flickr" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('flickr'), $kopa_flickr_url);
                                    endif;
                                    ?>

                                    <!-- rss -->
                                    <?php
                                    if (empty($kopa_rss_url)) :
                                        echo sprintf('<li><a title="RSS" href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('rss'), get_bloginfo('rss2_url'));
                                    elseif ($kopa_rss_url != 'HIDE') :
                                        echo sprintf('<li><a href="%2$s" target="_blank" rel="nofollow" >%1$s</a></li>', KopaIcon::getIcon('rss'), esc_url($kopa_rss_url));
                                    endif;
                                    ?>
                                </ul><!--social-links-->

                                <div class="sb-search-wrapper">
                                    <div id="sb-search" class="sb-search">
                                        <form method="get" action="<?php echo esc_url(home_url()); ?>">
                                            <input class="sb-search-input" placeholder="<?php _e('Enter your search term...', kopa_get_domain()); ?>" type="text" value="" name="s" id="search">
                                            <input class="sb-search-submit" type="submit" value="">
                                            <span class="sb-icon-search"></span>
                                        </form>
                                    </div><!--sb-search-->
                                </div><!--sb-search-wrapper-->

                            </div><!--social-search-box-->                    

                        </div><!--header-top-->

                        <div id="header-middle" class="clearfix">
                            <div id="logo-image">
                                <?php if (get_header_image()) { ?>
                                    <a href="<?php echo esc_url(home_url()); ?>">
                                        <img src="<?php header_image(); ?>" width="217" height="70" alt="<?php bloginfo('name'); ?> <?php _e('Logo', kopa_get_domain()); ?>">
                                    </a>
                                <?php } ?>
                                <h1 class="site-title"><a href="<?php echo esc_url(home_url()); ?>"><?php bloginfo('name'); ?></a></h1>
                            </div>
                            <div class="top-banner">

                                <?php echo htmlspecialchars_decode(stripslashes(get_option('kopa_theme_options_top_banner_code'))); ?>

                            </div><!--top-banner-->

                        </div><!--header-middle-->

                        <div id="header-bottom">

                            <nav id="main-nav">

                                <?php
                                if (has_nav_menu('main-nav')) {
                                    wp_nav_menu(array(
                                        'theme_location' => 'main-nav',
                                        'container' => '',
                                        'menu_id' => 'main-menu',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s clearfix">%3$s</ul>',
                                        'after' => '<span></span>'
                                    ));

                                    $mobile_menu_walker = new kopa_mobile_menu();
                                    wp_nav_menu(array(
                                        'theme_location' => 'main-nav',
                                        'container' => 'div',
                                        'container_id' => 'mobile-menu',
                                        'menu_id' => 'toggle-view-menu',
                                        'items_wrap' => '<span>' . __('Menu', kopa_get_domain()) . '</span><ul id="%1$s">%3$s</ul>',
                                        'walker' => $mobile_menu_walker
                                    ));
                                }
                                ?>

                            </nav><!--main-nav-->

                        </div><!--header-bottom-->

                    </header><!--page-header-->



                    <div id="main-content">