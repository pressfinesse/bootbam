<?php
/**
 * Template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage BootBam
 */

get_header(); ?>

<main id="main" role="main" class="site-main container">
	<div class="row">
	        <div class="col-sm-12 col-md-8 col-lg-8 col-xl-8 blog-main">
		<?php if ( have_posts() ) : ?>
			<?php while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/content', get_post_format() );
			endwhile; ?>

		<?php if ( function_exists('bampage') ) { bampage(); } ?>

		<?php else : get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

                </div>

                <div class="col-sm-12 col-md-4 col-lg-4 col-xl-4 main-sidebar">
			<?php get_sidebar(); ?>
                </div>
        </div>
</main>

<?php get_footer(); ?>
