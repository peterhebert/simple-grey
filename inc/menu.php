<?php

// Register Navigation Menus
function simple_grey_navigation_menus() {

	$locations = array(
		'primary' => __( 'Primary Navigation', 'simple-grey' )
	);
	register_nav_menus( $locations );

}
add_action( 'init', 'simple_grey_navigation_menus' );

// The Main Menu
function simple_grey_main_menu() {

	$params = array(
			'theme_location'  => 'primary',
			'container'       => false,
			'walker'          => new Aria_Walker_Nav_Menu(),
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			'menu_class'      => 'nav-menu '.get_theme_mod( 'simple_grey_nav_style' )
	);

	if ( 'flat' == get_theme_mod( 'simple_grey_nav_style' ) ) :
		$params['depth'] = -1;
	endif;

	wp_nav_menu( $params );

} /* End Main Menu */
