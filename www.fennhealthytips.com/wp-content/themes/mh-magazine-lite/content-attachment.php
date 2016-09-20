<?php /* Default template for displaying attachments. */
if (is_single()) { ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header clearfix">
			<h1 class="entry-title">
				<?php the_title(); ?>
			</h1>
		</header>
		<?php dynamic_sidebar('posts-1'); ?>
		<div class="entry-content clearfix"><?php
			if (wp_attachment_is_image($post->id)) {
				$att_image = wp_get_attachment_image_src($post->id, 'full'); ?>
				<a href="<?php echo esc_url(wp_get_attachment_url($post->id)); ?>" title="<?php echo the_title_attribute(); ?>" rel="attachment" target="_blank">
					<img src="<?php echo esc_url($att_image[0]); ?>" width="<?php echo absint($att_image[1]); ?>" height="<?php echo absint($att_image[2]); ?>" class="attachment-medium" alt="<?php echo the_title_attribute(); ?>" />
				</a>
				<?php if (get_post(get_post_thumbnail_id())->post_excerpt) { ?>
					<p class="wp-caption-text">
						<?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt); ?>
					</p>
				<?php } ?>
				<?php if (get_post(get_post_thumbnail_id())->post_content) { ?>
					<p><?php echo wp_kses_post(get_post(get_post_thumbnail_id())->post_content); ?></p>
				<?php }
			} ?>
		</div>
        <?php dynamic_sidebar('posts-2'); ?>
	</article><?php
} ?>