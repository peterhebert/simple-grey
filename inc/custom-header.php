<?php
// Register Theme Features
function simple_grey_custom_theme_features() {

    // Add theme support for Custom Header
	$header_args = array(
		'default-image'          => '',
		'default-text-color'     => 'EEEEEE',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'simple_grey_header_style',
		'admin-head-callback'    => 'simple_grey_admin_header_style',
		'admin-preview-callback' => 'simple_grey_admin_header_image',
	);
	add_theme_support( 'custom-header', $header_args );
    
}
add_action( 'after_setup_theme', 'simple_grey_custom_theme_features' );


if ( ! function_exists( 'simple_grey_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see simple_grey_custom_header_setup().
 */
function simple_grey_header_style() {
	$header_text_color = get_header_textcolor();
    $header_image = get_header_image();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color && $header_image === '') {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-info {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		elseif ( HEADER_TEXTCOLOR !== $header_text_color ) :
	?>
		#masthead .site-branding {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php else:
    endif; ?>
	<?php if ( get_header_image() ) : ?>
		.site-header {
            background: url(<?php header_image(); ?>) no-repeat center top;
            background-size: cover;
		}
	<?php endif; // End header image check. ?>
    </style>
	<?php
}
endif; // simple_grey_header_style

if ( ! function_exists( 'simple_grey_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see simple_grey_custom_header_setup().
 */
function simple_grey_admin_header_style() {
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		.site-header {
		  background: url(<?php header_image(); ?>) no-repeat 0 center;
		}
	</style>
<?php
}
endif; // simple_grey_admin_header_style

if ( ! function_exists( 'simple_grey_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see simple_grey_custom_header_setup().
 */
function simple_grey_admin_header_image() {
}
endif; // simple_grey_admin_header_image
