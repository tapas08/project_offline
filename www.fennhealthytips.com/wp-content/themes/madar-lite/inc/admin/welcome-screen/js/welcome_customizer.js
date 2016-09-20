jQuery(document).ready(function() {
    var madar_aboutpage = madarLiteWelcomeScreenCustomizerObject.aboutpage;
    var madar_nr_actions_required = madarLiteWelcomeScreenCustomizerObject.nr_actions_required;

    /* Number of required actions */
    if ((typeof madar_aboutpage !== 'undefined') && (typeof madar_nr_actions_required !== 'undefined') && (madar_nr_actions_required != '0')) {
        jQuery('#accordion-section-themes .accordion-section-title').append('<a href="' + madar_aboutpage + '"><span class="madar-lite-actions-count">' + madar_nr_actions_required + '</span></a>');
    }

    /* Upsell in Customizer (Link to Welcome page) */
    if ( !jQuery( ".madar-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('<li class="accordion-section madar-upsells">');
    }
    if (typeof madar_aboutpage !== 'undefined') {
        jQuery('.madar-upsells').append('<a style="width: 80%; margin: 5px auto 5px auto; display: block; text-align: center;" href="' + madar_aboutpage + '" class="button" target="_blank">{themeinfo}</a>'.replace('{themeinfo}', madarLiteWelcomeScreenCustomizerObject.themeinfo));
    }
    if ( !jQuery( ".madar-upsells" ).length ) {
        jQuery('#customize-theme-controls > ul').prepend('</li>');
    }
});