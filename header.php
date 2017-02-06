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
<nav role="navigation">
  <a href="#content" class="screen-reader-text" aria-role="navigation"><?php _e( 'Skip to Content', 'simple-grey' ); ?></a>
</nav>
<header id="masthead" class="site-header" role="banner">
  <div class="wrap">
<?php
$brand_class = '';
if ( has_custom_logo() ) :
    $brand_class .= ' with-logo';
endif;
if ( get_theme_mod( 'simple_grey_header_drop_shadow' ) ) :
    $brand_class .= ' drop-shadow';
endif;
      ?>
      <div class="site-branding row<?php echo $brand_class; ?>">
      <?php the_custom_logo( ); ?>
      <div class="site-info">
        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
      </div>
<?php if ( has_nav_menu( 'primary' ) ) : ?>
      <div id="menu-toggle" class="menu-toggle"><button aria-controls="navigation" aria-expanded="false"><i class="fa fa-bars" aria-hidden="true"></i><?php _e( 'Menu', 'simple-grey' ); ?></button></div>
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

<div id="content">
    <div class="wrap">
  <div class="row">
