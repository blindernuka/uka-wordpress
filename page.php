<?php
/*
 * 
 * TEMPLATE FOR PAGES
 *
 */
?>

<?php get_header(); ?>

<?php if ( has_nav_menu( 'main-menu' ) ) : ?>
	<nav id="site-navigation" class="main-navigation nav-fixed" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'uka' ); ?>">
	<?php
			wp_nav_menu(array(
				'theme_location' => 'main-menu',
				'menu_class'     => 'menu flex',
				'container' => false,
			 ) );
		?>
	</nav>
<?php endif; ?>
		
		<section id="articles" class="column">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<div class="entry-content">
			<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
			the_content();
			endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
			<?php endif; ?>
			</div>
			</article>
		</section>
	
<?php get_footer(); ?>

<!-- page.php -->