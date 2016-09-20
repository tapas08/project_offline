<?php
/**
 * level Theme Customizer.
 *
 * @package level
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function level_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';	
	$wp_customize->get_section( 'title_tagline'  )->title		= __('Site Titles & Logo','level');
	$wp_customize->remove_control( 'blogdescription');
	$wp_customize->get_control( 'header_text'  )->label			= __('Display Site Title','level');
	$wp_customize->get_section( 'title_tagline'  )->priority	= 10;
	$wp_customize->get_section( 'colors'  )->title				= __('Logo Text & Background Color','level');
	$wp_customize->get_section( 'colors'  )->panel				= 'level_panel_design';
	$wp_customize->get_section( 'background_image'  )->panel	= 'level_panel_design';
	
	// Theme important links started
   class level_Important_Links extends WP_Customize_Control {

      public $type = "level-important-links";

      public function render_content() {
         //Add Theme instruction
		 echo '<ul><b>
			<li>' . esc_attr__( '* WooCommerce & bbPress Support', 'level' ) . '</li>
			<li>' . esc_attr__( '* SEO Optimized', 'level' ) . '</li>
			<li>' . esc_attr__( '* More Responsive Design', 'level' ) . '</li>
			<li>' . esc_attr__( '* Full Support', 'level' ) . '</li>
			<li>' . esc_attr__( '* Google Fonts', 'level' ) . '</li>
			<li>' . esc_attr__( '* Theme Color Customization', 'level' ) . '</li>
			<li>' . esc_attr__( '* Custom CSS', 'level' ) . '</li>
			<li>' . esc_attr__( '* Website Layout', 'level' ) . '</li>
			<li>' . esc_attr__( '* Select Number of Columns', 'level' ) . '</li>
			<li>' . esc_attr__( '* Website Width Control', 'level' ) . '</li>
			</b></ul>
		 ';
         $important_links = array(
            'theme-info' => array(
               'link' => esc_url('http://www.insertcart.com/product/level-wordpress-theme/'),
               'text' => __('Level Pro', 'level'),
            ),
            'support' => array(
               'link' => esc_url('http://www.insertcart.com/contact-us/'),
               'text' => __('Contact us', 'level'),
            ),    
			       
         );
         foreach ($important_links as $important_link) {
            echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
         }
               }

   }

   $wp_customize->add_section('level_important_links', array(
      'priority' => 1,
      'title' => __('Upgrade to Pro', 'level'),
   ));

   $wp_customize->add_setting('level_important_links', array(
      'capability' => 'edit_theme_options',
      'sanitize_callback' => 'level_links_sanitize'
   ));

   $wp_customize->add_control(new level_Important_Links($wp_customize, 'important_links', array(
      'section' => 'level_important_links',
      'settings' => 'level_important_links'
   )));
	// Custom CSS
	$wp_customize->add_section('custom_section_css',
		array(
			'title'			=> __( 'Custom CSS', 'level' ),			
			'panel'			=> 'level_panel_design',
            'priority'    => 62,
		));
	// Top Navigation Color
	$wp_customize->add_section( 'top_navi_colorbg' , array(
    'title'      => __( 'Top Navigation Color', 'level' ),
	'panel'			=> 'level_panel_design',
    'priority'   => 64,
) );


/**************************************************
* Settings
***************************************************/
 $wp_customize->add_setting('custom_css',
		array(
			'default'			=> '',
			'section'		=> 'custom_section_css',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'level_sanitize_css'
		)
	);
$wp_customize->add_setting('radio_menu',
    array(
        'default'			=> 'fixed',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'level_sanitize_select'
    )
);
$wp_customize->add_setting( 'topnavbgcolor' , array(
    'default'     => '#40ACEC',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorsub' , array(
    'default'     => '#20598a',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting( 'topnavbgcolorfont' , array(
    'default'     => '#ffffff',
    'transport'   => 'refresh',
	'sanitize_callback'	=> 'sanitize_hex_color',
) );
$wp_customize->add_setting('search_setting',
    array(
        'default'			=> 'show',
			'type'				=> 'theme_mod',
			'capability'		=> 'edit_theme_options',
			'sanitize_callback'	=> 'level_sanitize_select'
    )
);
/**************************************************
* Layout
***************************************************/
// Post Settings
	$wp_customize->add_section( 'level_panel_layout' , array(
    'title'      => __( 'Layout', 'level' ),
	'panel'			=> 'level_panel_design',
    'priority'   => 2,
) );


//Author Profile
 $wp_customize->add_setting('website_layout',	
	array(
		'default'			=> 'rightside',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'level_sanitize_select'
	));
$wp_customize->add_control('website_layout',
                         array (                             
							'type' => 'radio',
							'label' => __('Post and Page Layout','level'),
							'settings'   => 'website_layout',
							'section' => 'level_panel_layout',
							'choices' => array(          
							'rightside' => __('Right Sidebar','level'),
							'left' => __('Left Sidebar','level'),
							'full' => __('Full Width [No sidebar]','level'),
                         )
						 ));	
	
/**************************************************
* Fonts
***************************************************/
$font_array = array('Helvetica Neue','Helvetica','Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater');
$fonts = array_combine($font_array, $font_array);
// Body Fonts
	$wp_customize->add_section( 'level_panel_bodyfonts' , array(
    'title'      => __( 'Body Fonts', 'level' ),
	'panel'			=> 'level_panel_advance',
    'priority'   => 1,
) );	
$wp_customize->add_setting(
	'level_title_font',
	array(
		'default'=> 'Open Sans',
		'sanitize_callback' => 'level_sanitize_gfont' 
		)
);
$wp_customize->add_control(
	'level_title_font',array(
			'label' => __('Title','level'),
			'settings' => 'level_title_font',
			'section'  => 'level_panel_bodyfonts',
			'type' => 'select',
			'choices' => $fonts,
		)
);
$wp_customize->add_setting(
		'level_body_font',
			array(	'default'=> 'Helvetica',
					'sanitize_callback' => 'level_sanitize_gfont' )
	);

$wp_customize->add_control(
		'level_body_font',array(
				'label' => __('Body','level'),
				'settings' => 'level_body_font',
				'section'  => 'level_panel_bodyfonts',
				'type' => 'select',
				'choices' => $fonts
			)
	);
/**************************************************
* Post Settings
***************************************************/
// Post Settings
	$wp_customize->add_section( 'level_panel_postsettings' , array(
    'title'      => __( 'Post Settings', 'level' ),
	'panel'			=> 'level_panel_advance',
    'priority'   => 2,
) );


$wp_customize->add_setting('random_post',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'level_sanitize_select'
	));
$wp_customize->add_control('random_post',
                         array (                             
							'type' => 'radio',
							'label' => __('Random Post Below Post','level'),
							'settings'   => 'random_post',
							'section' => 'level_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','level'),
							'disable' => __('Disable','level'),
                         )
						 ));
$wp_customize->add_setting('level_author_profile',	
	array(
		'default'			=> 'enable',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'sanitize_callback'	=> 'level_sanitize_select'
	));
$wp_customize->add_control('level_author_profile',
                         array (                             
							'type' => 'radio',
							'label' => __('Show Author Profile in Post and Pages','level'),
							'settings'   => 'level_author_profile',
							'section' => 'level_panel_postsettings',
							'choices' => array(
							'enable' => __('Enable','level'),
							'disable' => __('Disable','level'),
                         )
						 ));
						 
/**************************************************
* Footer Copyright
***************************************************/
	$wp_customize-> add_section(
    'level_custom_footer',
    array(
    	'title'			=> __('Custom Footer Text','level'),
    	'description'	=> __('Enter your Own Copyright Text.','level'),
    	'priority'		=> 3,
    	'panel'			=> 'level_panel_advance'
    	)
    );
    
	$wp_customize->add_setting(
	'level_footer_text',
	array(
		'default'		=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
		)
	);
	
	$wp_customize->add_control(	 
	       'level_footer_text',
	        array(
	            'section' => 'level_custom_footer',
	            'settings' => 'level_footer_text',
	            'type' => 'text'
	        )
	);
	
/**************************************************
* Social
***************************************************/
	// Social Icons
	$wp_customize->add_section('level_social_section', array(
			'title' => __('Social Icons','level'),
			'priority' => 44 ,
				'panel'	=> 'level_panel_advance'
	));
	
	$social_networks = array( //Redefinied in Sanitization Function.
					'none' => __('-','level'),
					'facebook' => __('Facebook','level'),
					'twitter' => __('Twitter','level'),
					'google-plus' => __('Google Plus','level'),
					'instagram' => __('Instagram','level'),
					'rss' => __('RSS Feeds','level'),
					'vine' => __('Vine','level'),
					'vimeo-square' => __('Vimeo','level'),
					'youtube' => __('Youtube','level'),
					'flickr' => __('Flickr','level'),
				);
				
	$social_count = count($social_networks);
				
	for ($x = 1 ; $x <= ($social_count - 3) ; $x++) :
			
		$wp_customize->add_setting(
			'level_social_'.$x, array(
				'sanitize_callback' => 'level_sanitize_social',
				'default' => 'none'
			));

		$wp_customize->add_control( 'level_social_'.$x, array(
					'settings' => 'level_social_'.$x,
					'label' => __('Icon ','level').$x,
					'section' => 'level_social_section',
					'type' => 'select',
					'choices' => $social_networks,			
		));
		
		$wp_customize->add_setting(
			'level_social_url'.$x, array(
				'sanitize_callback' => 'esc_url_raw'
			));

		$wp_customize->add_control( 'level_social_url'.$x, array(
					'settings' => 'level_social_url'.$x,
					'description' => __('Icon ','level').$x.__(' Url','level'),
					'section' => 'level_social_section',
					'type' => 'url',
					'choices' => $social_networks,			
		));
		
	endfor;
	
	function level_sanitize_social( $input ) {
		$social_networks = array(
					'none' ,
					'facebook',
					'twitter',
					'google-plus',
					'instagram',
					'rss',
					'vine',
					'vimeo-square',
					'youtube',
					'flickr'
				);
		if ( in_array($input, $social_networks) )
			return $input;
		else
			return '';	
	}	
	
	
/**************************************************
* Control
***************************************************/
	$wp_customize->add_control('custom_css',
		array(
			'settings'		=> 'custom_css',
			'section'		=> 'custom_section_css',
			'type'			=> 'textarea',
			'label'			=> __( 'Custom CSS', 'level' ),
			'description'	=> __( 'Define custom CSS be used for your site. Do not enclose in script tags.', 'level' ),
		));
	$wp_customize->add_control('radio_menu',
    array(
        'type' => 'radio',
        'label' => __('Top Navigation Position','level'),
		'settings'   => 'radio_menu',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'fixed' => __('Float','level'),
            'relative' => __('Fixed','level'),
        ) ));		
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolor', array(
	'label'        => __( 'Top Navigation Color', 'level' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolor',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorsub', array(
	'label'        => __( 'Sub Menu Color', 'level' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorsub',
	) ) );
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'topnavbgcolorfont', array(
	'label'        => __( 'Top Menu Font Color', 'level' ),
	'section'    => 'top_navi_colorbg',
	'settings'   => 'topnavbgcolorfont',
	) ) );
$wp_customize->add_control('search_setting',
    array(
        'type' => 'radio',
        'label' => __('Search Bar','level'),
		'settings'   => 'search_setting',
        'section' => 'top_navi_colorbg',
        'choices' => array(
            'show' => __('Show','level'),
            'hide' => __('Hide','level'),
        ) ));
		

/**************************************************
* Customizer Panels
***************************************************/	
	$wp_customize->add_panel('level_panel_geranal',
		array(
			'priority' 			=> 11,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'General Settings', 'level' ),
			'description' 		=> __( 'Configure color and layout settings for the Theme Name Theme', 'level' ),
		)
	);
	$wp_customize->add_panel('level_panel_design',
		array(
			'priority' 			=> 12,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Color, Design & CSS', 'level' ),
			'description' 		=> __( 'Configure color and layout settings for the Level Theme', 'level' ),
		)
	);
	$wp_customize->add_panel('level_panel_advance',
		array(
			'priority' 			=> 13,
			'capability' 		=> 'edit_theme_options',
			'theme_supports'	=> '',
			'title' 			=> __( 'Advance Settings', 'level' ),
			'description' 		=> __( 'Advance Settings related to footer copyright and Enable options', 'level' ),
		)
	);

	

}
add_action( 'customize_register', 'level_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function level_customize_preview_js() {
	wp_enqueue_script( 'level_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'level_customize_preview_js' );

/************************************
 * sanitization callback.
 ***********************************/
function level_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}
function level_sanitize_hex_color( $hex_color, $setting ) {
	// Sanitize $input as a hex value without the hash prefix.
	$hex_color = sanitize_hex_color( $hex_color );
	
	// If $input is a valid hex value, return it; otherwise, return the default.
	return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}
function level_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}
function level_sanitize_gfont( $input ) {
		if ( in_array($input, array('Helvetica Neue','Helvetica','Raleway','Khula','Open Sans','Indie Flower','Droid Sans','Droid Serif','Roboto','Roboto Condensed','Lato','Bree Serif','Oswald','Slabo','Lora','Source Sans Pro','PT Sans','Ubuntu','Lobster','Arimo','Bitter','Noto Sans','Fjalla One','PT Sans Narrow','Poiret One','Passion One','Arvo','Inconsolata','Shadows Into Light','Pacifico','Dancing Script','Architects Daughter','Sigmar One','Righteous','Amatic SC','Orbitron','Chewy','Lobster Two','Gloria Hallelujah','Lekton','Almendra Display','Swanky and Moo Moo','Hanalei Fill','Uncial Antiqua','Rouge Script','Engagement','Bonbon','Caesar Dressing','Kenia','Lemon','Stardos Stencil','Bilbo','Macondo','Delius Unicase','Butcherman','Monoton','Nosifer','Codystar','Fontdiner Swanky','Diplomata SC','Snowburst One','Faster One','Rock Salt','Eater') ) )
			return $input;
		else
			return '';	
	}