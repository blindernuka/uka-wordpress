<?php
/*
 * 
 * TEMPLATE FOR HOMEPAGE
 *
 */
?>

<?php get_header(); ?>


<main id="main">
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

</section>
<?php
	$pages = intval(get_theme_mod('pages'));
	if ($pages > 0){
		for ($i = 1; $i < $pages + 1; $i++){
			$id = str_replace(' ', '-', strtolower(get_theme_mod('panel-'.$i.'-title')));
			echo '<section class="panel panel-'.$i.'" id="'.$id.'" style="background-color:'.get_theme_mod('panel-'.$i.'-background-color').';">';
			dynamic_sidebar('panel-'.$i); 
			echo '</section>';
		}
	}
?>

<section id="news" class="panel">
		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>
			<?php endif; ?>

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			// End the loop.
			endwhile;



		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>
</section>
</main>
	
<?php get_footer(); ?>
