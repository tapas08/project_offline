(function($){
	// Sticky Header Options 
			 
		$(window).scroll(function() {
		if ($(this).scrollTop() > 1){  
		    $('.site-header').addClass("sticky-header");
		  }
		  else{
		    $('.site-header').removeClass("sticky-header");
		  }
		});

})(jQuery); 