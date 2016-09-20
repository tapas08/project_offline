/* global nivoSliderParams */
/**
 * Theme functions file.
 *
 * Contains handler for navigation.
 */

( function( $ ) {
	$( document ).ready( function() {
		$('#main-menu').smartmenus({
			subMenusSubOffsetX: 1,
			subMenusSubOffsetY: -6,
			markCurrentItem: true,
			markCurrentTree: false
		});
		$('#menu-button').click(function() {
			var $this = $(this),
				$menu = $('#main-menu');
			if ($menu.is(':animated')) {
				return false;
			}
			if (!$this.hasClass('collapsed')) {
				$menu.slideUp(250, function() { $(this).addClass('collapsed').css('display', ''); });
				$this.addClass('collapsed');
			} else {
				$menu.slideDown(250, function() { $(this).removeClass('collapsed'); });
				$this.removeClass('collapsed');
			}
			return false;
		});
	});
	$( window ).load( function() {
		$('#slider').nivoSlider({
			effect: nivoSliderParams.effect,
			animSpeed: nivoSliderParams.animspeed,
			pauseTime: nivoSliderParams.pausetime,
			controlNav: false
		});
	});
} )( jQuery );