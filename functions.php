<?php if ( ! function_exists( 'bootbam_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 *
 * Create your own bootbam_setup() function to override in a child theme.
 *
 * @since Boot Bam .091
 */
function bootbam_setup() {
	/*
	 * theme available for translation.
	 */
	load_theme_textdomain( 'bootbam' );

	// default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for custom logo.
	 *
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	/*
	 * support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 9999 );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'bootbam' ),
		'secondary' => __( 'Secondary Menu', 'bootbam' ),
//		'social' => __( 'Social Links Menu', 'bootbam' ),
		'footer'  => __( 'Footer Menu', 'bootbam' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'gallery',
	) );

	// Indicate widget sidebars can use selective refresh in the Customizer.
	add_theme_support( 'customize-selective-refresh-widgets' );
}
endif; // bootbam_setup
add_action( 'after_setup_theme', 'bootbam_setup' );

//Enable Bootstrap 4 compatible numbered pagination 
function bampage() {
global $wp_query;

	$big = 99999999;
	$paginate = paginate_links( array(
        'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format' => '?paged=%#%',
        'type' => 'list',
        'add_args'           => true,
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
        'current' => max( 1, get_query_var('paged') ),
        'total' => $wp_query->max_num_pages
) );

	if ( $paginate ) {
	    echo '<div class="pagination">';
	    echo $paginate;
	    echo '</div><!--// end .pagination -->';
	}

}
//add_action( 'bampage', 'bootbam_setup' );


// Custom Walker for the Bootstrap 4 menu
class Main2 extends Walker_Nav_Menu {

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        // Depth-dependent classes.
        $indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
        $display_depth = ( $depth + 1); // because it counts the first submenu as 0
        $classes = array(
            'dropdown-menu',
            ( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
            ( $display_depth >=2 ? 'sub-sub-menu' : '' ),
            'menu-depth-' . $display_depth
        );
        $class_names = implode( ' ', $classes );

        // Build HTML for output.
        $output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
    }

    /**
     * Start the element output.
     *
     * Adds main/sub-classes to the list items and links.
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item   Menu item data object.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     * @param int    $id     Current item ID.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        global $wp_query;
        $indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent
 
        // Depth-dependent classes.
        $depth_classes = array(
            ( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
            ( $depth >=2 ? 'sub-sub-menu-item' : '' ),
            ( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
            'menu-item-depth-' . $depth
        );
        $depth_class_names = esc_attr( implode( ' ', $depth_classes ) );
 
        // Passed classes.
        $classes = empty( $item->classes ) ? array() : (array) $item->classes;
        $class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );
        $class_names = str_replace( 'menu-item-has-children', 'menu-item-has-children dropdown', $class_names );

        // Build HTML.
        $output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';
 
        // Link attributes.
        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
        $attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
        $attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
	if ( $this->has_children ) {$attributes .= ' data-toggle="dropdown"';}

        // Build HTML output and pass through the proper filter.
        $item_output = sprintf( '%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s',
            $args->before,
            $attributes,
            $args->link_before,
            apply_filters( 'the_title', $item->title, $item->ID ),
            $args->link_after,
            $args->after
        );

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
    }

}

function bootbam_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main SideBar', 'bootbam' ),
		'id'            => 'mainbar',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'bootbam' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Block 1', 'bootbam' ),
		'id'            => 'bootblock-1',
		'description'   => __( 'First Home page Widget Enabled Block.', 'bootbam' ),
		'before_widget' => '<div id="%1$s" class="widget text-center %2$s card border-info">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="card-header text-white bg-dark">',
		'after_title'   => '</h2><div class="card-body">',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Block 2', 'bootbam' ),
		'id'            => 'bootblock-2',
		'description'   => __( 'Second Home page Widget Enabled Block.', 'bootbam' ),
		'before_widget' => '<div id="%1$s" class="widget text-center %2$s card border-info">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="card-header text-white bg-dark">',
		'after_title'   => '</h2><div class="card-body">',
	) );

	register_sidebar( array(
		'name'          => __( 'Content Block 3', 'bootbam' ),
		'id'            => 'bootblock-3',
		'description'   => __( 'Third Home page Widget Enabled Block.', 'bootbam' ),
		'before_widget' => '<div id="%1$s" class="widget text-center %2$s card">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="card-header text-white bg-dark">',
		'after_title'   => '</h2><div class="card-body">',
	) );


	register_sidebar( array(
		'name'          => __( 'Footer Block', 'bootbam' ),
		'id'            => 'footerblock',
		'description'   => __( 'The widget section in the left side of the footer.', 'bootbam' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s card">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h2 class="card-header">',
		'after_title'   => '</h2><div class="card-body">',
	) );


}
add_action( 'widgets_init', 'bootbam_widgets_init' );


/**
 * Clean up wp_head()
 *
 * Remove unnecessary <link>'s
 * Remove inline CSS used by Recent Comments widget
 * Remove inline CSS used by posts with galleries
 * Remove self-closing tag and change ''s to "'s on rel_canonical()
 */
function headclean() {
  // Originally from http://wpengineer.com/1438/wordpress-header/
  remove_action('wp_head', 'feed_links', 2);
  remove_action('wp_head', 'feed_links_extra', 3);
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');
  remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
  remove_action('wp_head', 'wp_generator');
  remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

  global $wp_widget_factory;
  remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

}
add_action( 'after_setup_theme', 'headclean' );

if ( ! function_exists( 'bootbam_entry_meta' ) ) :
function bootbam_entry_meta() {
	if ( 'post' === get_post_type() ) {
		$author_avatar_size = apply_filters( 'bootbam_author_avatar_size', 49 );
		printf( '<span class="byline"><span class="author vcard">%1$s<span class="screen-reader-text">%2$s </span> <a class="url fn n" href="%3$s">%4$s</a></span></span>',
			get_avatar( get_the_author_meta( 'user_email' ), $author_avatar_size ),
			_x( 'Author', 'Used before post author name.', 'bootbam' ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}

	if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
		bootbam_entry_date();
	}

	$format = get_post_format();
	if ( current_theme_supports( 'post-formats', $format ) ) {
		printf( '<span class="entry-format">%1$s<a href="%2$s">%3$s</a></span>',
			sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'bootbam' ) ),
			esc_url( get_post_format_link( $format ) ),
			get_post_format_string( $format )
		);
	}

	if ( 'post' === get_post_type() ) {
		bootbam_entry_taxonomies();
	}

	if ( ! is_singular() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link( sprintf( __( 'Leave a comment<span class="screen-reader-text"> on %s</span>', 'bootbam' ), get_the_title() ) );
		echo '</span>';
	}
}
endif;

if ( ! function_exists( 'bootbam_entry_date' ) ) :
function bootbam_entry_date() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		get_the_date(),
		esc_attr( get_the_modified_date( 'c' ) ),
		get_the_modified_date()
	);

	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s </span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'bootbam' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;

if ( ! function_exists( 'bootbam_entry_taxonomies' ) ) :
function bootbam_entry_taxonomies() {
	$categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'bootbam' ) );
	if ( $categories_list && bootbam_categorized_blog() ) {
		printf( '<span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Categories', 'Used before category names.', 'bootbam' ),
			$categories_list
		);
	}

	$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'bootbam' ) );
	if ( $tags_list ) {
		printf( '<span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span>',
			_x( 'Tags', 'Used before tag names.', 'bootbam' ),
			$tags_list
		);
	}
}
endif;

if ( ! function_exists( 'bootbam_post_thumbnail' ) ) :
function bootbam_post_thumbnail() {
	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
		return;
	}

	if ( is_singular() ) :
	?>

	<div class="post-thumbnail">
		<?php the_post_thumbnail(); ?>
	</div><!-- .post-thumbnail -->

	<?php else : ?>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
		<?php the_post_thumbnail( 'post-thumbnail', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
	</a>

	<?php endif;
}
endif;

if ( ! function_exists( 'bootbam_excerpt' ) ) :
	function bootbam_excerpt( $class = 'entry-summary' ) {
		$class = esc_attr( $class );

		if ( has_excerpt() || is_search() ) : ?>
			<div class="<?php echo $class; ?>">
				<?php the_excerpt(); ?>
			</div><!-- .<?php echo $class; ?> -->
		<?php endif;
	}
endif;

if ( ! function_exists( 'bootbam_excerpt_more' ) && ! is_admin() ) :
function bootbam_excerpt_more() {
	$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
		esc_url( get_permalink( get_the_ID() ) ),
		/* translators: %s: Name of current post */
		sprintf( __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'bootbam' ), get_the_title( get_the_ID() ) )
	);
	return ' &hellip; ' . $link;
}
add_filter( 'excerpt_more', 'bootbam_excerpt_more' );
endif;

if ( ! function_exists( 'bootbam_categorized_blog' ) ) :
function bootbam_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'bootbam_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'bootbam_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so bootbam_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so bootbam_categorized_blog should return false.
		return false;
	}
}
endif;

/**
 * Flushes out the transients used in bootbam_categorized_blog().
 *

 */
function bootbam_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'bootbam_categories' );
}
add_action( 'edit_category', 'bootbam_category_transient_flusher' );
add_action( 'save_post',     'bootbam_category_transient_flusher' );

if ( ! function_exists( 'bootbam_the_custom_logo' ) ) :
/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
function bootbam_the_custom_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}
endif;

