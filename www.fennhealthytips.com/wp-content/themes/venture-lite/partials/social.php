<?php 
if (nimbus_get_option('social-toggle') != 2){
    $social_type = array("fa-facebook" => "nimbus_facebook_url", "fa-linkedin" => "nimbus_linkedin_url", "fa-twitter" => "nimbus_twitter_url", "fa-youtube" => "nimbus_youtube_url", "fa-google-plus" => "nimbus_google_plus_url", "fa-vimeo-square" => "nimbus_vimeo_url", "fa-flickr" => "nimbus_flickr_url", "fa-wordpress" => "nimbus_wpcom_url", "fa-pinterest-square" => "nimbus_pinterest_url", "fa-instagram" => "nimbus_instagram_url", "fa-tumblr" => "nimbus_tumblr_url", "fa-envelope" => "nimbus_mail_url");
    $social_toggle = nimbus_get_option('social-toggle');
    ?>
    <div class="social-icons">
        <?php 
        foreach ($social_type as $key => $id) { 
            $$id = trim(nimbus_get_option($id));
            $mailto = ($key == 'fa-envelope') ? 'mailto:' : '';
            if ($key == 'fa-envelope'){
                $id = sanitize_email($$id);
            } else {
                $id = esc_url($$id);
            }
            if (!empty($id)) {
            ?>
                <a target="_blank" href="<?php echo $mailto; ?><?php echo $id; ?>"><i class="fa <?php echo $key; ?>"></i></a>
            <?php
            }
        }
        ?>
        <?php if (nimbus_get_option('nimbus_hide_rss_icon') == 0) { ?>
            <a target="_blank" href="<?php echo get_bloginfo('rss2_url'); ?>"><i class="fa fa-rss"></i></a>
        <?php } ?>
    </div>
<?php
}