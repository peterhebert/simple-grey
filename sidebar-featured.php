<?php
/**
 * The Sidebar containing the featured widget areas.
 *
 * @package peterhebert
 */

?>
    <section id="featured" class="widget-area" role="complementary">
        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( ! dynamic_sidebar( 'sidebar-featured' ) ) : ?>
        <?php endif; // end sidebar widget area ?>
    </section>
