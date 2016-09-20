<?php
/**
 * Welcome Screen Class
 */
class Madar_Welcome {

	/**
	 * Constructor for the welcome screen
	 */
	public function __construct() {

		/* create dashbord page */
		add_action( 'admin_menu', array( $this, 'madar_lite_welcome_register_menu' ) );

		/* activation notice */
		add_action( 'load-themes.php', array( $this, 'madar_lite_activation_admin_notice' ) );

		/* enqueue script and style for welcome screen */
		add_action( 'admin_enqueue_scripts', array( $this, 'madar_lite_welcome_style_and_scripts' ) );

		/* load welcome screen */
		add_action( 'madar_lite_welcome', array( $this, 'madar_lite_welcome_getting_started' ), 	    10 );
		add_action( 'madar_lite_welcome', array( $this, 'madar_lite_welcome_child_themes' ), 		    30 );
		add_action( 'madar_lite_welcome', array( $this, 'madar_lite_welcome_github' ), 		            40 );
		add_action( 'madar_lite_welcome', array( $this, 'madar_lite_welcome_free_pro' ), 				60 );

	}

	/**
	 * Creates the dashboard page
	 * @see  add_theme_page()
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_register_menu() {
		add_theme_page( 'About Madar Lite', 'About Madar Lite', 'activate_plugins', 'madar-lite-welcome', array( $this, 'madar_lite_welcome_screen' ) );
	}

	/**
	 * Adds an admin notice upon successful activation.
	 * @since 1.8.2.4
	 */
	public function madar_lite_activation_admin_notice() {
		global $pagenow;

		if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
			add_action( 'admin_notices', array( $this, 'madar_lite_welcome_admin_notice' ), 99 );
		}
	}

	/**
	 * Display an admin notice linking to the welcome screen
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_admin_notice() {
		?>
			<div class="updated notice is-dismissible">
				<p><?php echo sprintf( esc_html__( 'Welcome! Thank you for choosing Madar Lite! To fully take advantage of the best our theme can offer please make sure you visit our %swelcome page%s.', 'madar-lite' ), '<a href="' . esc_url( admin_url( 'themes.php?page=madar-lite-welcome' ) ) . '">', '</a>' ); ?></p>
				<p><a href="<?php echo esc_url( admin_url( 'themes.php?page=madar-lite-welcome' ) ); ?>" class="button" style="text-decoration: none;"><?php _e( 'Get started with Madar Lite', 'madar-lite' ); ?></a></p>
			</div>
		<?php
	}

	/**
	 * Load welcome screen css and javascript
	 * @since  1.8.2.4
	 */
	public function madar_lite_welcome_style_and_scripts( $hook_suffix ) {
wp_enqueue_style( 'madar-lite-welcome-screen-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome.css' );
		if ( 'appearance_page_madar-lite-welcome' == $hook_suffix ) {
			
			wp_enqueue_script( 'madar-lite-welcome-screen-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome.js', array('jquery') );

			global $madar_required_actions;

			$nr_actions_required = 0;

			/* get number of required actions */
			if( get_option('madar_show_required_actions') ):
				$madar_show_required_actions = get_option('madar_show_required_actions');
			else:
				$madar_show_required_actions = array();
			endif;

			if( !empty($madar_required_actions) ):
				foreach( $madar_required_actions as $madar_required_action_value ):
					if(( !isset( $madar_required_action_value['check'] ) || ( isset( $madar_required_action_value['check'] ) && ( $madar_required_action_value['check'] == false ) ) ) && ((isset($madar_show_required_actions[$madar_required_action_value['id']]) && ($madar_show_required_actions[$madar_required_action_value['id']] == true)) || !isset($madar_show_required_actions[$madar_required_action_value['id']]) )) :
						$nr_actions_required++;
					endif;
				endforeach;
			endif;

			wp_localize_script( 'madar-lite-welcome-screen-js', 'madarLiteWelcomeScreenObject', array(
				'nr_actions_required' => $nr_actions_required,
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'template_directory' => get_template_directory_uri(),
				'no_required_actions_text' => __( 'Hooray! There are no required actions for you right now.','madar-lite' )
			) );
		}
	}

	/**
	 * Load scripts for customizer page
	 * @since  1.8.2.4
	 */
	public function madar_lite_welcome_scripts_for_customizer() {

		wp_enqueue_style( 'madar-lite-welcome-screen-customizer-css', get_template_directory_uri() . '/inc/admin/welcome-screen/css/welcome_customizer.css' );
		wp_enqueue_script( 'madar-lite-welcome-screen-customizer-js', get_template_directory_uri() . '/inc/admin/welcome-screen/js/welcome_customizer.js', array('jquery'), '20120206', true );

		global $madar_required_actions;

		$nr_actions_required = 0;

		/* get number of required actions */
		if( get_option('madar_show_required_actions') ):
			$madar_show_required_actions = get_option('madar_show_required_actions');
		else:
			$madar_show_required_actions = array();
		endif;

		if( !empty($madar_required_actions) ):
			foreach( $madar_required_actions as $madar_required_action_value ):
				if(( !isset( $madar_required_action_value['check'] ) || ( isset( $madar_required_action_value['check'] ) && ( $madar_required_action_value['check'] == false ) ) ) && ((isset($madar_show_required_actions[$madar_required_action_value['id']]) && ($madar_show_required_actions[$madar_required_action_value['id']] == true)) || !isset($madar_show_required_actions[$madar_required_action_value['id']]) )) :
					$nr_actions_required++;
				endif;
			endforeach;
		endif;

		wp_localize_script( 'madar-lite-welcome-screen-customizer-js', 'madarLiteWelcomeScreenCustomizerObject', array(
			'nr_actions_required' => $nr_actions_required,
			'aboutpage' => esc_url( admin_url( 'themes.php?page=madar-lite-welcome#actions_required' ) ),
			'customizerpage' => esc_url( admin_url( 'customize.php#actions_required' ) ),
			'themeinfo' => __('View Theme Info','madar-lite'),
		) );
	}

	/**
	 * Dismiss required actions
	 * @since 1.8.2.4
	 */
	public function madar_lite_dismiss_required_action_callback() {

		global $madar_required_actions;

		$madar_dismiss_id = (isset($_GET['dismiss_id'])) ? $_GET['dismiss_id'] : 0;

		echo $madar_dismiss_id; /* this is needed and it's the id of the dismissable required action */

		if( !empty($madar_dismiss_id) ):

			/* if the option exists, update the record for the specified id */
			if( get_option('madar_show_required_actions') ):

				$madar_show_required_actions = get_option('madar_show_required_actions');

				$madar_show_required_actions[$madar_dismiss_id] = false;

				update_option( 'madar_show_required_actions',$madar_show_required_actions );

			/* create the new option,with false for the specified id */
			else:

				$madar_show_required_actions_new = array();

				if( !empty($madar_required_actions) ):

					foreach( $madar_required_actions as $madar_required_action ):

						if( $madar_required_action['id'] == $madar_dismiss_id ):
							$madar_show_required_actions_new[$madar_required_action['id']] = false;
						else:
							$madar_show_required_actions_new[$madar_required_action['id']] = true;
						endif;

					endforeach;

				update_option( 'madar_show_required_actions', $madar_show_required_actions_new );

				endif;

			endif;

		endif;

		die(); // this is required to return a proper result
	}
	

	/**
	 * Welcome screen content
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_screen() {

		require_once( ABSPATH . 'wp-load.php' );
		require_once( ABSPATH . 'wp-admin/admin.php' );
		require_once( ABSPATH . 'wp-admin/admin-header.php' );
		?>

		<ul class="madar-lite-nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#getting_started" aria-controls="getting_started" role="tab" data-toggle="tab"><?php esc_html_e( 'Getting started','madar-lite'); ?></a></li>
			<li role="presentation"><a href="#child_themes" aria-controls="child_themes" role="tab" data-toggle="tab"><?php esc_html_e( 'Premium themes','madar-lite'); ?></a></li>
			<li role="presentation"><a href="#github" aria-controls="github" role="tab" data-toggle="tab"><?php esc_html_e( 'Contribute','madar-lite'); ?></a></li>
			<li role="presentation"><a href="#free_pro" aria-controls="free_pro" role="tab" data-toggle="tab"><?php esc_html_e( 'Free VS PRO','madar-lite'); ?></a></li>
		</ul>

		<div class="madar-lite-tab-content">

			<?php
			/**
			 * @hooked madar_lite_welcome_getting_started - 10
			 * @hooked madar_lite_welcome_actions_required - 20
			 * @hooked madar_lite_welcome_child_themes - 30
			 * @hooked madar_lite_welcome_github - 40
			 * @hooked madar_lite_welcome_changelog - 50
			 * @hooked madar_lite_welcome_free_pro - 60
			 */
			do_action( 'madar_lite_welcome' ); ?>

		</div>
		<?php
	}

	/**
	 * Getting started
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_getting_started() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/getting-started.php' );
	}


	/**
	 * Child themes
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_child_themes() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/child-themes.php' );
	}

	/**
	 * Contribute
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_github() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/github.php' );
	}

	/**
	 * Free vs PRO
	 * @since 1.8.2.4
	 */
	public function madar_lite_welcome_free_pro() {
		require_once( get_template_directory() . '/inc/admin/welcome-screen/sections/free_pro.php' );
	}
}

$GLOBALS['Madar_Welcome'] = new Madar_Welcome();