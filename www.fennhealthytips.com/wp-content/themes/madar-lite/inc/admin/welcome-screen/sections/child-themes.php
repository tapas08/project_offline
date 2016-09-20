<?php
/**
 * Child themes template
 */
?>
<div id="child_themes" class="madar-lite-tab-pane">

	<?php
		$current_theme = wp_get_theme();
	?>

	<div class="madar-tab-pane-center">

		<h1><?php esc_html_e( 'Get a whole new look for your website', 'madar-lite' ); ?></h1>

		<p><?php esc_html_e( 'Below you will find a selection of highest downloaded themes that will totally transform the experience of your website to high level.', 'madar-lite' ); ?></p>

	</div>


	<div class="madar-tab-pane-half madar-tab-pane-first-half">

		<!-- Avada -->
		<div class="madar-lite-child-theme-container">
			<div class="madar-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/avada.jpg'; ?>" alt="<?php esc_html_e( 'Avada Wordpress Theme', 'madar-lite' ); ?>" />
				<div class="madar-lite-child-theme-description">
					<h2><?php esc_html_e( 'Avada', 'madar-lite' ); ?></h2>
				</div>
			</div>
			<div class="madar-lite-child-theme-details">
				<?php if ( 'Avada' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name">Avada Theme</span>
						<a href="http://retina-theme.com/why-you-should-choose-avada-theme/" class="button button-primary install right"><?php esc_html_e( 'Get now', 'madar-lite' ); ?></a>
						
						<div class="madar-lite-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Avada - Premium theme', 'madar-lite' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
		<hr />

		<!-- Madar Pro -->
		<div class="madar-lite-child-theme-container">
			<div class="madar-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/madarpro.png'; ?>" alt="<?php esc_html_e( 'Madar Pro Retina Theme', 'madar-lite' ); ?>" />
				<div class="madar-lite-child-theme-description">
					<h2><?php esc_html_e( 'Madar Pro', 'madar-lite' ); ?></h2>
				</div>
			</div>
			<div class="madar-lite-child-theme-details">
				<?php if ( 'Madar Pro' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name">Madar Pro</span>
						<a href="http://retina-theme.com/madar-pro-responsive-multipurpose-retina-ready-wordpress-theme/" class="button button-primary install right"><?php printf( __( 'Install %s now', 'madar-lite' ), '<span class="screen-reader-text">Madar Pro</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="http://demo.retina-theme.com"><?php esc_html_e( 'Live Preview','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'Madar Pro - Current theme', 'madar-lite' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>
		
		<hr/>
		<!-- X WordPress Theme -->
		<div class="madar-lite-child-theme-container">
			<div class="madar-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/x-wordpress-theme.jpg'; ?>" alt="<?php esc_html_e( 'X WordPress Theme', 'madar-lite' ); ?>" />
				<div class="madar-lite-child-theme-description">
					<h2><?php esc_html_e( 'X WordPress Theme', 'madar-lite' ); ?></h2>
				</div>
			</div>
			<div class="madar-lite-child-theme-details">
				<?php if ( 'X WordPress Theme' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name">X WordPress Theme</span>
						<a href="http://retina-theme.com/x-wordpress-most-downloaded-theme/" class="button button-primary install right"><?php printf( __( 'Install %s now', 'madar-lite' ), '<span class="screen-reader-text">X WordPress Theme</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="http://retina-theme.com/x-wordpress-most-downloaded-theme/"><?php esc_html_e( 'Live Preview','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } else { ?>
					<div class="theme-details active">
						<span class="theme-name"><?php echo esc_html_e( 'X WordPress Theme - Current theme', 'madar-lite' ); ?></span>
						<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e( 'Customize','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } ?>
			</div>
		</div>

	</div>

	<div class="madar-tab-pane-half">
		<!-- Betheme -->
		<div class="madar-lite-child-theme-container">
			<div class="madar-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/Betheme.jpg'; ?>" alt="<?php esc_html_e( 'BeTheme ', 'madar-lite' ); ?>" />
				<div class="madar-lite-child-theme-description">
					<h2><?php esc_html_e( 'BeTheme ', 'madar-lite' ); ?></h2>
				</div>
			</div>
			<div class="madar-lite-child-theme-details">
				<?php if ( 'BeTheme ' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name">BeTheme </span>
						<a href="http://retina-theme.com/betheme-responsive-multi-purpose-wordpress-theme/" class="button button-primary install right"><?php printf( __( 'Get %s now', 'madar-lite' ), '<span class="screen-reader-text">BeTheme </span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="http://retina-theme.com/betheme-responsive-multi-purpose-wordpress-theme/"><?php esc_html_e( 'Live Preview','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } else { ?>
				<div class="theme-details active">
					<span class="theme-name"><?php echo esc_html_e( 'BeTheme  - Current theme', 'madar-lite' ); ?></span>
					<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','madar-lite'); ?></a>
					<div class="madar-lite-clear"></div>
				</div>
				<?php } ?>
			</div>
		</div>
		<hr />

		<!-- Jupiter -->
		<div class="madar-lite-child-theme-container">
			<div class="madar-lite-child-theme-image-container">
				<img src="<?php echo esc_url( get_template_directory_uri() ) . '/inc/admin/welcome-screen/img/jupiter.jpg'; ?>" alt="<?php esc_html_e( 'Jupiter Wordpress Theme', 'madar-lite' ); ?>" />
				<div class="madar-lite-child-theme-description">
					<h2><?php esc_html_e( 'Jupiter', 'madar-lite' ); ?></h2>
				</div>
			</div>
			<div class="madar-lite-child-theme-details">
				<?php if ( 'Jupiter' != $current_theme['Name'] ) { ?>
					<div class="theme-details">
						<span class="theme-name">Jupiter</span>
						<a href="http://retina-theme.com/jupiter-retina-multipurpose-wordpresstheme/" class="button button-primary install right"><?php printf( __( 'Install %s now', 'madar-lite' ), '<span class="screen-reader-text">Jupiter</span>' ); ?></a>
						<a class="button button-secondary preview right" target="_blank" href="http://retina-theme.com/jupiter-retina-multipurpose-wordpresstheme/"><?php esc_html_e( 'Live Preview','madar-lite'); ?></a>
						<div class="madar-lite-clear"></div>
					</div>
				<?php } else { ?>
				<div class="theme-details active">
					<span class="theme-name"><?php echo esc_html_e( 'Jupiter - Current theme', 'madar-lite' ); ?></span>
					<a class="button button-secondary customize right" target="_blank" href="<?php echo get_site_url(). '/wp-admin/customize.php' ?>"><?php esc_html_e('Customize','madar-lite'); ?></a>
					<div class="madar-lite-clear"></div>
				</div>
				<?php } ?>
			</div>
		</div>

	</div>

</div>
