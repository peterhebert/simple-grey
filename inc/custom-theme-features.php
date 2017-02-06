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

	/*
	 * Add Theme Support for Custom Logo (starting with WordPress 4.5).
	 * See https://make.wordpress.org/core/2016/03/10/custom-logo/
	 */
	if ( function_exists( 'the_custom_logo' ) ) {

		add_theme_support( 'custom-logo', array(
			'height'      => 90, // set to your dimensions
			'width'       => 90,
			'flex-height' => true,
			'flex-width'  => true,
		) );

	}

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
		if ( $header_image === '' ) {
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
		if ( ! empty( $color ) ) {
			/* Use 'background' instead of 'background-color'. */
			$style .= " background: #{$color};";
		}

		/* Get the background image. */
		$image = get_background_image();
		if ( ! empty( $image ) ) {
			$style .= " background-image: url('$image');";

			$size = get_theme_mod( 'simple_grey_background_size' );
			if ( ! empty( $size ) ){
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
		$style = trim( $style );

		/* If no styles, return. */
		if ( '' == $style ) {
			return;
		}

		?>
		<style type="text/css">#content { <?php echo esc_attr( $style ); ?> }</style>
	<?php
	}
endif; // simple_grey_header_style

// filter the output of the_custom_logo

function simple_grey_the_custom_logo() {
	if ( function_exists( 'has_custom_logo' ) && has_custom_logo( $blog_id = 0 ) ) :
		 $logo_class = '';
		if ( get_theme_mod( 'simple_grey_logo_style' ) !== '' ) :
			   $logo_class .= ' '.get_theme_mod( 'simple_grey_logo_style' );
		 endif;

		 $custom_logo_id = get_theme_mod( 'custom_logo' );
		 $custom_logo_image_src = wp_get_attachment_image_src( $custom_logo_id , 'custom-logo' );
		 $custom_logo = wp_get_attachment_image( $custom_logo_id, 'custom-logo', false, array(
			 'class'    => 'custom-logo',
			 'itemprop' => 'logo',
			 'alt'      => esc_attr( get_bloginfo( 'name', 'display' ) ),
		 ) );

		 $html = sprintf( ' <div class="site-logo%1$s"><a href="%2$s" title="%3$s" rel="home" itemprop="url">%4$s</a></div>',
			 esc_attr( $logo_class ),
			 esc_url( home_url( '/' ) ),
			 esc_attr( get_bloginfo( 'name', 'display' ) ),
			 $custom_logo
		 );
		 return $html;
else :
	return '';
	 endif;
}
add_filter( 'get_custom_logo', 'simple_grey_the_custom_logo' );
