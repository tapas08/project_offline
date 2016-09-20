/**
 * Myth.js
 *
 * Some custom scripts for this theme.
 */
( function( $ ) {

	// Check distance to top and bottom and display social-icons and back-to-top accordingly.
	$(window).scroll(function(){
		if ($(this).scrollTop() > 500) {
			$( ".back-to-top" ).addClass( "show-back-to-top" );
		} else {
			$( ".back-to-top" ).removeClass( "show-back-to-top" );
		}

		if ($(this).scrollTop() > 500 && $(this).scrollTop() + $(this).height() < $(document).height() - 500) {
			$( ".social-right" ).addClass( "show-social-right" );
		} else {
			$( ".social-right" ).removeClass( "show-social-right" );
		}
	});

	// Click event to scroll to top.
	$( '.back-to-top, .search-toggle' ).click(function(){
		$( 'html, body' ).animate({scrollTop : 0},800);
		return false;
	});

	// Add margin top to vertical center element.
	var socialHeight = ( $( ".social-right" ).height() * -1 ) / 2;
	$( ".social-right" ).css( "margin-top" , socialHeight );

	
	// Open hidden header to reveal mobile menu.
	$( ".menu-toggle" ).click(function() {
		$( "#hidden-header" ).slideToggle( "slow" );
		$( ".menu-toggle" ).toggleClass( "menu-toggled" );

		// Change aria attritute.
		if ( $( this ).hasClass( "menu-toggled" ) ) {
			$( ".menu-toggle" ).attr( "aria-expanded" , "true" );
		}
		else {
			$( ".menu-toggle" ).attr( "aria-expanded" , "false" );
		}
	});

	// Open hidden header to reveal desktop search.
	$( ".search-toggle" ).click(function() {
		$( "#hidden-header" ).slideToggle( "slow" );
	});

	// Add a focus class to sub menu items with children.
	$( ".menu-item-has-children" ).on( 'focusin focusout', function() {
		$( this ).toggleClass( "focus" );
	});

	// Make focus search-toggle more intuitif.
	$( '.search-toggle' ).click(function(){

		// Add class .toggled on toggle.
		$( this ).toggleClass( "toggled" );

		// Immediately move focus when opened.
		if ( $( this ).hasClass( "toggled" ) ) { 
			$( "#desktop-search input" ).focus();
		}

		// Move focus to search-input.
		$( ".search-toggle" ).on( 'blur', function() {
			$( "#desktop-search input" ).focus();
		});

		// Move focus back to search-toggle.
		$( "#desktop-search .search-submit" ).on( 'blur', function() {
			$( ".search-toggle" ).focus();
		});

	});

	// Make focus menu-toggle more intuitif.
	$( '.menu-toggle' ).click(function(){

		// Move focus to first menu item.
		$( ".menu-toggle" ).on( 'blur', function() {
			$( '#mobile-navigation' ).find( 'a:eq(0)' ).focus();
		});

		// Move focus to menu-toggle.
		$( "#mobile-navigation .search-submit" ).on( 'blur', function() {
			$( ".menu-toggle" ).focus();
		});

	});

	// Add aria-haspopup to menu items with children.
	$( "#desktop-navigation .menu-item-has-children" ).attr( "aria-haspopup" , "true" );

	// Resize function.
	$( window ).on( 'resize',function() {

		var windowWidth = window.innerWidth;

		// Hide hidden header and remove class if width is more than or equal to 800px.
		if ( windowWidth >= 800 ) {
			$( "#hidden-header" ).hide();
			$( '.menu-toggle' ).removeClass( 'menu-toggled' );
		}

		// Move right sidebar if width is more than or equal to 800px.
		if ( windowWidth >= 800 ) {
			$( "#tertiary-inner" ).appendTo( "#secondary" );
			$( "#hidden-header" ).hide();
		}

		// Move right sidebar if width is less than 1200px.
		if ( windowWidth < 1200 ) {
			$( "#tertiary-inner" ).appendTo( "#secondary" );
		}

		// Move right sidebar if width is more than or equal to 1200px.
		if ( windowWidth >= 1200 ) {
			$( "#tertiary-inner" ).appendTo( "#tertiary" );
		}

	}).trigger( 'resize' );

})( jQuery );