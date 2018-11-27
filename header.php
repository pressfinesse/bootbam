<?php
/**
 * Template for the header
 *
 * Displays all of the head element, stopping at the main element.
 *
 * @package WordPress
 * @subpackage BootBam
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
        <!-- CDN Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<!-- Custom styles for this template -->
	<link href="<?php echo esc_url( home_url( '/' ) ); ?>/wp-content/themes/bootbam/css/theme.beta.css" rel="stylesheet">
</head>
<body><header>
<div class="blog-masthead">
	<div class="container">
		<?php if ( has_nav_menu( 'primary' ) ) :
		wp_nav_menu(array( 'menu' => 'primary', 'container' => 'nav', 'container_class' => 'nav', 'container_id' => '', 'menu_class' => 'menu', 'menu_id' => '',
		    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul>%3$s</ul>', 'item_spacing' => 'preserve',
		    'depth' => 0, 'walker' => new Main2(), 'theme_location' => 'primary' ));
		endif; ?>
	</div>
</div>

</header>
