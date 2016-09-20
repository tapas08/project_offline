<?php
if(! function_exists('colorist_footer_credits') ) {
	function colorist_footer_credits() { 
		printf( __('<p>Powered by <a href="%1$s">WordPress</a>', 'colorist'), esc_url( 'http://wordpress.org/') );
		printf( '<span class="sep"> .</span>' );
		printf( __( 'Theme: Colorist by <a href="%1$s" rel="designer">Webulous Themes</a></p>', 'colorist' ), esc_url('http://www.webulousthemes.com/') );
	}
}
	
	add_action('colorist_credits','colorist_footer_credits');  

if(! function_exists('colorist_before_branding_widgets') ) {
	function colorist_before_branding_widgets() {
?>
		<div class="top-nav">
			<div class="container">
			<?php if( is_active_sidebar( 'top-left' ) ) : ?>    
				<div class="cart eight columns top-left">
					<?php dynamic_sidebar('top-left' ); ?>
				</div>
			<?php endif; ?> 
			<?php if( is_active_sidebar('top-right' ) ) : ?>
				<div class="eight columns social top-right">
					<?php dynamic_sidebar('top-right' ); ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
<?php
	}
}

add_action('colorist_before_branding','colorist_before_branding_widgets');

/* MORE TEXT VALUE */

add_filter( 'the_content_more_link','colorist_more_text_value');
if(! function_exists('colorist_more_text_value') ) {
	function colorist_more_text_value( ) {
		$more_text = get_theme_mod('more_text');
		if( $more_text && !empty( $more_text ) ) {
			$more_link_text = sprintf(__('%1$s','colorist'), $more_text );
		}else{
			$more_link_text = __('Read More','colorist');
		}
		return '<p class="portfolio-readmore"><a class="more-link" href="' . get_permalink() . '">'.$more_link_text.'<span class="screen-reader-text"></span>
<span class="meta-nav"></span></a></p>';
	} 
}

/**
 * Configuration sample for the Kirki Customizer.
 * The function's argument is an array of existing config values
 * The function returns the array with the addition of our own arguments
 * and then that result is used in the kirki/config filter
 *
 * @param $config the configuration array
 *
 * @return array
 */

function colorist_demo_configuration_sample_styling( $config ) {
	return wp_parse_args( array(
		'color_accent' => '#eb416b',
		'color_back'   => '#FFFFFF',
		'width'   => '320px',
	), $config );
}
add_filter( 'kirki/config', 'colorist_demo_configuration_sample_styling' );    

add_action('colorist_blog_layout_class_wrapper_before','colorist_blog_layout_wrapper_class_before');
if(! function_exists('colorist_blog_layout_wrapper_class_before') ) {

	function colorist_blog_layout_wrapper_class_before() {
		$blog_layout = get_theme_mod('blog_layout',1);
		switch ( $blog_layout ) {
			case 2: ?>
				<div class="eight columns blog-box">	
	<?php	break;
	        case 3: ?>
			    <div class="one-third column blog-box">
	<?php	break;
	        case 4: ?>
			    <div class="eight columns masonry-post blog-box">
	<?php	break;
			case 5: ?>  
			   <div class="one-third column masonry-post blog-box">	
	<?php	break;

		}
	}
}
   
add_action('colorist_blog_layout_class_wrapper_after','colorist_blog_layout_wrapper_class_after');
if(! function_exists('colorist_blog_layout_wrapper_class_after') ) {
	function colorist_blog_layout_wrapper_class_after() {
	    $blog_layout = get_theme_mod('blog_layout',1 );
		   if(  isset( $blog_layout ) && $blog_layout  > 1 ) { ?>
	          </div>
	<?php	}
	}
}

add_action('wp_head', 'colorist_masonry_custom_js');
if(! function_exists('colorist_masonry_custom_js') ) {

	function colorist_masonry_custom_js() {

	  if( get_theme_mod('blog_layout',1) == 4 || get_theme_mod('blog_layout',1) == 5 ) { ?>

	    <script type="text/javascript">
		    jQuery(document).ready( function($) {
				  $('.masonry-blog-content').imagesLoaded(function () {
			            $('.masonry-blog-content').masonry({
			                itemSelector: '.masonry-post',
			                gutter: 0,
			                transitionDuration: 0,
			            }).masonry('reloadItems');
			      });
		    });
	    </script> 

<?php }
	}
}
 
 