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
	 * Store parent IDs in a stack for nested menus.
	 *
	 * @var array Stack of parent menu item IDs.
	 */
	private $parent_id_stack = array();

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

		// Get the parent ID from the stack (last pushed ID is the current parent).
		$parent_id = ! empty( $this->parent_id_stack ) ? end( $this->parent_id_stack ) : 0;
		$menu_id   = $parent_id ? ' id="sub-menu-' . esc_attr( $parent_id ) . '"' : '';

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

		// Push parent ID onto the stack before rendering its children.
		if ( $has_children ) {
			$this->parent_id_stack[] = $item->ID;
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
			$aria_label = sprintf( __( 'Expand %s', 'simple-grey' ), $item->title );
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
	 * Destructor to clean up parent ID stack.
	 *
	 * @return void
	 */
	public function __destruct() {
		$this->parent_id_stack = array();
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

		// Pop the parent ID from the stack after closing its submenu.
		if ( ! empty( $this->parent_id_stack ) ) {
			array_pop( $this->parent_id_stack );
		}
	}
}
