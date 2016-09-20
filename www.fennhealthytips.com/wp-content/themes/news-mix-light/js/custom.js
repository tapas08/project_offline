/*!
 * Kopa custom js (http://kopatheme.com)
 * Copyright 2014 Kopasoft.
 * Licensed under GNU General Public License v3
 */

/* =========================================================
Comment Form
============================================================ */
jQuery(document).ready(function(){
    if(jQuery("#comments-form").length > 0){
    	// get front validate localization
        var validateLocalization = kopa_custom_front_localization.validate;

        // Validate the comments form
    	jQuery('#comments-form').validate({
    	
    		// Add requirements to each of the fields
    		rules: {
    			author: {
    				required: true,
    				minlength: 2
    			},
    			email: {
    				required: true,
    				email: true
    			},
    			comment: {
    				required: true,
    				minlength: 10
    			}
    		},
    		
    		// Specify what error messages to display
    		// when the user does something horrid
    		messages: {
    			author: {
    				required: validateLocalization.name.required,
                    minlength: jQuery.format(validateLocalization.name.minlength)
    			},
    			email: {
    				required: validateLocalization.email.required,
                    email: validateLocalization.email.email
    			},
    			url: {
    				required: validateLocalization.url.required,
                    url: validateLocalization.url.url
    			},
    			comment: {
    				required: validateLocalization.message.required,
                    minlength: jQuery.format(validateLocalization.message.minlength)
    			}
    		}
	    });  
	}
	
	if(jQuery("#contact-form").length > 0){
        // get front validate localization
        var validateLocalization = kopa_custom_front_localization.validate;

	    // Validate the contact form
	    jQuery('#contact-form').validate({
	
    		// Add requirements to each of the fields
    		rules: {
    			name: {
    				required: true,
    				minlength: 2
    			},
    			email: {
    				required: true,
    				email: true
    			},
    			message: {
    				required: true,
    				minlength: 10
    			}
    		},
    		
    		// Specify what error messages to display
    		// when the user does something horrid
    		messages: {
    			name: {
    				required: validateLocalization.name.required,
                    minlength: jQuery.format(validateLocalization.name.minlength)
    			},
    			email: {
    				required: validateLocalization.email.required,
                    email: validateLocalization.email.email
    			},
    			url: {
    				required: validateLocalization.url.required,
                    url: validateLocalization.url.url
    			},
    			message: {
    				required: validateLocalization.message.required,
                    minlength: jQuery.format(validateLocalization.message.minlength)
    			}
    		},
    		
    		// Use Ajax to send everything to processForm.php
    		submitHandler: function(form) {
    			jQuery("#submit-contact").attr("value", validateLocalization.form.sending);
    			jQuery(form).ajaxSubmit({
    				success: function(responseText, statusText, xhr, $form) {
    					jQuery("#response").html(responseText).hide().slideDown("fast");
    					jQuery("#submit-contact").attr("value", validateLocalization.form.submit);
    				}
    			});
    			return false;
    		}
	    });
	}
});

/* =========================================================
HeadLine Scroller
============================================================ */

jQuery(function() {
	var _scroll = {
		delay: 1000,
		easing: 'linear',
		items: 1,
		duration: 0.07,
		timeoutDuration: 0,
		pauseOnHover: 'immediate'
	};
	jQuery('.ticker-1').carouFredSel({
		width: 1000,
		align: false,
		items: {
			width: 'variable',
			height: 40,
			visible: 1
		},
		scroll: _scroll
	});

	//	set carousels to be 100% wide
	jQuery('.caroufredsel_wrapper').css('width', '100%');
});

/* =========================================================
Sub menu
==========================================================*/
(function($){ //create closure so we can safely use $ as alias for jQuery

	jQuery(document).ready(function(){

		// initialise plugin
		var example = jQuery('#main-menu').superfish({
            //add options here if required
            disableHI: true // Fix: Superfish conflicts with WP admin bar for WordPress < 3.6
		});
	});

})(jQuery);

/* =========================================================
Mobile menu
============================================================ */
jQuery(document).ready(function () {
     
    jQuery('#mobile-menu > span').click(function () {
 
        var mobile_menu = jQuery('#toggle-view-menu');
 
        if (mobile_menu.is(':hidden')) {
            mobile_menu.slideDown('300');
            jQuery(this).children('span').html('-');    
        } else {
            mobile_menu.slideUp('300');
            jQuery(this).children('span').html('+');    
        }
		
		
         
    });
	
	jQuery('#toggle-view-menu li').click(function () {
 
        var text = jQuery(this).children('div.menu-panel');
 
        if (text.is(':hidden')) {
            text.slideDown('300');
            jQuery(this).children('span').html('-');    
        } else {
            text.slideUp('300');
            jQuery(this).children('span').html('+');    
        }
		
		jQuery(this).toggleClass('active');
         
    });
 
});

/* =========================================================
Flex Slider
============================================================ */
jQuery(window).load(function(){
    
    // flexslider widget 1
    jQuery('.home-slider').each(function () {
        var $this = jQuery(this),
            dataAnimation = $this.data('animation'),
            dataDirection = $this.data('direction'),
            dataSlideshowSpeed = $this.data('slideshow_speed'),
            dataAnimationSpeed = $this.data('animation_speed'),
            dataIsAutoPlay = $this.data('autoplay');

        $this.flexslider({
            animation: dataAnimation, // animation effect
            direction: dataDirection, // direction
            slideshow: dataIsAutoPlay, // autoplay
            slideshowSpeed: dataSlideshowSpeed, // slideshow 
            animationSpeed: dataAnimationSpeed, // animation speed
            smoothHeight:true,
            pauseOnHover: true,
            start: function(slider){
                jQuery('body').removeClass('loading');
            }
        });
    });

    // article list gallery slider
    jQuery('.entry-thumb-slider').flexslider({
        animation: "slide",
        slideshow: false,
        smoothHeight:true,
        pauseOnHover: true,
        start: function(slider){
            jQuery('body').removeClass('loading');
        }
    });

    // flexslide widget 2
    jQuery('.gallery-slider').each(function () {
        var $this = jQuery(this),
            dataAnimation = $this.data('animation'),
            dataDirection = $this.data('direction'),
            dataSlideshowSpeed = $this.data('slideshow_speed'),
            dataAnimationSpeed = $this.data('animation_speed'),
            dataIsAutoPlay = $this.data('autoplay');

        $this.flexslider({
            animation: dataAnimation, // animation effect
            direction: dataDirection, // direction
            slideshow: dataIsAutoPlay, // autoplay
            slideshowSpeed: dataSlideshowSpeed, // slideshow 
            animationSpeed: dataAnimationSpeed, // animation speed
            smoothHeight:true,
            pauseOnHover: true,
            start: function(slider){
                jQuery('body').removeClass('loading');
            }
        });
    });

    // gallery post format slider
    jQuery('.kopa-single-slider').flexslider({
        animation: "slide",
        smoothHeight:true,
        pauseOnHover: true,
        start: function(slider){
            jQuery('body').removeClass('loading');
        }
    });

    // blog slider 2
    jQuery('.kopa-blog-slider').each(function () {
        var $this = jQuery(this),
            dataAnimation = $this.data('animation'),
            dataSlideshowSpeed = $this.data('slideshow_speed'),
            dataAnimationSpeed = $this.data('animation_speed'),
            dataIsAutoPlay = $this.data('autoplay');

        $this.flexslider({
            animation: dataAnimation, // animation effect
            slideshow: dataIsAutoPlay, // autoplay
            slideshowSpeed: dataSlideshowSpeed, // slideshow 
            animationSpeed: dataAnimationSpeed, // animation speed
            smoothHeight:true,
            pauseOnHover: true,
            start: function(slider){
                jQuery('body').removeClass('loading');
            }
        });
    });
});

/* =========================================================
Tabs
============================================================ */
jQuery(document).ready(function() { 
	
    jQuery( '.tabs-1' ).each(function () {
        var $this = jQuery(this),
            firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function () {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();    
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                $currentClickLink = $this.children('a');

            if ( $this.hasClass('active') ) {
                return;
            } else {
                $this.addClass('active')
                    .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function () {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery( $currentClickLink.attr('href') ).fadeIn();

        });
    });

    jQuery( '.tabs-2' ).each(function () {
        var $this = jQuery(this),
            firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function () {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();    
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                $currentClickLink = $this.children('a');

            if ( $this.hasClass('active') ) {
                return;
            } else {
                $this.addClass('active')
                    .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function () {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery( $currentClickLink.attr('href') ).fadeIn();

        });
    });

    jQuery( '.tabs-3' ).each(function () {
        var $this = jQuery(this),
            firstTabContentID = $this.find('li a').first().attr('href');

        // add active class to first list item
        $this.children('li').first().addClass('active');

        // hide all tabs
        $this.find('li a').each(function () {
            var tabContentID = jQuery(this).attr('href');
            jQuery(tabContentID).hide();    
        });
        // show only first tab
        jQuery(firstTabContentID).show();

        $this.children('li').on('click', function(e) {
            e.preventDefault();
            var $this = jQuery(this),
                $currentClickLink = $this.children('a');

            if ( $this.hasClass('active') ) {
                return;
            } else {
                $this.addClass('active')
                    .siblings().removeClass('active');
            }

            $this.siblings('li').find('a').each(function () {
                var tabContentID = jQuery(this).attr('href');
                jQuery(tabContentID).hide();
            });

            jQuery( $currentClickLink.attr('href') ).fadeIn();

        });
    });
	
});

/* =========================================================
Carousel
============================================================ */
jQuery(window).load(function() {
	
    if( jQuery(".kopa-featured-news-carousel").length > 0){
		jQuery('.kopa-featured-news-carousel').each(function() {
            var $this = jQuery(this),
                prevID = $this.data('prev-id'),
                nextID = $this.data('next-id'),
                paginationID = $this.data('pagination-id'),
                scrollItems = $this.data('scroll-items');

            $this.carouFredSel({
                responsive: true,
                prev: prevID,
                next: nextID,
                width: '100%',
                height:'variable',
                scroll: scrollItems,
                pagination: paginationID,
                auto: false,
                pauseOnHover: true,
                items: {
                    width: 234,
                    height: 'auto',
                    visible: {              
                        min: 1,
                        max: 4
                    }
                }
            })
        });
	}
});

/* =========================================================
prettyPhoto
============================================================ */
jQuery(document).ready(function(){
    init_image_effect();
});

jQuery(window).resize(function(){
    init_image_effect();
});

function init_image_effect(){    

	var view_p_w = jQuery(window).width();
	var pp_w = 500;
	var pp_h = 344;
	
	if(view_p_w <= 479){
		pp_w = '120%';
		pp_h = '100%';
	}
	else if(view_p_w >= 480 && view_p_w <= 599){
		pp_w = '100%';
		pp_h = '170%';
	}
		    
    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        show_title: false,
        deeplinking:false,
        social_tools:false,
		default_width: pp_w,
		default_height: pp_h
    });    
}

/* =========================================================
Twitter
============================================================ */
jQuery(function(){
	jQuery('.kp-tweets-container').each(function() {
        var $this = jQuery(this),
            twitterUsername = $this.data('twitter-username'),
            tweetsNumber = $this.data('tweets-number');

        $this.tweetable({
            username: twitterUsername,
            time: true,
            rotate: false,
            speed: 4000,
            limit: tweetsNumber,
            replies: false,
            position: 'append',
            failed: "Sorry, twitter is currently unavailable for this user.",
            html5: true,
            onComplete:function($ul){
                jQuery('time').timeago();
            }
        });
    });
});

/* =========================================================
Accordion
========================================================= */
jQuery(document).ready(function() {
        var acc_wrapper=jQuery('.acc-wrapper');
        if (acc_wrapper.length >0) 
        {
			
            jQuery('.acc-wrapper .accordion-container').hide();
            jQuery.each(acc_wrapper, function(index, item){
                jQuery(this).find(jQuery('.accordion-title')).first().addClass('active').next().show();
				
            });
			
            jQuery('.accordion-title').on('click', function(e) {
                kopa_accordion_click(jQuery(this));
                e.preventDefault();
            });
			
			var titles = jQuery('.accordion-title');
			
			jQuery.each(titles,function(){
				kopa_accordion_click(jQuery(this));
			});
        }
		
});

function kopa_accordion_click (obj) {
	if( obj.next().is(':hidden') ) {
		obj.parent().find(jQuery('.active')).removeClass('active').next().slideUp(300);
		obj.toggleClass('active').next().slideDown(300);
							
	}
jQuery('.accordion-title span').html('+');
	if (obj.hasClass('active')) {
		obj.find('span').first().html('-');			     
	} 
}

/* =========================================================
Full Screen Background
============================================================ */
// jQuery(document).ready(function(){
// 	var view_port_w;
// 		if(self.innerWidth!=undefined) view_port_w= self.innerWidth;
// 		else{
// 			var D= document.documentElement;
// 			if(D) view_port_w= D.clientWidth;
// 		}
// 	if(view_port_w > 1000){
// 		jQuery.backstretch([
// 			  // "http://localhost/news-mix/wp-content/uploads/2013/08/01.jpg"
// 			], {
// 				fade: 750,
// 				duration: 4000
// 		});
// 	}
// })

/* =========================================================
Toggle Boxes
============================================================ */
jQuery(document).ready(function () {
     
    jQuery('#toggle-view li').click(function (event) {
 		
        var text = jQuery(this).children('div.panel');
 
        if (text.is(':hidden')) {
			jQuery(this).addClass('active');
            text.slideDown('300');
            jQuery(this).children('span').html('-');			     
        } else {
			jQuery(this).removeClass('active');
            text.slideUp('300');
            jQuery(this).children('span').html('+');			   
        }
         
    });
 
});

/* =========================================================
Gallery slider
============================================================ */
jQuery(window).load(function(){
  
  jQuery('.kp-gallery-carousel').flexslider({
	animation: "slide",
	controlNav: false,
	slideshow: false,
	itemWidth: 149,
	itemMargin: 6,
	asNavFor: '.kp-gallery-slider'
  });
  
  jQuery('.kp-gallery-slider').flexslider({
	animation: "slide",
	controlNav: false,
	slideshow: false,
	sync: ".kp-gallery-carousel",
	start: function(slider){
	  jQuery('body').removeClass('loading');
	}
  });
});

/* =========================================================
Scroll to top
============================================================ */
jQuery(document).ready(function(){

	// hide #back-top first
	jQuery("#back-top").hide();
	
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 200) {
				jQuery('#back-top').fadeIn();
			} else {
				jQuery('#back-top').fadeOut();
			}
		});

		// scroll body to 0px on click
		jQuery('#back-top a').click(function () {
			jQuery('body,html').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});

});

/* =========================================================
UISearch
============================================================ */
new UISearch( document.getElementById( 'sb-search' ) );

/*==========================================================
focus on comment form when click reply button
============================================================*/
jQuery(document).ready(function(){
    jQuery('.comment-reply-link').on('click',function(){
        jQuery('#comment_message').focus();
    });
});