<?php
/**
 * Matata Theme Customizer.
 *
 * @package Matata
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function matata_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Theme important links started
	class MATATA_Important_Links extends WP_Customize_Control {
		public $type = "matata-important-links";
		public function render_content() {
		//Add Theme Documentation, Support Forum, Demo Link
			$important_links = array(
				'documentation' => array(
					'link' => esc_url('http://justhemes.com/documentation-matata'),
					'text' => __('Documentation', 'matata')
					),
				'support' => array(
					'link' => esc_url('http://justhemes.com/forums'),
					'text' => __('Support', 'matata')
					),
				'demo' => array(
					'link' => esc_url('http://justhemes.com/demo/matata'),
					'text' => __('View Demo', 'matata')
					),
				'rating' => array(
					'link' => esc_url('https://wordpress.org/support/view/theme-reviews/matata'),
					'text' => __('Rate This Theme', 'matata')
					)
				);
			foreach ($important_links as $important_link) {
				echo '<p><a target="_blank" href="' . $important_link['link'] . '" >' . esc_attr($important_link['text']) . ' </a></p>';
			}
		}
	}

	$wp_customize->add_section('matata_important_links', array(
		'priority' => 5,
		'title' => __('Matata Important Links', 'matata')
	));

	$wp_customize->add_setting('matata_important_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_links_sanitize'
	));

	$wp_customize->add_control(new MATATA_Important_Links($wp_customize, 'important_links', array(
		'label' => __('Important Links', 'matata'),
		'section' => 'matata_important_links',
		'settings' => 'matata_important_links'
	)));
	// Theme Important Links Ended

	// Start of the Matata Main Options
	$wp_customize->add_panel('matata_main_options', array(
		'capabitity' => 'edit_theme_options',
		'description' => __('Panel to update matata theme options', 'matata'),
		'priority' => 10,
		'title' => __('Matata Options', 'matata')
	));

	// home slider enable/disable
	$wp_customize->add_section('matata_home_slider_section', array(
		'title' => __('Home Slider', 'matata'),
		'panel' => 'matata_main_options',
		'priority' => 25
	));

	$wp_customize->add_setting('matata_home_slider', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_checkbox_sanitize'
	));

	$wp_customize->add_control('matata_home_slider', array(
		'type' => 'checkbox',
		'label' => __('Check to enable Home Slider. In order to see the slider you need to create a new page and assign it the "Homepage with Slider" template. Then set the page as front page.', 'matata'),
		'section' => 'matata_home_slider_section',
		'settings' => 'matata_home_slider'
	));

	// home slider options
	$categories = get_categories();
	$cats = array('default' => '');
	foreach($categories as $category){
		$cats[$category->slug] = $category->name;
	}
    $wp_customize->add_setting('matata_slide_categories', array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'matata_sanitize_slidecat'
    ));
    $wp_customize->add_control('matata_slide_categories', array(
        'label' => __('Slider Category', 'matata'),
        'section' => 'matata_home_slider_section',
        'type'    => 'select',
        'description' => __('Select a category for the featured post slider', 'matata'),
        'choices'    => $cats
    ));

    $wp_customize->add_setting('matata_slide_number', array(
        'default' => 3,
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'matata_sanitize_number'
    ));
    $wp_customize->add_control('matata_slide_number', array(
        'label' => __('Number of slide items', 'matata'),
        'section' => 'matata_home_slider_section',
        'description' => __('Enter the number of slide items', 'matata'),
        'type' => 'text'
    ));

	// primary color
	$wp_customize->add_section('matata_primary_color_setting', array(
		'panel' => 'matata_main_options',
		'priority' => 5,
		'title' => __('Primary Color', 'matata')
	));

	$wp_customize->add_setting('matata_primary_color', array(
		'default' => '#249ccc',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_color_option_hex_sanitize',
		'sanitize_js_callback' => 'matata_color_escaping_option_sanitize'
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'matata_primary_color', array(
		'label' => __('Choose a color to match your site', 'matata'),
		'section' => 'matata_primary_color_setting',
		'settings' => 'matata_primary_color'
	)));

	// blog post style
	$wp_customize->add_section('matata_post_style_setting', array(
		'priority' => 10,
		'title' => __('Blog Post Style', 'matata'),
		'panel' => 'matata_main_options'
	));

	$wp_customize->add_setting('matata_post_style', array(
		'default' => 'matata-magazine',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_show_radio_saniztize'
	));

	$wp_customize->add_control('matata_post_style', array(
		'type' => 'radio',
		'label' => __('Choose if you want to use magazine or normal blog post style.', 'matata'),
		'section' => 'matata_post_style_setting',
		'choices' => array(
			'matata-blog' => __('Blog', 'matata'),
			'matata-magazine' => __('Magazine', 'matata')
			)
	));

	// default layout setting
	$wp_customize->add_section('matata_default_layout_setting', array(
		'priority' => 20,
		'title' => __('Default Layout', 'matata'),
		'panel'=> 'matata_main_options'
		));

	$wp_customize->add_setting('matata_default_layout', array(
		'default' => 'right_sidebar',
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_layout_sanitize'
	));

	$wp_customize->add_control('matata_default_layout', array(
		'type' => 'radio',
		'label' => __('Select default layout. This layout will be reflected in whole site archives, categories, search page etc.', 'matata'),
		'section' => 'matata_default_layout_setting',
		'settings' => 'matata_default_layout',
		'choices' => array(
			'right_sidebar' => __('Right Sidebar', 'matata'),
			'left_sidebar' => __('Left Sidebar', 'matata'),
			'no_sidebar_full_width' => __('No Sidebar Full Width', 'matata'),
			'no_sidebar_content_centered' => __('No Sidebar Content Centered', 'matata')
			)
	));

	// Custom CSS
	$wp_customize->add_section('matata_custom_css_setting', array(
		'priority' => 30,
		'title' => __('Custom CSS', 'matata'),
		'panel'=> 'matata_main_options'
		));

	$wp_customize->add_setting('matata_custom_css', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'sanitize_textarea'
	));

	$wp_customize->add_control('matata_custom_css', array(
		'type' => 'textarea',
		'label' => __('Your Custom CSS', 'matata'),
		'section' => 'matata_custom_css_setting',
		'settings' => 'matata_custom_css'
	));

	// Social Options
	$wp_customize->add_section('matata_social_link_activate_settings', array(
		'title' => __('Social Links Area', 'matata'),
		'panel' => 'matata_main_options'
	));

	$wp_customize->add_setting('matata_social_link_activate', array(
		'default' => 0,
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'matata_checkbox_sanitize'
	));

	$wp_customize->add_control('matata_social_link_activate', array(
		'type' => 'checkbox',
		'label' => __('Check to activate social links area', 'matata'),
		'section' => 'matata_social_link_activate_settings',
		'settings' => 'matata_social_link_activate'
	));

	$matata_social_links = array(
		'matata_social_facebook' => array(
			'id' => 'matata_social_facebook',
			'title' => __('Facebook', 'matata'),
			'default' => ''
			),
		'matata_social_twitter' => array(
			'id' => 'matata_social_twitter',
			'title' => __('Twitter', 'matata'),
			'default' => ''
			),
		'matata_social_googleplus' => array(
			'id' => 'matata_social_googleplus',
			'title' => __('Google-Plus', 'matata'),
			'default' => ''
			),
		'matata_social_instagram' => array(
			'id' => 'matata_social_instagram',
			'title' => __('Instagram', 'matata'),
			'default' => ''
			),
		'matata_social_pinterest' => array(
			'id' => 'matata_social_pinterest',
			'title' => __('Pinterest', 'matata'),
			'default' => ''
			),
		'matata_social_youtube' => array(
			'id' => 'matata_social_youtube',
			'title' => __('YouTube', 'matata'),
			'default' => ''
			),
		);

	$i = 20;

	foreach($matata_social_links as $matata_social_link) {

		$wp_customize->add_setting($matata_social_link['id'], array(
			'default' => $matata_social_link['default'],
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw'
		));

		$wp_customize->add_control($matata_social_link['id'], array(
			'label' => $matata_social_link['title'],
			'section'=> 'matata_social_link_activate_settings',
			'settings'=> $matata_social_link['id'],
			'priority' => $i
		));

		$wp_customize->add_setting($matata_social_link['id'].'_checkbox', array(
			'default' => 0,
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'matata_checkbox_sanitize'
		));

		$wp_customize->add_control($matata_social_link['id'].'_checkbox', array(
			'type' => 'checkbox',
			'label' => __('Check to show in new tab', 'matata'),
			'section'=> 'matata_social_link_activate_settings',
			'settings'=> $matata_social_link['id'].'_checkbox',
			'priority' => $i
		));

		$i++;

	}

	function matata_show_radio_saniztize($input) {
		$valid_keys = array(
			'matata-blog' => __('Default', 'matata'),
			'matata-magazine' => __('Magazine', 'matata'),
			);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function matata_checkbox_sanitize($input) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function matata_color_option_hex_sanitize($color) {
		if ($unhashed = sanitize_hex_color_no_hash($color))
			return '#' . $unhashed;

		return $color;
	}

	function matata_color_escaping_option_sanitize($input) {
		$input = esc_attr($input);
		return $input;
	}

	function matata_layout_sanitize($input) {
		$valid_keys = array(
			'right_sidebar' => __('Right Sidebar', 'matata'),
			'left_sidebar' => __('Left Sidebar', 'matata'),
			'no_sidebar_full_width' => __('No Sidebar Full Width', 'matata'),
			'no_sidebar_content_centered' => __('No Sidebar Content Centered', 'matata')
			);
		if ( array_key_exists( $input, $valid_keys ) ) {
			return $input;
		} else {
			return '';
		}
	}

	function matata_links_sanitize() {
		return false;
	}

	// Sanitize textarea 
	function sanitize_textarea( $text ) {
		return esc_textarea( $text );
	}

	function matata_sanitize_number($input) {
	    if ( isset( $input ) && is_numeric( $input ) ) {
	        return $input;
	    }
    }

    function matata_sanitize_slidecat( $input ) {
    	$valid_keys = array(
    		'default' => '',
    		);
    	$categories = get_categories();
    	foreach($categories as $category){
    		$valid_keys[$category->slug] = $category->name;
    	}
	    if ( array_key_exists( $input, $valid_keys ) ) {
	        return $input;
	    } else {
	        return '';
	    }
	}

}
add_action( 'customize_register', 'matata_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function matata_customize_preview_js() {
	wp_enqueue_script( 'matata_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'matata_customize_preview_js' );
