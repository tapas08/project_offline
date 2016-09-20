<?php get_header(); ?>
<div class="mh-wrapper clearfix">
	<div id="main-content" class="mh-content"><?php
		mh_before_page_content();
		mh_magazine_lite_page_title();
		if (category_description()) { ?>
			<div class="mh-category-desc">
				<?php echo category_description(); ?>
			</div><?php
		}
		if (is_author()) {
			mh_magazine_lite_author_box();
		}
		if (have_posts()) {
			while (have_posts()) : the_post();
				get_template_part('content', 'loop');
			endwhile;
			mh_magazine_lite_pagination();
		} else {
			get_template_part('content', 'none');
		} ?>
	</div>
	<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>