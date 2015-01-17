<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...

	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>

 *
 * @package Simple Grey
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses simple_grey_header_style()
 * @uses simple_grey_admin_header_style()
 * @uses simple_grey_admin_header_image()
 */
function simple_grey_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'simple_grey_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => 'EEEEEE',
		'width'                  => 1600,
		'height'                 => 400,
		'flex-width'            => true,
		'flex-height'            => true,
		'wp-head-callback'       => 'simple_grey_header_style',
		'admin-head-callback'    => 'simple_grey_admin_header_style',
		'admin-preview-callback' => 'simple_grey_admin_header_image',
	) ) );
}
add_action( 'after_setup_theme', 'simple_grey_custom_header_setup' );

if ( ! function_exists( 'simple_grey_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see simple_grey_custom_header_setup().
 */
function simple_grey_header_style() {
	/* nothing here as no custom color capabilitites have been defined for this theme */
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
		#masthead .headimg {
            
            width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
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
	if ( get_header_image() ) : ?>
		<div class="headimg"><img src="<?php header_image(); ?>" alt=""></div>
<?php endif; ?>
<?php
}
endif; // simple_grey_admin_header_image