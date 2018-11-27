<?php
/**
 * Template part for displaying results in search pages
 *
 * @package WordPress
 * @subpackage BootBam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"><?php the_title( sprintf( '<h2 class="display-4"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?></header>

	<?php bootbam_post_thumbnail(); ?>
	<?php bootbam_excerpt(); ?>

	<?php if ( 'post' === get_post_type() ) : ?>

		<footer class="entry-footer">
			<?php //bootbam_entry_meta(); ?>
			<?php edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootbam' ),
					get_the_title()
				),
				'<span class="edit-link">','</span>');
			?>
		</footer>

	<?php else : ?>
		<?php edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootbam' ),
				get_the_title()
			),
			'<footer class="entry-footer"><span class="edit-link">','</span></footer>');
		?>
	<?php endif; ?>
</article><div class="h25"></div>
