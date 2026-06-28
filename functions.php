<?php
/**
 * Simple Grey theme functions and definitions.
 *
 * @package Simple Grey
 */

$theme = wp_get_theme();
define( 'SIMPLE_GREY_VERSION', $theme->get( 'Version' ) );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function simple_grey_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Secondary', 'simple-grey' ),
			'id'            => 'sidebar-secondary',
			'description'   => '',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Featured', 'simple-grey' ),
			'id'            => 'sidebar-featured',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'simple-grey' ),
			'id'            => 'sidebar-footer',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'simple_grey_widgets_init' );

/**
 * Backwards compatibility for get_theme_file_uri(), for versions pre 4.7.
 */

if ( ! function_exists( 'get_theme_file_uri' ) ) {
	/**
	 * Get the URL of a theme file
	 *
	 * @param string $file (Optional) File to search for in the stylesheet directory.
	 * @return string The URL of the file.
	 */
	function get_theme_file_uri( $file = '' ) {
		$file = ltrim( $file, '/' );
		if ( empty( $file ) ) {
			$url = get_stylesheet_directory_uri();
		} elseif ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
			$url = get_stylesheet_directory_uri() . '/' . $file;
		} else {
			$url = get_template_directory_uri() . '/' . $file;
		}
		return apply_filters( 'theme_file_uri', $url, $file );
	}
}

/**
 * Enqueue scripts and styles.
 */
function simple_grey_scripts() {
	// phpcs:ignore.
	wp_enqueue_style( 'simple-grey-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic', array(), date( 'U' ) );
	wp_enqueue_style( 'dashicons' );

	// load theme stylesheets.
	if ( is_rtl() ) {
		wp_enqueue_style( 'simple-grey-main-rtl', get_theme_file_uri( 'css/simple-grey-rtl.css' ), array(), simple_grey_file_version( '/css/simple-grey-rtl.css' ) );
	} else {
		wp_enqueue_style( 'simple-grey-main', get_theme_file_uri( 'css/simple-grey.css' ), array(), simple_grey_file_version( '/css/simple-grey.css' ) );
	}

	// Fork Awesome web font.
	wp_enqueue_style( 'fork-awesome-icons', get_theme_file_uri( 'css/fork-awesome.min.css' ), array(), '1.2.0' );

	// load scripts.
	wp_enqueue_script( 'simple-grey-navigation', get_theme_file_uri( 'js/navigation.js' ), array(), simple_grey_file_version( '/js/navigation.js' ), true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// fix issues with oEmbeds.
	wp_enqueue_script( 'simple-grey-oembed-adjust', get_theme_file_uri( 'js/oembed-adjust.js' ), array(), simple_grey_file_version( 'js/oembed-adjust.js' ), true );

	// and finally, enqueue theme stylesheet (style.css).
	wp_enqueue_style( 'simple-grey-style', get_stylesheet_uri(), array(), SIMPLE_GREY_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'simple_grey_scripts' );

/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function simple_grey_add_editor_styles() {
	add_editor_style( 'css/editor.css' );
}
add_action( 'init', 'simple_grey_add_editor_styles' );

/**
 * Post Format customizations.
 */
require get_template_directory() . '/inc/post-formats.php';

/**
 * Theme setup, Custom Header and Custom Background features.
 */
require get_template_directory() . '/inc/theme-setup.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customize form and comments appearance for accesisbility.
 */
require get_template_directory() . '/inc/forms-commenting.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
* Menu functions and walkers.
*/
require get_template_directory() . '/inc/menu.php';
require get_template_directory() . '/inc/class-aria-walker-nav-menu.php';
require get_template_directory() . '/inc/class-disclosure-walker-nav-menu.php';
