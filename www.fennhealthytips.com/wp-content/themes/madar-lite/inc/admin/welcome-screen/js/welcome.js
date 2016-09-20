jQuery(document).ready(function() {

	/* If there are required actions, add an icon with the number of required actions in the About Madar page -> Actions required tab */
    var madar_nr_actions_required = madarLiteWelcomeScreenObject.nr_actions_required;

    if ( (typeof madar_nr_actions_required !== 'undefined') && (madar_nr_actions_required != '0') ) {
        jQuery('li.madar-lite-w-red-tab a').append('<span class="madar-lite-actions-count">' + madar_nr_actions_required + '</span>');
    }

    /* Dismiss required actions */
    jQuery(".madar-dismiss-required-action").click(function(){

        var id= jQuery(this).attr('id');
        console.log(id);
        jQuery.ajax({
            type       : "GET",
            data       : { action: 'madar_lite_dismiss_required_action',dismiss_id : id },
            dataType   : "html",
            url        : madarLiteWelcomeScreenObject.ajaxurl,
            beforeSend : function(data,settings){
				jQuery('.madar-lite-tab-pane#actions_required h1').append('<div id="temp_load" style="text-align:center"><img src="' + madarLiteWelcomeScreenObject.template_directory + '/inc/admin/welcome-screen/img/ajax-loader.gif" /></div>');
            },
            success    : function(data){
				jQuery("#temp_load").remove(); /* Remove loading gif */
                jQuery('#'+ data).parent().remove(); /* Remove required action box */

                var madar_lite_actions_count = jQuery('.madar-lite-actions-count').text(); /* Decrease or remove the counter for required actions */
                if( typeof madar_lite_actions_count !== 'undefined' ) {
                    if( madar_lite_actions_count == '1' ) {
                        jQuery('.madar-lite-actions-count').remove();
                        jQuery('.madar-lite-tab-pane#actions_required').append('<p>' + madarLiteWelcomeScreenObject.no_required_actions_text + '</p>');
                    }
                    else {
                        jQuery('.madar-lite-actions-count').text(parseInt(madar_lite_actions_count) - 1);
                    }
                }
            },
            error     : function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR + " :: " + textStatus + " :: " + errorThrown);
            }
        });
    });

	/* Tabs in welcome page */
	function madar_welcome_page_tabs(event) {
		jQuery(event).parent().addClass("active");
        jQuery(event).parent().siblings().removeClass("active");
        var tab = jQuery(event).attr("href");
        jQuery(".madar-lite-tab-pane").not(tab).css("display", "none");
        jQuery(tab).fadeIn();
	}

	var madar_actions_anchor = location.hash;

	if( (typeof madar_actions_anchor !== 'undefined') && (madar_actions_anchor != '') ) {
		madar_welcome_page_tabs('a[href="'+ madar_actions_anchor +'"]');
	}

    jQuery(".madar-lite-nav-tabs a").click(function(event) {
        event.preventDefault();
		madar_welcome_page_tabs(this);
    });

		/* Tab Content height matches admin menu height for scrolling purpouses */
	 $tab = jQuery('.madar-lite-tab-content > div');
	 $admin_menu_height = jQuery('#adminmenu').height();
	 if( (typeof $tab !== 'undefined') && (typeof $admin_menu_height !== 'undefined') )
	 {
		 $newheight = $admin_menu_height - 180;
		 $tab.css('min-height',$newheight);
	 }

});
