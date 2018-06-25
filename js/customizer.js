/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header background color.
	wp.customize( 'simple_grey_header_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('background-color', newval );
		} );
	} );
	
	// Header text color.
	wp.customize( 'simple_grey_header_bg_color', function( value ) {
		value.bind( function( newval ) {
			$('.site-header').css('color', newval );
		} );
	} );

	// Header link color.
	wp.customize( 'simple_grey_header_link_color', function( value ) {
		value.bind( function( newval ) {
			$('.site-header a, .site-header a:visited').css('color', newval );
		} );
	} );
	// Header link hover color.
	wp.customize( 'simple_grey_header_link_hover_color', function( value ) {
		value.bind( function( newval ) {
			$('.site-header a:hover').css('color', newval );
		} );
	} );

} )( jQuery );

