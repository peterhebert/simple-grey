<?php
/**
 * Simple Grey functions and definitions
 *
 * @package Simple Grey
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 720; /* pixels */
}

if ( ! function_exists( 'simple_grey_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function simple_grey_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Simple Grey, use a find and replace
	 * to change 'simple-grey' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'simple-grey', get_template_directory() . '/languages' );

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

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'simple-grey' ),
	) );

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
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'simple_grey_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	// replace Gallery shortcode function with my own custom version
	remove_shortcode('gallery', 'gallery_shortcode');
	add_shortcode('gallery', 'simple_grey_gallery_shortcode');
  
	// allow shortcode rendering in widgets
	add_filter('widget_text', 'do_shortcode');

}
endif; // simple_grey_setup
add_action( 'after_setup_theme', 'simple_grey_setup' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function simple_grey_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Secondary', 'simple-grey' ),
		'id'            => 'sidebar-secondary',
		'description'   => '',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

	register_sidebar( array(
		'name'          => __( 'Featured', 'simple-grey' ),
		'id'            => 'sidebar-featured',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
  
	register_sidebar( array(
		'name'          => __( 'Footer', 'simple-grey' ),
		'id'            => 'sidebar-footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );

}
add_action( 'widgets_init', 'simple_grey_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function simple_grey_scripts() {

	wp_enqueue_style( 'dashicons' );

	//wp_enqueue_script( 'simple-grey-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20140817', true );

    wp_enqueue_script( 'simple-grey-jq-navigation', get_template_directory_uri() . '/js/jq-navigation.js', array( 'jquery' ) );

    
    
	wp_enqueue_script( 'simple-grey-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'simple-grey-jq-gallery-adjust', get_template_directory_uri() . '/js/jq-gallery-adjust.js', array( 'jquery' ) );

	/* adjust issues with oEmbeds

	make Twitter embeds responsive
	* http://sanerdesign.com/2012/07/twitter-embed-width-issue-wordpress-fix/

	add wmode=transparent to YouTube embeds to fix z-index issue
	* http://stackoverflow.com/questions/9074365/youtube-video-embedded-via-iframe-ignoring-z-index

	*/
	wp_register_script( 'simple-grey-oembed-adjust' , get_template_directory_uri() . '/js/oembed-adjust.js', array( 'jquery' ), null, true );
	wp_enqueue_script ( 'simple-grey-oembed-adjust' );

	// load Google Fonts
	wp_register_script( 'open-sans', get_template_directory_uri() . '/js/fonts.js' );
	wp_enqueue_script( 'open-sans');


	// load theme stylesheet
	wp_enqueue_style( 'simple-grey-style', get_template_directory_uri() . '/css/simple-grey.css' );

	// bxSlider
	wp_enqueue_style('simple-grey-bxstyle', get_template_directory_uri() . '/js/jquery-bxslider/jquery.bxslider.css');
	wp_enqueue_script('simple-grey-bxscript' , get_template_directory_uri() . '/js/jquery-bxslider/jquery.bxslider.min.js', array( 'jquery' ), null, true );

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

// Remove version number and 'generator' tags.
function simple_grey_remove_wp_version_meta_rss() {
  return '';
}
add_filter('the_generator', 'simple_grey_remove_wp_version_meta_rss');

// remove wp version param from any enqueued scripts
function simple_grey_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}
add_filter( 'style_loader_src', 'simple_grey_remove_wp_ver_css_js', 9999 );
add_filter( 'script_loader_src', 'simple_grey_remove_wp_ver_css_js', 9999 );

/**
 * get the modified author id and meta
 */
if ( ! function_exists( 'get_the_modified_author_id' ) ) :

  function get_the_modified_author_id() {
    if ( $last_id = get_post_meta( get_post()->ID, '_edit_last', true) ) {
      return $last_id;
    }
  }

endif; // get_the_modified_author_id

/**
 * Customized tag cloud arguments.
 */

function simple_grey_widget_tag_cloud_args( $args ) {
	// change units to percentages and use sensible sizes
	$args['largest'] = 250;
	$args['smallest'] = 75;
	$args['unit'] = '%';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'simple_grey_widget_tag_cloud_args' );

/**
 * remove width and height attributes from img tags when inserting media
 */
function simple_grey_remove_dimension_attributes( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
add_filter( 'post_thumbnail_html', 'simple_grey_remove_dimension_attributes', 10 );
add_filter( 'image_send_to_editor', 'simple_grey_remove_dimension_attributes', 10 );

/**
 * list post categories without 'Uncategorized' category.
 */

function simple_grey_get_the_category_list( $id )
 {

    $categories = get_the_category( $id );
    $category_list = array();
    foreach ($categories as $category) {
      // exclude Uncategorized from lists
      if($category->name != 'Uncategorized') {
        $category_list[] = '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( __( "View all posts in %s", 'simple-grey' ), $category->name ) ) . '" rel="category tag">'. $category->name.'</a>';
      }
    }

	return $category_list;
}

function simple_grey_list_categories_without_uncategorized($args=array())
 {
    if(get_category_by_slug('uncategorized')) {
      $uncatObj = get_category_by_slug('uncategorized');
    	$args['exclude'] = strval($uncatObj->term_id);
    }
    $args['title_li'] = '';
  	return wp_list_categories($args);

}


/**
 * Add Embed Container
 *
 * Wrap the embed in a container for scaling
 */
function simple_grey_modify_embed_output( $html ) {
	
	// Pattern for removing width and height attributes
	$attr_pattern = '/(width|height)="[0-9]*"/i';
	$whitespace_pattern = '/\s+/';
	$embed = preg_replace($attr_pattern, "", $html);
	$embed = preg_replace($whitespace_pattern, ' ', $embed); // Clean-up whitespace
	$embed = trim($embed);

	// Add container
	$html = "<div class=\"responsive-embed\">$embed</div>\n";
	
	return $html;
}
add_filter('embed_oembed_html', 'simple_grey_modify_embed_output', 10);

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
