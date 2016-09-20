=== Fourteen Colors ===
Contributors: celloexpressions
Tags: Twenty Fourteen, Custom Colors, Custom, Colors, Customizer, Theme Customizer, Twenty Fourteen Theme, Default Theme, Bundled Theme, 2014
Requires at least: 3.8
Tested up to: 4.6
Stable tag: 1.4
Description: Customize the colors of the Twenty Fourteen Theme, directly within the Customizer.
License: GPLv2

== Description ==
Not a big fan of green and black? Love the layout of Twenty Fourteen, but need its colors to match your brand? Don't have time to create a child theme, or want to change up your site's look on a regular basis without technical overhead?

Fourteen Colors is the most *efficient* way to re-color the Twenty Fourteen theme. It provides two color pickers, which together control:

* Header/Sidebar/Footer Background Color
* Featured Content Background Color
* Link Color
* Search Bar Color
* Navigation Menu Hover Colors
* Text Selection/Highlight Color
* Audio/Video Player Colorschemes
* And more...

Fourteen Colors automatically adjusts your color choices to ensure the minimum required contrast to keep Twenty Fourteen accessible-ready, and to keep your site as readable as possible. The plugin is designed to support almost any combination of colors, so you can be creative and express yourself with your site! Please report any issues on the support forums, after reading the FAQ and the changelog to see if they address your question.

The Accent Color feature was originally developed in Twenty Fourteen core, but it was removed near the end of the initial development cycle due to a variety of concerns. This plugin addresses those concerns and adds the contrast color feature to enable a broad range of custom colorschemes.

Special thanks to the entire Twenty Fourteen team for their work on the accent color throughout the development cycle. This plugin (and Twenty Fourteen) would not exist without their hard work and attention to detail.

== Installation ==
1. Take the easy route and install through the WordPress plugin installer OR
1. Download the .zip file and upload the unzipped folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Go to the Customizer (Appearance -> Customize) and adjust the two new color pickers under the "Colors" heading to your liking


== Frequently Asked Questions ==
= I tried using Fourteen Colors with a theme other than Twenty Fourteen and ... =
Don't. There is a known bug where the plugin may be applied to other themes when live previewing them, but Fourteen Colors will prevent itself from functioning when the current theme is not Twenty Fourteen or a child.

= Child Themes =
Fourteen Colors is a plugin, not a child theme, because it is primarily programmatic (ie, it would only consist of a functions.php file), and for flexibility.

You can use Fourteen Colors with both Twenty Fourteen and child themes. Be aware that the Fourteen Colors settings are stored with the active theme, so if you switch to a child theme or switch child themes, you'll need to re-set your colors. Child theme compatibility depends on the extent of changes made by the child theme. But child theme developers can hook into Fourteen Colors to extend it to adapt to their changes, allowing the plugin to work seamlessly even if the child theme is significantly different than the parent theme.

= Suggested/Recommended Colors =
The contrast color option tends to work best with colors that are either grayscale or close to grayscale. Try light or dark grays in conjunction with any accent color if the default black feels too bold.

Accent colors work best when they are intense, fully saturated colors that avoid anything too light or too dark. However, brighter colors such as yellow do work well, as do darker colors such as black, with a good choice of contrast color. If a particular set of colors feels close, but not quite right, try making the accent color more intense and making the contrast color lighter (if it's already light) or darker (if it's already dark) to increase the overall contrast of your site.

= Known Issues =
Due to the automatic generation of secondary colors, in order to maximize color contrast ratios, undesirable colors may come up in some places. You can override these with custom CSS, and feel free to post in the support forums if you can't figure it out (but search there first).

Please note that if you're having trouble getting the plugin to "work" it is extremely likely that you're doing something wrong. Don't forget that the color options are added to the Customizer.

= Supported Colors =
All colors are supported except for pure white (#fff), which should technically work but results in a poor user experience due to the lack of contrast, which helps to provide visual hierarchy. Pure black (#000) accent colors are more fully supported, but can also have (less significant) issues with providing proper visual hierarchy.

== Screenshots ==
1. Light theme with a touch of blue
2. Autumn colors
3. Happy Holidays!
4. Purple and Pink
5. Blue and Orange
6. Gray and Yellow
7. Red and black

== Changelog ==
Please note: this plugin is only updated when changes are needed for compatibility with theme updates or WordPress changes (or in rare cases, if additional bugs/edge cases are found and fixed). It is not anticipated that major updates will be needed in the future as of December 2015.

= 1.4 =
* Add postMessage previewing of base colors for an enhanced user experience. Contrast and accent colors are now instantly previewed in the customizer, with secondary generated colors updating on a slight delay (typically a few seconds).

= 1.3 =
* Implement support for Selective Refresh in the Customizer. Colors will now be updated much more quickly (but still not instantly) in the Customizer preview. Available in WordPress 4.5+.

= 1.2 =
* Updates for WordPress 4.0 / Twenty Fourteen 1.2. Please update those before updating Fourteen Colors.
* The mediaelements-genericons component, which facilitated audio/video player color-scheming, has been merged into Twenty Fourteen core.
* Added two new filters to adjust the plugin's output CSS: `fourteen_colors_contrast_css` and `fourteen_colors_accent_css`.
* Leverage some of the Customizer API improvements in WordPress 4.0.
* Fix a couple of really minor, obscure bugs that surfaced in the wild.

= 1.1 =
* Full support for Twenty Fourteen 1.1.
* Fix mobile menu-toggle button colors.
* Fix support for button-styled links in widgets (via the `.button` class).
* Add a filter to the version of the accent color that contrasts with the white page background, facillitating the ability to override the automatically-generated version with another color picker via an add-on plugin.

= 1.0.2 =
* Fix bugs with mobile navigation menus with certain color combinations.
* Add support for the `.button` class introduced in Twenty Fourteen 1.1 / WordPress 3.9.
* Fix link and border color in Twenty Fourteen Ephemera widgets when used in the Primary and Footer widget areas with a light contrast color.
* Override the Site Title option, as it is hidden from the Theme Customizer (since Fourteen Colors automatically adjusts it for contrast).
* Add basic support for IE8, which is handled differently in Twenty Fourteen due to its lack of support for modern standards.

= 1.0.1 =
* Add a description of the different color controls (requires changes that might change the order of the options).
* Fix paging navigation hover states (border, not background color should change).
* Darken all borders when using light contrast colors on mobile.
* Fix sub-menu colors on mobile when using a light contrast color.
* Automatically refresh the cached plugin output CSS after the plugin has been updated.
* Hide the site title color control to reduce confusion, since the color is automatically tweaked based on the contrast color. The Header Text Color option is still available via the Appearance -> Header page if it needs to be customized.

= 1.0 =
* Plugin is ready for general use, alongside Twenty Fourteen 1.0 and WordPress 3.8.

= 0.7 =
* Screenshots, finalized documentation.

= 0.6 =
* Code cleanup, inline code documentation, coding standards to match Twenty Fourteen core.
* Tweaks post-code-review, props @lancewillett.

= 0.5 =
* Save the entire plugin CSS output as a single theme_mod to allow for more computationally intensive color calculations.
* Introduce a more robust set of color calculations; most importantly, the ability to calculate the contrast ratio between any two colors.
* Adjustments to make any color work as the accent color, addressing the concerns that led to the feature's removal from Twenty Fourteen core.
* Ensure that there is adequate contrast between all colors that are displayed against each other.

= 0.2 =
* Build out of the contrast color option.

= 0.1 =
* Initial port from the Twenty Fourteen Theme's implementation.
* Initial pass at an experimental "Contrast Color" option.

== Upgrade Notice ==
= 1.4 =
* Add instant previewing of base colors, with secondary generated colors updating on a slight delay.

= 1.3 =
* Implement support for Selective Refresh in the Customizer. Colors will now be updated much more quickly (but still not instantly) in the Customizer preview. Available in WordPress 4.5+.

= 1.2 =
* Compatible with WordPress 4.0 and Twenty Fourteen 1.2, adds more filters.

= 1.1 =
* Minor fixes for Twenty Fourteen 1.1 compatibility, add a filter for the generated main link color.

= 1.0.2 =
* Bugfixes for mobile & IE8 nav menus, edge cases, and support for the .button CSS class coming in Twentty Fourteen 1.1.

= 1.0.1 =
* Several bugfixes, particularly with lighter contrast colors on mobile. Cached plugin output is now automatically refreshed after updating.

= 1.0 =
* Please visit the Customizer and re-set your colors after updating. This plugin is now ready for prime-time!

= 0.2 =
* Build out the contrast color option.

= 0.1 =
* Initial port from the Twenty Fourteen Theme's implementation and initial pass at a "Contrast Color" option