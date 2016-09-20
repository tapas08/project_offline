<?php
/**
 * Getting started template
 */

$customizer_url = admin_url() . 'customize.php' ;
?>

<div id="getting_started" class="madar-lite-tab-pane active">

	<div class="madar-tab-pane-center">

		<h1 class="madar-lite-welcome-title">Welcome to Madar Lite! <?php if( !empty($madar_lite['Version']) ): ?> <sup id="madar-lite-theme-version"><?php echo esc_attr( $madar_lite['Version'] ); ?> </sup><?php endif; ?></h1>

		<p><?php esc_html_e( 'Our most popular free Multipurpose WordPress theme, Madar Lite!','madar-lite'); ?></p>
		<p><?php esc_html_e( 'We want to make sure you have the best experience using Madar Lite and that is why we gathered here all the necessary informations for you. We hope you will enjoy using Madar Lite, as much as we enjoy creating great products.', 'madar-lite' ); ?>

	</div>

	<hr />

	<div class="madar-tab-pane-center">

		<h1><?php esc_html_e( 'Getting started', 'madar-lite' ); ?></h1>

		<h4><?php esc_html_e( 'Customize everything in a single place.' ,'madar-lite' ); ?></h4>
		<p><?php esc_html_e( 'Using the WordPress Customizer panel you can easily customize every aspect of the theme.', 'madar-lite' ); ?></p>
		<p><a href="<?php echo esc_url( $customizer_url ); ?>" class="button button-primary"><?php esc_html_e( 'Go to Customizer', 'madar-lite' ); ?></a></p>

	</div>

	<div class="madar-lite-clear"></div>

	<hr />

	<div class="madar-tab-pane-center">

		<h1><?php esc_html_e( 'View full documentation', 'madar-lite' ); ?></h1>
		<p><?php esc_html_e( 'Need more details? Please check our full documentation for detailed information on how to start with Madar Lite.', 'madar-lite' ); ?></p>
		<p><a href="<?php echo esc_url( 'http://retina-theme.com/how-to-install-madar-lite-theme/' ); ?>" class="button button-primary"><?php esc_html_e( 'Read full documentation', 'madar-lite' ); ?></a></p>

	</div>


	<div class="madar-lite-clear"></div>

</div>
