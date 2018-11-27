<?php
/**
 * Template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage BootBam
 */

get_header(); ?>

<main id="main" role="main" class="site-main container">
	<div class="row">
	        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 blog-main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'template-parts/content', 'single' );

			if ( is_singular( 'attachment' ) ) {
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'bootbam' ),
				) );
			}

			if ( comments_open() || get_comments_number() ) {comments_template();}

			/*elseif ( is_singular( 'post' ) ) {
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'bootbam' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'bootbam' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'bootbam' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'bootbam' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}*/

		endwhile; ?>
                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 main-sidebar">
			<?php get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
