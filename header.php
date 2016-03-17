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
  <div id="skiplinks">
    <a href="#content"><?php _e( 'Skip to Content', 'simple-grey' ); ?></a>
    <a href="#navigation"><?php _e( 'Skip to Navigation', 'simple-grey' ); ?></a>
    <a href="#footer"><?php _e( 'Skip to Footer', 'simple-grey' ); ?></a>
  </div>
<header id="masthead" class="site-header" role="banner">
  <div class="wrap">
<?php
$brand_class = '';
$logo_class = '';
if ( get_theme_mod( 'simple_grey_logo' ) ) :
    $brand_class .= ' with-logo';
endif;
if ( get_theme_mod( 'simple_grey_header_drop_shadow' ) ) :
    $brand_class .= ' drop-shadow';
endif;
if ( get_theme_mod( 'simple_grey_logo_style' ) !== '') :
    $logo_class .= ' '.get_theme_mod( 'simple_grey_logo_style' );
endif;
      ?>
      <div class="site-branding row<?php echo $brand_class; ?>">
      <?php if ( get_theme_mod( 'simple_grey_logo' ) ) : ?>
      <div class="site-logo<?php echo $logo_class; ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'simple_grey_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></div>
      <?php endif; ?>
      <div class="site-info">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
          <?php echo get_theme_mod( 'simple_grey_site_description' ); ?>
      </div>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
      <div id="menu-toggle" class="menu-toggle"><button aria-controls="menu" aria-expanded="false"><i class="fa fa-bars"></i><?php _e( 'Menu', 'simple-grey' ); ?></button></div>
<?php endif; ?>
      </div>
      <!-- .site-branding -->
  </div>
</header><!-- #masthead -->
<?php if ( has_nav_menu( 'primary' ) ) : ?>
    <nav id="navigation" role="navigation">
      <div class="wrap"><?php simple_grey_main_menu(); ?></div>
    </nav>
<?php endif; ?>

<div id="content">
    <div class="wrap">
  <div class="row">
