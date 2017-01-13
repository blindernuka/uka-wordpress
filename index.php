<?php
/*
 * 
 * TEMPLATE FOR HOMEPAGE
 *
 */
?>

<?php get_header(); ?>



<section id="home" class="panel">
<?php if (is_active_sidebar('home-top-left')): ?>
	<aside id="home-top-left" class="widget-area">
		<?php dynamic_sidebar('home-top-left'); ?>
	</aside>
<?php endif; ?>
<?php if (is_active_sidebar('home-top-right')): ?>
	<aside id="home-top-right" class="widget-area">
		<?php dynamic_sidebar('home-top-right'); ?>
	</aside>
<?php endif; ?>
<?php if (is_active_sidebar('home-bottom-left')): ?>
	<aside id="home-bottom-left" class="widget-area">
		<?php dynamic_sidebar('home-bottom-left'); ?>
	</aside>
<?php endif; ?>
<?php if (is_active_sidebar('home-bottom-right')): ?>
	<aside id="home-bottom-right" class="widget-area">
		<?php dynamic_sidebar('home-bottom-right'); ?>
	</aside>
<?php endif; ?>

	<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
		<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'uka' ); ?>">
		<?php
				wp_nav_menu(array(
					'theme_location' => 'main-menu',
					'menu_class'     => 'menu flex',
					'container' => false,
				 ) );
			?>
		</nav>
	<?php endif; ?>

</section>

<?php
	$panels = intval(get_theme_mod('panels'));
	if ($panels > 0){
		for ($i = 1; $i <= $panels; $i++){
			$id = str_replace(' ', '-', strtolower(get_theme_mod('panel-'.$i.'-title')));
			echo '<section class="panel panel-'.$i.'" id="'.$id.'">';
			if (get_theme_mod('panel-'.$i.'-show-title')){
				echo '<h1 class="widget-title">'.get_theme_mod('panel-'.$i.'-title').'</h1>';
			}
			dynamic_sidebar('panel-'.$i); 
			echo '</section>';
		}
	}
	
?>
	
<?php get_footer(); ?>




