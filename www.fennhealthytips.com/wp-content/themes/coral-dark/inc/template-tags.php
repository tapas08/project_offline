<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package coral-dark
 */

if ( ! function_exists( 'coral_dark_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function coral_dark_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( __( 'Leave a comment', 'coral-dark' ), __( '1 Comment', 'coral-dark' ), __( '% Comments', 'coral-dark' ) );
		echo '</span>';
	}
	edit_post_link( __( 'Edit', 'coral-dark' ), '<span class="edit-link">', '</span>' );
}
endif;

if ( ! function_exists( 'coral_dark_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function coral_dark_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' == get_post_type() ) {
		
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="published updated" datetime="%1$s">%2$s</time>';
			$time_string = sprintf( $time_string,
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
			);	
			$posted_on = '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
			printf( '<span class="update">' . __( 'Updated: %1$s', 'coral-dark' ) . '</span><br>', $posted_on );
		}
		
		if (is_rtl()) {

			$categories_list = get_the_category_list();
			if ( $categories_list && coral_dark_categorized_blog() ) {
				echo '<span class="cat-links-label">' . __( 'Categories:', 'coral-dark' ) . '</span>' . $categories_list ;
			}

			$tags_list = get_the_tag_list( '<ul class="post-tags"><li>','</li><li>','</li></ul>' );
			if ( $tags_list ) {
				echo '<span class="tags-links-label">' . __( 'Tags:', 'coral-dark' ) . '</span>' . $tags_list ;
			}
		} else {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'coral-dark' ) );
			if ( $categories_list && coral_dark_categorized_blog() ) {
				printf( '<span class="cat-links">' . __( 'Categories: %1$s', 'coral-dark' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'coral-dark' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . __( 'Tags: %1$s', 'coral-dark' ) . '</span>', $tags_list );
			}
		}
	}

}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function coral_dark_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'coral_dark_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'coral_dark_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so coral_dark_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so coral_dark_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in coral_dark_categorized_blog.
 */
function coral_dark_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'coral_dark_categories' );
}
add_action( 'edit_category', 'coral_dark_category_transient_flusher' );
add_action( 'save_post',     'coral_dark_category_transient_flusher' );

if ( ! function_exists( 'coral_dark_post_thumbnail' ) ) :
/**
 * Displays an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index views, or a div
 * element when on single views.
 *
 * Create your own coral_dark_post_thumbnail() function to override in a child theme.
 *
 */
function coral_dark_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail('large'); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'class' => 'alignleft smallpostthumb', 'alt' => the_title_attribute( 'echo=0' ), 'sizes' => '(max-width: 480px) 100vw, 210px' ) ); ?>
	</a>

	<?php endif; // End is_singular()
}
endif;
if ( ! function_exists( 'coral_dark_excerpt' ) ) :
	/**
	 * Displays the optional excerpt.
	 *
	 * Wraps the excerpt in a div element.
	 *
	 * Create your own coral_dark_excerpt() function to override in a child theme.
	 *
	 * @param string $class Optional. Class string of the div element. Defaults to 'entry-summary'.
	 */
	function coral_dark_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( ! is_attachment() && ( has_excerpt() || is_search() ) ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;
if ( ! function_exists( 'coral_dark_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 * 
 */
function coral_dark_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;
