<?php
if (has_post_thumbnail()) {
    the_post_thumbnail('venture_lite_652_411', array('class' => 'venture_lite_652_411 img-responsive'));
} else { ?>
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/preview/652x411-<?php echo rand(1,13); ?>.jpg" class="venture_lite_652_411 img-responsive" alt="<?php the_title(); ?>" />
<?php } ?>