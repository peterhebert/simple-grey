<?php
/**
 * Post navigation.
 *
 * @package Simple Grey
 */

$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
$next     = get_adjacent_post( false, '', false );

if ( $next || $previous ) :
	?>
	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Post navigation', 'simple-grey' ); ?></h1>
		<div class="nav-links">
		<?php
			previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">&larr;</span>%title' );
			next_post_link( '<div class="nav-next">%link</div>', '%title<span class="meta-nav">&rarr;</span>' );
		?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
<?php endif; ?>
