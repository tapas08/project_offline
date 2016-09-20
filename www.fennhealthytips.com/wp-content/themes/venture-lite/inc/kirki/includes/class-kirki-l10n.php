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
		protected $textdomain = 'kirki';

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
				'background-color'      => esc_attr__( 'Background Color', 'venture-lite' ),
				'background-image'      => esc_attr__( 'Background Image', 'venture-lite' ),
				'no-repeat'             => esc_attr__( 'No Repeat', 'venture-lite' ),
				'repeat-all'            => esc_attr__( 'Repeat All', 'venture-lite' ),
				'repeat-x'              => esc_attr__( 'Repeat Horizontally', 'venture-lite' ),
				'repeat-y'              => esc_attr__( 'Repeat Vertically', 'venture-lite' ),
				'inherit'               => esc_attr__( 'Inherit', 'venture-lite' ),
				'background-repeat'     => esc_attr__( 'Background Repeat', 'venture-lite' ),
				'cover'                 => esc_attr__( 'Cover', 'venture-lite' ),
				'contain'               => esc_attr__( 'Contain', 'venture-lite' ),
				'background-size'       => esc_attr__( 'Background Size', 'venture-lite' ),
				'fixed'                 => esc_attr__( 'Fixed', 'venture-lite' ),
				'scroll'                => esc_attr__( 'Scroll', 'venture-lite' ),
				'background-attachment' => esc_attr__( 'Background Attachment', 'venture-lite' ),
				'left-top'              => esc_attr__( 'Left Top', 'venture-lite' ),
				'left-center'           => esc_attr__( 'Left Center', 'venture-lite' ),
				'left-bottom'           => esc_attr__( 'Left Bottom', 'venture-lite' ),
				'right-top'             => esc_attr__( 'Right Top', 'venture-lite' ),
				'right-center'          => esc_attr__( 'Right Center', 'venture-lite' ),
				'right-bottom'          => esc_attr__( 'Right Bottom', 'venture-lite' ),
				'center-top'            => esc_attr__( 'Center Top', 'venture-lite' ),
				'center-center'         => esc_attr__( 'Center Center', 'venture-lite' ),
				'center-bottom'         => esc_attr__( 'Center Bottom', 'venture-lite' ),
				'background-position'   => esc_attr__( 'Background Position', 'venture-lite' ),
				'background-opacity'    => esc_attr__( 'Background Opacity', 'venture-lite' ),
				'on'                    => esc_attr__( 'ON', 'venture-lite' ),
				'off'                   => esc_attr__( 'OFF', 'venture-lite' ),
				'all'                   => esc_attr__( 'All', 'venture-lite' ),
				'cyrillic'              => esc_attr__( 'Cyrillic', 'venture-lite' ),
				'cyrillic-ext'          => esc_attr__( 'Cyrillic Extended', 'venture-lite' ),
				'devanagari'            => esc_attr__( 'Devanagari', 'venture-lite' ),
				'greek'                 => esc_attr__( 'Greek', 'venture-lite' ),
				'greek-ext'             => esc_attr__( 'Greek Extended', 'venture-lite' ),
				'khmer'                 => esc_attr__( 'Khmer', 'venture-lite' ),
				'latin'                 => esc_attr__( 'Latin', 'venture-lite' ),
				'latin-ext'             => esc_attr__( 'Latin Extended', 'venture-lite' ),
				'vietnamese'            => esc_attr__( 'Vietnamese', 'venture-lite' ),
				'hebrew'                => esc_attr__( 'Hebrew', 'venture-lite' ),
				'arabic'                => esc_attr__( 'Arabic', 'venture-lite' ),
				'bengali'               => esc_attr__( 'Bengali', 'venture-lite' ),
				'gujarati'              => esc_attr__( 'Gujarati', 'venture-lite' ),
				'tamil'                 => esc_attr__( 'Tamil', 'venture-lite' ),
				'telugu'                => esc_attr__( 'Telugu', 'venture-lite' ),
				'thai'                  => esc_attr__( 'Thai', 'venture-lite' ),
				'serif'                 => _x( 'Serif', 'font style', 'venture-lite' ),
				'sans-serif'            => _x( 'Sans Serif', 'font style', 'venture-lite' ),
				'monospace'             => _x( 'Monospace', 'font style', 'venture-lite' ),
				'font-family'           => esc_attr__( 'Font Family', 'venture-lite' ),
				'font-size'             => esc_attr__( 'Font Size', 'venture-lite' ),
				'font-weight'           => esc_attr__( 'Font Weight', 'venture-lite' ),
				'line-height'           => esc_attr__( 'Line Height', 'venture-lite' ),
				'font-style'            => esc_attr__( 'Font Style', 'venture-lite' ),
				'letter-spacing'        => esc_attr__( 'Letter Spacing', 'venture-lite' ),
				'top'                   => esc_attr__( 'Top', 'venture-lite' ),
				'bottom'                => esc_attr__( 'Bottom', 'venture-lite' ),
				'left'                  => esc_attr__( 'Left', 'venture-lite' ),
				'right'                 => esc_attr__( 'Right', 'venture-lite' ),
				'center'                => esc_attr__( 'Center', 'venture-lite' ),
				'justify'               => esc_attr__( 'Justify', 'venture-lite' ),
				'color'                 => esc_attr__( 'Color', 'venture-lite' ),
				'add-image'             => esc_attr__( 'Add Image', 'venture-lite' ),
				'change-image'          => esc_attr__( 'Change Image', 'venture-lite' ),
				'no-image-selected'     => esc_attr__( 'No Image Selected', 'venture-lite' ),
				'add-file'              => esc_attr__( 'Add File', 'venture-lite' ),
				'change-file'           => esc_attr__( 'Change File', 'venture-lite' ),
				'no-file-selected'      => esc_attr__( 'No File Selected', 'venture-lite' ),
				'remove'                => esc_attr__( 'Remove', 'venture-lite' ),
				'select-font-family'    => esc_attr__( 'Select a font-family', 'venture-lite' ),
				'variant'               => esc_attr__( 'Variant', 'venture-lite' ),
				'subsets'               => esc_attr__( 'Subset', 'venture-lite' ),
				'size'                  => esc_attr__( 'Size', 'venture-lite' ),
				'height'                => esc_attr__( 'Height', 'venture-lite' ),
				'spacing'               => esc_attr__( 'Spacing', 'venture-lite' ),
				'ultra-light'           => esc_attr__( 'Ultra-Light 100', 'venture-lite' ),
				'ultra-light-italic'    => esc_attr__( 'Ultra-Light 100 Italic', 'venture-lite' ),
				'light'                 => esc_attr__( 'Light 200', 'venture-lite' ),
				'light-italic'          => esc_attr__( 'Light 200 Italic', 'venture-lite' ),
				'book'                  => esc_attr__( 'Book 300', 'venture-lite' ),
				'book-italic'           => esc_attr__( 'Book 300 Italic', 'venture-lite' ),
				'regular'               => esc_attr__( 'Normal 400', 'venture-lite' ),
				'italic'                => esc_attr__( 'Normal 400 Italic', 'venture-lite' ),
				'medium'                => esc_attr__( 'Medium 500', 'venture-lite' ),
				'medium-italic'         => esc_attr__( 'Medium 500 Italic', 'venture-lite' ),
				'semi-bold'             => esc_attr__( 'Semi-Bold 600', 'venture-lite' ),
				'semi-bold-italic'      => esc_attr__( 'Semi-Bold 600 Italic', 'venture-lite' ),
				'bold'                  => esc_attr__( 'Bold 700', 'venture-lite' ),
				'bold-italic'           => esc_attr__( 'Bold 700 Italic', 'venture-lite' ),
				'extra-bold'            => esc_attr__( 'Extra-Bold 800', 'venture-lite' ),
				'extra-bold-italic'     => esc_attr__( 'Extra-Bold 800 Italic', 'venture-lite' ),
				'ultra-bold'            => esc_attr__( 'Ultra-Bold 900', 'venture-lite' ),
				'ultra-bold-italic'     => esc_attr__( 'Ultra-Bold 900 Italic', 'venture-lite' ),
				'invalid-value'         => esc_attr__( 'Invalid Value', 'venture-lite' ),
				'add-new'           	=> esc_attr__( 'Add new', 'venture-lite' ),
				'row'           		=> esc_attr__( 'row', 'venture-lite' ),
				'limit-rows'            => esc_attr__( 'Limit: %s rows', 'venture-lite' ),
				'open-section'          => esc_attr__( 'Press return or enter to open this section', 'venture-lite' ),
				'back'                  => esc_attr__( 'Back', 'venture-lite' ),
				'reset-with-icon'       => sprintf( esc_attr__( '%s Reset', 'venture-lite' ), '<span class="dashicons dashicons-image-rotate"></span>' ),
				'text-align'            => esc_attr__( 'Text Align', 'venture-lite' ),
				'text-transform'        => esc_attr__( 'Text Transform', 'venture-lite' ),
				'none'                  => esc_attr__( 'None', 'venture-lite' ),
				'capitalize'            => esc_attr__( 'Capitalize', 'venture-lite' ),
				'uppercase'             => esc_attr__( 'Uppercase', 'venture-lite' ),
				'lowercase'             => esc_attr__( 'Lowercase', 'venture-lite' ),
				'initial'               => esc_attr__( 'Initial', 'venture-lite' ),
				'select-page'           => esc_attr__( 'Select a Page', 'venture-lite' ),
				'open-editor'           => esc_attr__( 'Open Editor', 'venture-lite' ),
				'close-editor'          => esc_attr__( 'Close Editor', 'venture-lite' ),
				'switch-editor'         => esc_attr__( 'Switch Editor', 'venture-lite' ),
			);

			$config = apply_filters( 'kirki/config', array() );

			if ( isset( $config['i18n'] ) ) {
				$translation_strings = wp_parse_args( $config['i18n'], $translation_strings );
			}

			return apply_filters( 'kirki/' . $config_id . '/l10n', $translation_strings );

		}
	}
}
