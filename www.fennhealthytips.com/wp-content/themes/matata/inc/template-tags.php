<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Matata
 */

if ( ! function_exists( 'matata_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function matata_posted_on() {

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

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'matata' ),
		'' . $time_string . ''
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'matata' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"><i class="fa fa-calendar-o"></i> ' . $posted_on . '</span>'; // WPCS: XSS OK.

	$categories_list = get_the_category_list( esc_html__( ', ', 'matata' ) );
	if ( $categories_list && matata_categorized_blog() ) {
		printf( ' <span class="cat-links"><i class="fa fa-folder-o"></i> ' . esc_html__( '%1$s', 'matata' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' <span class="comments-link"><i class="fa fa-comment-o"></i> ';
		comments_popup_link( esc_html__( '0', 'matata' ), esc_html__( '1', 'matata' ), esc_html__( '%', 'matata' ) );
		echo '</span>';
	}
		
}
endif;

if ( ! function_exists( 'matata_posted_on_single' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function matata_posted_on_single() {

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

	$posted_on = sprintf(
		esc_html_x( '%s', 'post date', 'matata' ),
		$time_string
	);

	$byline = sprintf(
		esc_html_x( '%s', 'post author', 'matata' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on"><i class="fa fa-calendar-o"></i> ' . $posted_on . '</span> <span class="byline"><i class="fa fa-user"></i> ' . $byline . '</span>'; // WPCS: XSS OK.

	$categories_list = get_the_category_list( esc_html__( ', ', 'matata' ) );
	if ( $categories_list && matata_categorized_blog() ) {
		printf( ' <span class="cat-links"><i class="fa fa-folder-o"></i> ' . esc_html__( '%1$s', 'matata' ) . '</span>', $categories_list ); // WPCS: XSS OK.
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo ' <span class="comments-link"><i class="fa fa-comment-o"></i> ';
		comments_popup_link( esc_html__( 'Leave a comment', 'matata' ), esc_html__( '1 Comment', 'matata' ), esc_html__( '% Comments', 'matata' ) );
		echo '</span>';
	}	

}
endif;

if ( ! function_exists( 'matata_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function matata_entry_footer() {

	/* translators: used between list items, there is a space after the comma */
	$tags_list = get_the_tag_list( '', esc_html__( ', ', 'matata' ) );
	if ( $tags_list ) {
		echo '<div class="entry-tags">';
		printf( '<span class="tags-links"><i class="fa fa-tag"></i> ' . esc_html__( '%1$s', 'matata' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		echo '</div>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'matata' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link"> ',
		'</span>'
	);
	
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function matata_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'matata_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'matata_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so matata_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so matata_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in matata_categorized_blog.
 */
function matata_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'matata_categories' );
}
add_action( 'edit_category', 'matata_category_transient_flusher' );
add_action( 'save_post',     'matata_category_transient_flusher' );
