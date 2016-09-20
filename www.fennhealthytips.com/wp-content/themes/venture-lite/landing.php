<?php
/* Template Name: Landing Page */
get_header();
if (function_exists('venture_lite_companion')) {
    get_template_part( 'partials/companion/frontpage','featured');
    get_template_part( 'partials/companion/frontpage','action1');
    get_template_part( 'partials/companion/frontpage','about');
    get_template_part( 'partials/companion/frontpage','action2');
    get_template_part( 'partials/companion/frontpage','team');
    get_template_part( 'partials/companion/frontpage','social');
    get_template_part( 'partials/companion/frontpage','test');
    get_template_part( 'partials/companion/frontpage','news');
} else {
    get_template_part( 'partials/loop');
}
get_footer();
?>