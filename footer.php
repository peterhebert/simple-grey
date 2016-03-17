<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Simple Grey
 */
?>
  </div>
</div>
</div>
<footer id="footer" class="site-footer" role="contentinfo">
  <div class="wrap">
    <div class="row">
      <?php if ( get_theme_mod( 'simple_grey_footer_text_top' ) ) : ?>
      <div class="footer-text"><?php echo get_theme_mod( 'simple_grey_footer_text_top' ); ?></div>
      <?php endif; ?>
      <?php if ( is_active_sidebar( 'sidebar-footer' ) ) : ?>
      <div class="widget-area">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar-footer') ) : ?>
        <?php endif; ?>
      </div>
       <!-- .widget-area -->
      <?php endif; ?>

     <?php if ( get_theme_mod( 'simple_grey_footer_text_bottom' ) || get_theme_mod( 'simple_grey_show_footer_credits' ) ) : ?>
    <div class="footer-text">
      <?php if ( get_theme_mod( 'simple_grey_footer_text_bottom' ) ) : ?>
        <p><?php echo get_theme_mod( 'simple_grey_footer_text_bottom' ); ?></p>
      <?php endif; ?>
      <?php if ( get_theme_mod( 'simple_grey_show_footer_credits' ) != '' ) : ?>
      <?php do_action( 'simple_grey_credits' ); ?>
      <p><i class="mv mv-wordpress icon-large"></i> <a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'simple-grey' ), 'WordPress' ); ?></a>. <?php printf( __( 'Theme: %1$s by %2$s.', 'simple-grey' ), sprintf( __( '<a href="%1$s">%2$s</a>', 'simple-grey' ), __( 'https://github.com/peterhebert/simple-grey', 'simple-grey' ), __( 'Simple Grey', 'simple-grey' ) ), sprintf( __( '<a href="%1$s" rel="designer">%2$s</a>', 'simple-grey' ), __( 'http://peterhebert.com/', 'simple-grey' ), __( 'Peter Hebert', 'simple-grey' ) ) ); ?></p>
      <?php endif; ?>
    </div>
    <?php endif; ?>
    </div>
  </div>
</footer>
<!-- #footer -->

<?php wp_footer(); ?>
</body></html>
