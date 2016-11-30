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

	return $classes;
}
add_filter( 'body_class', 'simple_grey_body_classes' );

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Filters wp_title to print a neat <title> tag based on what is being viewed.
	 *
	 * @param string $title Default title text for current view.
	 * @param string $sep   Optional separator.
	 *
	 * @return string The filtered title.
	 */
	function simple_grey_wp_title($title, $sep)
	{
		if ( is_feed() ) {
			return $title;
		}

		global $page, $paged;

		// Add the blog name
		$title .= get_bloginfo( 'name', 'display' );

		// Add the blog description for the home/front page.
		$site_description = get_bloginfo( 'description', 'display' );
		if ( $site_description && (is_home() || is_front_page()) ) {
			$title .= " $sep $site_description";
		}

		// Add a page number if necessary:
		if ( ($paged >= 2 || $page >= 2) && ! is_404() ) {
			$title .= " $sep ".sprintf( __( 'Page %s', 'simple-grey' ), max( $paged, $page ) );
		}

		return $title;
	}
	add_filter( 'wp_title', 'simple_grey_wp_title', 10, 2 );
endif;

if ( ! function_exists( '_wp_render_title_tag' ) ) :
	/**
	 * Title shim for sites older than WordPress 4.1.
	 *
	 * @link https://make.wordpress.org/core/2014/10/29/title-tags-in-4-1/
	 *
	 * @todo Remove this function when WordPress 4.3 is released.
	 */
	function simple_grey_render_title()
	{
		?>
    <title><?php wp_title( '|', true, 'right' );
		?></title>
<?php

	}
	add_action( 'wp_head', 'simple_grey_render_title' );
endif;

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
