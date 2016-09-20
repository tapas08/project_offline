<?php
/**
 * Various helper functions for conditional styles and color modifications.
 *
 * These functions are generic; they can be used for color calculations 
 * unrelated to the Fourteen Colors plugin (note that they are dependent
 * on each other).
 *
 * @package WordPress
 * @subpackage Fourteen Colors
 * @since Fourteen Colors 0.5
 */

/**
 * Convert 3- or 6-digit Hex to RGB.
 *
 * @since Fourteen Colors 0.5
 *
 * @param string $color The color, in 3- or 6-digit hexadecimal form.
 * @return array $rgb The color, in an array( r, g, b )
 */
function fourteen_colors_hex2rgb( $color ) {
	// Convert shorthand to full hex.
	if ( strlen( $color ) == 4 ) {
		$color = '#'.str_repeat( substr( $color, 1, 1 ), 2 ) . str_repeat( substr( $color, 2, 1 ), 2 ) . str_repeat( substr( $color, 3, 1), 2 );
	}

	// Convert hex to rgb.
	$rgb = array( hexdec( substr( $color, 1, 2 ) ), hexdec( substr( $color, 3, 2 ) ), hexdec( substr( $color, 5, 2 ) ) );

	return $rgb;
}

/**
 * Tweak the brightness of a color by adjusting the RGB values by the given interval.
 *
 * Use positive values of $steps to brighten the color and negative values to darken the color.
 * All three RGB values are modified by the specified steps, within the range of 0-255. The hue
 * is generally maintained unless the number of steps causes one value to be capped at 0 or 255.
 *
 * @since Fourteen Colors 0.1
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @param int $steps The number of steps to adjust the color by, in RGB units.
 * @return string $color The new color, in 6-digit hexadecimal form.
 */
function fourteen_colors_adjust_color( $color, $steps ) {
	// Convert hex string to rgb array.
	$rgb = fourteen_colors_hex2rgb( $color );

	// Adjust color and switch back to 6-digit hex.
	$hex = '#';
	foreach ( $rgb as $value ) {
		$value += $steps;
		if ( $value > 255 ) {
			$value = 255;
		} elseif ( $value < 0 ) {
			$value = 0;
		}
		$hex .= str_pad( dechex( $value ), 2, '0', STR_PAD_LEFT);
	}

	return $hex;
}

/**
 * Calculate the relative luminance of a hex color.
 *
 * Used to determine color contrast and to determine appropriate color
 * patterns given different contexts.
 *
 * Officially, the relative brightness of any point in a colorspace, 
 * normalized to 0 for darkest black and 1 for lightest white.
 *
 * @since Fourteen Colors 0.5
 * @link http://www.w3.org/TR/2008/REC-WCAG20-20081211/#relativeluminancedef
 *
 * @param string $color The color, in 3- or 6-digit hexadecimal form.
 * @return float $luminance The relative luminance of the color, as a decimal between 0 and 1.
 */
function fourteen_colors_relative_luminance( $color ) {
	// Convert hex string to rgb array.
	$rgb = fourteen_colors_hex2rgb( $color );

	// Calculate luminance.
	$sRGB = array( $rgb[0] / 255, $rgb[1] / 255, $rgb[2] / 255 );
	
	$R = ( $sRGB[0] <= 0.03928 ? $sRGB[0] / 12.92 : pow( ( $sRGB[0] + 0.055 ) / (1.055), 2.4 ) );
	$G = ( $sRGB[1] <= 0.03928 ? $sRGB[1] / 12.92 : pow( ( $sRGB[1] + 0.055 ) / (1.055), 2.4 ) );
	$B = ( $sRGB[2] <= 0.03928 ? $sRGB[2] / 12.92 : pow( ( $sRGB[2] + 0.055 ) / (1.055), 2.4 ) );
	
	$luminance = 0.2126 * $R + 0.7152 * $G + 0.0722 * $B;

	return $luminance;
}

/**
 * Calculate the Web Content Accessibility Guidelines (WCAG) 2.0 contrast ratio of two colors.
 *
 * Text and background colors can be passed to the function in either order. The 
 * lighter and darker color are automatically determined by the function.
 *
 * @since Fourteen Colors 0.5
 * @link http://www.w3.org/TR/UNDERSTANDING-WCAG20/visual-audio-contrast-contrast.html#contrast-ratiodef
 *
 * @param string $color1 The background or text color, in 3- or 6-digit hexadecimal form.
 * @param string $color2 The text or background color, in 3- or 6-digit hexadecimal form.
 * @return float $ratio The contrast ratio, as $ratio:1, which ranges from 1 to 21.
 */
function fourteen_colors_contrast_ratio( $color1, $color2 ) {
	// Calculate relative luminance of each color.
	$l1 = fourteen_colors_relative_luminance( $color1 );
	$l2 = fourteen_colors_relative_luminance( $color2 );

	// Determine the larger color and re-order if necessary.
	if ( $l1 < $l2 ) {
		$l_ = $l1;
		$l1 = $l2;
		$l2 = $l_;
	}
	
	// Calculate contrast ratio.
	$ratio = ( $l1 + 0.05 ) / ( $l2 + 0.05 );

	return $ratio;
}