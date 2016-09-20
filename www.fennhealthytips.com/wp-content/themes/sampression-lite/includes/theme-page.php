<?php

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

/**
 * Sampression Lite Theme Options
 *
 * @package Sampression-Lite
 * @since Sampression Lite 2.0
 */

/*=======================================================================
 * Function to build theme page
 *=======================================================================*/
add_action('admin_menu', 'sampression_theme_page');

function sampression_theme_page() {

    add_theme_page(__('Sampression Theme', 'sampression-lite'), __('About Theme', 'sampression-lite'), 'edit_theme_options', 'about-sampression', 'about_sampression_theme_page');

}

function about_sampression_theme_page() {
    ?>
    <div class="wrap" style="width:75%">
        <div>
            <h1><?php _e( 'Welcome to Sampression Lite', 'sampression-lite' ) ?></h1>
            <p><?php _e( 'We hope you will enjoy using Sampression Lite, as much as we enjoyed creating it.', 'sampression-lite' ) ?></p>
        </div>
        <div>
            <h2><?php _e( 'Getting started', 'sampression-lite' ) ?></h2>
            <h4><?php _e( 'Customize everything from a single place.', 'sampression-lite' ) ?></h4>
            <p><?php _e( 'Using the WordPress Customizer you can easily customize every aspect of the theme.', 'sampression-lite' ) ?></p>
            <p><a class="button button-primary" href="<?php echo esc_url('customize.php?return=%2Fwp-admin%2Fthemes.php%3Fpage%3Dabout-sampression') ?>"><?php _e( 'Go to Customizer', 'sampression-lite' ) ?></a> <a class="button button-primary" href="<?php echo esc_url( site_url() ) ?>" target="_blank"><?php _e( 'Visit', 'sampression-lite' ) ?> <?php bloginfo('name') ?></a></p>
            <p><?php _e( 'For further help, please visit our support page at:', 'sampression-lite' ) ?> <a href="<?php echo esc_url( 'http://www.sampression.com/support/' ); ?>" target="_blank"><?php echo esc_url( 'http://www.sampression.com/support/' ); ?></a></p>
        </div>
        <div>
            <h2><?php _e( 'Sampression PRO', 'sampression-lite' ) ?></h2>
            <p><?php _e( 'We also have a paid Pro version of the theme, which offers many more extra features and options for  customization. Sampression Pro offers additional following features:', 'sampression-lite' ) ?></p>
            <ul class="pro-feature-list">
                <li><h3><?php _e( 'Custom logo', 'sampression-lite' ) ?></h3>
                    <?php _e( 'You can upload your own logo from the customizer.', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Google Fonts', 'sampression-lite' ) ?></h3>
                    <?php _e( 'Supports fonts that have been provided by Google to enhance every sites design.', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Icons Mind icon set', 'sampression-lite' ) ?></h3>
                    <?php _e( 'Sampression Pro comes bundled with IconsMind iconset worth US$ 79.00.', 'sampression-lite' ) ?>
                </li>
                <li class="clear left"><h3><?php _e( 'Typography options', 'sampression-lite' ) ?></h3>
                    <?php _e( 'Sampression Pro goes even further in its support for various typography options. Now you can make changes to all and any typography element of your website e.g. You can choose the font family, size, style, color etc.', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Multiple layout options', 'sampression-lite' ) ?></h3>
                    <?php _e( 'The pro version of Sampression offers various different layout options including number of columns (one, two, three and four) to be displayed in home page, option to turn sidebar off/on etc', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Set the number of post/category on home page', 'sampression-lite' ) ?></h3>
                    <?php _e( 'The Pro version of the theme provides you with control over the number of posts/categories that you want to display in the home page.', 'sampression-lite' ) ?>
                </li>
                <li class="clear left"><h3><?php _e( 'Show hide your meta', 'sampression-lite' ) ?></h3>
                    <?php _e( 'You can choose to either show or hide the display of meta information from your posts.', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Write your own css in customizer', 'sampression-lite' ) ?></h3>
                    <?php _e( 'You can further customize the look of your Sampression Pro theme using your own CSS code.', 'sampression-lite' ) ?>
                </li>
                <li><h3><?php _e( 'Custom code', 'sampression-lite' ) ?></h3>
                    <?php _e( 'Add custom codes to Header and Footer easily.', 'sampression-lite' ) ?>
                </li>
            </ul>
            <p style="clear: both; padding-top: 20px;">
                <a target="_blank" class="button upgrade-pro" href="<?php echo esc_url( 'http://www.sampression.com/?add-to-cart=447' ); ?>"><?php _e( 'Upgrade to PRO', 'sampression-lite' ) ?></a>
                <a target="_blank" class="button button-primary" href="<?php echo esc_url( 'http://www.demo.sampression.com/sampression-pro/' ); ?>"><?php _e( 'Live Theme Demo', 'sampression-lite' ) ?></a>
            </p>
        </div>
    </div>
    <style>
        ul.pro-feature-list {
            list-style: inherit;
        }
        ul.pro-feature-list > li {
            display: inline-block;
            float: left;
            padding: 10px;
            width: 30%;
        }
        ul.pro-feature-list .clear.left {
            clear: left;
        }
        .button.upgrade-pro {
            background-color: #fe6e41;
            box-shadow: 0 1px 0 #FF3B00;
            color: #fff;
            border-color: #FF3B00;
        }
        .button.upgrade-pro:hover {
            background-color: #FB8F6E;
            color: #fff;
            border-color: #FF3B00;
        }
    </style>
    <?php
}