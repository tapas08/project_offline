<?php

/* ----------------------------------------------------------------------------------- */
/* Suggested Plugin Jetpack
/*----------------------------------------------------------------------------------- */
require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'level_register_required_plugins' );
function level_register_required_plugins() {
	$plugins = array(
	array(
			'name'      => 'Jetpack by WordPress.com',
			'slug'      => 'jetpack',
			'required'  => false,
		),
		);
		$config = array(
		'id'           => 'level',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
);

	tgmpa( $plugins, $config );
}	
/* ----------------------------------------------------------------------------------- */
/* Customize Comment Form
/*----------------------------------------------------------------------------------- */
add_filter( 'comment_form_default_fields', 'level_comment_form_fields' );
function level_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns"><label for="middle-label" class="text-right middle">' . '<span class="prefix"><i class="fa fa-user"></i>'. ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Name','level' ) .'" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'email'  => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-envelope-o"></i>' . ( $req ? ' <span class="required">* </span>' : '' ) . '</span></label></div> ' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Email','level' ) .'" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="20"' . $aria_req . ' /></div></div></div>',
        'url'    => '<div class="large-6 columns"><div class="row collapse prefix-radius"><div class="small-2 columns">' . ' <label for="middle-label" class="text-right middle"><span class="prefix"><i class="fa fa-external-link"></i>'  . '</span></label></div>' .
                    '<div class="small-10 columns"><input class="form-control" placeholder="'. __( 'Website','level' ) .'" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div></div></div>'        
    );
    
    return $fields;
    
    
}

add_filter( 'comment_form_defaults', 'level_comment_form' );
function level_comment_form( $argsbutton ) {
        $argsbutton['class_submit'] = 'float-center button'; 
    
    return $argsbutton;
}
/* ----------------------------------------------------------------------------------- */
/* Pagination
  /*----------------------------------------------------------------------------------- */

if ( ! function_exists( 'level_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Fourteen 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function level_paging_nav() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 2,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => __( '&laquo; Previous', 'level' ),
		'next_text' => __( 'Next &raquo;', 'level' ),
                'type'     => 'list',
	) );

	if ( $links ) :

	?>
	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'level' ); ?></h1>
		<ul class="pagination loop-pagination">
			<?php echo $links; ?>
		</ul><!-- .pagination -->
	</nav><!-- .navigation -->
	<style>div#infinite-handle{display:none;} </style>
	<?php
	endif;
}
endif;

/* ----------------------------------------------------------------------------------- */
/* Custom CSS Output
/*----------------------------------------------------------------------------------- */

function level_custom_css_output(){
    
    echo '<style type="text/css">';	
    echo esc_html(get_theme_mod('custom_css'));    

    echo '.floatingmenu #primary-menu > li.menu-item > ul{background: '.esc_html(get_theme_mod('topnavbgcolorsub','#20598a')).' !important;}';
    echo '.floatingmenu,.floatingmenu div.large-8.columns{background-color: '.esc_html(get_theme_mod('topnavbgcolor','#40ACEC')).' !important;}';
    echo '.floatingmenu li.page_item a, .floatingmenu li.menu-item a{color: '.esc_html(get_theme_mod('topnavbgcolorfont','#ffffff')).' !important;}';
    echo '.floatingmenu{position: '.esc_attr(get_theme_mod('radio_menu','fixed')).' !important;}';

	if ( get_theme_mod('level_body_font') ) :
		echo "body { font-family: ".esc_attr(get_theme_mod('level_body_font'))."; }";
	endif;
	if ( get_theme_mod('level_title_font') ) :
		echo "h1.site-title, h1.entry-title, h2.entry-title { font-family: ".esc_attr(get_theme_mod('level_title_font'))."; }";
	endif;
    echo '</style>';
    
}
add_action('wp_head','level_custom_css_output');

if ( function_exists('yoast_breadcrumb') ) { 
function level_breadcrumb_support(){		
		yoast_breadcrumb('<p id="breadcrumbs">','</p>');		
}
add_action('level_before_single_post_title','level_breadcrumb_support');
}