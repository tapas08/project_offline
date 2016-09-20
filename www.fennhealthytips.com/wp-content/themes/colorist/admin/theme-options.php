<?php
/**
 * Created by PhpStorm.
 * User: venkat
 * Date: 2/5/16
 * Time: 4:32 PM        
 */
       
include_once( get_template_directory() . '/admin/kirki/kirki.php' );     
include_once( get_template_directory() . '/admin/kirki-helpers/class-colorist-kirki.php' );

Colorist_Kirki::add_config( 'colorist', array(     
	'capability'    => 'edit_theme_options',                  
	'option_type'   => 'theme_mod',          
) );               
     
// colorist option start //   

//  site identity section // 

Colorist_Kirki::add_section( 'title_tagline', array(
	'title'          => __( 'Site Identity','colorist' ),
	'description'    => __( 'Site Header Options', 'colorist'),       
	'priority'       => 8,         																																																																																																																																	
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'logo_title',
	'label'    => __( 'Enable Logo as Title', 'colorist' ),
	'section'  => 'title_tagline',
	'type'     => 'switch',
	'priority' => 5,
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',   
) );  
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'tagline',
	'label'    => __( 'Show site Tagline', 'colorist' ), 
	'section'  => 'title_tagline',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'on',
) );

// home panel //

Colorist_Kirki::add_panel( 'home_options', array(     
	'title'       => __( 'Home', 'colorist' ),
	'description' => __( 'Home Page Related Options', 'colorist' ),     
) );  

// home page type section

Colorist_Kirki::add_section( 'home_type_section', array(
	'title'          => __( 'General Settings','colorist' ),
	'description'    => __( 'Home Page options', 'colorist'),
	'panel'          => 'home_options', // Not typically needed. 
) );


Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_home_default_content',
	'label'    => __( 'Enable Home Page Default Content', 'colorist' ),
	'section'  => 'home_type_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'off',
	'tooltip' => __('Enable home page default content ( home page content )','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'home_sidebar',
	'label'    => __( 'Enable sidebar on the Home page', 'colorist' ),
	'section'  => 'home_type_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off', 
	'tooltip' => __('Disable by default. If you want to display the sidebars in your frontpage, turn this Enable.','colorist'),
) );

// Slider section

Colorist_Kirki::add_section( 'slider_section', array(
	'title'          => __( 'Slider Section','colorist' ),
	'description'    => __( 'Home Page Slider Related Options', 'colorist'),
	'panel'          => 'home_options', // Not typically needed. 
) );
Colorist_Kirki::add_field( 'colorist', array(  
	'settings' => 'enable_slider',
	'label'    => __( 'Enable Slider Post ( Section )', 'colorist' ),
	'section'  => 'slider_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ),
	),
	'default'  => 'on',
	'tooltip' => __('Enable Slider Post in home page','colorist'),
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'slider_cat',
	'label'    => __( 'Slider Posts category', 'colorist' ),
	'section'  => 'slider_section',
	'type'     => 'select',
	'choices' => Kirki_Helper::get_terms( 'category' ),
	'active_callback' => array(
		array(
			'setting'  => 'enable_slider',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Create post ( Goto Dashboard => Post => Add New ) and Post Featured Image ( Preferred size is 1200 x 450 pixels ) as taken as slider image and Post Content as taken as Flexcaption.','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'slider_count',
	'label'    => __( 'No. of Sliders', 'colorist' ),
	'section'  => 'slider_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 999,
		'step' => 1,
	),
	'default'  => 2,
	'active_callback' => array(
		array(
			'setting'  => 'enable_slider',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Enter number of slides you want to display under your selected Category','colorist'),
) );


     
// service section 

Colorist_Kirki::add_section( 'service_section', array(
	'title'          => __( 'Service Section','colorist' ),
	'description'    => __( 'Home Page - Service Related Options', 'colorist'),
	'panel'          => 'home_options', // Not typically needed. 
) );

Colorist_Kirki::add_field( 'colorist', array( 
	'settings' => 'enable_service',
	'label'    => __( 'Enable Service Section', 'colorist' ),
	'section'  => 'service_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	
	'default'  => 'on',
	'tooltip' => __('Enable service section in home page','colorist'),
) ); 
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'service_count',
	'label'    => __( 'No. of Service Section', 'colorist' ),
	'description' => __('Save the Settings, and Reload this page to Configure the service section','colorist'),
	'section'  => 'service_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 3,
		'max' => 99,
		'step' => 3,
	),
	'default'  => 3,
	'active_callback' => array(
		array(
			'setting'  => 'enable_service',
			'operator' => '==',
			'value'    => true,
		),
		
    ),
    'tooltip' => __('Enter number of service page you want to display','colorist'),
) );

if ( get_theme_mod('service_count') > 0 ) {
 $service = get_theme_mod('service_count');
 		for ( $i = 1 ; $i <= $service ; $i++ ) {
             //Create the settings Once, and Loop through it.
 			Colorist_Kirki::add_field( 'colorist', array(
				'settings' => 'service_'.$i,
				'label'    => sprintf(__( 'Service Section #%1$s', 'colorist' ), $i ),
				'section'  => 'service_section',
				'type'     => 'dropdown-pages',	
				//'tooltip' => __('Create Page ( Goto Dashboard => Page =>Add New ) and Page Featured Image ( Preferred size is 100 x 100 pixels )','colorist'),
				'active_callback' => array(
					array(
						'setting'  => 'enable_service',
						'operator' => '==',
						'value'    => true,
					),
					
                ), 
               // 'description' => __('Create Page ( Goto Dashboard => Page =>Add New ) and Page Featured Image ( Preferred size is 100 x 100 pixels )','colorist'),
        
			) );
 		}
}

// latest blog section 

Colorist_Kirki::add_section( 'latest_blog_section', array(
	'title'          => __( 'Latest Blog Section','colorist' ),
	'description'    => __( 'Home Page - Latest Blog Options', 'colorist'),
	'panel'          => 'home_options', // Not typically needed. 
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_recent_post_service',
	'label'    => __( 'Enable Recent Post Section', 'colorist' ),
	'section'  => 'latest_blog_section',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	
	'default'  => 'on',
	'tooltip' => __('Enable recent post section in home page','colorist'),
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'recent_posts_count',
	'label'    => __( 'No. of Recent Posts', 'colorist' ),
	'section'  => 'latest_blog_section',
	'type'     => 'number',
	'choices' => array(
		'min' => 3,
		'max' => 99,
		'step' => 3,
	),
	'default'  => 4,
	'active_callback' => array(
		array(
			'setting'  => 'enable_recent_post_service',
			'operator' => '==',
			'value'    => true,
		),
		
    ),
) );

// general panel   

Colorist_Kirki::add_panel( 'general_panel', array(   
	'title'       => __( 'General Settings', 'colorist' ),  
	'description' => __( 'general settings', 'colorist' ),         
) );

//  Page title bar section // 

Colorist_Kirki::add_section( 'header-pagetitle-bar', array(   
	'title'          => __( 'Page Title Bar & Breadcrumb','colorist' ),
	'description'    => __( 'Page Title bar related options', 'colorist'),
	'panel'          => 'general_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'page_titlebar',  
	'label'    => __( 'Page Title Bar', 'colorist' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( 'Show Bar and Content', 'colorist' ),
		2 => __( 'Show Content Only ', 'colorist' ),
		3 => __('Hide','colorist'),
    ),
    'default' => 1,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'page_titlebar_text',  
	'label'    => __( 'Page Title Bar Text', 'colorist' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( 'Show', 'colorist' ),
		2 => __( 'Hide', 'colorist' ), 
    ),
    'default' => 1,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'breadcrumb',  
	'label'    => __( 'Breadcrumb', 'colorist' ),
	'section'  => 'header-pagetitle-bar', 
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ),
	),
	'default'  => 'on',
) ); 

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'breadcrumb_char',
	'label'    => __( 'Breadcrumb Character', 'colorist' ),
	'section'  => 'header-pagetitle-bar',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		1 => __( ' >> ', 'colorist' ),
		2 => __( ' / ', 'colorist' ),
		3 => __( ' > ', 'colorist' ),
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'breadcrumb',
			'operator' => '==',
			'value'    => true,
		),
	),
	//'sanitize_callback' => 'allow_htmlentities'
) );

//  pagination section // 

Colorist_Kirki::add_section( 'general-pagination', array(   
	'title'          => __( 'Pagination','colorist' ),
	'description'    => __( 'Pagination related options', 'colorist'),
	'panel'          => 'general_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'numeric_pagination',
	'label'    => __( 'Numeric Pagination', 'colorist' ),   
	'section'  => 'general-pagination',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Numbered', 'colorist' ),
		'off' => esc_attr__( 'Next/Previous', 'colorist' )
	),
	'default'  => 'on',
) );

// skin color panel 

Colorist_Kirki::add_panel( 'skin_color_panel', array(   
	'title'       => __( 'Skin Color', 'colorist' ),  
	'description' => __( 'Color Settings', 'colorist' ),         
) );

// Change Color Options

Colorist_Kirki::add_section( 'primary_color_field', array(
	'title'          => __( 'Change Color Options','colorist' ),
	'description'    => __( 'This will reflect in links, buttons,Navigation and many others. Choose a color to match your site.', 'colorist'),
	'panel'          => 'skin_color_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_primary_color',
	'label'    => __( 'Enable Custom Primary color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'primary_color',
	'label'    => __( 'Primary color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#eb416b',
	'alpha'  => true,
	'active_callback' => array(
		array (
			'setting'  => 'enable_primary_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element'  => '.comment-respond input[type="email"]:focus,
							.comment-respond input[type="text"]:focus,.comment-respond input[type="url"]:focus,.comment-respond textarea:focus,.bypostauthor article .comment-content,
						    .widget_image-box-widget .image-box img,
						    .widget.widget_skill-widget .skill-container .skill .skill-percentage::after,
						    .toggle-normal .toggle-title,.cnt-address .fa,.widget_calendar caption,
						    ol.webulous_page_navi li a:hover',
			'property' => 'border-color',
		),
		array(
			'element'  => '.main-navigation a:hover,.main-navigation .current_page_item a, .main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a,input[type="button"],input[type="reset"],input[type="submit"],.main-navigation ul ul li,.sub-menu .current_page_item > a,.sub-menu .current-menu-item > a,.sub-menu .current_page_ancestor > a,.site-content .navigation .nav-links a:hover,.site-content .more-link:hover, 
							.page-links a:hover,ol.webulous_page_navi li a:hover,ol.webulous_page_navi li.bpn-current,
							.home .free-home #primary .post-wrapper .latest-post .latest-post-content p a:hover,#primary .sticky,.site-footer .circle-icon-box a.more-button:hover,
							a.more-button,.site-footer .flex-direction-nav a.flex-next:hover,.site-footer .flex-direction-nav a.flex-prev:hover,
							.ui-accordion h3,.ui-accordion h3 span .fa,.ui-accordion .ui-accordion-header-active,.notice,.btn,
							.widget_button-widget a.btn.btn-default,.callout-widget,.wide-cta,.circle-icon-box a.more-button:hover,.circle-icon-box:hover .circle-icon-wrapper .fa-stack i,.circle-icon-box:hover a.more-button,.dropcap-circle,
							.dropcap-box,.widget_flexslider-widget .flexcarousel .flex-direction-nav a:hover,.icon-horizontal:hover .more-button a, .icon-vertical:hover .more-button a,.widget_image-box-widget a.more-button,.sub-menu .current_page_item > a, .sub-menu .current-menu-item > a, .sub-menu .current_page_ancestor > a,.portfolioeffects .overlay_icon a:hover,.widget_recent-work-widget .portfolioeffects .overlay_icon a:hover, .widget_recent-work-widget .work .overlay_icon a:hover,
							.widget.widget_skill-widget .skill-container .skill .skill-percentage,.widget_social-networks-widget ul li a:hover, .share-box ul li a:hover,.widget_stat-widget .stat-container .icon-wrapper h5::after,.tabs-container ul.tabs li.ui-tabs-active a,.tabs-container ul.tabs li a:hover,.tabs-container.center ul.tabs li a,.toggle-normal .toggle-title::before,.withtip::before,
							.service-features .service:hover .fa-stack,#secondary .left-sidebar .callout-widget,.widget_calendar #today,.widget_tag_cloud a,.top-nav ul li:hover a,.order-total .amount,
							.cart-subtotal .amount,.home .flexslider .flex-control-paging li .flex-active,.home .site-content #primary .post-wrapper .latest-post .latest-post-content p a:hover,.main-navigation ul ul a:hover,
							.woocommerce #content div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce-page div.product .woocommerce-tabs ul.tabs li a:hover,
							.woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active,
							.woocommerce-page div.product .woocommerce-tabs ul.tabs li.active,.woocommerce #content nav.woocommerce-pagination ul li a:focus,
							.woocommerce #content nav.woocommerce-pagination ul li a:hover,
							.woocommerce #content nav.woocommerce-pagination ul li span.current,
							.woocommerce nav.woocommerce-pagination ul li a:focus,
							.woocommerce nav.woocommerce-pagination ul li a:hover,
							.woocommerce nav.woocommerce-pagination ul li span.current,
							.woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
							.woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
							.woocommerce-page #content nav.woocommerce-pagination ul li span.current,
							.woocommerce-page nav.woocommerce-pagination ul li a:focus,
							.woocommerce-page nav.woocommerce-pagination ul li a:hover,
							.woocommerce-page nav.woocommerce-pagination ul li span.current,
							.site-footer .scroll-to-top,
							.site-footer .scroll-to-top:hover',																				
			'property' => 'background-color',
		),
		array(
			'element'  => '.main-navigation a:hover::after,
							 .main-navigation .current_page_item > a::after,
							 .main-navigation .current-menu-item > a::after,
							 .main-navigation .current_page_ancestor > a::after,
							 .main-navigation .current_page_parent > a::after ',
			'property' => 'border-left-color',
		),
		array(
			'element'  => 'a,th a,button,.required,
							.site-header .branding .site-branding .site-title a,.site-title span,.page-template-blog-fullwidth .site-main .entry-body h1 a:hover,
							.page-template-blog-large .site-main .entry-body h1 a:hover,.blog .site-main .entry-body h1 a:hover,#recentcomments a,
							.comment-author cite.fn a:hover,.comment-author b,.comment-author a,.comment-metadata a:hover,.comment-metadata.reply a,
							.home .free-home #primary .post-wrapper .latest-post .latest-post-content h1 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h2 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h3 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h4 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h5 a:hover,.home .free-home #primary .post-wrapper .latest-post .latest-post-content h6 a:hover,
							.entry-content blockquote:before,.site-footer .dropcap,.widget_testimonial-widget .testimony .t-inner::before,.site-footer .widget_testimonial-widget p.client,.notice a:hover,.breadcrumb-wrap #breadcrumb a:hover i,.circle-icon-box .circle-icon-wrapper .fa-stack i,
							.circle-icon-box:hover a.link-title,.circle-icon-box:hover a.link-title h4,.circle-icon-box:hover h4,.icon-horizontal a.link-title i, .icon-horizontal .icon-title i, .icon-horizontal .fa-stack i, .icon-vertical a.link-title i, .icon-vertical .icon-title i, .icon-vertical .fa-stack i,.icon-horizontal:hover a.link-title, .icon-horizontal:hover .icon-title, .icon-horizontal:hover .fa-stack, .icon-vertical:hover a.link-title, .icon-vertical:hover .icon-title, .icon-vertical:hover .fa-stack,
							.pullright::before,.pullleft::before,.pullnone::before,.recent-post .rp-content h4:hover,.recent-post .rp-content a:hover h4,.recent-post .rp-content .entry-date,ul.filter-options li a:hover,.widget_stat-widget .stat-container .icon-wrapper i,.toggle-normal .toggle-title:hover,.widget_list-widget ul li .fa,.widget_list-widget ol li .fa,.widget_rss a,.widget-area ul a:hover,.recentcomments a,.site-footer .footer-widgets a:hover, .site-info a,
							.home .site-content #primary .post-wrapper .latest-post .latest-post-content h1 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h2 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h3 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h4 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h5 a:hover, .home .site-content #primary .post-wrapper .latest-post .latest-post-content h6 a:hover,
							#primary .entry-title a:hover,.widget-area .left-sidebar ul a:hover,#recentcomments a,.order-total .amount,
					        .cart-subtotal .amount,.woocommerce #content table.cart a.remove,
							.woocommerce table.cart a.remove,
							.woocommerce-page #content table.cart a.remove,
							.woocommerce-page table.cart a.remove,.star-rating',
			'property' => 'color',
		),
		array(
			'element'  => '.breadcrumb-wrap #breadcrumb a:hover',
			'property' => 'color',
			'suffix' => '!important',
		),
		array(
			'element'  => '.woocommerce #content input.button:hover,
							.woocommerce #respond input#submit:hover,
							.woocommerce a.button:hover,
							.woocommerce button.button:hover,
							.woocommerce input.button:hover,
							.woocommerce-page #content input.button:hover,
							.woocommerce-page #respond input#submit:hover,
							.woocommerce-page a.button:hover,
							.woocommerce-page button.button:hover,
							.woocommerce-page input.button:hover,.home .flexslider .slides .flex-caption p a',
			'property' => 'background-color',
			'suffix' => '!important',
		),
		array(
			'element' => '.entry-content blockquote,.sep:after,.pullright, .pullleft, .pullnone,.withtip.top:after',
			'property' => 'border-top-color',
		),
		array(
			'element' => '.main-navigation a:hover,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,ul.filter-options li a,.main-navigation .current_page_item a, .main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a',
			'property' => 'border-bottom-color',
		),
		array(
			'element' => '.withtip.right:after ',
			'property' => 'border-right-color',
		),
		array(
			'element' => '.ui-accordion .ui-accordion-content::before,.tabs-container ul.tabs li.ui-tabs-active a::after,.tabs-container ul.tabs li a:hover::after,.withtip.left:after',
			'property' => 'border-left-color',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_nav_bar_color',
	'label'    => __( 'Enable Navigation Bar hover Color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'nav_bar_color',
	'label'    => __( 'Navigation Bar hover Color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#242424',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_nav_bar_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '#nav-wrap .main-navigation ul li a:hover',
			'property' => 'background-color',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_dd_bg_color',
	'label'    => __( 'Enable Navigation DropDown Background color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );    
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'dd_bg_color',
	'label'    => __( 'Navigation DropDown Background color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_dd_bg_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => '.main-navigation .nav-menu li .sub-menu li ',
			'property' => 'background-color',
			'suffix' => '!important',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_secondary_color',
	'label'    => __( 'Enable Custom Secondary color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'secondary_color',
	'label'    => __( 'Secondary Color', 'colorist' ),
	'section'  => 'primary_color_field',
	'type'     => 'color',
	'default'  => '#1e1e1e',
	'alpha'  => true,
	'active_callback' => array(
		array(
			'setting'  => 'enable_secondary_color',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output' => array(
		array(
			'element' => 'button,input,select,textarea,table tr th:hover a,.site-footer a.more-button:hover,
							.site-footer .widget_social-networks-widget ul li a:hover i,.left-sidebar .circle-icon-box:hover .icon-wrapper p.fa-stack i:before,.comment-list > li article .comment-meta .comment-author cite.fn a,.comment-list > li article .comment-meta .comment-author b:hover,.comment-list > li article .comment-meta .comment-author a:hover,
							.comment-list > li article .comment-meta .comment-metadata .reply a:hover,  .comment-respond input[type="email"]:focus,.comment-respond input[type="text"]:focus,
							.comment-respond input[type="url"]:focus,.comment-respond textarea:focus,#primary .sticky a:hover, #primary .sticky span:hover, #primary .sticky time:hover,.page-template-blog-fullwidth .site-main .entry-body h1 a,.page-template-blog-large .site-main .entry-body h1 a, .blog .site-main .entry-body h1 a,.recentcomments a:hover,.widget_rss a:hover,.widget_tag_cloud a:hover,.site-footer .footer-widgets .recentcomments a,.site-footer .footer-widgets .widget_archive select, .site-footer .footer-widgets .widget_categories select, .site-footer .footer-widgets .textwidget select,
							.site-footer .footer-widgets .widget_tag_cloud a:hover,.site-footer .footer-widgets .widget_rss ul a,.site-info a:hover',
			'property' => 'color',
		),
		array(
			'element' => 'button:hover,input[type="button"]:hover,input[type="reset"]:hover,input[type="submit"]:hover,ol.webulous_page_navi li a,
							.flexslider .flex-caption a:hover,.btn:hover,.widget_button-widget a.btn.btn-default:hover,#secondary .left-sidebar .callout-widget a:hover,.comment-respond input[type="email"],.comment-respond input[type="text"],
							.comment-respond input[type="url"],.comment-respond textarea,.widget_text .textwidget p.btn-more a,.top-features a.more-button:hover,#secondary select, .footer-widgets select ',
			'property' => 'background-color',
		),
       array(
			'element' => 'abbr, acronym',
			'property' => 'border-bottom-color',
		),
        array(
			'element' => '.page-numbers:last-child ',
			'property' => 'border-right-color',
		),
		array(
			'element' => 'button:focus,input[type="button"]:focus,input[type="reset"]:focus,input[type="submit"]:focus,button:active,
						input[type="button"]:active,input[type="reset"]:active,input[type="submit"]:active,
						.page-numbers,.widget_testimonial-widget .testimony,.widget_image-box-widget a.more-button:hover',
			'property' => 'border-color',
		),
	),
) );
// typography panel //

Colorist_Kirki::add_panel( 'typography', array( 
	'title'       => __( 'Typography', 'colorist' ),
	'description' => __( 'Typography and Link Color Settings', 'colorist' ),
) );
   
    Colorist_Kirki::add_section( 'typography_section', array(
		'title'          => __( 'General Settings','colorist' ),
		'description'    => __( 'General Settings', 'colorist'),
		'panel'          => 'typography', // Not typically needed.
	) );
	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'custom_typography',
		'label'    => __( 'Enable Custom Typography', 'colorist' ),
		'description' => __('Save the Settings, and Reload this page to Configure the typography section','colorist'),
		'section'  => 'typography_section',
		'type'     => 'switch',
		'choices' => array(
			'on'  => esc_attr__( 'Enable', 'colorist' ),
			'off' => esc_attr__( 'Disable', 'colorist' )
		),
		'tooltip' => __('Turn on to customize typography and turn off for default typography','colorist'),
		'default'  => 'off',
	) );

$typography_setting = get_theme_mod('custom_typography',false );
if( $typography_setting ) :

        $body_font = get_theme_mod('body_family','Roboto');		        
	    $body_color = get_theme_mod( 'body_color','#1e1e1e' );   
		$body_size = get_theme_mod( 'body_size','13');
		$body_weight = get_theme_mod( 'body_weight','regular');
		$body_weight == 'bold' ? $body_weight = '400':  $body_weight = 'regular';
		

	Colorist_Kirki::add_section( 'body_font', array(
		'title'          => __( 'Body Font','colorist' ),
		'description'    => __( 'Specify the body font properties', 'colorist'),
		'panel'          => 'typography', // Not typically needed.
	) ); 


	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'body',
		'label'    => __( 'Body Settings', 'colorist' ),
		'section'  => 'body_font', 
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $body_font,
			'variant'        => $body_weight,
			'font-size'      => $body_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $body_color,
		),
		'output'      => array(
			array(
				'element' => 'body',
				//'suffix' => '!important',
			),
		),
	) );


	Colorist_Kirki::add_section( 'heading_section', array(
		'title'          => __( 'Heading Font','colorist' ),
		'description'    => __( 'Specify typography of H1, H2, H3, H4, H5, H6', 'colorist'),
		'panel'          => 'typography', // Not typically needed.
	) );

	$h1_font = get_theme_mod('h1_family','Raleway');
	$h1_color = get_theme_mod( 'h1_color','#1e1e1e' );
	$h1_size = get_theme_mod( 'h1_size','48');
	$h1_weight = get_theme_mod( 'h1_weight','700');
	$h1_weight == 'bold' ? $h1_weight = '700' : $h1_weight = 'regular';

	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h1',
		'label'    => __( 'H1 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h1_font,
			'variant'        => $h1_weight,
			'font-size'      => $h1_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h1_color,
		),
		'output'      => array(
			array(
				'element' => 'h1',
			),
		),
		
	) );

	$h2_font = get_theme_mod('h2_family','Raleway');
	$h2_color = get_theme_mod( 'h2_color','#1e1e1e' );
	$h2_size = get_theme_mod( 'h2_size','36');
	$h2_weight = get_theme_mod( 'h2_weight','700');
	$h2_weight == 'bold' ? $h2_weight = '700' : $h2_weight = 'regular';

	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h2',
		'label'    => __( 'H2 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h2_font,
			'variant'        => $h2_weight,
			'font-size'      => $h2_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h2_color,
		),
		'output'      => array(
			array(
				'element' => 'h2',
			),
		),
		
	) );

	$h3_font = get_theme_mod('h3_family','Raleway');
	$h3_color = get_theme_mod( 'h3_color','#1e1e1e' );
	$h3_size = get_theme_mod( 'h3_size','30');
	$h3_weight = get_theme_mod( 'h3_weight','700');
	$h3_weight == 'bold' ? $h3_weight = '700' : $h3_weight = 'regular';

	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h3',
		'label'    => __( 'H3 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default' => array(
			'font-family'    => $h3_font,
			'variant'        => $h3_weight,
			'font-size'      => $h3_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h3_color,
		),
		'output'      => array(
			array(
				'element' => 'h3',
			),
		),
		
	) );

	$h4_font = get_theme_mod('h4_family','Raleway');
	$h4_color = get_theme_mod( 'h4_color','#1e1e1e' );
	$h4_size = get_theme_mod( 'h4_size','24');
	$h4_weight = get_theme_mod( 'h4_weight','700');
	$h4_weight == 'bold' ? $h4_weight = '700' : $h4_weight = 'regular';


	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h4',
		'label'    => __( 'H4 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h4_font,
			'variant'        => $h4_weight,
			'font-size'      => $h4_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h4_color,
		),
		'output'      => array(
			array(
				'element' => 'h4',
			),
		),
		
	) );

    $h5_font = get_theme_mod('h5_family','Raleway');
	$h5_color = get_theme_mod( 'h5_color','#1e1e1e' );
	$h5_size = get_theme_mod( 'h5_size','18');
	$h5_weight = get_theme_mod( 'h5_weight','700');
	$h5_weight == 'bold' ? $h5_weight = '700' : $h5_weight = 'regular';


	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h5',
		'label'    => __( 'H5 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h5_font,
			'variant'        => $h5_weight,
			'font-size'      => $h5_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h5_color,
		),
		'output'      => array(
			array(
				'element' => 'h5',
			),
		),
		
	) );

	$h6_font = get_theme_mod('h6_family','Raleway');
	$h6_color = get_theme_mod( 'h6_color','#1e1e1e' );
	$h6_size = get_theme_mod( 'h6_size','16');
	$h6_weight = get_theme_mod( 'h6_weight','700');
	$h6_weight == 'bold' ? $h6_weight = '700' : $h6_weight = 'regular';


	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'h6',
		'label'    => __( 'H6 Settings', 'colorist' ),
		'section'  => 'heading_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => $h6_font,
			'variant'        => $h6_weight,
			'font-size'      => $h6_size.'px',
			'line-height'    => '1.8',
			'letter-spacing' => '0',
			'color'          => $h6_color,
		),
		'output'      => array(
			array(
				'element' => 'h6',
			),
		),
		
	) );

	// navigation font 
	Colorist_Kirki::add_section( 'navigation_section', array(
		'title'          => __( 'Navigation Font','colorist' ),
		'description'    => __( 'Specify Navigation font properties', 'colorist'),
		'panel'          => 'typography', // Not typically needed.
	) );

	Colorist_Kirki::add_field( 'colorist', array(
		'settings' => 'navigation_font',
		'label'    => __( 'Navigation Font Settings', 'colorist' ),
		'section'  => 'navigation_section',
		'type'     => 'typography',
		'default'     => array(
			'font-family'    => 'Roboto',
			'variant'        => '400',
			'font-size'      => '16px',
			'line-height'    => '1.8', 
			'letter-spacing' => '0',
			'color'          => '#ffffff',
		),
		'output'      => array(
			array(
				'element' => '.main-navigation a',
			),
		),
	) );
endif; 


// header panel //

Colorist_Kirki::add_panel( 'header_panel', array(     
	'title'       => __( 'Header', 'colorist' ),
	'description' => __( 'Header Related Options', 'colorist' ), 
) );  

Colorist_Kirki::add_section( 'header', array(
	'title'          => __( 'General Header','colorist' ),
	'description'    => __( 'Header options', 'colorist'),
	'panel'          => 'header_panel', // Not typically needed.  
) );    

/*Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_search',
	'label'    => __( 'Enable to Show Search box in Header', 'colorist' ), 
	'section'  => 'header',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'on',
) );*/
/* Breaking News section  */
/*Colorist_Kirki::add_section( 'header_breaking_news', array(
	'title'          => __( 'Breaking News','colorist' ),
	'description'    => __( 'Breaking News', 'colorist'),
	'panel'          => 'header_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_breaking_news',
	'label'    => __( 'Enable Breaking News', 'colorist' ), 
	'section'  => 'header_breaking_news',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'active_callback' => array(
		array(
			'setting'  => 'home-page-type',
			'operator' => '==',
			'value'    => 'magazine',
		),
    ),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_breaking_news_title',
	'label'    => __( 'Breaking News Title', 'colorist' ),
	'section'  => 'header_breaking_news',
	'type'     => 'text',
	'active_callback' => array(
		array(
			'setting'  => 'home-page-type', 
			'operator' => '==',
			'value'    => 'magazine',
		),
		array(
			'setting'  => 'header_breaking_news', 
			'operator' => '==',
			'value'    => true,
		),
    ),
    'default' => __('LATEST NEWS','colorist'),   
) );*/
/* STICKY HEADER section */   

Colorist_Kirki::add_section( 'stricky_header', array(
	'title'          => __( 'Sticky Menu','colorist' ),
	'description'    => __( 'sticky header', 'colorist'),
	'panel'          => 'header_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(    
	'settings' => 'sticky_header',
	'label'    => __( 'Enable Sticky Header', 'colorist' ),
	'section'  => 'stricky_header',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'sticky_header_position',
	'label'    => __( 'Enable Sticky Header Position', 'colorist' ),
	'section'  => 'stricky_header',
	'type'     => 'radio-buttonset',
	'choices' => array(
		'top'  => esc_attr__( 'Top', 'colorist' ),
		'bottom' => esc_attr__( 'Bottom', 'colorist' )
	),
	'active_callback'    => array(
		array(
			'setting'  => 'sticky_header',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'top',
) );
Colorist_Kirki::add_section( 'header_style_type', array(
	'title'          => __( 'Header Navigation Type','colorist' ),
	'description'    => __( 'header navigation type', 'colorist'),
	'panel'          => 'header_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(   
	'settings' => 'header_nav_type',
	'label'    => __( 'Select Header Navigation Style Type', 'colorist' ),
	'section'  => 'header_style_type',
	'type'     => 'radio-buttonset',    
	'choices' => array(
		 'style1' => __('Style 1', 'colorist'),
         'style2' => __('Style 2', 'colorist'),
         'style3' => __('Style 3', 'colorist'),
	),
	'default'  => 'style1',
) );
/*
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_top_margin',
	'label'    => __( 'Header Top Margin', 'colorist' ),
	'description' => __('Select the top margin of header in pixels','colorist'),
	'section'  => 'header',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1,
	),
	//'default'  => '213',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_bottom_margin',
	'label'    => __( 'Header Bottom Margin', 'colorist' ),
	'description' => __('Select the bottom margin of header in pixels','colorist'),
	'section'  => 'header',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1,
	),
	//'default'  => '213',
) );*/

Colorist_Kirki::add_section( 'header_image', array(
	'title'          => __( 'Header Background Image','colorist' ),
	'description'    => __( 'Custom Header Image options', 'colorist'),
	'panel'          => 'header_panel', // Not typically needed.  
) );

Colorist_Kirki::add_field( 'colorist', array(   
	'settings' => 'header_bg_size',
	'label'    => __( 'Header Background Size', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'radio-buttonset', 
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'colorist' ),
		'contain' => esc_attr__( 'Contain', 'colorist' ),
		'auto'  => esc_attr__( 'Auto', 'colorist' ),
		'inherit'  => esc_attr__( 'Inherit', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => '.header-image',
			'property' => 'background-size',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_image',
			'operator' => '!=',
			'value'    => 'remove-header',
		),
	),
	'default'  => 'cover',
	'tooltip' => __('Header Background Image Size','colorist'),
) );

/*Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_height',
	'label'    => __( 'Header Background Image Height', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'number',
	'choices' => array(
		'min' => 100,
		'max' => 600,
		'step' => 1,
	),
	'default'  => '213',
) ); */
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_bg_repeat',
	'label'    => __( 'Header Background Repeat', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'colorist'),
        'repeat' => esc_attr__('Repeat', 'colorist'),
        'repeat-x' => esc_attr__('Repeat Horizontally','colorist'),
        'repeat-y' => esc_attr__('Repeat Vertically','colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.header-image',
			'property' => 'background-repeat',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_image',
			'operator' => '!=',
			'value'    => 'remove-header',
		),
	),
	'default'  => 'repeat',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_bg_position', 
	'label'    => __( 'Header Background Position', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'colorist'),
        'center center' => esc_attr__('Center Center', 'colorist'),
        'center bottom' => esc_attr__('Center Bottom', 'colorist'),
        'left top' => esc_attr__('Left Top', 'colorist'),
        'left center' => esc_attr__('Left Center', 'colorist'),
        'left bottom' => esc_attr__('Left Bottom', 'colorist'),
        'right top' => esc_attr__('Right Top', 'colorist'),
        'right center' => esc_attr__('Right Center', 'colorist'),
        'right bottom' => esc_attr__('Right Bottom', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.header-image',
			'property' => 'background-position',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_image',
			'operator' => '!=',
			'value'    => 'remove-header',
		),
	),
	'default'  => 'center center',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_bg_attachment',
	'label'    => __( 'Header Background Attachment', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'colorist'),
        'fixed' => esc_attr__('Fixed', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.header-image',
			'property' => 'background-attachment',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_image',
			'operator' => '!=',
			'value'    => 'remove-header',
		),
	),
	'default'  => 'scroll',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_overlay',
	'label'    => __( 'Enable Header( Background ) Overlay', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
  
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'header_overlay_color',
	'label'    => __( 'Header Overlay ( Background )color', 'colorist' ),
	'section'  => 'header_image',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '', 
	'output'   => array(
		array(
			'element'  => '.overlay-header',
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'header_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
) );

/*
/* e-option start */
/*
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'custon_favicon',
	'label'    => __( 'Custom Favicon', 'colorist' ),
	'section'  => 'header',
	'type'     => 'upload',
	'default'  => '',
) ); */
/* e-option start */ 
/* Blog page section */


/* Blog panel */

Colorist_Kirki::add_panel( 'blog_panel', array(     
	'title'       => __( 'Blog', 'colorist' ),
	'description' => __( 'Blog Related Options', 'colorist' ),     
) ); 
Colorist_Kirki::add_section( 'blog', array(
	'title'          => __( 'Blog Page','colorist' ),
	'description'    => __( 'Blog Related Options', 'colorist'),
	'panel'          => 'blog_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'blog-slider',
	'label'    => __( 'Enable to show the slider on blog page', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'off',
	'tooltip' => __('To show the slider on posts page','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'blog_layout',
	'label'    => __( 'Select Blog Page Layout you prefer', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'select',
	'multiple'  => 1,
	'choices' => array(
		1  => esc_attr__( 'Default ( One Column )', 'colorist' ),
		2 => esc_attr__( 'Two Columns ', 'colorist' ),
		3 => esc_attr__( 'Three Columns ( Without Sidebar ) ', 'colorist' ),
		4 => esc_attr__( 'Two Columns With Masonry', 'colorist' ),
		5 => esc_attr__( 'Three Columns With Masonry ( Without Sidebar ) ', 'colorist' ),
	),
	'default'  => 1,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'featured_image',
	'label'    => __( 'Enable Featured Image', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable Featured Image for blog page','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'more_text',
	'label'    => __( 'More Text', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'text',
	'description' => __('Text to display in case of text too long','colorist'),
	'default' => __('Read More','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'featured_image_size',
	'label'    => __( 'Choose the Featured Image Size for Blog Page', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'select',
	'multiple'  => 1,
	'choices' => array(
		1 => esc_attr__( 'Large Featured Image', 'colorist' ),
		2 => esc_attr__( 'Small Featured Image', 'colorist' ),
		3 => esc_attr__( 'Original Size', 'colorist' ),
		4 => esc_attr__( 'Medium', 'colorist' ),
		5 => esc_attr__( 'Large', 'colorist' ), 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Set large and medium image size: Goto Dashboard => Settings => Media', 'colorist') ,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_single_post_top_meta',
	'label'    => __( 'Enable to display top post meta data', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable to Display Top Post Meta Details. This will reflect for blog page, single blog page, blog full width & blog large templates','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_post_top_meta',
	'label'    => __( 'Activate and Arrange the Order of Top Post Meta elements', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'sortable',
	'choices'     => array(
		1 => esc_attr__( 'date', 'colorist' ),
		2 => esc_attr__( 'author', 'colorist' ),
		3 => esc_attr__( 'comment', 'colorist' ),
		4 => esc_attr__( 'category', 'colorist' ),
		5 => esc_attr__( 'tags', 'colorist' ),
		6 => esc_attr__( 'edit', 'colorist' ),
	),
	'default'  => array(1, 2, 6),
	'active_callback' => array(
		array(
			'setting'  => 'enable_single_post_top_meta',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Click above eye icon in order to activate the field, This will reflect for blog page, single blog page, blog full width & blog large templates','colorist'),

) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_single_post_bottom_meta',
	'label'    => __( 'Enable to display bottom post meta data', 'colorist' ),
	'section'  => 'blog', 
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'tooltip' => __('Enable to Display Top Post Meta Details. This will reflect for blog page, single blog page, blog full width & blog large templates','colorist'),
	'default'  => 'on',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_post_bottom_meta',
	'label'    => __( 'Activate and arrange the Order of Bottom Post Meta elements', 'colorist' ),
	'section'  => 'blog',
	'type'     => 'sortable',
	'choices'     => array(
		1 => esc_attr__( 'date', 'colorist' ),
		2 => esc_attr__( 'author', 'colorist' ),
		3 => esc_attr__( 'comment', 'colorist' ),
		4 => esc_attr__( 'category', 'colorist' ),
		5 => esc_attr__( 'tags', 'colorist' ),
		6 => esc_attr__( 'edit', 'colorist' ),
	),
	'default'  => array(3,4,5),
	'active_callback' => array(
		array(
			'setting'  => 'enable_single_post_bottom_meta',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Click above eye icon in order to activate the field, This will reflect for blog page, single blog page, blog full width & blog large templates','colorist'),
) );


/* Single Blog page section */

Colorist_Kirki::add_section( 'single_blog', array(
	'title'          => __( 'Single Blog Page','colorist' ),
	'description'    => __( 'Single Blog Page Related Options', 'colorist'),
	'panel'          => 'blog_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_featured_image',
	'label'    => __( 'Enable Single Post Featured Image', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Enable Featured Image for Single Post Page','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_featured_image_size',
	'label'    => __( 'Choose the featured image display type for Single Post Page', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'radio',
	'choices' => array(
		1  => esc_attr__( 'Large Featured Image', 'colorist' ),
		2 => esc_attr__( 'Small Featured Image', 'colorist' ),
		3 => esc_attr__( 'FullWidth Featured Image', 'colorist' ),
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'single_featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'author_bio_box',
	'label'    => __( 'Enable Author Bio Box below single post', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'social_sharing_box',
	'label'    => __( 'Enable Social Sharing options Box below single post', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'related_posts',
	'label'    => __( 'Show Related Posts', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'off',
	'tooltip' => __('Show the Related Post for Single Blog Page','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'related_posts_hierarchy',
	'label'    => __( 'Related Posts Must Be Shown As:', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'radio',
	'choices' => array(
		1  => esc_attr__( 'Related Posts By Tags', 'colorist' ),
		2 => esc_attr__( 'Related Posts By Categories', 'colorist' ) 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'related_posts',
			'operator' => '==',
			'value'    => true,
		),
    ),
    'tooltip' => __('Select the Hierarchy','colorist'),

) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'comments',
	'label'    => __( ' Show Comments', 'colorist' ),
	'section'  => 'single_blog',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
	'tooltip' => __('Show the Comments for Single Blog Page','colorist'),
) );
//  social network panel //

Colorist_Kirki::add_panel( 'social_panel', array(
	'title'        =>__( 'Social Networks', 'colorist'),
	'description'  =>__( 'social networks', 'colorist'),
	'priority'  =>11,	
));
//social sharing box section

Colorist_Kirki::add_section( 'social_sharing_box', array(
	'title'          =>__( 'Social Sharing Box', 'colorist'),
	'description'   =>__('Social Sharing box related options', 'colorist'),
	'panel'			 =>'social_panel',
));

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'facebook_sb',
	'label'    => __( 'Enable facebook sharing option below single post', 'colorist' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'twitter_sb',
	'label'    => __( 'Enable twitter sharing option below single post', 'colorist' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'linkedin_sb',
	'label'    => __( 'Enable linkedin sharing option below single post', 'colorist' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'google-plus_sb',
	'label'    => __( 'Enable googleplus sharing option below single post', 'colorist' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'email_sb',
	'label'    => __( 'Enable email sharing option below single post', 'colorist' ),
	'section'  => 'social_sharing_box',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
/* FOOTER SECTION 
footer panel */

Colorist_Kirki::add_panel( 'footer_panel', array(     
	'title'       => __( 'Footer', 'colorist' ),
	'description' => __( 'Footer Related Options', 'colorist' ),     
) );  

Colorist_Kirki::add_section( 'footer', array(
	'title'          => __( 'Footer','colorist' ),
	'description'    => __( 'Footer related options', 'colorist'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_widgets',
	'label'    => __( 'Footer Widget Area', 'colorist' ),
	'description' => sprintf(__('Select widgets, Goto <a href="%1$s"target="_blank"> Customizer </a> => Widgets','colorist'),admin_url('customize.php') ),
	'section'  => 'footer',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
/* Choose No.Of Footer area */
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_widgets_count',
	'label'    => __( 'Choose No.of widget area you want in footer', 'colorist' ),
	'section'  => 'footer',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( '1', 'colorist' ),
		2  => esc_attr__( '2', 'colorist' ),
		3  => esc_attr__( '3', 'colorist' ),
		4  => esc_attr__( '4', 'colorist' ),
	),
	'default'  => 4,
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'copyright',
	'label'    => __( 'Footer Copyright Text', 'colorist' ),
	'section'  => 'footer',
	'type'     => 'textarea',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_top_margin',
	'label'    => __( 'Footer Top Margin', 'colorist' ),
	'description' => __('Select the top margin of footer in pixels','colorist'),
	'section'  => 'footer',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.site-footer',
			'property' => 'margin-top',
			'units' => 'px',
		),
	),
	'default'  => 0,
) );

/* CUSTOM FOOTER BACKGROUND IMAGE 
footer background image section  */

Colorist_Kirki::add_section( 'footer_image', array(
	'title'          => __( 'Footer Image','colorist' ),
	'description'    => __( 'Custom Footer Image options', 'colorist'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_image',
	'label'    => __( 'Upload Footer Background Image', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.site-footer .footer-widgets,.footer-image',
			'property' => 'background-image',
			'suffix'  => '!important',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_size',
	'label'    => __( 'Footer Background Size', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'radio-buttonset',
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'colorist' ),
		'contain' => esc_attr__( 'Contain', 'colorist' ),
		'auto'  => esc_attr__( 'Auto', 'colorist' ),
		'inherit'  => esc_attr__( 'Inherit', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'cover',
	'tooltip' => __('Footer Background Image Size','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_repeat',
	'label'    => __( 'Footer Background Repeat', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'colorist'),
        'repeat' => esc_attr__('Repeat', 'colorist'),
        'repeat-x' => esc_attr__('Repeat Horizontally','colorist'),
        'repeat-y' => esc_attr__('Repeat Vertically','colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_position',
	'label'    => __( 'Footer Background Position', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'colorist'),
        'center center' => esc_attr__('Center Center', 'colorist'),
        'center bottom' => esc_attr__('Center Bottom', 'colorist'),
        'left top' => esc_attr__('Left Top', 'colorist'),
        'left center' => esc_attr__('Left Center', 'colorist'),
        'left bottom' => esc_attr__('Left Bottom', 'colorist'),
        'right top' => esc_attr__('Right Top', 'colorist'),
        'right center' => esc_attr__('Right Center', 'colorist'),
        'right bottom' => esc_attr__('Right Bottom', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'center center',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_attachment',
	'label'    => __( 'Footer Background Attachment', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'colorist'),
        'fixed' => esc_attr__('Fixed', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'scroll',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_overlay',
	'label'    => __( 'Enable Footer( Background ) Overlay', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
  
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_overlay_color',
	'label'    => __( 'Footer Overlay ( Background )color', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '', 
	'active_callback' => array(
		array(
			'setting'  => 'footer_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'   => array(
		array(
			'element'  => '.overlay-footer',
			'property' => 'background-color',
		),
	),
) );


// single page section //

Colorist_Kirki::add_section( 'single_page', array(
	'title'          => __( 'Single Page','colorist' ),
	'description'    => __( 'Single Page Related Options', 'colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_page_featured_image',
	'label'    => __( 'Enable Single Page Featured Image', 'colorist' ),
	'section'  => 'single_page',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'single_page_featured_image_size',
	'label'    => __( 'Single Page Featured Image Size', 'colorist' ),
	'section'  => 'single_page',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( 'Normal', 'colorist' ),
		2 => esc_attr__( 'FullWidth', 'colorist' ) 
	),
	'default'  => 1,
	'active_callback' => array(
		array(
			'setting'  => 'single_page_featured_image',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );

// Layout section //

Colorist_Kirki::add_section( 'layout', array(
	'title'          => __( 'Layout','colorist' ),
	'description'    => __( 'Layout Related Options', 'colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'site-style',
	'label'    => __( 'Site Style', 'colorist' ),
	'section'  => 'layout',
	'type'     => 'radio-buttonset',
	'choices' => array(
		'wide' =>  esc_attr__('Wide', 'colorist'),
        'boxed' =>  esc_attr__('Boxed', 'colorist'),
        'fluid' =>  esc_attr__('Fluid', 'colorist'),  
        //'static' =>  esc_attr__('Static ( Non Responsive )', 'colorist'),
    ),
	'default'  => 'wide',
	'tooltip' => __('Select the default site layout. Defaults to "Wide".','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'sidebar_position',
	'label'    => __( 'Main Layout', 'colorist' ),
	'section'  => 'layout',
	'type'     => 'radio-image',   
	'description' => __('Select main content and sidebar arrancoloristent.','colorist'),
	'choices' => array(
		'left' =>  get_template_directory_uri() . '/admin/kirki/assets/images/2cl.png',
        'right' =>  get_template_directory_uri() . '/admin/kirki/assets/images/2cr.png',
        'two-sidebar' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cm.png',  
        'two-sidebar-left' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cl.png',
        'two-sidebar-right' =>  get_template_directory_uri() . '/admin/kirki/assets/images/3cr.png',
        'fullwidth' =>  get_template_directory_uri() . '/admin/kirki/assets/images/1c.png',
        'no-sidebar' =>  get_template_directory_uri() . '/images/no-sidebar.png',
    ),
	'default'  => 'right',
	'tooltip' => __('This layout will be reflected in all pages unless unique layout template is set for specific page','colorist'),
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'body_top_margin',
	'label'    => __( 'Body Top Margin', 'colorist' ),
	'description' => __('Select the top margin of body element in pixels','colorist'),
	'section'  => 'layout',
	'type'     => 'number',
	'choices' => array(
		'min' => 0,
		'max' => 200,
		'step' => 1,
	),
	'active_callback'    => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'margin-top',
			'units'    => 'px',
		),
	),
	'default'  => 0,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'body_bottom_margin',
	'label'    => __( 'Body Bottom Margin', 'colorist' ),
	'description' => __('Select the bottom margin of body element in pixels','colorist'),
	'section'  => 'layout',
	'type'     => 'number',
	'choices' => array(
		'min' => 0,
		'max' => 200,
		'step' => 1,
	),
	'active_callback'    => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'margin-bottom',
			'units'    => 'px',
		),
	),
	'default'  => 0,
) );

/* LAYOUT SECTION  */
/*
Colorist_Kirki::add_section( 'layout', array(
	'title'          => __( 'Layout','colorist' ),   
	'description'    => __( 'Layout settings that affects overall site', 'colorist'),
	'panel'          => 'colorist_options', // Not typically needed.
) );



Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'primary_sidebar_width',
	'label'    => __( 'Primary Sidebar Width', 'colorist' ),
	'section'  => 'layout',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'1' => __( 'One Column', 'colorist' ),
		'2' => __( 'Two Column', 'colorist' ),
		'3' => __( 'Three Column', 'colorist' ),
		'4' => __( 'Four Column', 'colorist' ),
		'5' => __( 'Five Column ', 'colorist' ),
	),
	'default'  => '5',  
	'tooltip' => __('Select the width of the Primary Sidebar. Please note that the values represent grid columns. The total width of the page is 16 columns, so selecting 5 here will make the primary sidebar to have a width of approximately 1/3 ( 4/16 ) of the total page width.','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'secondary_sidebar_width',
	'label'    => __( 'Secondary Sidebar Width', 'colorist' ),
	'section'  => 'layout',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'1' => __( 'One Column', 'colorist' ),
		'2' => __( 'Two Column', 'colorist' ),
		'3' => __( 'Three Column', 'colorist' ),
		'4' => __( 'Four Column', 'colorist' ),
		'5' => __( 'Five Column ', 'colorist' ),
	),            
	'default'  => '5',  
	'tooltip' => __('Select the width of the Secondary Sidebar. Please note that the values represent grid columns. The total width of the page is 16 columns, so selecting 5 here will make the primary sidebar to have a width of approximately 1/3 ( 4/16 ) of the total page width.','colorist'),
) ); 

*/

/* FOOTER SECTION 
footer panel */

Colorist_Kirki::add_panel( 'footer_panel', array(     
	'title'       => __( 'Footer', 'colorist' ),
	'description' => __( 'Footer Related Options', 'colorist' ),     
) );  

Colorist_Kirki::add_section( 'footer', array(
	'title'          => __( 'Footer','colorist' ),
	'description'    => __( 'Footer related options', 'colorist'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_widgets',
	'label'    => __( 'Footer Widget Area', 'colorist' ),
	'description' => sprintf(__('Select widgets, Goto <a href="%1$s"target="_blank"> Customizer </a> => Widgets','colorist'),admin_url('customize.php') ),
	'section'  => 'footer',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'on',
) );
/* Choose No.Of Footer area */
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_widgets_count',
	'label'    => __( 'Choose No.of widget area you want in footer', 'colorist' ),
	'section'  => 'footer',
	'type'     => 'radio-buttonset',
	'choices' => array(
		1  => esc_attr__( '1', 'colorist' ),
		2  => esc_attr__( '2', 'colorist' ),
		3  => esc_attr__( '3', 'colorist' ),
		4  => esc_attr__( '4', 'colorist' ),
	),
	'default'  => 4,
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'copyright',
	'label'    => __( 'Footer Copyright Text', 'colorist' ),
	'section'  => 'footer',
	'type'     => 'textarea',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_top_margin',
	'label'    => __( 'Footer Top Margin', 'colorist' ),
	'description' => __('Select the top margin of footer in pixels','colorist'),
	'section'  => 'footer',
	'type'     => 'number',
	'choices' => array(
		'min' => 1,
		'max' => 1000,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.site-footer',
			'property' => 'margin-top',
			'units' => 'px',
		),
	),
	'default'  => 0,
) );

/* CUSTOM FOOTER BACKGROUND IMAGE 
footer background image section  */

Colorist_Kirki::add_section( 'footer_image', array(
	'title'          => __( 'Footer Image','colorist' ),
	'description'    => __( 'Custom Footer Image options', 'colorist'),
	'panel'          => 'footer_panel', // Not typically needed.
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_image',
	'label'    => __( 'Upload Footer Background Image', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.site-footer .footer-widgets',
			'property' => 'background-image',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_size',
	'label'    => __( 'Footer Background Size', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'radio-buttonset',
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'colorist' ),
		'contain' => esc_attr__( 'Contain', 'colorist' ),
		'auto'  => esc_attr__( 'Auto', 'colorist' ),
		'inherit'  => esc_attr__( 'Inherit', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'cover',
	'tooltip' => __('Footer Background Image Size','colorist'),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_repeat',
	'label'    => __( 'Footer Background Repeat', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'colorist'),
        'repeat' => esc_attr__('Repeat', 'colorist'),
        'repeat-x' => esc_attr__('Repeat Horizontally','colorist'),
        'repeat-y' => esc_attr__('Repeat Vertically','colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_position',
	'label'    => __( 'Footer Background Position', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'colorist'),
        'center center' => esc_attr__('Center Center', 'colorist'),
        'center bottom' => esc_attr__('Center Bottom', 'colorist'),
        'left top' => esc_attr__('Left Top', 'colorist'),
        'left center' => esc_attr__('Left Center', 'colorist'),
        'left bottom' => esc_attr__('Left Bottom', 'colorist'),
        'right top' => esc_attr__('Right Top', 'colorist'),
        'right center' => esc_attr__('Right Center', 'colorist'),
        'right bottom' => esc_attr__('Right Bottom', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'center center',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_bg_attachment',
	'label'    => __( 'Footer Background Attachment', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'colorist'),
        'fixed' => esc_attr__('Fixed', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.footer-image',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'footer_bg_image',
			'operator' => '=',
			'value'    => true,
		),
	),
	'default'  => 'scroll',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_overlay',
	'label'    => __( 'Enable Footer( Background ) Overlay', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'switch',
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' )
	),
	'default'  => 'off',
) );
  
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'footer_overlay_color',
	'label'    => __( 'Footer Overlay ( Background )color', 'colorist' ),
	'section'  => 'footer_image',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '#E5493A', 
	'active_callback' => array(
		array(
			'setting'  => 'footer_overlay',
			'operator' => '==',
			'value'    => true,
		),
	),
	'output'   => array(
		array(
			'element'  => '.overlay-footer',
			'property' => 'background-color',
		),
	),
) );

//  slider panel //

Colorist_Kirki::add_panel( 'slider_panel', array(   
	'title'       => __( 'Slider Settings', 'colorist' ),  
	'description' => __( 'Flex slider related options', 'colorist' ), 
	'priority'    => 11,    
) );

//  flexslider section  //

Colorist_Kirki::add_section( 'flex_caption_section', array(
	'title'          => __( 'Flexcaption Settings','colorist' ),
	'description'    => __( 'Flexcaption Related Options', 'colorist'),
	'panel'          => 'slider_panel', // Not typically needed.
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'enable_flex_caption_edit',
	'label'    => __( 'Enable Custom Flexcaption Settings', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'switch',  
	'choices' => array(
		'on'  => esc_attr__( 'Enable', 'colorist' ),
		'off' => esc_attr__( 'Disable', 'colorist' ) 
	),
	'default'  => 'off',
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_bg',
	'label'    => __( 'Select Flexcaption Background Color', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'color',
	'default'  => 'rgba(255, 255, 255, 0.7)',
	'alpha' => true,
	'output'   => array(
		array(
			'element'  => '.flex-caption',
			'property' => 'background-color',
			'suffix' => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_align',
	'label'    => __( 'Select Flexcaption Alignment', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'select',
	'default'  => 'left',
	'choices' => array(
		'left' => esc_attr__( 'Left', 'colorist' ),
		'right' => esc_attr__( 'Right', 'colorist' ),
		'center' => esc_attr__( 'Center', 'colorist' ),
		'justify' => esc_attr__( 'Justify', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => '.home .flexslider .slides .flex-caption p,.home .flexslider .slides .flex-caption h1, .home .flexslider .slides .flex-caption h2, .home .flexslider .slides .flex-caption h3, .home .flexslider .slides .flex-caption h4, .home .flexslider .slides .flex-caption h5, .home .flexslider .slides .flex-caption h6,.flexslider .slides .flex-caption,.flexslider .slides .flex-caption h1, .flexslider .slides .flex-caption h2, .flexslider .slides .flex-caption h3, .flexslider .slides .flex-caption h4, .flexslider .slides .flex-caption h5, .flexslider .slides .flex-caption h6,.flexslider .slides .flex-caption p,.flexslider .slides .flex-caption',
			'property' => 'text-align',
			//'suffix' => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
 Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_bg_position',
	'label'    => __( 'Select Flexcaption Background Horizontal Position', 'colorist' ),
	'tooltip' => __('Select how far from left, Default value left = 55 ( in % )','colorist'),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '55',
	'choices'     => array(
		'min'  => 0,
		'max'  => 64,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'left',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) ); 
 Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_bg_vertical_position',
	'label'    => __( 'Select Flexcaption Background Vertical Position', 'colorist' ),
	'tooltip' => __('Select how far from top, Default value top = 10 ( in % )','colorist'),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '10',
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'top',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),

) ); 
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_bg_width',
	'label'    => __( 'Select Flexcaption Background Width', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '35',
	'tooltip' => __('Select Flexcaption Background Width , Default width value 35','colorist'),
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'width',
			'suffix' => '%',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) ); 
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_responsive_bg_width',
	'label'    => __( 'Select Responsive Flexcaption Background Width', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'number',
	'default'  => '100',
	'tooltip' => __('Select Responsive Flexcaption Background Width, Default width value 100 ( This value will apply for max-width: 768px )','colorist'),
	'choices'     => array(
		'min'  => 0,
		'max'  => 100,
		'step' => 1, 
	),
	'output'   => array(
		array(
			'element'  => '.flexslider .slides .flex-caption,.home .flexslider .slides .flex-caption',
			'property' => 'width',
			'media_query' => '@media (max-width: 768px)',
			'value_pattern' => 'calc($%)',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexheading_color',
	'label'    => __( 'Select Flex Heading Font Color', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'color',
	'default'  => '#ffffff',
	'alpha' => true,
	'output'   => array(
		array(
			'element'  => '.home .flexslider .slides .flex-caption h2, 
							.home .flexslider .slides .flex-caption h3, 
							.home .flexslider .slides .flex-caption h4,
							 .home .flexslider .slides .flex-caption h5,
							 .home .flexslider .slides .flex-caption h6,
							.flexslider .slides .flex-caption h1,
							.flexslider .slides .flex-caption h2,
							.flexslider .slides .flex-caption h3,
							.flexslider .slides .flex-caption h4,
							.flexslider .slides .flex-caption h5,
							.flexslider .slides .flex-caption h6',
			'property' => 'color',
			'suffix' => '!important',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ),

) ); 
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'flexcaption_color',
	'label'    => __( 'Select Flexcaption Font Color', 'colorist' ),
	'section'  => 'flex_caption_section',
	'type'     => 'color',
	'default'  => '',
	'alpha' => true,
	'output'   => array(
		array(
			'element'  => '.home .flexslider .slides .flex-caption p a,.home .flexslider .slides .flex-caption p,.flexslider .slides .flex-caption p',
			'property' => 'color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'enable_flex_caption_edit',
			'operator' => '==',
			'value'    => true,
		),
    ), 

) );

 if( class_exists( 'WooCommerce' ) ) {
	Colorist_Kirki::add_section( 'woocommerce_section', array(
		'title'          => __( 'WooCommerce','colorist' ),
		'description'    => __( 'Theme options related to woocommerce', 'colorist'),
		'priority'       => 11, 

		'theme_supports' => '', // Rarely needed.
	) );
	Colorist_Kirki::add_field( 'woocommerce', array(
		'settings' => 'woocommerce_sidebar',
		'label'    => __( 'Enable Woocommerce Sidebar', 'colorist' ),
		'description' => __('Enable Sidebar for shop page','colorist'),
		'section'  => 'woocommerce_section',
		'type'     => 'switch',
		'choices' => array(
			'on'  => esc_attr__( 'Enable', 'colorist' ),
			'off' => esc_attr__( 'Disable', 'colorist' ) 
		),

		'default'  => 'on',
	) );
}
	
// background color ( rename )

Colorist_Kirki::add_section( 'colors', array(
	'title'          => __( 'Background Color','colorist' ),
	'description'    => __( 'This will affect overall site background color', 'colorist'),
	//'panel'          => 'skin_color_panel', // Not typically needed.
	'priority' => 11,
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_color',
	'label'    => __( 'General Background Color', 'colorist' ),
	'section'  => 'colors',
	'type'     => 'color',
	'alpha' => true,
	'default'  => '#ffffff',
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-color',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'content_background_color',
	'label'    => __( 'Content Background Color', 'colorist' ),
	'section'  => 'colors',
	'type'     => 'color',
	'description' => __('when you are select boxed layout content background color will reflect the grid area','colorist'), 
	'alpha' => true, 
	'default'  => '#ffffff',
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-color',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_image',
	'label'    => __( 'General Background Image', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-image',
		),
	),
) );

// background image ( general & boxed layout ) //


Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_repeat',
	'label'    => __( 'General Background Repeat', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'colorist'),
        'repeat' => esc_attr__('Repeat', 'colorist'),
        'repeat-x' => esc_attr__('Repeat Horizontally','colorist'),
        'repeat-y' => esc_attr__('Repeat Vertically','colorist'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-repeat',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_size',
	'label'    => __( 'General Background Size', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'colorist' ),
		'contain' => esc_attr__( 'Contain', 'colorist' ),
		'auto'  => esc_attr__( 'Auto', 'colorist' ),
		'inherit'  => esc_attr__( 'Inherit', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-size',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'cover',  
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_attachment',
	'label'    => __( 'General Background Attachment', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'colorist'),
        'fixed' => esc_attr__('Fixed', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-attachment',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image',
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'fixed',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'general_background_position',
	'label'    => __( 'General Background Position', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'colorist'),
        'center center' => esc_attr__('Center Center', 'colorist'),
        'center bottom' => esc_attr__('Center Bottom', 'colorist'),
        'left top' => esc_attr__('Left Top', 'colorist'),
        'left center' => esc_attr__('Left Center', 'colorist'),
        'left bottom' => esc_attr__('Left Bottom', 'colorist'),
        'right top' => esc_attr__('Right Top', 'colorist'),
        'right center' => esc_attr__('Right Center', 'colorist'),
        'right bottom' => esc_attr__('Right Bottom', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => 'body',
			'property' => 'background-position',
		),
	),
	'active_callback'    => array(
		array(
			'setting'  => 'general_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'center top',  
) );


/* CONTENT BACKGROUND ( boxed background image )*/

Colorist_Kirki::add_field( 'colorist', array(  
	'settings' => 'content_background_image',
	'label'    => __( 'Content Background Image', 'colorist' ),
	'description' => __('when you are select boxed layout content background image will reflect the grid area','colorist'),
	'section'  => 'background_image',
	'type'     => 'upload',
	'default'  => '',
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-image',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
	),
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'content_background_repeat',
	'label'    => __( 'Content Background Repeat', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'no-repeat' => esc_attr__('No Repeat', 'colorist'),
        'repeat' => esc_attr__('Repeat', 'colorist'),
        'repeat-x' => esc_attr__('Repeat Horizontally','colorist'),
        'repeat-y' => esc_attr__('Repeat Vertically','colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-repeat',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'repeat',  
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'content_background_size',
	'label'    => __( 'Content Background Size', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
    'choices' => array(
		'cover'  => esc_attr__( 'Cover', 'colorist' ),
		'contain' => esc_attr__( 'Contain', 'colorist' ),
		'auto'  => esc_attr__( 'Auto', 'colorist' ),
		'inherit'  => esc_attr__( 'Inherit', 'colorist' ),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-size',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'cover',  
) );

Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'content_background_attachment',
	'label'    => __( 'Content Background Attachment', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'scroll' => esc_attr__('Scroll', 'colorist'),
        'fixed' => esc_attr__('Fixed', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-attachment',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'fixed',  
) );
Colorist_Kirki::add_field( 'colorist', array(
	'settings' => 'content_background_position',
	'label'    => __( 'Content Background Position', 'colorist' ),
	'section'  => 'background_image',
	'type'     => 'select',
	'multiple'    => 1,
	'choices'     => array(
		'center top' => esc_attr__('Center Top', 'colorist'),
        'center center' => esc_attr__('Center Center', 'colorist'),
        'center bottom' => esc_attr__('Center Bottom', 'colorist'),
        'left top' => esc_attr__('Left Top', 'colorist'),
        'left center' => esc_attr__('Left Center', 'colorist'),
        'left bottom' => esc_attr__('Left Bottom', 'colorist'),
        'right top' => esc_attr__('Right Top', 'colorist'),
        'right center' => esc_attr__('Right Center', 'colorist'),
        'right bottom' => esc_attr__('Right Bottom', 'colorist'),
	),
	'output'   => array(
		array(
			'element'  => '.boxed-container',
			'property' => 'background-position',
		),
	),
	'active_callback' => array(
		array(
			'setting'  => 'site-style',
			'operator' => '==',
			'value'    => 'boxed',
		),
		array(
			'setting'  => 'content_background_image', 
			'operator' => '==',
			'value'    => true,
		),
	),
	'default'  => 'center top',  
) );

do_action('wbls-colorist_pro_customizer_options');
do_action('colorist_child_customizer_options');
