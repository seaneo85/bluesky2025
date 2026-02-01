<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <header>
    <div class="header-container">
      <div class="content-container">
        <div id="logo-container">
          <a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home" class="logo">
            <img src="<?php echo get_template_directory_uri(); ?>/images/bluesky-logo-2025.svg" alt="<?php bloginfo( 'name' ) ?>" />
            <span class="sr-only"><?php bloginfo( 'name' ) ?>: <?php bloginfo( 'description' ) ?></span>
          </a>
        </div> <!--branding-->
          
        <div id="search" class="desktop-search">
          <?php get_search_form(); ?>
        </div> <!--search-->

        <div class="mobile-menu-button-container">
          <button type="button" id="menu-toggle" aria-controls="top-nav" aria-expanded="false">
            <i class="fas fa-bars fa-2xl"></i>
          </button>

          <div class="nav-toggle-container" id="nav-toggle-container">
            <nav id="top-nav">
              <div id="mobile-nav-close-container">
                <button type="button" id="mobile-nav-close" aria-controls="top-nav" aria-expanded="true">
                  <i class="fas fa-times fa-2xl"></i>
                  <span class="sr-only"><?php _e('Close Menu', 'bluesky2025'); ?></span>
                </button>
              </div>

              <?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
            </nav>
          </div> <!--nav-toggle-container-->
        </div>
      </div> <!-- content-container-->

      
    </div> <!--header-container-->
  </header>

  <div id="wrapper" class="hfeed">
    <div id="container">