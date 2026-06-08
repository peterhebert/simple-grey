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

	$navigation_style = get_theme_mod( 'simple_grey_nav_style', 'flat' );

	$params = array(
		'theme_location'       => 'primary',
		'container'            => 'nav',
		'container_class'      => 'row',
		'container_aria_label' => __( 'Primary navigation', 'simple-grey' ),
		'walker'               => new Aria_Walker_Nav_Menu(),
		'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'menu_class'           => 'nav-menu ' . $navigation_style,
	);

	if ( 'flat' === $navigation_style ) {
		$params['depth'] = -1;

	} elseif ( 'drop-down' === $navigation_style ) {
		$params['walker'] = new Disclosure_Walker_Nav_Menu();
	}

	wp_nav_menu( $params );
}
