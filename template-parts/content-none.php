<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package WordPress
 * @subpackage BootBam
 */
?>

<section class="no-results not-found">
	<header class="alert alert-warning" id="page-header"><h1 class="display-4"><?php _e( 'Nothing Found', 'bootbam' ); ?></h1></header>
		<div class="page-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish? <a href="%1$s">Get Started</a>.', 'bootbam' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
		<?php elseif ( is_search() ) : ?>
			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'bootbam' ); ?></p>
		<?php endif; ?>
		</div>
</section>
