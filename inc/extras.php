<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * @param array $args Configuration arguments.
 *
 * @return array
 */
function simple_grey_page_menu_args($args)
{
	$args['show_home'] = true;

	return $args;
}
add_filter( 'wp_page_menu_args', 'simple_grey_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function simple_grey_body_classes($classes)
{
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// add classes for each active sidebar
	if(is_array($GLOBALS['wp_registered_sidebars']) && count($GLOBALS['wp_registered_sidebars']) > 0) {
		foreach( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			if ( is_active_sidebar(  $sidebar['id'] ) ) {
				$classes[] = sanitize_html_class('has-' . $sidebar['id']);
			}
		}
	}

	return $classes;
}
add_filter( 'body_class', 'simple_grey_body_classes' );

/**
 * Sets the authordata global when viewing an author archive.
 *
 * This provides backwards compatibility with
 * http://core.trac.wordpress.org/changeset/25574
 *
 * It removes the need to call the_post() and rewind_posts() in an author
 * template to print information about the author.
 *
 * @global WP_Query $wp_query WordPress Query object.
 */
function simple_grey_setup_author()
{
	global $wp_query;

	if ( $wp_query->is_author() && isset( $wp_query->post ) ) {
		$GLOBALS['authordata'] = get_userdata( $wp_query->post->post_author );
	}
}
add_action( 'wp', 'simple_grey_setup_author' );

/**
 * Improve get_the_excerpt function.
 */
function simple_grey_trim_excerpt($text) {
	if ( '' == $text ) {
		$text = get_the_content( '' );

		$text = strip_shortcodes( $text );

		/* This filter is documented in wp-includes/post-template.php */
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( ']]>', ']]&gt;', $text );

		$text = preg_replace( '@<script[^>]*?>.*?</script>@si', '', $text );
		$text = strip_tags( $text );
		$remove_chars = array("\n", "\r", "\t");
		$text = str_replace( $remove_chars, ' ', $text );

		/* reset length default to 30 words */
		$excerpt_length = apply_filters( 'excerpt_length', 30 );

		/*
		* Filter the string in the "more" link displayed after a trimmed excerpt.
		*
		* @since 2.9.0
		*
		* @param string $more_string The string shown within the more link.
		*/
		$excerpt_more = apply_filters( 'excerpt_more', '' );

		/* new length trimming code to replace wp_trim_words */
		$words = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			$text = implode( ' ', $words );
		}
		$text = rtrim( $text, " \t\n\r.," );
		/* now add more text */
		$text .= $excerpt_more;
	}
	return $text;
}
add_filter( 'get_the_excerpt', 'simple_grey_trim_excerpt' );

/**
 * custom read more link for the Excerpt.
 */
function simple_grey_excerpt_more($more)
{
	return '&hellip; <a class="read-more" href="'.get_permalink( get_the_ID() ).'">'.__( 'Read More', 'simple-grey' ).'</a>';
}
add_filter( 'excerpt_more', 'simple_grey_excerpt_more' );
