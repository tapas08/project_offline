jQuery(document).ready(function() {

	var sticky = new Waypoint.Sticky({
	  element: jQuery('.primary-nav')[0]
	})
	
	jQuery("html").niceScroll({
		cursorcolor: "#1a1a1a",
		cursorborder: "#1a1a1a",
		cursoropacitymin: 0.2,
		cursorwidth: 10,
		zindex: 10,
		scrollspeed: 60,
		mousescrollstep: 40
	});

	window.sr = new scrollReveal();

    jQuery('a.scrolltrue').bind('click', function(event) {
    	event.preventDefault();
        var $href = jQuery(this);
        jQuery('html, body').stop().animate({
            scrollTop: jQuery($href.attr('href')).offset().top
        }, 1000, 'easeInOutQuad');
    });	

});