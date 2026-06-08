<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Simple Grey
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>
<a href="#content" class="screen-reader-text skip-link"><?php echo esc_html__( 'Skip to main content', 'simple-grey' ); ?></a>
<header id="masthead" class="site-header" role="banner">
<div class="wrap">
<?php
$brand_class = '';

if ( function_exists( 'has_custom_logo' ) ) {
	if ( has_custom_logo() ) :
		$brand_class .= ' with-logo';
	endif;
}

if ( get_theme_mod( 'simple_grey_header_drop_shadow' ) ) :
	$brand_class .= ' drop-shadow';
endif;
?>
<div class="site-branding row<?php echo esc_attr( $brand_class ); ?>">
<?php
if ( function_exists( 'has_custom_logo' ) ) {
	the_custom_logo();
}

$site_title       = get_bloginfo( 'name' );
$site_description = get_bloginfo( 'description' );

if ( ! empty( $site_title ) || ! empty( $site_description ) ) :
	?>
<div class="site-info">
	<?php if ( ! empty( $site_title ) ) : ?>
		<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php endif; ?>

	<?php if ( ! empty( $site_description ) ) : ?>
		<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
	<?php endif; ?>
</div>
	<?php
endif;
if ( has_nav_menu( 'primary' ) ) :
	?>
<div id="menu-toggle" class="menu-toggle"><button aria-controls="navigation" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i><?php echo esc_html__( 'Menu', 'simple-grey' ); ?></button></div>
<?php endif; ?>
</div>
<!-- .site-branding -->
</div>
</header><!-- #masthead -->
<?php if ( has_nav_menu( 'primary' ) ) : ?>
<div id="navigation" role="navigation">
<div class="wrap">
<nav class="row">
	<?php simple_grey_main_menu(); ?>
</nav>
</div>
</div>
<?php endif; ?>

<div id="content" tabindex="-1">
	<div class="wrap">
		<div class="row">
