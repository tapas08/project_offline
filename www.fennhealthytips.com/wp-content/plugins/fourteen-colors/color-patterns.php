<?php
/**
 * Fourteen Colors CSS Color Pattern Logic
 *
 * @package WordPress
 * @subpackage Fourteen Colors
 * @since Fourteen Colors 0.5
 */

require( 'color-calculations.php' );

/**
 * Returns the CSS for the Contrast Color option.
 *
 * @since Fourteen Colors 0.1
 *
 * @return String $css
 */
function fourteen_colors_contrast_css() {
	$contrast_color = get_theme_mod( 'contrast_color', '#000000' );

	// Don't do anything if the current color is the default.
	if ( '#000000' === $contrast_color ) {
		return '';
	}

	// Add the CSS for implementing the contrast color.
	$css = '/* Custom Contrast Color */
		.site:before,
		#secondary,
		.site-header,
		.site-footer,
		.menu-toggle,
		.featured-content,
		.featured-content .entry-header,
		.slider-direction-nav a,
		.ie8 .featured-content,
		.ie8 .site:before {
			background-color: ' . $contrast_color . ';
		}

		.grid .featured-content .entry-header,
		.ie8 .grid .featured-content .entry-header {
			border-color: ' . $contrast_color . ';
		}

		.slider-control-paging a:before {
			background-color: rgba(255,255,255,.33);
		}

		.hentry .mejs-mediaelement,
		.hentry .mejs-container .mejs-controls {
			background: ' . $contrast_color . ';
		}
	';

	// Adjustents to make lighter Contrast Colors looks just as good.
	if ( fourteen_colors_contrast_ratio( $contrast_color, '#fff' ) < 4.5 &&
		fourteen_colors_contrast_ratio( $contrast_color, '#fff' ) < fourteen_colors_contrast_ratio( $contrast_color, '#2b2b2b' ) ) {
		$css .= '
			.site-description,
			.secondary-navigation a,
			.widget,
			.widget a,
			.widget-title,
			.widget-title a,
			.widget_calendar caption,
			.site-header a,
			.site-title a,
			.site-title a:hover,
			.menu-toggle:before,
			.site-footer,
			.site-footer a,
			.featured-content a,
			.featured-content .entry-meta,
			.slider-direction-nav a:before,
			.hentry .mejs-container .mejs-controls .mejs-time span,
			.hentry .mejs-controls .mejs-button button {
				color: #2b2b2b;
			}

			@media screen and (min-width: 783px) {
				.primary-navigation ul ul a {
					color: #fff;
				}
			}

			@media screen and (min-width: 1008px) {
				.secondary-navigation ul ul a,
				.secondary-navigation li:hover > a,
				.secondary-navigation li.focus > a {
					color: #fff;
				}
			}

			.widget_calendar tbody a,
			.site-footer .widget_calendar tbody a,
			.slider-direction-nav a:hover:before {
				color: #fff;
			}

			.slider-control-paging a:before {
				background-color: rgba(0, 0, 0, .33);
			}

			.featured-content {
				background-image: url(' . plugins_url( '/pattern-dark-inverse.svg', __FILE__ ) . ');
			}

			.site-navigation li,
			#secondary,
			.secondary-navigation,
			.secondary-navigation li,
			.widget table,
			.widget th,
			.widget td,
			.widget_archive li,
			.widget_categories li,
			.widget_links li,
			.widget_meta li,
			.widget_nav_menu li,
			.widget_pages li,
			.widget_recent_comments li,
			.widget_recent_entries li,
			.widget_categories li ul,
			.widget_nav_menu li ul,
			.widget_pages li ul,
			.widget abbr[title] {
				border-color: rgba(0, 0, 0, .2);
			}

			.widget input,
			.widget textarea {
				background-color: rgba(0, 0, 0, .02);
				border-color: rgba(0, 0, 0, .2);
				color: #000;
			}

			.widget input:focus, .widget textarea:focus {
				border-color: rgba(0, 0, 0, 0.4);
			}

			.widget_twentyfourteen_ephemera .entry-meta a {
				color: rgba(0, 0, 0, 0.7);
			}

			.widget_twentyfourteen_ephemera > ol > li {
				border-bottom-color: rgba(0, 0, 0, 0.2);
			}

			#supplementary + .site-info {
				border-top: 1px solid rgba(0, 0, 0, 0.2);
			}

			.hentry .mejs-controls .mejs-time-rail .mejs-time-total, 
			.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-total {
				background: rgba(0,0,0,.3);
			}

			.hentry .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current {
				background-color: #2b2b2b;
			}

			/* Override the site title color option with an over-qualified selector, as the option is hidden. */
			h1.site-title a {
				color: #2b2b2b;
			}
		';
	}
	else {
		// These only really work well with darker colors.
		$css .= '
			.content-sidebar .widget_twentyfourteen_ephemera .widget-title:before {
				background: ' . $contrast_color . ';
			}

			.paging-navigation,
			.content-sidebar .widget .widget-title {
				border-top-color: ' . $contrast_color . ';
			}

			.content-sidebar .widget .widget-title, 
			.content-sidebar .widget .widget-title a,
			.paging-navigation,
			.paging-navigation a:hover,
			.paging-navigation a {
				color: ' . $contrast_color . ';
			}

			/* Override the site title color option with an over-qualified selector, as the option is hidden. */
			h1.site-title a {
				color: #fff;
			}
		';
	}

	// Modified Contrast Color.
	$contrast_light = fourteen_colors_adjust_color( $contrast_color, 68 );
	$css .= '
		.menu-toggle:active,
		.menu-toggle:focus,
		.menu-toggle:hover {
			background-color: ' . $contrast_light . ';
		}';

	/**
	 * Fiter the CSS for the contrast color option.
	 *
	 * @since Fourteen Colors 1.2
	 *
	 * @param string $css            The CSS generated by Fourteen Colors.
	 * @param string $contrast_color The user's chosen Contrast Color.
	 * @param string $contrast_light A light variant of the Contrast Color.
	 */
	return apply_filters( 'fourteen_colors_contrast_css', $css, $contrast_color, $contrast_light );
}

/**
 * Returns the CSS for the Accent Color option.
 *
 * Accent color styles should be added after contrast color styles 
 * because these override hover states.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return String $css
 */
function fourteen_colors_accent_css() {
	$accent_color = get_theme_mod( 'accent_color', '#24890d' );

	// Don't do anything if the current color is the default.
	if ( '#24890d' === $accent_color ) {
		return '';
	}

	$css = '
		/* Custom accent color. */
		button,
		.button,
		.contributor-posts-link,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.search-toggle,
		.hentry .mejs-controls .mejs-time-rail .mejs-time-current,
		.hentry .mejs-overlay:hover .mejs-overlay-button,
		.widget button,
		.widget .button,
		.widget input[type="button"],
		.widget input[type="reset"],
		.widget input[type="submit"],
		.widget_calendar tbody a,
		.content-sidebar .widget input[type="button"],
		.content-sidebar .widget input[type="reset"],
		.content-sidebar .widget input[type="submit"],
		.slider-control-paging .slider-active:before,
		.slider-control-paging .slider-active:hover:before,
		.slider-direction-nav a:hover,
		.ie8 .primary-navigation ul ul,
		.ie8 .secondary-navigation ul ul,
		.ie8 .primary-navigation li:hover > a,
		.ie8 .primary-navigation li.focus > a,
		.ie8 .secondary-navigation li:hover > a,
		.ie8 .secondary-navigation li.focus > a {
			background-color: ' . $accent_color . ';
		}

		.site-navigation a:hover {
			color: ' . $accent_color . ';
		}

		::-moz-selection {
			background: ' . $accent_color . ';
		}

		::selection {
			background: ' . $accent_color . ';
		}

		.paging-navigation .page-numbers.current {
			border-color: ' .  $accent_color . ';
		}

		@media screen and (min-width: 782px) {
			.primary-navigation li:hover > a,
			.primary-navigation li.focus > a,
			.primary-navigation ul ul {
				background-color: ' . $accent_color . ';
			}
		}

		@media screen and (min-width: 1008px) {
			.secondary-navigation li:hover > a,
			.secondary-navigation li.focus > a,
			.secondary-navigation ul ul {
				background-color: ' . $accent_color . ';
			}
		}
	';

	// Darker accent color will only be created if needed for visibility on white background.
	$accent_dark = $accent_color;

	// Adjustments for light accent colors, including darkening the color where needed.
	if ( fourteen_colors_contrast_ratio( $accent_color, '#fff' ) < 4.5 &&
		fourteen_colors_contrast_ratio( $accent_color, '#fff' ) < fourteen_colors_contrast_ratio( $accent_color, '#2b2b2b' ) ) {

		$css .= '
			.contributor-posts-link,
			.button,
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.search-toggle:before,
			.hentry .mejs-overlay:hover .mejs-overlay-button,
			.widget button,
			.widget .button,
			.widget input[type="button"],
			.widget input[type="reset"],
			.widget input[type="submit"],
			.widget_calendar tbody a,
			.widget_calendar tbody a:hover,
			.site-footer .widget_calendar tbody a,
			.content-sidebar .widget input[type="button"],
			.content-sidebar .widget input[type="reset"],
			.content-sidebar .widget input[type="submit"],
			button:hover,
			button:focus,
			.button:hover,
			.button:focus,
			.widget a.button:hover,
			.widget a.button:focus,
			.widget a.button:active,
			.content-sidebar .widget a.button,
			.content-sidebar .widget a.button:hover,
			.content-sidebar .widget a.button:focus,
			.content-sidebar .widget a.button:active,
			.contributor-posts-link:hover,
			.contributor-posts-link:active,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			.slider-direction-nav a:hover:before,
			.ie8 .primary-navigation li:hover > a,
			.ie8 .primary-navigation li.focus > a,
			.ie8 .secondary-navigation li:hover > a,
			.ie8 .secondary-navigation li.focus > a {
				color: #2b2b2b;
			}

			@media screen and (min-width: 782px) {
				.site-navigation li .current_page_item > a,
				.site-navigation li .current_page_ancestor > a,
				.site-navigation li .current-menu-item > a,
				.site-navigation li .current-menu-ancestor > a,
				.primary-navigation ul ul a,
				.primary-navigation li:hover > a,
				.primary-navigation li.focus > a,
				.primary-navigation ul ul {
					color: #2b2b2b;
				}
			}

			@media screen and (min-width: 1008px) {
				.secondary-navigation ul ul a,
				.secondary-navigation li:hover > a,
				.secondary-navigation li.focus > a,
				.secondary-navigation ul ul {
					color: #2b2b2b;
				}
			}

			::selection {
				color: #2b2b2b;
			}

			::-moz-selection {
				color: #2b2b2b;
			}

			.hentry .mejs-controls .mejs-time-rail .mejs-time-loaded {
				background-color: #2b2b2b;
			}

		';
		
		// Darken the accent color, if needed, for adequate (4.5:1) contrast against white page background.
		// Unfortunately, this can result in some colors losing character, such as yellow -> gold.
		while( fourteen_colors_contrast_ratio( $accent_dark, '#fff' ) < 4.5 ) {
			$accent_dark = fourteen_colors_adjust_color( $accent_dark, -5 );
		}

		/**
		 * Filter the generated dark variant of the Accent Color.
		 *
		 * @since Fourteen Colors 1.1
		 *
		 * @param string $accent_dark The generated version of the accent color that has a minimum 4.5:1 contrast ratio with white.
		 */
		$accent_dark = apply_filters( 'fourteen_colors_accent_dark', $accent_dark );
	}
	else {
		// Adjustments for dark accent colors. These are mostly specifed by default in Twenty Fourteen, but are insurance.
		$css .= '
			.contributor-posts-link,
			button,
			.button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"],
			.search-toggle:before,
			.hentry .mejs-overlay:hover .mejs-overlay-button,
			.widget button,
			.widget .button,
			.widget input[type="button"],
			.widget input[type="reset"],
			.widget input[type="submit"],
			.widget_calendar tbody a,
			.widget_calendar tbody a:hover,
			.site-footer .widget_calendar tbody a,
			.content-sidebar .widget input[type="button"],
			.content-sidebar .widget input[type="reset"],
			.content-sidebar .widget input[type="submit"],
			button:hover,
			button:focus,
			.button:hover,
			.button:focus,
			.widget a.button:hover,
			.widget a.button:focus,
			.widget a.button:active,
			.content-sidebar .widget a.button,
			.content-sidebar .widget a.button:hover,
			.content-sidebar .widget a.button:focus,
			.content-sidebar .widget a.button:active,
			.contributor-posts-link:hover,
			.contributor-posts-link:active,
			input[type="button"]:hover,
			input[type="button"]:focus,
			input[type="reset"]:hover,
			input[type="reset"]:focus,
			input[type="submit"]:hover,
			input[type="submit"]:focus,
			.slider-direction-nav a:hover:before {
				color: #fff;
			}

			@media screen and (min-width: 782px) {
				.primary-navigation ul ul a,
				.primary-navigation li:hover > a,
				.primary-navigation li.focus > a,
				.primary-navigation ul ul {
					color: #fff;
				}
			}

			@media screen and (min-width: 1008px) {
				.secondary-navigation ul ul a,
				.secondary-navigation li:hover > a,
				.secondary-navigation li.focus > a,
				.secondary-navigation ul ul {
					color: #fff;
				}
			}
		';
	}

	// Base some color variants off of the potentially darkened color.
	$accent_mid = fourteen_colors_adjust_color( $accent_color, 29 );
	$accent_mid_dark = fourteen_colors_adjust_color( $accent_dark, 29 );
	$accent_light = fourteen_colors_adjust_color( $accent_color, 49 );

	$css .= '
		/* Generated variants of custom accent color. */
		a,
		.content-sidebar .widget a {
			color: ' . $accent_dark . ';
		}

		.contributor-posts-link:hover,
		.button:hover,
		.button:focus,
		.slider-control-paging a:hover:before,
		.search-toggle:hover,
		.search-toggle.active,
		.search-box,
		.widget_calendar tbody a:hover,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.widget button:hover,
		.widget .button:hover,
		.widget button:focus,
		.widget .button:focus,
		.widget input[type="button"]:hover,
		.widget input[type="button"]:focus,
		.widget input[type="reset"]:hover,
		.widget input[type="reset"]:focus,
		.widget input[type="submit"]:hover,
		.widget input[type="submit"]:focus,
		.content-sidebar .widget input[type="button"]:hover,
		.content-sidebar .widget input[type="button"]:focus,
		.content-sidebar .widget input[type="reset"]:hover,
		.content-sidebar .widget input[type="reset"]:focus,
		.content-sidebar .widget input[type="submit"]:hover,
		.content-sidebar .widget input[type="submit"]:focus,
		.ie8 .primary-navigation ul ul a:hover,
		.ie8 .primary-navigation ul ul li.focus > a,
		.ie8 .secondary-navigation ul ul a:hover,
		.ie8 .secondary-navigation ul ul li.focus > a {
			background-color: ' . $accent_mid . ';
		}

		.featured-content a:hover,
		.featured-content .entry-title a:hover,
		.widget a:hover,
		.widget-title a:hover,
		.widget_twentyfourteen_ephemera .entry-meta a:hover,
		.hentry .mejs-controls .mejs-button button:hover,
		.site-info a:hover,
		.featured-content a:hover {
			color: ' . $accent_mid . ';
		}

		a:active,
		a:hover,
		.entry-title a:hover,
		.entry-meta a:hover,
		.cat-links a:hover,
		.entry-content .edit-link a:hover,
		.post-navigation a:hover,
		.image-navigation a:hover,
		.comment-author a:hover,
		.comment-list .pingback a:hover,
		.comment-list .trackback a:hover,
		.comment-metadata a:hover,
		.comment-reply-title small a:hover,
		.content-sidebar .widget a:hover,
		.content-sidebar .widget .widget-title a:hover,
		.content-sidebar .widget_twentyfourteen_ephemera .entry-meta a:hover {
			color: ' . $accent_mid_dark . ';
		}

		.page-links a:hover,
		.paging-navigation a:hover {
			border-color: ' . $accent_mid_dark . ';
		}

		.entry-meta .tag-links a:hover:before {
			border-right-color: ' . $accent_mid_dark . ';
		}

		.page-links a:hover,
		.entry-meta .tag-links a:hover {
			background-color: ' . $accent_mid_dark . ';
		}

		@media screen and (min-width: 782px) {
			.primary-navigation ul ul a:hover,
			.primary-navigation ul ul li.focus > a {
				background-color: ' . $accent_mid . ';
			}
		}

		@media screen and (min-width: 1008px) {
			.secondary-navigation ul ul a:hover,
			.secondary-navigation ul ul li.focus > a {
				background-color: ' . $accent_mid . ';
			}
		}

		button:active,
		.button:active,
		.contributor-posts-link:active,
		input[type="button"]:active,
		input[type="reset"]:active,
		input[type="submit"]:active,
		.widget input[type="button"]:active,
		.widget input[type="reset"]:active,
		.widget input[type="submit"]:active,
		.content-sidebar .widget input[type="button"]:active,
		.content-sidebar .widget input[type="reset"]:active,
		.content-sidebar .widget input[type="submit"]:active {
			background-color: ' . $accent_light . ';
		}

		.site-navigation .current_page_item > a,
		.site-navigation .current_page_ancestor > a,
		.site-navigation .current-menu-item > a,
		.site-navigation .current-menu-ancestor > a {
			color: ' . $accent_light . ';
		}
	';

	/**
	 * Fiter the CSS for the Accent Color option.
	 *
	 * @since Fourteen Colors 1.2
	 *
	 * @param string $css             The CSS generated by Fourteen Colors.
	 * @param string $accent_color    The user's chosen Accent Color.
	 * @param string $accent_dark     A variant of the Accent Color that contrasts adequately with white.
	 * @param string $accent_mid      A lightend variant of the Accent Color.
	 * @param string $accent_mid_dark A lightend variant of the Accent Color that contrasts with white.
	 * @param string $accent_light    A significantly lightened variant of the Accent Color.
	 */
	return apply_filters( 'fourteen_colors_accent_css', $css, $accent_color, $accent_dark, $accent_mid, $accent_mid_dark, $accent_light );
}

/**
 * Returns the CSS that increases contrast between the Contrast and Accent Colors is needed.
 *
 * These styles should be added after the styles for each individual component. The default colors
 * pass the initial contrast tests here, so no modifications are made.
 *
 * @since Fourteen Colors 0.5
 *
 * @return String $css
 */
function fourteen_colors_general_css() {
	$accent_color = get_theme_mod( 'accent_color', '#24890d' );
	$contrast_color = get_theme_mod( 'contrast_color', '#000000' );

	if ( fourteen_colors_contrast_ratio( $accent_color, $contrast_color ) > 3 ) {
		// We're good. Accent-on-contrast is all hover states except for
		// current nav item, so contrast ratio of 3:1 is acceptable.
		return '';
	}

	// Try lightening accent color to acheive desired contrast, until hitting white.
	$accent_lightened = $accent_color;
	while( fourteen_colors_contrast_ratio( $accent_lightened, $contrast_color ) < 3
		   && fourteen_colors_relative_luminance( $accent_lightened ) < 1 ) {
		$accent_lightened = fourteen_colors_adjust_color( $accent_lightened, 8 );
	}

	// Did we make it?
	if ( fourteen_colors_contrast_ratio( $accent_lightened, $contrast_color ) > 3 ) {
		$accent_color = $accent_lightened;
	}
	else {
		// Try darkening accent color to acheive desired contrast, until hitting black.
		$accent_darkened = $accent_color;
		while( fourteen_colors_contrast_ratio( $accent_darkened, $contrast_color ) < 3
			   && fourteen_colors_relative_luminance( $accent_darkened ) > 0 ) {
			$accent_darkened = fourteen_colors_adjust_color( $accent_darkened, -8 );
		}

		// Do we acheive higher contrast with the lightened or darkened color?
		if ( fourteen_colors_contrast_ratio( $accent_lightened, $contrast_color ) < fourteen_colors_contrast_ratio( $accent_darkened, $contrast_color ) ) {
			$accent_color = $accent_darkened;
		}
		else {
			$accent_color = $accent_lightened;
		}
	}

	// Replace the accent color with the higher-contrast version against the contrast color.
	$css = '
		/* Higher contrast Accent Color against contrast color */
		.site-navigation .current_page_item > a,
		.site-navigation .current_page_ancestor > a,
		.site-navigation .current-menu-item > a,
		.site-navigation .current-menu-ancestor > a,
		.site-navigation a:hover,
		.featured-content a:hover,
		.featured-content .entry-title a:hover,
		.widget a:hover,
		.widget-title a:hover,
		.widget_twentyfourteen_ephemera .entry-meta a:hover,
		.hentry .mejs-controls .mejs-button button:hover,
		.site-info a:hover,
		.featured-content a:hover {
			color: ' . $accent_color . ';
		}

		.hentry .mejs-controls .mejs-time-rail .mejs-time-current,
		.slider-control-paging a:hover:before,
		.slider-control-paging .slider-active:before,
		.slider-control-paging .slider-active:hover:before {
			background-color: ' . $accent_color . ';
		}
	';

	return $css;
}