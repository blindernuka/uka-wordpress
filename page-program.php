<?php
/*
Template Name: Program
*/
?>
<?php get_header(); ?>


		
		<section id="articles" class="column">

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<header>
				<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
			</header>

			<div class="entry-content">
				<iframe src="http://blindernuka.no/billett/eventgroup/2" width="100%" height="500" frameborder="0" allowtransparency="true" seamless></iframe>
			</div>
			</article>
		</section>

	<?php get_sidebar(); ?>
	
<?php get_footer(); ?>
