<?php
function level_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'level_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1284,
		'height'                 => 250,    
'header-text'            => false,        
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'level_custom_header_setup' );