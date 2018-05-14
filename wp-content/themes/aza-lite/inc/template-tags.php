<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package aza-lite
 */

if ( ! function_exists( 'aza_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time and author.
	 */
	function aza_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">. Updated on %4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'aza-lite' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'aza-lite' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}
endif;

if ( ! function_exists( 'aza_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function aza_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'aza-lite' ) );
			if ( $categories_list && aza_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'aza-lite' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'aza-lite' ) );
			if ( $tags_list ) {
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'aza-lite' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link( esc_html__( 'Leave a comment', 'aza-lite' ), esc_html__( '1 Comment', 'aza-lite' ), esc_html__( '% Comments', 'aza-lite' ) );
			echo '</span>';
		}

		edit_post_link(
			sprintf(
			/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'aza-lite' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function aza_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'aza_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,

			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'aza_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so aza_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so aza_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in aza_categorized_blog.
 */
function aza_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'aza_categories' );
}
add_action( 'edit_category', 'aza_category_transient_flusher' );
add_action( 'save_post',     'aza_category_transient_flusher' );

/**
 * Excerpt length option.
 *
 * @return int
 */
function aza_custom_excerpt_length() {
	$excerpt = get_theme_mod( 'aza_frontpage_blog_excerpt_length' );
	if ( is_page_template('template-frontpage.php') ) {
		return absint( $excerpt );
	} else {
		return 100;
	}
}
add_filter( 'excerpt_length', 'aza_custom_excerpt_length', 999 );

/**
 * Add class for sticky navbar if sticky navbar is on.
 *
 * @param $classes
 *
 * @return array
 */
function aza_body_classes( $classes ) {
	$aza_sticky_navbar = get_theme_mod('aza_sticky_navbar', false);

	if( (bool) $aza_sticky_navbar === true ) {
		return array_merge( $classes, array( 'sticky-navigation' ) );
	} else {
		return $classes;
	}
};

add_filter( 'body_class', 'aza_body_classes' );
