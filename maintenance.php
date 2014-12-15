<?php
/**
 * The template for site maintenance mode.
 *
 @package Simple Grey
 */

$protocol = $_SERVER["SERVER_PROTOCOL"];
if ( 'HTTP/1.1' != $protocol && 'HTTP/1.0' != $protocol )
$protocol = 'HTTP/1.0';
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="maintenance-mode">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Site Under Maintenance', 'simple-grey' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">
					<p><?php _e( "We're currently performing maintenance on this website. Please check back soon.", 'simple-grey' ); ?></p>

				</div><!-- .page-content -->
			</section><!-- .maintenance-mode -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>