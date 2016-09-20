<?php
/**
 * Internationalization helper.
 *
 * @package     Kirki
 * @category    Core
 * @author      Aristeides Stathopoulos
 * @copyright   Copyright (c) 2016, Aristeides Stathopoulos
 * @license     http://opensource.org/licenses/https://opensource.org/licenses/MIT
 * @since       1.0
 */

if ( ! class_exists( 'Kirki_l10n' ) ) {

	/**
	 * Handles translations
	 */
	class Kirki_l10n {

		/**
		 * The plugin textdomain
		 *
		 * @access protected
		 * @var string
		 */
		protected $textdomain = 'colorist';

		/**
		 * The class constructor.
		 * Adds actions & filters to handle the rest of the methods.
		 *
		 * @access public
		 */
		public function __construct() {

			add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );

		}

		/**
		 * Load the plugin textdomain
		 *
		 * @access public
		 */
		public function load_textdomain() {

			if ( null !== $this->get_path() ) {
				load_textdomain( $this->textdomain, $this->get_path() );
			}
			load_plugin_textdomain( $this->textdomain, false, Kirki::$path . '/languages' );

		}

		/**
		 * Gets the path to a translation file.
		 *
		 * @access protected
		 * @return string Absolute path to the translation file.
		 */
		protected function get_path() {
			$path_found = false;
			$found_path = null;
			foreach ( $this->get_paths() as $path ) {
				if ( $path_found ) {
					continue;
				}
				$path = wp_normalize_path( $path );
				if ( file_exists( $path ) ) {
					$path_found = true;
					$found_path = $path;
				}
			}

			return $found_path;

		}

		/**
		 * Returns an array of paths where translation files may be located.
		 *
		 * @access protected
		 * @return array
		 */
		protected function get_paths() {

			return array(
				WP_LANG_DIR . '/' . $this->textdomain . '-' . get_locale() . '.mo',
				Kirki::$path . '/languages/' . $this->textdomain . '-' . get_locale() . '.mo',
			);

		}

		/**
		 * Shortcut method to get the translation strings
		 *
		 * @static
		 * @access public
		 * @param string $config_id The config ID. See Kirki_Config.
		 * @return array
		 */
		public static function get_strings( $config_id = 'global' ) {

			$translation_strings = array(
				'background-color'      => esc_attr__( 'Background Color', 'colorist' ),
				'background-image'      => esc_attr__( 'Background Image', 'colorist' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'colorist' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'colorist' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'colorist' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'colorist' ),
				'inherit'               => esc_attr__( 'Inherit', 'colorist' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'colorist' ),
				'cover'                 => esc_attr__( 'Cover', 'colorist' ),
				'contain'               => esc_attr__( 'Contain', 'colorist' ),
				'background-size'       => esc_attr__( 'Background Size', 'colorist' ),
				'fixed'                 => esc_attr__( 'Fixed', 'colorist' ),
				'scroll'                => esc_attr__( 'Scroll', 'colorist' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'colorist' ),
				'left-top'              => esc_attr__( 'Left Top', 'colorist' ),
				'left-center'           => esc_attr__( 'Left Center', 'colorist' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'colorist' ),
				'right-top'             => esc_attr__( 'Right Top', 'colorist' ),
				'right-center'          => esc_attr__( 'Right Center', 'colorist' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'colorist' ),
				'center-top'            => esc_attr__( 'Center Top', 'colorist' ),
				'center-center'         => esc_attr__( 'Center Center', 'colorist' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'colorist' ),
				'background-position'   => esc_attr__( 'Background Position', 'colorist' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'colorist' ),
				'on'                    => esc_attr__( 'ON', 'colorist' ),
				'off'                   => esc_attr__( 'OFF', 'colorist' ),
				'all'                   => esc_attr__( 'All', 'colorist' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'colorist' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'colorist' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'colorist' ),
				'greek'                 => esc_attr__( 'Greek', 'colorist' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'colorist' ),
				'khmer'                 => esc_attr__( 'Khmer', 'colorist' ),
				'latin'                 => esc_attr__( 'Latin', 'colorist' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'colorist' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'colorist' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'colorist' ),
				'arabic'                => esc_attr__( 'Arabic', 'colorist' ),
				'bengali'               => esc_attr__( 'Bengali', 'colorist' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'colorist' ),
				'tamil'                 => esc_attr__( 'Tamil', 'colorist' ),
				'telugu'                => esc_attr__( 'Telugu', 'colorist' ),
				'thai'                  => esc_attr__( 'Thai', 'colorist' ),
				'serif'                 => _x( 'Serif', 'font style', 'colorist' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'colorist' ),
				'monospace'             => _x( 'Monospace', 'font style', 'colorist' ),
				'font-family'           => esc_attr__( 'Font Family', 'colorist' ),
				'font-size'             => esc_attr__( 'Font Size', 'colorist' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'colorist' ),
				'line-height'           => esc_attr__( 'Line Height', 'colorist' ),
				'font-style'            => esc_attr__( 'Font Style', 'colorist' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'colorist' ),
				'top'                   => esc_attr__( 'Top', 'colorist' ),
				'bottom'                => esc_attr__( 'Bottom', 'colorist' ),
				'left'                  => esc_attr__( 'Left', 'colorist' ),
				'right'                 => esc_attr__( 'Right', 'colorist' ),
				'center'                => esc_attr__( 'Center', 'colorist' ),
				'justify'               => esc_attr__( 'Justify', 'colorist' ),
				'color'                 => esc_attr__( 'Color', 'colorist' ),
				'add-image'             => esc_attr__( 'Add Image', 'colorist' ),
				'change-image'          => esc_attr__( 'Change Image', 'colorist' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'colorist' ),
				'add-file'              => esc_attr__( 'Add File', 'colorist' ),
				'change-file'           => esc_attr__( 'Change File', 'colorist' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'colorist' ),
				'remove'                => esc_attr__( 'Remove', 'colorist' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'colorist' ),
				'variant'               => esc_attr__( 'Variant', 'colorist' ),
				'subsets'               => esc_attr__( 'Subset', 'colorist' ),
				'size'                  => esc_attr__( 'Size', 'colorist' ),
				'height'                => esc_attr__( 'Height', 'colorist' ),
				'spacing'               => esc_attr__( 'Spacing', 'colorist' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'colorist' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'colorist' ),
				'light'                 => esc_attr__( 'Light 200', 'colorist' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'colorist' ),
				'book'                  => esc_attr__( 'Book 300', 'colorist' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'colorist' ),
				'regular'               => esc_attr__( 'Normal 400', 'colorist' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'colorist' ),
				'medium'                => esc_attr__( 'Medium 500', 'colorist' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'colorist' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'colorist' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'colorist' ),
				'bold'                  => esc_attr__( 'Bold 700', 'colorist' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'colorist' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'colorist' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'colorist' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'colorist' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'colorist' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'colorist' ),
				'add-new'           	=> esc_attr__( 'Add new', 'colorist' ),
				'row'           		=> esc_attr__( 'row', 'colorist' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'colorist' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'colorist' ),
				'back'                  => esc_attr__( 'Back', 'colorist' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'colorist' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'colorist' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'colorist' ),
				'none'                  => esc_attr__( 'None', 'colorist' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'colorist' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'colorist' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'colorist' ),
				'initial'               => esc_attr__( 'Initial', 'colorist' ),
				'select-page'           => esc_attr__( 'Select a Page', 'colorist' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'colorist' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'colorist' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'colorist' ),
				'hex-value'             => esc_attr__( 'Hex Value', 'colorist' ),
			);

			$config = apply_filters( 'kirki/config', array() );

			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
