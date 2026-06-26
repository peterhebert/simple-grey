<?php
/**
 * Comments customization functions.
 *
 * @package Simple Grey
 */

/**
 * Completely removes the "Required fields are marked *" markup globally from the form,
 * preventing it from appending inside the logged-in paragraph wrapper.
 *
 * @param string $message The HTML markup containing the required fields notice.
 * @return string An empty string to hide the message completely.
 */
function simple_grey_remove_required_message_globally( $message ) {
	$message = '';

	return $message;
}
add_filter( 'wp_required_field_message', 'simple_grey_remove_required_message_globally' );

/**
 * Changes the default visual required field asterisk to a text indicator.
 *
 * @param string $indicator The HTML markup for the visual indicator.
 * @return string Modified HTML markup containing the new text indicator string.
 */
function simple_grey_change_required_indicator( $indicator ) {
	$indicator = '<span class="required"> ' . __( '(required)', 'simple-grey' ) . '</span>';
	return $indicator;
}
add_filter( 'wp_required_field_indicator', 'simple_grey_change_required_indicator' );

/**
 * Automatically loops through all form fields and appends "(optional)"
 * to the labels of any fields that do not contain a required attribute or flag.
 *
 * @param array $comment_fields Array of HTML strings for all comment form fields.
 * @return array The processed fields array with optional tags cleanly injected.
 */
function simple_grey_add_optional_to_labels( $comment_fields ) {
	foreach ( $comment_fields as $key => $field_html ) {
		// Skip adding (optional) if the field is explicitly marked as required.
		if ( strpos( $field_html, 'required=' ) !== false || strpos( $field_html, 'class="required"' ) !== false ) {
			continue;
		}

		// Locate the closing tag of the HTML label element.
		if ( strpos( $field_html, '</label>' ) !== false ) {
			$optional_markup = '<span class="optional"> ' . __( '(optional)', 'simple-grey' ) . '</span></label>';

			// Replace the original closing label tag with our custom text wrapper.
			$comment_fields[ $key ] = str_replace( '</label>', $optional_markup, $field_html );
		}
	}

	return $comment_fields;
}
add_filter( 'comment_form_fields', 'simple_grey_add_optional_to_labels', 30 );
