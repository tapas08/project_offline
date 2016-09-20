<?php
  
// #################################################
// Reg. js / css
// #################################################

function venture_lite_customizer_scripts() {
    wp_register_script( 'venture_lite_customizer_scripts', get_template_directory_uri() . '/assets/js/customizer.js', array("jquery"), '', true  );
    wp_enqueue_script( 'venture_lite_customizer_scripts' );
}
add_action( 'customize_controls_enqueue_scripts', 'venture_lite_customizer_scripts' );

function venture_lite_customizer_styles() { ?>
	<style type="text/css">
	    .button-venture-lite-secondary{width: 80%!important;margin: 5px auto 5px auto!important; display: block!important; text-align: center!important;margin-top:15px!important;margin-bottom:15px!important;}
        .button-nimbus{background: #e92c6a!important; border-color:#e92c6a!important; -webkit-box-shadow: 0 1px 0 #e92c6a!important; box-shadow: 0 1px 0 #e92c6a!important; color: #fff!important; text-decoration: none!important; text-shadow: 0 -1px 1px #e92c6a,1px 0 1px #e92c6a,0 1px 1px #e92c6a,-1px 0 1px #e92c6a!important;width: 80%!important; margin: 5px auto 5px auto!important; display: block!important; text-align: center!important;margin-top:15px!important;margin-bottom:15px!important;}
        .venture-lite-hide{display:none!important;}
        #accordion-section-pro_features>h3.accordion-section-title:before,#accordion-section-slideshow-options>h3.accordion-section-title:before { content: "Pro"!important; position: relative!important; top: -1px!important; margin-left: 0px!important; padding: 3px 6px !important; line-height: 1.5 !important; font-size: 9px !important; color: #ffffff !important; background-color: #e92c6a!important; letter-spacing: 1px!important; text-transform: uppercase!important; -webkit-font-smoothing: subpixel-antialiased !important; }
	</style>
<?php }
add_action( 'customize_controls_print_styles', 'venture_lite_customizer_styles', 20 );


// #################################################
// Kirki
// #################################################


Kirki::add_config( 'venture-lite-config', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );



Kirki::add_section( 'setup', array(
    'title'          => __( 'Theme Userguide', 'venture-lite' ),
    'description'    => '',
    'panel'          => '', 
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'userguide-info',
	'label'    => __( 'Userguide', 'venture-lite' ),
	'section'  => 'setup',
	'type'     => 'custom',
	'priority' => 1,
	'description'   => __( 'This theme was designed to be very easy to set up but just in case we\'ve created a userguide to assist: ', 'venture-lite' ) . '<a href="https://docs.google.com/document/d/1tEeN3BO20Pm6e10ALkUKaolEnJfVGGHxloTdRrg5uPA/" target="_blank" class="button button-venture-lite-secondary">View User Guide</a>',
) );

Kirki::add_section( 'social', array(
    'title'          => __( 'Header Social Media', 'venture-lite' ),
    'description'    => '',
    'panel'          => '', 
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'social-toggle',
	'label'       => __( 'Social Icons Status', 'venture-lite' ),
	'section'     => 'social',
	'default'     => '1',
	'priority'    => 1,
	'choices'     => array(
		'1'   => esc_attr__( 'Show', 'venture-lite' ),
		'2' => esc_attr__( 'Hide', 'venture-lite' ),
	),
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_facebook_url',
	'label'    => __( 'Facebook URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_linkedin_url',
	'label'    => __( 'LinkedIn URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_twitter_url',
	'label'    => __( 'Twitter URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_youtube_url',
	'label'    => __( 'YouTube URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_google_plus_url',
	'label'    => __( 'Google+ URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_vimeo_url',
	'label'    => __( 'Vimeo URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_flickr_url',
	'label'    => __( 'Flickr URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_wpcom_url',
	'label'    => __( 'WordPress.com URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_pinterest_url',
	'label'    => __( 'Pinterest URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_instagram_url',
	'label'    => __( 'Instagram URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_tumblr_url',
	'label'    => __( 'Tumblr URL', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'nimbus_mail_url',
	'label'    => __( 'Email Address', 'venture-lite' ),
	'section'  => 'social',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'sanitize_callback' => 'venture_lite_sanitize_email'
) );


Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'checkbox',
	'settings'    => 'nimbus_hide_rss_icon',
	'label'       => __( 'Hide RSS Icon', 'venture-lite' ),
	'section'     => 'social',
	'default'     => '0',
	'priority'    => 10,
) );



Kirki::add_panel( 'frontpage_banners', array(
    'priority'    => 2,
    'title'       => __( 'Frontpage Banner Section', 'venture-lite' ),
    'description' => '',
) );

Kirki::add_section( 'banner_select', array(
    'title'          => __( 'Banner General Settings', 'venture-lite' ),
    'description'    => '',
    'panel'          => 'frontpage_banners', 
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '', 
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fp-banner-toggle',
	'label'       => __( 'Frontpage Banner Status', 'venture-lite' ),
	'section'     => 'banner_select',
	'default'     => '2',
	'priority'    => 1,
	'choices'     => array(
		'1'   => esc_attr__( 'Custom Banner', 'venture-lite' ),
		'2' => esc_attr__( 'Post/Page', 'venture-lite' ),
	),
) );


Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-banner-slug',
	'label'    => __( 'Navigation Menu ID', 'venture-lite' ),
	'section'  => 'banner_select',
	'type'     => 'text',
	'priority' => 1,
	'default'  => 'home',
	'description'   => __( 'The frontpage section IDs (what shows up in the hover state and the address bar when clicked) have already been set to a default show in this field. If you would like to change the ID so that a different term comes up in the slug for that section (ie. http://example.com/#top instead of /#home), then change the term below for the corresponding section. You will also want to add the custom menu items in the Menus section of your dashboard (click "Links," then add the entire URL, such as http://example.com/#top). IMPORTANT: You must also add this term to the title field in the menu editor. If you do not see this field you may have to activate it by selecting the Screen Options tab in the top right of the page and then checking the Title Attribute box.', 'venture-lite' ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'custom',
	'settings'    => 'fp-banner-background-note',
	'label'       => 'Banner Background Image',
	'section'     => 'banner_select',
	'default'     => __( 'You can populate the banner background as well as any transparent containers throughout your website via the WordPress Core - Background Image setting. Look for this setting in the left sidebar or on the customizer.', 'venture-lite' ),
	'priority'    => 10,
) );


Kirki::add_section( 'pp_banner_options', array(
    'title'          => __( 'Post/Page Banner Options', 'venture-lite' ),
    'description'    => '',
    'panel'          => 'frontpage_banners',
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'fp-pp-banner-toggle',
	'label'       => __( 'Use Post or Page?', 'venture-lite' ),
	'section'     => 'pp_banner_options',
	'default'     => 'post',
	'priority'    => 1,
	'choices'     => array(
		'post'    => esc_attr__( 'Use Post', 'venture-lite' ),
		'page'    => esc_attr__( 'Use Page', 'venture-lite' ),
	),
) );


Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'select',
	'settings'    => 'fp_pp_banner_posts',
	'label'       => __( 'Choose a Post (from latest 50)', 'venture-lite' ),
	'section'     => 'pp_banner_options',
	'default'     => 'option-1',
	'priority'    => 1,
	'multiple'    => 1,
	'choices'     => Kirki_Helper::get_posts( array( 'posts_per_page' => 50, 'post_type' => 'post' ) ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'select',
	'settings'    => 'fp_pp_banner_page',
	'label'       => __( 'Choose a Page (from latest 50)', 'venture-lite' ),
	'section'     => 'pp_banner_options',
	'default'     => 'option-1',
	'priority'    => 1,
	'multiple'    => 1,
	'choices'     => Kirki_Helper::get_posts( array( 'posts_per_page' => 50, 'post_type' => 'page' ) ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-pp-banner-sub-title-override',
	'label'    => __( 'Banner - Sub Title - Override', 'venture-lite' ),
	'section'  => 'pp_banner_options',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'description'   => __( 'This is the smaller text in the banner. This will override the automatically generated exerpt.', 'venture-lite' ),
) );



Kirki::add_section( 'banner_options', array(
    'title'          => __( 'Custom Banner Options', 'venture-lite' ),
    'description'    => '',
    'panel'          => 'frontpage_banners',
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );




Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-banner-title',
	'label'    => __( 'Banner - Main Title', 'venture-lite' ),
	'section'  => 'banner_options',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'description'   => __( 'This is the big text in the banner. Leave blank to hide.', 'venture-lite' ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-banner-sub-title',
	'label'    => __( 'Banner - Sub Title', 'venture-lite' ),
	'section'  => 'banner_options',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'description'   => __( 'This is the smaller text in the banner. Leave blank to hide.', 'venture-lite' ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-banner-button-text',
	'label'    => __( 'Banner - Button Text', 'venture-lite' ),
	'section'  => 'banner_options',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'description'   => __( 'This is the button in the banner. Leave blank to hide.', 'venture-lite' ),
) );

Kirki::add_field( 'venture-lite-config', array(
	'settings' => 'fp-banner-button-url',
	'label'    => __( 'Banner - Button Destination URL', 'venture-lite' ),
	'section'  => 'banner_options',
	'type'     => 'text',
	'priority' => 10,
	'default'  => '',
	'description'   => __( 'This is the button link destination in the banner.', 'venture-lite' ),
	'sanitize_callback' => 'venture_lite_sanitize_url'
) );







Kirki::add_section( 'blog-settings', array(
    'title'          => __( 'Blog Settings', 'venture-lite' ),
    'description'    => '',
    'panel'          => '', 
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
) );

Kirki::add_field( 'venture-lite-config', array(
	'type'        => 'radio-buttonset',
	'settings'    => 'full-excerpt',
	'label'       => __( 'Choose Blog/Archive Display', 'venture-lite' ),
	'section'     => 'blog-settings',
	'default'     => '2',
	'priority'    => 1,
	'choices'     => array(
		'1'   => esc_attr__( 'Full', 'venture-lite' ),
		'2'  => esc_attr__( 'Excerpt', 'venture-lite' ),
	),
) );



// #################################################
// Get Options
// #################################################
    
function nimbus_get_option($optionID, $default_data = false) {
    if (get_theme_mod( $optionID )) {
        return get_theme_mod( $optionID );   
    } else {
        return NULL;
    }
}



// #################################################
// Some Custom Sanitize Functions
// #################################################

function venture_lite_sanitize_url( $value ) {

    $value=esc_url( $value );

    return $value;

}

function venture_lite_sanitize_email( $value ) {

    $value=sanitize_email( $value );

    return $value;

}