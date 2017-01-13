<?php
/*
 * 
 * TEMPLATE FOR POSTS?
 *
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php ?>	
	<a class="entry-anchor" href="<?php echo esc_url(get_permalink()); ?>">
	<?php if (has_post_thumbnail()) : ?>
			<img class="entry-thumbnail" src="<?php the_post_thumbnail_url() ?>">
	<?php else: ?>
		<img class="entry-thumbnail" src="<?php echo get_template_directory_uri().'/images/'.get_theme_mod('uka_post_ratio').'.png' ?>">
	<?php endif; ?>
	</a>

	<header class="entry-header">
		<?php the_title(sprintf('<a href="%s" rel="bookmark"><span class="entry-title">', esc_url(get_permalink())), '</span></a>'); ?>
		<?php if (has_excerpt()) : ?>
			<a href="<?php echo esc_url(get_permalink()); ?>"><span class="entry-excerpt"><?php echo get_the_excerpt(); ?></span></a>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content"></div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php
			edit_post_link(
				__( 'Edit', 'uka' ),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
<!--/div-->
</article>
<!-- content.php -->













