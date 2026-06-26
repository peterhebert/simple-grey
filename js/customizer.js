/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function () {
	if ( typeof wp === 'undefined' || ! wp.customize ) {
		return;
	}

	// Site title and description.
	wp.customize(
		'blogname',
		function ( value ) {
			value.bind(
				function ( to ) {
					var titleLink = document.querySelector( '.site-title a' );

					if ( titleLink ) {
						titleLink.textContent = to;
					}
				}
			);
		}
	);
	wp.customize(
		'blogdescription',
		function ( value ) {
			value.bind(
				function ( to ) {
					var description = document.querySelector( '.site-description' );

					if ( description ) {
						description.textContent = to;
					}
				}
			);
		}
	);

	// Header background color.
	wp.customize(
		'simple_grey_header_bg_color',
		function ( value ) {
			value.bind(
				function ( newval ) {
					var header = document.querySelector( '.site-header' );

					if ( header ) {
						header.style.backgroundColor = newval;
					}
				}
			);
		}
	);

	// Header text color.
	wp.customize(
		'simple_grey_header_bg_color',
		function ( value ) {
			value.bind(
				function ( newval ) {
					var header = document.querySelector( '.site-header' );

					if ( header ) {
						header.style.color = newval;
					}
				}
			);
		}
	);

	// Header link color.
	wp.customize(
		'simple_grey_header_link_color',
		function ( value ) {
			value.bind(
				function ( newval ) {
					var links = document.querySelectorAll( '.site-header a, .site-header a:visited' );

					Array.prototype.forEach.call( links, function ( link ) {
						link.style.color = newval;
					} );
				}
			);
		}
	);
	// Header link hover color.
	wp.customize(
		'simple_grey_header_link_hover_color',
		function ( value ) {
			value.bind(
				function ( newval ) {
					var links = document.querySelectorAll( '.site-header a:hover' );

					Array.prototype.forEach.call( links, function ( link ) {
						link.style.color = newval;
					} );
				}
			);
		}
	);

} )();
