/**
 * Customizer preview scripts.
 *
 * Contains handlers to make Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Update accent and contrast colors in the colors CSS.
	// Generated colors are updated with a complete refresh of the CSS in a
	// partial refresh that applies after this initial instant preview.
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#fourteen-colors' ),
			    color = style.data( 'accent-color' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			style.html( css )
			     .data( 'accent-color', to );
		} );
	} );
	wp.customize( 'contrast_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS
			var style = $( '#fourteen-colors' ),
			    color = style.data( 'contrast-color' ),
			    css = style.html();
			//css = css.replace( color, to );
			css = css.split( color ).join( to ); // css.replaceAll.
			style.html( css )
			     .data( 'contrast-color', to );
		} );
	} );} )( jQuery );
