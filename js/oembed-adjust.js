document.addEventListener( 'DOMContentLoaded', function () {
	var iframes = document.querySelectorAll( 'iframe[src*="youtube.com"]' );

	// add wmode=transparent to YouTube iframes to fix z-index issue.
	Array.prototype.forEach.call( iframes, function ( iframe ) {
		var src = iframe.getAttribute( 'src' );

		if ( src && src.indexOf( 'wmode=transparent' ) === -1 ) {
			iframe.setAttribute( 'src', src + ( src.indexOf( '?' ) === -1 ? '?' : '&' ) + 'wmode=transparent' );
		}
	} );
} );
