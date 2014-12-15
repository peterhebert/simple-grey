<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Simple Grey
 */
?>

	</div><!-- #content -->

	<footer class="site-footer" role="contentinfo">
	  <div class="wrap">
    <?php if ( get_theme_mod( 'simple_grey_footer_text' ) ) : ?>
    <div class="footer-credits">
      <p><?php echo get_theme_mod( 'simple_grey_footer_text' ); ?></p>
	  </div><!-- .footer-credits -->
    <?php endif; ?>

  <?php if ( is_active_sidebar( 'Footer' ) ) : ?>
	  <div class="footer-widgets">
	  <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer') ) : ?>
	  <?php endif; ?>
	  </div><!-- .footer-widgets -->
  <?php endif; ?>

    <div class="footer-credits">
    <?php if ( get_theme_mod( 'simple_grey_copyright_info' ) ) : ?>
      <p><?php echo get_theme_mod( 'simple_grey_copyright_info' ); ?></p>
    <?php endif; ?>
    <?php if ( get_theme_mod( 'simple_grey_show_footer_credits' ) != '' ) : ?>
	      <?php do_action( 'simple_grey_credits' ); ?>
	      <p><i class="mv mv-wordpress icon-large"></i> <a href="http://wordpress.org/" rel="generator"><?php printf( __( 'Proudly powered by %s', 'simple-grey' ), 'WordPress' ); ?></a>. 
	      <?php printf( __( 'Theme: %1$s by %2$s.', 'simple-grey' ), sprintf( __( '<a href="%1$s">%2$s</a>', 'simple-grey' ), __( 'http://peterhebert.com/', 'simple-grey' ), __( 'Simple Grey', 'simple-grey' ) ), sprintf( __( '<a href="%1$s" rel="designer">%2$s</a>', 'simple-grey' ), __( 'http://peterhebert.com/', 'simple-grey' ), __( 'Peter Hebert', 'simple-grey' ) ) ); ?></p>
    <?php endif; ?>
	  </div><!-- .footer-credits -->
    </div><!-- .wrap -->
	</footer><!-- #site-footer -->


</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
