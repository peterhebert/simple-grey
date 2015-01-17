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
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
			} else {
				$( '#masthead, #masthead .site-branding a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header background color.
	wp.customize( 'simple_grey_header_background_color', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
			} else {
				$( '#masthead' ).css( {
					'background-color': to
				} );
			}
		} );
	} );

} )( jQuery );
