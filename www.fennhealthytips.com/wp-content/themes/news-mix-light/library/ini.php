<?php
$KOPA_LAYOUT = array(

    'blog' => array(
        'title' => __('Blog', kopa_get_domain()),
        'thumbnails' => 'blog.jpg',
        'positions' => array(
            'position_13'
        )
    ),
    'page-right-sidebar' => array(
        'title' => __('Page Right Sidebar', kopa_get_domain()),
        'thumbnails' => 'page.jpg',
        'positions' => array(
            'position_13'
        )
    ),
    'page-fullwidth' => array(
        'title' => __('Page Full Width', kopa_get_domain()),
        'thumbnails' => 'page-fullwidth.jpg',
        'positions' => array()
    ),
    'page-fullwidth-widget' => array(
        'title' => __('Page Full Width Widgets', kopa_get_domain()),
        'thumbnails' => 'page-fullwidth-widgets.jpg',
        'positions' => array(
            'position_17'
        )
    ),
    'single-right-sidebar' => array(
        'title' => __('Single', kopa_get_domain()),
        'thumbnails' => 'single.jpg',
        'positions' => array(
            'position_13'
        )
    ),
    'archive' => array(
        'title' => __('Archive', kopa_get_domain()),
        'thumbnails' => 'archive.jpg',
        'positions' => array(
            'position_13'
        )
    )
);

$KOPA_SIDEBAR_POSITION = array(
    
    'position_13' => array('title' => 'Widget Area 13'),
    
    'position_17' => array('title' => 'Widget Area 17'),
    
);

$KOPA_TEMPLATE_HIERARCHY = array(
    'home' => array(
        'title' => __('Home', kopa_get_domain()),
        'layout' => array('blog')
    ),
    
    'post' => array(
        'title' => __('Post', kopa_get_domain()),
        'layout' => array('single-right-sidebar')
    ),
    'page' => array(
        'title' => __('Page', kopa_get_domain()),
        'layout' => array( 'page-right-sidebar', 'page-fullwidth', 'page-fullwidth-widget')
    ),
    'taxonomy' => array(
        'title' => __('Taxonomy', kopa_get_domain()),
        'layout' => array('archive')
    ),
    'search' => array(
        'title' => __('Search', kopa_get_domain()),
        'layout' => array('archive')
    ),
    'archive' => array(
        'title' => __('Archive', kopa_get_domain()),
        'layout' => array('archive')
    )
);
$KOPA_SETTING = array(
    'home' => array(
        'layout_id' => 'blog',
        'sidebars' => array(
            'sidebar_13'
        )
    ),
    
    'post' => array(
        'layout_id' => 'single-right-sidebar',
        'sidebars' => array(
            'sidebar_13'
        ),
    ),
    'page' => array(
        'layout_id' => 'page-right-sidebar',
        'sidebars' => array(
            'sidebar_13'
        ),
    ),
    'taxonomy' => array(
        'layout_id' => 'archive',
        'sidebars' => array(
            'sidebar_13'
        ),
    ),
    'search' => array(
        'layout_id' => 'archive',
        'sidebars' => array(
            'sidebar_13'
        ),
    ),
    'archive' => array(
        'layout_id' => 'archive',
        'sidebars' => array(
            'sidebar_13'
        ),
    )
);
$KOPA_SIDEBAR = array(
    'sidebar_hide' => '-- None --',
    
    'sidebar_13' => __('Kopa Right Sidebar', kopa_get_domain()),
    'sidebar_17' => __('Kopa Page Fullwidth Sidebar',kopa_get_domain()),
    
);

$KOPA_SETTING = get_option('kopa_setting', $KOPA_SETTING);
$KOPA_SIDEBAR = get_option('kopa_sidebar', $KOPA_SIDEBAR);
if (!empty($KOPA_SIDEBAR)) {
    foreach ($KOPA_SIDEBAR as $key => $value) {
        if ('sidebar_hide' != $key) {
            register_sidebar(array(
                'name' => $value,
                'id' => $key,
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widget-title clearfix">
                                    <span class="title-line"></span>
                                    <span class="title-text">',
                'after_title' => '</span></h3>'
            ));
        }
    }
}


