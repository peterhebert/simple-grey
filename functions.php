<?php
/**
 * simple_grey functions and definitions.
 */

define('SIMPLE_GREY_VERSION', '1.6.1');

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'simple_grey_setup' ) ) :
	/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
	function simple_grey_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on simple_grey, use a find and replace
		 * to change 'simple-grey' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'simple-grey', get_template_directory().'/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 220, 220 );

		/**
		* Add support for Gutenberg.
		*
		* @link https://wordpress.org/gutenberg/handbook/reference/theme-support/
		*/

		// wide blocks
		add_theme_support( 'align-wide' );

		// editor color palette
		add_theme_support( 'editor-color-palette', array(
			array(
				'name'  => __( 'White', 'simple-grey' ),
				'slug'  => 'white',
				'color' => '#ffffff',
			),
			array(
				'name'  => __( 'Grey 100 / Whitesmoke', 'simple-grey' ),
				'slug'  => 'grey-100',
				'color' => '#f5f5f5',
			),
			array(
				'name'  => __( 'Grey 200', 'simple-grey' ),
				'slug'  => 'grey-200',
				'color' => '#ededed',
			),
			array(
				'name'  => __( 'Grey 300', 'simple-grey' ),
				'slug'  => 'grey-300',
				'color' => '#cccccc',
			),
			array(
				'name'  => __( 'Grey 400', 'simple-grey' ),
				'slug'  => 'grey-400',
				'color' => '#999999',
			),
			array(
				'name'  => __( 'Grey 500', 'simple-grey' ),
				'slug'  => 'grey-500',
				'color' => '#666666',
			),
			array(
				'name'  => __( 'Grey 600', 'simple-grey' ),
				'slug'  => 'grey-600',
				'color' => '#545454',
			),
			array(
				'name'  => __( 'Grey 700', 'simple-grey' ),
				'slug'  => 'grey-700',
				'color' => '#454545',
			),
			array(
				'name'  => __( 'Grey 800', 'simple-grey' ),
				'slug'  => 'grey-800',
				'color' => '#333333',
			),
			array(
				'name'  => __( 'Grey 900', 'simple-grey' ),
				'slug'  => 'grey-900',
				'color' => '#212121',
			),
			array(
				'name'  => __( 'Black', 'simple-grey' ),
				'slug'  => 'black',
				'color' => '#000000',
			),
			array(
				'name'	=> __( 'Red', 'simple-grey' ),
				'slug'	=> 'red',
				'color'	=> '#cc0000',
			),
			array(
				'name'	=> __( 'Green', 'simple-grey' ),
				'slug'	=> 'green',
				'color'	=> '#039600',
			),
			array(
				'name'  => __( 'Blue', 'simple-grey' ),
				'slug'  => 'blue',
				'color'	=> '#0066cc',
			),
			array(
				'name'  => __( 'Cyan', 'simple-grey' ),
				'slug'  => 'cyan',
				'color' => '#00caca',
			),
			array(
				'name'  => __( 'Magenta', 'simple-grey' ),
				'slug'  => 'magenta',
				'color' => '#db00db',
			),
			array(
				'name'  => __( 'Yellow', 'simple-grey' ),
				'slug'  => 'yellow',
				'color' => '#ffcc00',
			),
			array(
				'name'  => __( 'Orange', 'simple-grey' ),
				'slug'  => 'orange',
				'color' => '#FF7400',
			),

		) );		
		
	}
 
endif; // simple_grey_setup
add_action( 'after_setup_theme', 'simple_grey_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function simple_grey_widgets_init()
{
	register_sidebar(array(
		'name' => __( 'Secondary', 'simple-grey' ),
		'id' => 'sidebar-secondary',
		'description' => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));

	register_sidebar(array(
		'name' => __( 'Featured', 'simple-grey' ),
		'id' => 'sidebar-featured',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));

	register_sidebar(array(
		'name' => __( 'Footer', 'simple-grey' ),
		'id' => 'sidebar-footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	));
}
add_action( 'widgets_init', 'simple_grey_widgets_init' );

/**
 * backwards compatibility for get_theme_file_uri(), for versions pre 4.7.
 */

if ( ! function_exists( 'get_theme_file_uri' ) ){
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
function simple_grey_scripts()
{
	
	// load fonts
	wp_enqueue_style( 'simple-grey-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic', false );
	wp_enqueue_style( 'dashicons' );

	// load theme stylesheets
	if ( is_rtl() ) {
		wp_enqueue_style( 'simple-grey-main-rtl', get_theme_file_uri( 'css/simple-grey-rtl.css' ) );
	} else {
		wp_enqueue_style( 'simple-grey-main', get_theme_file_uri( 'css/simple-grey.css' ) );
	}

	wp_enqueue_script( 'simple-grey-navigation', get_theme_file_uri( 'js/navigation.js' ), array(), SIMPLE_GREY_VERSION, true );

	wp_enqueue_script( 'simple-grey-skip-link-focus-fix', get_theme_file_uri( 'js/skip-link-focus-fix.js' ), array(), SIMPLE_GREY_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// fix issues with oEmbeds
	wp_enqueue_script( 'simple-grey-oembed-adjust', get_theme_file_uri( 'js/oembed-adjust.js' ), array( 'jquery' ), SIMPLE_GREY_VERSION, true );

	// accessibility features
	wp_enqueue_script( 'simple-grey-accessibility', get_theme_file_uri( 'js/accessibility.js' ), array( 'jquery' ), SIMPLE_GREY_VERSION, true );

	// and finally, enqueue theme stylesheet (style.css)
	wp_enqueue_style( 'simple-grey-style', get_stylesheet_uri(), array(), SIMPLE_GREY_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'simple_grey_scripts' );

/**
 * Apply theme's stylesheet to the visual editor.
 *
 * @uses add_editor_style() Links a stylesheet to visual editor
 * @uses get_stylesheet_uri() Returns URI of theme stylesheet
 */
function simple_grey_add_editor_styles()
{
	add_editor_style( 'css/editor.css' );
}
add_action( 'init', 'simple_grey_add_editor_styles' );


/**
* Enqueue editor styles for Gutenberg
*/
 
function simple_grey_block_editor_styles() {

	wp_register_style( 'simple-grey-block-editor-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,400italic,600,600italic');

	wp_enqueue_style( 'simple-grey-block-editor-styles', get_theme_file_uri( '/css/gutenberg-min.css' ), array('simple-grey-block-editor-fonts') );

}
add_action( 'enqueue_block_editor_assets', 'simple_grey_block_editor_styles' );

/**
 * Post Format customizations.
 */
require get_template_directory().'/inc/post-formats.php';

/**
 * Implement the Custom Header and Custom Background features.
 */
require get_template_directory().'/inc/custom-theme-features.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory().'/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory().'/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory().'/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory().'/inc/jetpack.php';

	/**
	* Menu functions and walkers.
	*/
require get_template_directory().'/inc/menu.php';
require get_template_directory().'/inc/aria-walker-nav-menu.php';
