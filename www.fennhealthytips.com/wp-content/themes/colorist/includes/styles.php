<?php

function colorist_custom_styles($custom) {
$custom = '';	
	$sticky_header_position = get_theme_mod('sticky_header_position') ;
	if( $sticky_header_position == 'bottom') {
		$custom .= ".sticky-header #nav-wrap {  top: auto!important;
			bottom:0; 
               border-top: 2px solid #d7d7d7; }"."\n";	
		$custom .= ".sticky-header #nav-wrap .nav-menu .sub-menu  {  top: auto;
			bottom:100%; }"."\n";    	
	}	

	$page_title_bar = get_theme_mod('page_titlebar');
     switch ($page_title_bar) {
     	case 2:
     		$custom .= ".breadcrumb-wrap {   
     			background-color: transparent;
     			background-image: none;
     		}"."\n";
     		break;     	
     	case 3:   
     		$custom .= ".breadcrumb-wrap {
     			display: none;
     		}"."\n";
     		break;		
     }

     $nav_dd_bg_color = get_theme_mod('enable_dd_bg_color');
     if( $nav_dd_bg_color ) {
         $custom .= ".main-navigation ul ul a {
                    background-image: none;
               }"."\n";
     }
     

     $page_title_bar_status = get_theme_mod('page_titlebar_text');
     if( $page_title_bar_status == 2 ) {
     	    $custom .= ".breadcrumb-wrap .entry-header {
     			display: none;
     		}"."\n";
     }

	//Output all the styles
	wp_add_inline_style( 'colorist-style', $custom );	
}


add_action( 'wp_enqueue_scripts', 'colorist_custom_styles' );  
