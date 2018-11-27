<?php
/**
 * Template part for displaying single posts
 *
 * @package WordPress
 * @subpackage BootBam
 */
?>

<div class="blog-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="blog-post-title"><?php the_title( '<h1 class="display-4">', '</h1>' ); ?></div>

	<?php the_date('Y-m-d', '<p>posted... ', '</p>'); ?>
	<?php bootbam_excerpt(); ?>
	<?php bootbam_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content(); ?>
	</div>

	<div class="entry-footer">
		<?php //bootbam_entry_meta(); ?>
		<?php edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootbam' ),
				get_the_title()
			),
			'<span class="edit-link">','</span>');
		?>
	</div>

	</article>
</div>
