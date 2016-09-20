<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

function level_notice() {
	if ( isset( $_GET['activated'] ) ) {
		$return = '<div class="updated activation"><p>';
					$my_theme = wp_get_theme();
	
		$return .= ' <a class="button button-primary theme-options" href="' . esc_url(admin_url( 'customize.php' )) . '">' . __( 'Theme Options', 'level' ) . '</a>';
		$return .= ' <a class="button button-primary help" href="http://www.insertcart.com/level-theme-setup-guide/">' . __( 'Need Help?', 'level' ) . '</a>';
		$return .= '</p></div>';
		echo $return;
	}
}
add_action( 'admin_notices', 'level_notice' );

/*
 * Hide core theme activation message.
 */
function level_admincss() { 
	?>

	<style>
	.themes-php div.activation a {
		text-decoration: none;
	}
	</style>
<?php }
add_action( 'admin_head-themes.php', 'level_admincss' );
