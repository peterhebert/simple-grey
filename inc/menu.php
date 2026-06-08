<?php
/**
 * Navigation Menu functionality
 *
 * @package Simple Grey
 */

/**
 * Register Navigation Menus
 *
 * @return void
 */
function simple_grey_navigation_menus() {

	$locations = array(
		'primary' => __( 'Primary Navigation', 'simple-grey' ),
	);
	register_nav_menus( $locations );
}
add_action( 'init', 'simple_grey_navigation_menus' );

/**
 * Setup the main menu.
 *
 * @return void
 */
function simple_grey_main_menu() {

	// retrieve style from db - default to flat if not set.
	$navigation_style = get_theme_mod( 'simple_grey_nav_style', 'flat' );

	$params = array(
		'theme_location' => 'primary',
		'container'      => false,
		'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'menu_class'     => 'nav-menu ' . $navigation_style,
	);

	if ( 'flat' === $navigation_style ) :
		$params['depth'] = -1;
	endif;

	wp_nav_menu( $params );
}
