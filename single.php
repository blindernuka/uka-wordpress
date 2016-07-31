<?php
/*
 * 
 * TEMPLATE FOR POSTS
 *
 */
?>

<?php get_header(); ?>
		
		<section id="articles" class="column">

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				<?php printf( __('<span>Published <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span></span>', 'uka'), get_the_time('c'), get_the_time(get_option('date_format')), get_the_author_link(get_the_author_meta('ID'))); ?>
			</header>

			<div class="entry-content">


			<?php the_content();
			endwhile; else: ?>
			<p>Sorry, no posts matched your criteria.</p>
			<?php endif; ?>
			</div>
			</article>
		</section>
	<?php get_sidebar(); ?>

<?php get_footer(); ?>
