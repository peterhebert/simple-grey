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

	// Add theme support for Custom Background
	$background_args = array(
		'default-color'          => '',
		'default-image'          => '',
		'default-repeat'         => '',
		'default-position-x'     => '',
		'wp-head-callback'       => 'simple_grey_custom_background_cb',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-background', $background_args );

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

if ( ! function_exists( 'simple_grey_custom_background_cb' ) ) :
/**
 * Implements styles for the Custom Background theme feature
 *
 * @see simple_grey_custom_header_setup().
 */
function simple_grey_custom_background_cb() {
		$style = '';

		/* Get the background color. */
		$color = get_background_color();
		if( !empty($color)) {
			/* Use 'background' instead of 'background-color'. */
			$style .= " background: #{$color};";
		}

		/* Get the background image. */
		$image = get_background_image();
		if( !empty($image)) {
			$style .= " background-image: url('$image');";

			$size = get_theme_mod('simple_grey_background_size');
			if(!empty($size)){
				$style .= " background-size: $size;";
			}

      $repeat = get_theme_mod( 'background_repeat', 'repeat' );
      if ( ! in_array( $repeat, array( 'no-repeat', 'repeat-x', 'repeat-y', 'repeat' ) ) ) {
				$repeat = 'repeat';
			}
      $style .= " background-repeat: $repeat;";

      $position = get_theme_mod( 'background_position_x', 'left' );
      if ( ! in_array( $position, array( 'center', 'right', 'left' ) ) ) {
				$position = 'left';
			}
      $style .= " background-position: top $position;";

      $attachment = get_theme_mod( 'background_attachment', 'scroll' );
      if ( ! in_array( $attachment, array( 'fixed', 'scroll' ) ) ) {
				$attachment = 'scroll';
			}
      $style .= " background-attachment: $attachment;";
}
		/* If no styles, return. */
		if ( '' == trim( $style ) )
			return;

	?>
	<style type="text/css">#content { <?php echo trim( $style ); ?> }</style>
	<?php
}
endif; // simple_grey_header_style
