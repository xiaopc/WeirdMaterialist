<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Materialist
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link type="text/css" rel="stylesheet" href="//cdn.bootcss.com/materialize/0.97.7/css/materialize.min.css" media="screen,projection"/>
<link type="text/css" rel="stylesheet" href="//cdn.bootcss.com/material-design-icons/2.2.3/iconfont/material-icons.css" media="screen,projection"/>
<?php wp_head(); ?>
<style>
    #loader {
        position: fixed;
        right: 90px;
        bottom: 22px;
        z-index: 66;
    }
</style>
</head>

<body <?php body_class(); ?>>
<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'materialist' ); ?></a>
<div id="windowbg"></div>
<div id="windowcontent">
    <div id="loader" class="preloader-wrapper medium active">
    	<div class="spinner-layer spinner-blue-only">
    		<div class="circle-clipper left">
    			<div class="circle">
    			</div>
    		</div>
    		<div class="gap-patch">
    			<div class="circle">
    			</div>
    		</div>
    		<div class="circle-clipper right">
    			<div class="circle">
    			</div>
    		</div>
    	</div>
    </div>

    <div class="navbar-fixed">
      <nav class="blue darken-2">
        <div class="nav-wrapper">
          <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo" rel="home"><?php bloginfo( 'name' ); ?><span class="description-nav hide-on-small-only"> | <?php bloginfo( 'description' ); ?></span></a>
          <a href="#" data-activates="mobile-nav" id="buttonCollapse" class="left" style="margin-left: -25px;"><i class="material-icons">menu</i></a>
          <?php wp_nav_menu( array( 'theme_location' => 'primary' , 'container' => false , 'menu_class' => 'right hide-on-med-and-down' , 'menu_id' => 'nav-mobile') ); ?>
          <?php wp_nav_menu( array( 'theme_location' => 'primary' , 'container' => false , 'menu_class' => 'side-nav' , 'menu_id' => 'mobile-nav') ); ?>
        </div>
      </nav>
    </div>

	<div class="container">
