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
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'simple-grey' ); ?></h1>
		<div class="nav-links">
			<?php
				previous_post_link( '<div class="nav-previous">%link</div>', _x( '<span class="meta-nav">&larr;</span>%title', 'Previous post link', 'simple-grey' ) );
				next_post_link(     '<div class="nav-next">%link</div>',     _x( '%title<span class="meta-nav">&rarr;</span>', 'Next post link',     'simple-grey' ) );
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->
<?php endif; ?>
