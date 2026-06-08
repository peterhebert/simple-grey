<?php
/**
 * W3C Disclosure Menu template functions
 *
 * @package Simple Grey
 * @see wp-includes/nav-menu-template.php
 * @link https://www.w3.org/WAI/ARIA/apg/patterns/disclosure/examples/disclosure-navigation-hybrid/
 */

/**
 * Create HTML list of nav menu items.
 *
 * @since 1.9.0
 * @uses Walker
 * @uses Walker_Nav_Menu
 */
class Disclosure_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Store the current item's ID so start_lvl can access it.
	 *
	 * @var integer Saved value for current menu item ID.
	 */
	private $current_parent_id = 0;

	/**
	 * Starts the list before the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::start_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );

		// Dynamically use the saved parent ID to build the id attribute.
		$menu_id = $this->current_parent_id ? ' id="sub-menu-' . esc_attr( $this->current_parent_id ) . '"' : '';

		$output .= "\n{$indent}<ul{$menu_id} class=\"sub-menu\" aria-hidden=\"true\">\n";
	}


	/**
	 * Start the element output.
	 *
	 * @see Walker_Nav_Menu::start_el() for parameters and longer explanation
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param WP_Post  $item   Menu item data object.
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 * @param int      $id     Current item ID.
	 *
	 * @return void
	 */
	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent  = str_repeat( "\t", $depth );
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$has_children = in_array( 'menu-item-has-children', $item->classes, true );

		// Update the property so start_lvl() knows which ID belongs to this level's parent.
		if ( $has_children ) {
			$this->current_parent_id = $item->ID;
		}

		$output .= "{$indent}<li id=\"menu-item-{$item->ID}\"{$class_names}>";

		$atts           = array();
		$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
		$atts['target'] = ! empty( $item->target ) ? $item->target : '';
		$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
		$atts['href']   = ! empty( $item->url ) ? $item->url : '';

		$attributes = '';
		foreach ( $atts as $attr => $value ) {
			if ( ! empty( $value ) ) {
				$value       = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		if ( $has_children ) {
			$item_output .= '<div class="menu-item-link-wrapper">';
		}
		$item_output .= '<a' . $attributes . '>' . $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after . '</a>';

		if ( $has_children ) {
			// Translators: Current menu item title.
			$aria_label = sprintf( __( 'Expand %s' ), $item->title );
			// Disclosure Button referencing the exact sub-menu id attribute.
			$item_output .= sprintf(
				'<button class="disclosure-toggle" type="button" aria-expanded="false" aria-controls="sub-menu-%1$s" aria-label="%2$s">',
				esc_attr( $item->ID ),
				esc_attr( $aria_label )
			);
			$item_output .= '</button>';
			$item_output .= '</div>';
		}

		$item_output .= $args->after;
		$output      .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * Ends the list of after the elements are added.
	 *
	 * @since 3.0.0
	 *
	 * @see Walker::end_lvl()
	 *
	 * @param string   $output Used to append additional content (passed by reference).
	 * @param int      $depth  Depth of menu item. Used for padding.
	 * @param stdClass $args   An object of wp_nav_menu() arguments.
	 */
	public function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent  = str_repeat( "\t", $depth );
		$output .= "{$indent}</ul>\n";
	}
}
