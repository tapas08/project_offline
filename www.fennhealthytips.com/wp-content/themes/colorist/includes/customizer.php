<?php
/**
 * colorist Theme Customizer
 *
 * @package colorist
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function colorist_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'colorist_customize_register' );



/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function colorist_customize_preview_js() {
	wp_enqueue_script( 'colorist_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'colorist_customize_preview_js' );


if( get_theme_mod('enable_primary_color',false) ) {    

	add_action( 'wp_head','wbls_customizer_primary_custom_css' );

		function wbls_customizer_primary_custom_css() {
			$primary_color = get_theme_mod( 'primary_color','#eb416b'); ?> 
        	<style type="text/css">
        		.site-footer .scroll-to-top:hover,.portfolioeffects .portfolio_overlay {
        			opacity: 0.6;
        		}
        	</style>
<?php
	    }
}

add_action( 'wp_head','wbls_header_nav_type_custom_css' );

if(!function_exists('wbls_header_nav_type_custom_css') ) {
	function wbls_header_nav_type_custom_css() {
        $header_nav_type = get_theme_mod( 'header_nav_type','style1'); 
        if( $header_nav_type != 'style1') { ?>
              <style type="text/css">
                 .main-navigation a  {
                 	height: 70px;
                 	background: transparent;
                 	padding-left:0;
                 	padding-right:0;
                 	margin-right: 15px; 
                 }
                 .main-navigation .sub-menu a {
                 	height: auto;
                 	margin-right:0;
                 }
                 .main-navigation ul ul {
                 	top: 2.2em;
                 }
                 .main-navigation a:hover,.main-navigation .current_page_item a,.main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a {
                 	background: transparent;
                 	color: #eb416b;
                 	border-bottom: 5px solid #eb416b;
                 	border-radius:0;
                 }
              </style><?php
        }
        if( $header_nav_type == 'style3') { ?>
              <style type="text/css">
                 .main-navigation a:hover,.main-navigation .current_page_item a,.main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a {
                 	border-bottom: none;
                 }
              </style><?php
        }
     
    }
}

add_action( 'wp_head','wbls_header_nav_change_color_css' );

if(!function_exists('wbls_header_nav_change_color_css') ) {  
    function wbls_header_nav_change_color_css() {
    if( get_theme_mod('enable_primary_color',false) ) {
        $primary_color = get_theme_mod( 'primary_color','#eb416b'); 
        $header_nav_type = get_theme_mod( 'header_nav_type','style1');  
        	if( $header_nav_type != 'style1') { ?>  
        		<style type="text/css">
        			.main-navigation a:hover,.main-navigation .current_page_item a, .main-navigation .current-menu-item a, .main-navigation .current-menu-parent > a, .main-navigation .current_page_parent > a {
        				border-bottom-color: <?php echo $primary_color; ?>!important;
        				color: <?php echo $primary_color; ?>!important;
        			}
        			.main-navigation .sub-menu a {
        				color: #ffffff!important;
        			}
        		</style>  
        	<?php } 
        }
    }
}