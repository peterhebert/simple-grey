<?php
/**
 * Post format customizations for this theme.
 *
 * @package Simple Grey
 */

if ( ! function_exists( 'simple_grey_pf_quote' ) ) :

	/**
	 * Check if qoute post format is wrapped in a <blockquote> tag.
	 * If not, then wrap it.
	 *
	 * @param string $content The content.
	 * @return string Updated content.
	 *
	 * @link http://justintadlock.com/archives/2012/08/27/post-formats-quote
	 */
	function simple_grey_pf_quote( $content ) {

		/* Check if we're displaying a 'quote' post. */
		if ( has_post_format( 'quote' ) ) {

			/* Match any <blockquote> elements. */
			preg_match( '/<blockquote.*?>/', $content, $matches );

			/* If no <blockquote> elements were found, wrap the entire content in one. */
			if ( empty( $matches ) ) {
				$content = "<blockquote>{$content}</blockquote>";
			}
		}

		return $content;
	}
	add_filter( 'the_content', 'simple_grey_pf_quote' );

endif;

