<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Myth
 */

if ( ! function_exists( 'myth_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function myth_posted_on() {
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

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'myth' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);

}
endif;

if ( ! function_exists( 'myth_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function myth_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		echo '<span class="entry-footer-left">';
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'myth' ) );
			if ( $categories_list && myth_categorized_blog() ) {
				echo '<span class="cat-links">' . $categories_list . '</span>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'myth' ) );
			if ( $tags_list ) {
				echo '<span class="tags-links">' . $tags_list . '</span>';
			}
		echo '</span>';
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="entry-footer-right"><span class="comments-link">';
		comments_popup_link( esc_html__( 'No Comments', 'myth' ), esc_html__( '1 Comment', 'myth' ), esc_html__( '% Comments', 'myth' ) );
		echo '</span></span>';
	}
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function myth_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'myth_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'myth_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so myth_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so myth_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in myth_categorized_blog.
 */
function myth_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'myth_categories' );
}
add_action( 'edit_category', 'myth_category_transient_flusher' );
add_action( 'save_post',     'myth_category_transient_flusher' );

if ( ! function_exists( 'myth_post_thumbnail' ) ) :
/**
 * Display an optional post thumbnail.
 *
 * @since Myth 1.0
 */
function myth_post_thumbnail( $type = 'header' ) {
	if ( ! has_post_thumbnail() || post_password_required() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="entry-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .entry-thumbnail -->

	<?php else : ?>

	<div class="entry-thumbnail">
		<a class="entry-thumbnail-link" href="<?php the_permalink(); ?>" aria-hidden="true">
			<?php
				the_post_thumbnail( 'post-thumbnail', array( 'alt' => get_the_title() ) );
			?>
		</a>
	</div><!-- .entry-thumbnail -->

	<?php endif; // End is_singular()
}
endif; // myth_post_thumbnail