<?php
/**
 * Primary navigation.
 *
 * @package Simple Grey
 * @since 1.9.0
 */

// check if accesible menu plugin is active.
$a11y_nav = is_plugin_active( 'classic-menu-accessible-a11y/classic-menu-accessible-a11y.php' );

if ( has_nav_menu( 'primary' ) ) :

	// load wrappers around menus if using core menus.
	if ( false === $a11y_nav ) : ?>
		<div id="navigation">
			<div class="wrap">
				<nav class="row" aria-label="<?php esc_attr_e( 'Primary navigation', 'simple-grey' ); ?>">
		<?php
	endif;

	simple_grey_main_menu();

	if ( false === $a11y_nav ) :
		?>
		</nav>
	</div>
</div>
		<?php
	endif;

endif;

