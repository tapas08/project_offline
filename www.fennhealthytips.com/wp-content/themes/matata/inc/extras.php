<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Matata
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function matata_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'matata_body_classes' );

/****************************************************************************************/

add_filter( 'body_class', 'matata_body_class' );
/**
 * Throwing different body class for the different layouts in the body tag
 */
function matata_body_class( $classes ) {
  
  $matata_default_layout = get_theme_mod( 'matata_default_layout', 'right_sidebar' );

  if( $matata_default_layout == 'right_sidebar' ) { $classes[] = ''; }
  elseif( $matata_default_layout == 'left_sidebar' ) { $classes[] = 'left-sidebar'; }
  elseif( $matata_default_layout == 'no_sidebar_full_width' ) { $classes[] = 'no-sidebar-full-width'; }
  elseif( $matata_default_layout == 'no_sidebar_content_centered' ) { $classes[] = 'no-sidebar'; }

  return $classes;
}

/****************************************************************************************/

if ( ! function_exists( 'matata_sidebar_select' ) ) :
/**
 * Function to select the sidebar
 */
function matata_sidebar_select() {

  $matata_default_layout = get_theme_mod( 'matata_default_layout', 'right_sidebar' );

  if( $matata_default_layout == 'right_sidebar' or $matata_default_layout == 'left_sidebar') { get_sidebar(); }

}
endif;

/****************************************************************************************/

add_filter( 'excerpt_length', 'matata_excerpt_length' );

function matata_excerpt_length( $length ) {
  return 24;
}

add_filter( 'excerpt_more', 'matata_excerpt_more' );

function matata_excerpt_more( $more ) {
  return '';
}

/****************************************************************************************/

add_action('wp_head', 'matata_custom_css');
/**
* Hooks the Custom Internal CSS to head section
*/
function matata_custom_css() {
  $matata_internal_css = '';
  $primary_color = esc_attr(get_theme_mod( 'matata_primary_color', '#249ccc' ));
  if( $primary_color != '#249ccc' ) {
    $matata_internal_css .= 'button,input[type="button"],input[type="reset"],input[type="submit"]{background: '.$primary_color.';}
    #masthead nav{border-top: 4px solid '.$primary_color.';}
    a{color: '.$primary_color.';}
    .main-navigation li:hover > a,.main-navigation li.focus > a,.main-navigation .current_page_item > a,.main-navigation .current-menu-item > a,.main-navigation .current_page_ancestor > a,.main-navigation .current-menu-ancestor > a,.posts-navigation .nav-previous a,.posts-navigation .nav-next a,a.more-link,#comments .reply a {background-color: '.$primary_color.';}
    .widget .widget-title{border-bottom: 4px solid '.$primary_color.';}';
  }

  if( !empty( $matata_internal_css ) ) {
    echo '<!-- '.get_bloginfo('name').' Internal Styles -->';
    ?><style type="text/css"><?php echo $matata_internal_css; ?></style>
    <?php
  }
}

/**************************************************************************************/

add_action('wp_head', 'matata_custom_user_css');
/**
* Hooks the Custom User CSS to head section
*/
function matata_custom_user_css() {
  $matata_user_css = esc_attr(get_theme_mod( 'matata_custom_css' ));

  if( !empty( $matata_user_css ) ) {
    echo '<!-- '.get_bloginfo('name').' Custom User CSS Styles -->';
    ?><style type="text/css"><?php echo $matata_user_css; ?></style>
    <?php
  }
}

/**************************************************************************************/

if ( ! function_exists( 'matata_social_links' ) ) :
/**
 * This function is for social links display on header
 */
function matata_social_links() {

 $matata_social_links = array( 'matata_social_facebook'   => __( 'Facebook', 'matata' ),
  'matata_social_twitter'     => __( 'Twitter', 'matata' ),
  'matata_social_googleplus'  => __( 'Google-Plus' , 'matata' ),
  'matata_social_instagram'   => __( 'Instagram', 'matata' ),
  'matata_social_pinterest'   => __( 'Pinterest', 'matata' ),
  'matata_social_youtube'     => __( 'YouTube', 'matata' )
  );
  ?>
  <div class="social-icon">
    <ul>
      <?php
      $i=0;
      $matata_links_output = '';
      foreach( $matata_social_links as $key => $value ) {
        $link = get_theme_mod( $key , '' );
        if ( !empty( $link ) ) {
          if ( get_theme_mod( $key.'_checkbox', 0 ) == 1 ) { $new_tab = 'target="_blank"'; } else { $new_tab = ''; }
          $matata_links_output .=
          '<li><a href="'.esc_url( $link ).'" '.$new_tab.'><i class="fa fa-'.strtolower($value).'"></i></a></li>';
        }
        $i++;
      }
      echo $matata_links_output;
      ?>
    </ul>
  </div><!-- .social-links -->
  <?php
}
endif;

/****************************************************************************************/

function matata_the_custom_logo() {
   if ( function_exists( 'the_custom_logo' ) ) {
      the_custom_logo();
   }
}
