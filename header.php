<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
		
		<div class="header-image">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo( get_header_image() ); ?>">
			</a>
		</div><!-- .header-image -->
		
		<header id="masthead" class="site-header container row translucent" role="banner">
			<!--div class="site-header-main"-->

				<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
					<!--div id="site-main-menu" class="site-main-menu"-->
							<nav id="site-navigation" class="main-navigation column" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'uka' ); ?>">
							<?php
									wp_nav_menu(array(
										'theme_location' => 'main-menu',
										'menu_class'     => 'menu flex space-around',
										//'container_class' => 'align-center',
										'container' => false,
									 ) );
								?>
							</nav><!-- .main-navigation -->
					<!--/div--><!-- .site-main-menu -->
				<?php endif; ?>

		</header><!-- .site-header -->

		<br>
		<main id="main" class="site-main container row translucent" role="main">
