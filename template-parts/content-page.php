<?php
/**
 * Template used for displaying page content
 *
 * @package WordPress
 * @subpackage BootBam
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header"><?php the_title( '<h1 class="display-4">', '</h1>' ); ?></header>

	<?php bootbam_post_thumbnail(); ?>

	<div class="entry-content">
		<?php the_content();
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bootbam' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'bootbam' ) . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
		) );
		?>
	</div>

	<?php edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'bootbam' ),
			get_the_title()
		),
		'<footer class="entry-footer"><span class="edit-link">','</span></footer>');
	?>

</article>
