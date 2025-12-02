<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<title><?php wp_title(' | ', true, 'right'); ?><?php bloginfo('name'); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
	<link rel="stylesheet" href="<?php bloginfo("template_url"); ?>/shortcodes.css" type="text/css" media="screen" />
<link rel="shortcut icon" href="<?php bloginfo("template_url"); ?>/favicon.ico" type="image/x-icon">
<link rel="icon" href="<?php bloginfo("template_url"); ?>/favicon.ico" type="image/x-icon">

<!-- Pulled from http://code.google.com/p/html5shiv/ -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<script src="<?php bloginfo("template_url"); ?>/scripts.js"></script>
<![endif]-->

	<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>


<header>
	<div class="header-container">
		<hgroup id="branding">
		
			<h1 id="blog-title">
				<a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home">
					<?php bloginfo( 'name' ) ?>
				</a>
			</h1>
			
			<h2 id="blog-description"><?php bloginfo( 'description' ) ?></h2>
			
		</hgroup> <!--branding-->
		
		<div id="search">
			<?php get_search_form(); ?>
		</div> <!--search-->
	</div>
		
	</header>


	<div id="wrapper" class="hfeed">



<nav id="top-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'main-menu' ) ); ?>
		</nav>
	
	
	
	<div id="container">