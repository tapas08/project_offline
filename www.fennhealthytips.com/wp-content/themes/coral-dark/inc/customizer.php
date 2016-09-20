<?php
/**
 * coral-dark Theme Customizer
 *
 * @package coral-dark
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

 //--------- Sanitize
function coral_dark_sanitize_yesno($setting){ if ( 0==$setting || 1==$setting ) return $setting; return 1;}
function coral_dark_sanitize_voffset($setting){ if (is_numeric($setting) && $setting>=0) return $setting; return 25;}
function coral_dark_sanitize_voffset2($setting){ if (is_numeric($setting)) return $setting; return 0;}
function coral_dark_sanitize_logoheight($setting){ if (is_numeric($setting) && $setting>=40 && $setting<=300) return $setting; return 100;}
function coral_dark_sanitize_size($setting){ if (is_numeric($setting) && $setting>=0) return $setting; return 0;}
function coral_dark_sanitize_typography( $input ) {
	$valid = array( 	"Default font" => "Default font",
							"Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
							"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
							"'Helvetica Neue', Helvetica, Arial, sans-serif" => "'Helvetica Neue', Helvetica, Arial, sans-serif",
							"'Comic Sans MS', cursive, sans-serif" => "'Comic Sans MS', cursive, sans-serif",
							"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
							"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
							"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
							"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
							"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif",
							"Georgia, serif" => "Georgia, serif",
							"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
							"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
							"'Courier New', Courier, monospace" => "'Courier New', Courier, monospace",
							"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace"
	); 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return "Default font";
    }
}
function coral_dark_sanitize_pausetime($setting){ if (is_numeric($setting) && $setting>=0) return $setting; return 5000;}
function coral_dark_sanitize_animspeed($setting){ if (is_numeric($setting) && $setting>=0) return $setting; return 500;}
function coral_dark_sanitize_effect( $input ) {
    $valid = array(
				'fade' => 'fade',
				'fold' => 'fold',
				'random' => 'random',
				'sliceDown' => 'sliceDown',
				'sliceDownLeft' => 'sliceDownLeft',
				'sliceDownLeft' => 'sliceDownLeft',
				'sliceUp' => 'sliceUp',
				'sliceUpLeft' => 'sliceUpLeft',
				'sliceUpDown' => 'sliceUpDown',
				'sliceUpDownLeft' => 'sliceUpDownLeft',
				'slideInRight' => 'slideInRight',
				'slideInLeft' => 'slideInLeft',
				'boxRandom' => 'boxRandom',
				'boxRain' => 'boxRain',
				'boxRainReverse' => 'boxRainReverse',
				'boxRainGrow' => 'boxRainGrow',
				'boxRainGrowReverse' => 'boxRainGrowReverse',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function coral_dark_sanitize_checkbox( $input ) {
		if ( $input == '1' ) {
			return '1';
		} else {
			return '';
		}
}
function coral_dark_sanitize_radio( $input ) {
    $valid = array(
        '1' => __( 'Yes', 'coral-dark' ),
		'0' => __( 'No, I want to display my own images', 'coral-dark' ),
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

//---------- Controls
if ( class_exists( 'WP_Customize_Control' ) ) {
	class Coral_Dark_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" class="custom-textarea" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

    class Coral_Dark_Text_Description_Control extends WP_Customize_Control {
        public $description;

	    public function render_content() {
			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <input type="text" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
            </label>
            <p class="description more-top"><?php echo ( $this->description ); ?></p>
			<?php
        }
    }
}
// function coral_dark_customize_controls_print_styles() {
// 	wp_enqueue_style( 'coral_dark_customizer_css', get_template_directory_uri() . '/css/customizer.css' );
// }
// add_action( 'customize_controls_print_styles', 'coral_dark_customize_controls_print_styles' );

function coral_dark_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

// Site title section panel ------------------------------------------------------
		$wp_customize->add_section( 'title_tagline', array(
			'title' => __( 'Logo, Site Title, Tagline, Site Icon', 'coral-dark' ),
			'priority' => 20,
		) );
		$choices =  array(
			'10' => '10%',
			'15' => '15%',
			'20' => '20%',
			'25' => '25%',
			'30' => '30%',
			'33' => '33%',
			'35' => '35%',
			'40' => '40%',
			'45' => '45%',
			'50' => '50%',
		);
		$wp_customize->add_setting( 'coral_dark_logowidth_setting', array(
			'default' => '35',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'coral_dark_logowidth_control', array(
			'label' => __( 'Max. width of the logo image or text (site title and tagline):', 'coral-dark' ),
			'description' => __( 'This also affects the place width of the social icons and the search form.', 'coral-dark' ),
			'section' => 'title_tagline',
			'settings' => 'coral_dark_logowidth_setting',
			'priority' => 8,
			'type' => 'select',
			'choices' => $choices,
		) );	
		$logoharr =  array( 40 => '40px');
		for ($i = 41; $i <= 300; $i++) {
			$logoharr[$i]=$i."px";
		}
		$wp_customize->add_setting( 'coral_dark_logoheight_setting' , array(
			'default'           => 100,
            'sanitize_callback' => 'coral_dark_sanitize_logoheight',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_logoheight_control', array(
			'label' 			=> __( 'Max. height of the logo image', 'coral-dark' ),
			'section' 			=> 'title_tagline',
			'settings' 			=> 'coral_dark_logoheight_setting',
			'priority' 			=> 9,
			'type' => 'select',
			'choices' => $logoharr,
		) );	
		$wp_customize->add_setting( 'blogname', array(
			'default'    => get_option( 'blogname' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'blogname', array(
			'label'      => __( 'Site Title', 'coral-dark' ),
			'description' => __( 'This is displayed only if you do not upload an image logo', 'coral-dark' ),
			'section'    => 'title_tagline',
			'priority' => 10,
		) );

		$wp_customize->add_setting( 'blogdescription', array(
			'default'    => get_option( 'blogdescription' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'sanitize_text_field',
		) );

		$wp_customize->add_control( 'blogdescription', array(
			'label'      => __( 'Tagline', 'coral-dark' ),
			'description' => __( 'This is displayed only if you do not upload an image logo', 'coral-dark' ),
			'section'    => 'title_tagline',
			'priority' => 20,
		) );

		$vposarr =  array( -100 => '-100px');
		for ($i = -99; $i <= 100; $i++) {
			$vposarr[$i]=$i."px";
		}
		$wp_customize->add_setting( 'coral_dark_titleoffset_setting' , array(
			'default'           => 25,
            'sanitize_callback' => 'coral_dark_sanitize_voffset2',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_titleoffset_control', array(
			'label' 			=> __( 'Vertical position (margin-top) of the site title', 'coral-dark' ),
			'section' 			=> 'title_tagline',
			'settings' 			=> 'coral_dark_titleoffset_setting',
			'priority' 			=> 58,
			'type' => 'select',
			'choices' => $vposarr,
		) );	
		$wp_customize->add_setting( 'coral_dark_taglineoffset_setting' , array(
			'default'           => -5,
            'sanitize_callback' => 'coral_dark_sanitize_voffset2',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_taglineoffset_control', array(
			'label' 			=> __( 'Vertical position (margin-top) of the tagline', 'coral-dark' ),
			'section' 			=> 'title_tagline',
			'settings' 			=> 'coral_dark_taglineoffset_setting',
			'priority' 			=> 59,
			'type' => 'select',
			'choices' => $vposarr,
		) );	

// Layout section panel ------------------------------------------------------
		$wp_customize->add_section( 'coral_dark_layout_section', array(
			'title' => __( 'Layout', 'coral-dark' ),
			'priority' => 27,
		) );

		$wp_customize->add_setting( 'coral_dark_socialoffset_setting' , array(
			'default'           => '47',
            'sanitize_callback' => 'coral_dark_sanitize_voffset2',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_socialoffset_control', array(
			'label' 			=> __( 'Vertical position (margin-top) of the social icons', 'coral-dark' ),
			'section' 			=> 'coral_dark_layout_section',
			'settings' 			=> 'coral_dark_socialoffset_setting',
			'priority' 			=> 39,
			'type' => 'select',
			'choices' => $vposarr,
		) );	
		$wp_customize->add_setting( 'coral_dark_showsearch_setting', array(
			'default' => '1',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'coral_dark_sanitize_yesno',
		) );

		$wp_customize->add_control( 'coral_dark_showsearch_control', array(
			'label' => __( 'Display search form?', 'coral-dark' ),
			'section' => 'coral_dark_layout_section',
			'settings' => 'coral_dark_showsearch_setting',
			'priority' => 40,
			'type' => 'select',
			'choices' => array(
				'1' => __( 'Yes', 'coral-dark' ),
				'0' => __( 'No', 'coral-dark' ),
			),
		) );	
		$choices2 =  array(
			'10' => '10%',
			'15' => '15%',
			'20' => '20%',
			'25' => '25%',
			'30' => '30%',
			'33' => '33%',
			'35' => '35%',
			'40' => '40%',
			'45' => '45%',
			'50' => '50%',
			'55' => '55%',
			'60' => '60%',
			'65' => '65%',
			'66' => '66%',
			'70' => '70%',
			'75' => '75%',
			'80' => '80%',
			'85' => '85%',
			'90' => '90%',
			'95' => '95%',
			'100' => '100%',
		);
		$wp_customize->add_setting( 'coral_dark_searchwidth_setting', array(
			'default' => '40',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'coral_dark_searchwidth_control', array(
			'label' => __( 'Width of the search form:', 'coral-dark' ),
			'description' => __( 'Percentage of the place on the side of the logo text. (Here the full right side is 100%, but leave enough place for the social icons!)', 'coral-dark' ),
			'section' => 'coral_dark_layout_section',
			'settings' => 'coral_dark_searchwidth_setting',
			'priority' => 42,
			'type' => 'select',
			'choices' => $choices2,
		) );
		$wp_customize->add_setting( 'coral_dark_searchoffset_setting' , array(
			'default'           => '42',
            'sanitize_callback' => 'coral_dark_sanitize_voffset2',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_searchoffset_control', array(
			'label' 			=> __( 'Vertical position (margin-top) of the search box', 'coral-dark' ),
			'section' 			=> 'coral_dark_layout_section',
			'settings' 			=> 'coral_dark_searchoffset_setting',
			'priority' 			=> 44,
			'type' => 'select',
			'choices' => $vposarr,
		) );	
		$wp_customize->add_setting( 'coral_dark_menuoffset_setting' , array(
			'default'           => '15',
            'sanitize_callback' => 'coral_dark_sanitize_voffset2',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( 'coral_dark_menuoffset_control', array(
			'label' 			=> __( 'Vertical position (margin-top) of the topmenu', 'coral-dark' ),
			'section' 			=> 'coral_dark_layout_section',
			'settings' 			=> 'coral_dark_menuoffset_setting',
			'priority' 			=> 45,
			'type' => 'select',
			'choices' => $vposarr,
		) );
		$choices1 =  array(
			'10' => '10%',
			'15' => '15%',
			'20' => '20%',
			'25' => '25%',
			'30' => '30%',
			'33' => '33%',
			'35' => '35%',
			'40' => '40%',
			'45' => '45%',
			'50' => '50%',
			'55' => '55%',
			'60' => '60%',
			'65' => '65%',
			'66' => '66%',
			'70' => '70%',
		);
		$wp_customize->add_setting( 'coral_dark_sidebarwidth_setting', array(
			'default' => '30',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'coral_dark_sidebarwidth_control', array(
			'label' => __( 'Sidebar width:', 'coral-dark' ),
			'section' => 'coral_dark_layout_section',
			'settings' => 'coral_dark_sidebarwidth_setting',
			'priority' => 46,
			'type' => 'select',
			'choices' => $choices1,
		) );		

// Social icons section panel
		$wp_customize->add_section( 'coral_dark_social_icons_section', array(
			'title' 			=> __( 'Social icons', 'coral-dark' ),
			'priority'			=> 28,
			'description' => __( 'Type the target URL (with http://) if you need a social icon in the header, remove it if you do not need it!', 'coral-dark' ),
		) );
		$wp_customize->add_setting( 'coral_dark_youtube_url_setting' , array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'coral_dark_youtube_url_control', array(
			'label' 			=> __( 'Youtube URL (start with http://)', 'coral-dark' ),
			'section' 			=> 'coral_dark_social_icons_section',
			'settings' 			=> 'coral_dark_youtube_url_setting',
			'priority' 			=> 14,
		) ) );	
		$wp_customize->add_setting( 'coral_dark_feed_url_setting' , array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'coral_dark_feed_url_control', array(
			'label' 			=> __( 'Feed URL (start with http://)', 'coral-dark' ),
			'section' 			=> 'coral_dark_social_icons_section',
			'settings' 			=> 'coral_dark_feed_url_setting',
			'priority' 			=> 16,
		) ) );		
		$wp_customize->add_setting( 'coral_dark_twitter_url_setting' , array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'coral_dark_twitter_url_control', array(
			'label' 			=> __( 'Twitter URL (start with http://)', 'coral-dark' ),
			'section' 			=> 'coral_dark_social_icons_section',
			'settings' 			=> 'coral_dark_twitter_url_setting',
			'priority' 			=> 18,
		) ) );
		$wp_customize->add_setting( 'coral_dark_google_url_setting' , array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'coral_dark_google_url_control', array(
			'label' 			=> __( 'Google URL (start with http://)', 'coral-dark' ),
			'section' 			=> 'coral_dark_social_icons_section',
			'settings' 			=> 'coral_dark_google_url_setting',
			'priority' 			=> 20,
		) ) );		
		$wp_customize->add_setting( 'coral_dark_facebook_url_setting' , array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'coral_dark_facebook_url_control', array(
			'label' 			=> __( 'Facebook URL (start with http://)', 'coral-dark' ),
			'section' 			=> 'coral_dark_social_icons_section',
			'settings' 			=> 'coral_dark_facebook_url_setting',
			'priority' 			=> 22,
		) ) );	

// Typography
		$wp_customize->add_section( 'coral_dark_typography_section', array(
			'title' 			=> __( 'Typography', 'coral-dark' ),
			'priority'			=> 32,
			'description' => __( 'Here you can set up the typography with basic web safe fonts', 'coral-dark' ),
		) );
		$typoarr = array( 	"Default font" => "Default font",
							"Arial, Helvetica, sans-serif" => "Arial, Helvetica, sans-serif",
							"'Arial Black', Gadget, sans-serif" => "'Arial Black', Gadget, sans-serif",
							"'Helvetica Neue', Helvetica, Arial, sans-serif" => "'Helvetica Neue', Helvetica, Arial, sans-serif",
							"'Comic Sans MS', cursive, sans-serif" => "'Comic Sans MS', cursive, sans-serif",
							"Impact, Charcoal, sans-serif" => "Impact, Charcoal, sans-serif",
							"'Lucida Sans Unicode', 'Lucida Grande', sans-serif" => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
							"Tahoma, Geneva, sans-serif" => "Tahoma, Geneva, sans-serif",
							"'Trebuchet MS', Helvetica, sans-serif" => "'Trebuchet MS', Helvetica, sans-serif",
							"Verdana, Geneva, sans-serif" => "Verdana, Geneva, sans-serif",
							"Georgia, serif" => "Georgia, serif",
							"'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
							"'Times New Roman', Times, serif" => "'Times New Roman', Times, serif",
							"'Courier New', Courier, monospace" => "'Courier New', Courier, monospace",
							"'Lucida Console', Monaco, monospace" => "'Lucida Console', Monaco, monospace"
		);
		$wp_customize->add_setting( 'title_font_setting', array(
			'default'        => 'Default font',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'coral_dark_sanitize_typography',
		) );
		$wp_customize->add_control( 'title_font_control', array(
			'label'   			=> __('Site title font','coral-dark'),
			'section' 			=> 'coral_dark_typography_section',
			'settings' 			=> 'title_font_setting',
			'type'    			=> 'select',
			'priority'        	=> 5,
			'choices'    		=> $typoarr,
		) );
		$fontsizearr =  array('8' => '8px');
		for ($i = 8; $i <= 80; $i++) {
			$fontsizearr[$i]=$i."px";
		}
		$wp_customize->add_setting( 'coral_dark_titlesize_setting', array(
			'default' => '36',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'coral_dark_titlesize_control', array(
			'label' => __( 'Site title fontsize:', 'coral-dark' ),
			'section' => 'coral_dark_typography_section',
			'settings' => 'coral_dark_titlesize_setting',
			'priority' => 10,
			'type' => 'select',
			'choices' => $fontsizearr,
		) );
		$wp_customize->add_setting( 'tagline_font_setting', array(
			'default'        => 'Default font',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'coral_dark_sanitize_typography',
		) );
		$wp_customize->add_control( 'tagline_font_control', array(
			'label'   			=> __('Tagline font','coral-dark'),
			'section' 			=> 'coral_dark_typography_section',
			'settings' 			=> 'tagline_font_setting',
			'type'    			=> 'select',
			'priority'        	=> 15,
			'choices'    		=> $typoarr,
		) );
		
		$wp_customize->add_setting( 'coral_dark_taglinesize_setting', array(
			'default' => '14',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'coral_dark_taglinesize_control', array(
			'label' => __( 'Tagline fontsize:', 'coral-dark' ),
			'section' => 'coral_dark_typography_section',
			'settings' => 'coral_dark_taglinesize_setting',
			'priority' => 20,
			'type' => 'select',
			'choices' => $fontsizearr,
		) );	
		$wp_customize->add_setting( 'body_font_setting', array(
			'default'        => 'Default font',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'coral_dark_sanitize_typography',
		) );
		$wp_customize->add_control( 'body_font_control', array(
			'label'   			=> __('Body font','coral-dark'),
			'section' 			=> 'coral_dark_typography_section',
			'settings' 			=> 'body_font_setting',
			'type'    			=> 'select',
			'priority'        	=> 25,
			'choices'    		=> $typoarr,
		) );
		$fontsizearr2 =  array('8' => '8px');
		for ($i = 8; $i <= 30; $i++) {
			$fontsizearr2[$i]=$i."px";
		}
		$wp_customize->add_setting( 'body_fontsize_setting', array(
			'default' => '14',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'body_fontsize_control', array(
			'label' => __( 'Body fontsize:', 'coral-dark' ),
			'section' => 'coral_dark_typography_section',
			'settings' => 'body_fontsize_setting',
			'priority' => 30,
			'type' => 'select',
			'choices' => $fontsizearr2,
		) );
		$wp_customize->add_setting( 'heading_font_setting', array(
			'default'        => 'Default font',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'coral_dark_sanitize_typography',
		) );
		$wp_customize->add_control( 'heading_font_control', array(
			'label'   			=> __('Heading font','coral-dark'),
			'description' => __( 'The h1, h2... fontsizes are based on the body fontsize', 'coral-dark' ),
			'section' 			=> 'coral_dark_typography_section',
			'settings' 			=> 'heading_font_setting',
			'type'    			=> 'select',
			'priority'        	=> 35,
			'choices'    		=> $typoarr,
		) );


// Slider section panel
		$wp_customize->add_section( 'coral_dark_slider_section', array(
			'title' 			=> __( 'Slideshow', 'coral-dark' ),
			'priority'			=> 35,
			'description' => __( 'Upload at least 980px wide images with the same aspect ratio!', 'coral-dark' ),
		) );
		$wp_customize->add_setting( 'front_page_setting', array(
            'default'        	=> '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'coral_dark_sanitize_checkbox',
        ) );
        $wp_customize->add_control( 'front_page_control', array(
            'label'   			=> __( 'Display slideshow on frontpage', 'coral-dark' ),
            'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'front_page_setting',
            'type'    			=> 'checkbox',
            'priority' 			=> 3
        ) );
		$wp_customize->add_setting( 'allpages', array(
            'default'        	=> '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'coral_dark_sanitize_checkbox',
        ) );
        $wp_customize->add_control( 'allpages_control', array(
            'label'   			=> __( 'Always display the slideshow', 'coral-dark'),
            'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'allpages',
            'type'    			=> 'checkbox',
            'priority' 			=> 5
        ) );
		$wp_customize->add_setting( 'post_id_setting' , array(
			'default'           => '',
            'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'post_id_control', array(
			'label' 			=> __( 'Comma separated IDs of posts/pages for which you need the slideshow (e.g. 1, 23, 54).', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'post_id_setting',
			'priority' 			=> 6,
		) ) );	
		//-----------------------------------------------
		$wp_customize->add_setting( 'slider_effect_setting', array(
			'default'        => 'fade',
			'sanitize_callback' => 'coral_dark_sanitize_effect',
		) );
		
		$wp_customize->add_control( 'slider_effect_control', array(
			'label'   			=> __('Slideshow effect','coral-dark'),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slider_effect_setting',
			'type'    			=> 'select',
			'priority'        	=> 7,
			'choices'    		=> array(
				'fade' => 'fade',
				'fold' => 'fold',
				'random' => 'random',
				'sliceDown' => 'sliceDown',
				'sliceDownLeft' => 'sliceDownLeft',
				'sliceDownLeft' => 'sliceDownLeft',
				'sliceUp' => 'sliceUp',
				'sliceUpLeft' => 'sliceUpLeft',
				'sliceUpDown' => 'sliceUpDown',
				'sliceUpDownLeft' => 'sliceUpDownLeft',
				'slideInRight' => 'slideInRight',
				'slideInLeft' => 'slideInLeft',
				'boxRandom' => 'boxRandom',
				'boxRain' => 'boxRain',
				'boxRainReverse' => 'boxRainReverse',
				'boxRainGrow' => 'boxRainGrow',
				'boxRainGrowReverse' => 'boxRainGrowReverse',
			),
		) );
		$wp_customize->add_setting( 'slide_animspeed_setting' , array(
			'default'           => '500',
            'sanitize_callback' => 'coral_dark_sanitize_animspeed',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'slide_animspeed_control', array(
			'label' 			=> __( 'Animation speed (mS)', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_animspeed_setting',
			'priority' 			=> 8,
		) ) );	
		$wp_customize->add_setting( 'slide_pausetime_setting' , array(
			'default'           => '5000',
            'sanitize_callback' => 'coral_dark_sanitize_pausetime',
			'transport'         => 'refresh',
		));
		$wp_customize->add_control( new Coral_Dark_Text_Description_Control( $wp_customize, 'slide_pausetime_control', array(
			'label' 			=> __( 'Pause time (mS)', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_pausetime_setting',
			'priority' 			=> 9,
		) ) );	
		// ----------------------------------------------
		$wp_customize->add_setting( 'slide_title1' , array(
			'default'        	=> '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( 'slide_title_control1', array(
			'label' 			=> __( 'Slide title 1', 'coral-dark' ),
			'description' 		=> __( 'Choose a page for the slide title, to which the title is also linked', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_title1',
			'type' 				=> 'dropdown-pages',
			'priority' 			=> 10,
		) );		

		$wp_customize->add_setting( 'slider_image1', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image_control1', array(
			'label'        		=> __( 'Slider image 1', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slider_image1',
			'priority' 			=> 16,
		) ) );
		// ----------------------------------------------
		$wp_customize->add_setting( 'slide_title2' , array(
			'default'        	=> '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( 'slide_title_control2', array(
			'label' 			=> __( 'Slide title 2', 'coral-dark' ),
			'description' 		=> __( 'Choose a page for the slide title, to which the title is also linked', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_title2',
			'type' 				=> 'dropdown-pages',
			'priority' 			=> 20,
		) );		
	
		$wp_customize->add_setting( 'slider_image2', array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image_control2', array(
			'label'        		=> __( 'Slider image 2', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slider_image2',
			'priority' 			=> 26,
		) ) );
		// ----------------------------------------------
		$wp_customize->add_setting( 'slide_title3' , array(
			'default'        	=> '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( 'slide_title_control3', array(
			'label' 			=> __( 'Slide title 3', 'coral-dark' ),
			'description' 		=> __( 'Choose a page for the slide title, to which the title is also linked', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_title3',
			'type' 				=> 'dropdown-pages',
			'priority' 			=> 30,
		) );		
	
		$wp_customize->add_setting( 'slider_image3', array(
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image_control3', array(
			'label'        		=> __( 'Slider image 3', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slider_image3',
			'priority' 			=> 36,
		) ) );
		// ----------------------------------------------
		$wp_customize->add_setting( 'slide_title4' , array(
			'default'        	=> '0',
			'transport'         => 'refresh',
			'sanitize_callback' => 'absint',
		));
		$wp_customize->add_control( 'slide_title_control4', array(
			'label' 			=> __( 'Slide title 4', 'coral-dark' ),
			'description' 		=> __( 'Choose a page for the slide title, to which the title is also linked', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slide_title4',
			'type' 				=> 'dropdown-pages',
			'priority' 			=> 40,
		) );		
	
		$wp_customize->add_setting( 'slider_image4', array(
			'transport'         => 'refresh',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'slider_image_control4', array(
			'label'        		=> __( 'Slider image 4', 'coral-dark' ),
			'section' 			=> 'coral_dark_slider_section',
			'settings' 			=> 'slider_image4',
			'priority' 			=> 46,
		) ) );
// Color section panel
		$wp_customize->add_section( 'colors', array(
			'title'          => __( 'Colors', 'coral-dark' ),
			'priority'       => 40,
		) );		
		$wp_customize->add_setting( 'title_color_setting', array(
			'default'        => 'eeeeee',
			'capability' => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'title_color_control', array(
			'label'   => __( 'Site title color', 'coral-dark' ),
			'section' => 'colors',
			'settings' => 'title_color_setting',
			'priority' => 4,
		) ) );
		$wp_customize->add_setting( 'tagline_color_setting', array(
			'default'        => '999999',
			'capability' => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		) );
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'tagline_color_control', array(
			'label'   => __( 'Tagline Color', 'coral-dark' ),
			'section' => 'colors',
			'settings' => 'tagline_color_setting',
			'priority' => 6,
		) ) );
		$wp_customize->add_setting( 'background_color', array(
			'default'        => '000000',
			'capability' => 'edit_theme_options',
			'sanitize_callback'    => 'sanitize_hex_color_no_hash',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'background_color', array(
			'label'   => __( 'Background Color', 'coral-dark' ),
			'section' => 'colors',
			'settings' => 'background_color',
			'priority' => 8,
		) ) );
	
}
add_action( 'customize_register', 'coral_dark_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function coral_dark_customize_preview_js() {
	wp_enqueue_script( 'coral_dark_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'coral_dark_customize_preview_js' );
