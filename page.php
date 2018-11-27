<?php
/**
 * Template for displaying pages
 *
 *
 * @package WordPress
 * @subpackage BootBam
 */

get_header(); ?>

<main id="main" role="main" class="site-main container">
        <div class="row">
                <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 blog-main">
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', 'page' );
				if ( comments_open() || get_comments_number() ) { comments_template(); }
			endwhile; ?>
		</div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 main-sidebar">
                                <?php get_sidebar(); ?>
                </div>
        </div>
</main>

<?php get_footer(); ?>
