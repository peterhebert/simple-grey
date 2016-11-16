<?php
// Register Theme Features
function simple_grey_custom_theme_features() {

    // Add theme support for Custom Header
	$header_args = array(
		'header-text'            => false,
		'default-text-color'     => '',
		'default-image'          => '',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'simple_grey_header_style',
		'admin-head-callback'    => 'simple_grey_admin_header_style',
	);
	add_theme_support( 'custom-header', $header_args );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio' ) );

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

	// If no custom header image is set, let's bail
	if ( $header_image === '') {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
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
			background: url(<?php header_image(); ?>) no-repeat center top;
		}
	</style>
<?php
}
endif; // simple_grey_admin_header_style
