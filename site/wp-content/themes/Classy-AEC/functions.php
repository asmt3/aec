<?php
// Get theme options and set defaults
$options = get_option( 'classy_theme_settings' );
// Get slider type and set slides as default
if($options['slider_type'] !='') {
	$slider_type = $options['slider_type'];
	} else {
		$slider_type = 'nivo';
}
// Set default portfolio columns ---> Note if you change your columns in the admin panel make sure to regenerate your thumgnails.
if($options['portfolio_columns'] !='') {
	$portfolio_columns = $options['portfolio_columns']; 
	} else {
		$portfolio_columns = '4';
}

// Set max content width
if ( ! isset( $content_width ) ) $content_width = 930;

// Remove junk from head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);

// Main includes
require('admin/theme-admin.php');
require('functions/pagination.php');
require('functions/better-excerpts.php');
require('functions/custom-editor-columns.php');
require('functions/shortcodes.php');

// Meta includes
require('functions/meta/meta-box-class.php');
require('functions/meta/meta-box-usage.php');

// Include custom widgets
require('functions/widgets/widget-author.php');
require('functions/widgets/widget-flickr.php');
require('functions/widgets/widget-social.php');
require('functions/widgets/widget-recent-posts.php');
require('functions/widgets/widget-recent-portfolio.php');

// ProjectMcColl
require('functions-PMC.php');

// Get scripts
add_action('wp_enqueue_scripts','my_theme_scripts_function');

function my_theme_scripts_function() {
	global $options;
	global $slider_type;
	
	// Use google js
	wp_deregister_script('jquery'); 
		wp_register_script('jquery', ("http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"), false, '1.6.2'); 
	wp_enqueue_script('jquery');
   
	// Site wide js
	wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js');
	
	//include comment reply js
	if ( is_single() || is_page() ) wp_enqueue_script( 'comment-reply' ); 
	
	// Single portfolio posts js
	if(('portfolio' == get_post_type()) ) :
		wp_enqueue_script('portfolio', get_template_directory_uri() . '/js/portfolio.js');
		wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
		wp_enqueue_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js');
		wp_enqueue_script('elegantcarousel', get_template_directory_uri() . '/js/jquery.elegantcarousel.min.js');
	endif;
	
	// Homepage js
	if(is_front_page()) :	
		
		wp_enqueue_script('easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js');
		
		if ($options['disable_home_portfolio'] != 'disable') {
			wp_enqueue_script('elegantcarousel', get_template_directory_uri() . '/js/jquery.elegantcarousel.min.js');
		}
		
		if ($options['disable_home_slider'] != 'disable') { 
		
			if($slider_type == 'content') {
				wp_enqueue_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js');
			}
			if($slider_type == 'nivo') {
				wp_enqueue_script('nivo', get_template_directory_uri() . '/js/jquery.nivo.slider.js');
			}
		
		}
		
	endif;
}

// Limit Post Word Count
function new_excerpt_length($length) {
	return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');

// Replace Excerpt Link
function new_excerpt_more($more) {
       global $post;
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Activate post-image functionality (WP 2.9+)
if ( function_exists( 'add_theme_support' ) )
add_theme_support( 'post-thumbnails' );

// Featured images
if ( function_exists( 'add_image_size' ) ) {

// Set default image size
add_image_size( 'full-size',  9999, 9999, false ); //Full resolution
add_image_size( 'blog',  140, 140, true ); //blog
add_image_size( 'small-thumbnail',  50, 50, true ); //Small thumbs
add_image_size( 'nivo-slider',  980, 280, true ); //Slider image
add_image_size( 'page-header',  980, 280, true ); //Page header image
add_image_size( 'staff',  110, 110, true );//staff thumbnail
add_image_size( 'single-staff',  290, 310, true );//staff main
add_image_size( 'portfolio',  200, 140, true ); // Default Portfolio Image
add_image_size( 'portfolio-three',  280, 220, true ); //Portfolio 3 Column Images
add_image_size( 'portfolio-two',  440, 380, true ); //Portfolio 2 Column Images
add_image_size( 'single-portfolio',  530, 9999, false ); // Single Portfolio Image
}

// Enable Custom Background
add_custom_background();

// Register navigation menus
register_nav_menus(
	array(
	'main nav'=>__('Main Nav'),
	)
);

// Menu fallback
function default_menu() {
	require_once (TEMPLATEPATH . '/includes/default-menu.php');
}

// Define Post Types
add_action( 'init', 'create_post_types' );
function create_post_types() {
		
// Define Post Type For Homepage Highlights
register_post_type( 'hp_highlights',
	array(
		'labels' => array(
		'name' => _x( 'HP Highlights', 'post type general name', 'classy' ),
		'singular_name' => _x( 'HP Highlight', 'post type singular name', 'classy' ),
		'add_new' => _x( 'Add New', 'HP Highlight', 'classy' ),
		'add_new_item' => __( 'Add New HP Highlight', 'classy' ),
		'edit_item' => __( 'Edit HP Highlight', 'classy' ),
		'new_item' => __( 'New HP Highlight', 'classy' ),
		'view_item' => __( 'View HP Highlight', 'classy' ),
		'search_items' => __( 'Search HP Highlights', 'classy' ),
		'not_found' =>  __( 'No HP Highlights found', 'classy' ),
		'not_found_in_trash' => __( 'No HP Highlights found in Trash', 'classy' ),
		'parent_item_colon' => ''
	),
		  'public' => true,
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'supports' => array('title','editor'),
    )
);
// Define Post Type For Slides
register_post_type( 'slides',
		array(
		  'labels' => array(
			'name' => _x( 'Slides', 'post type general name', 'classy' ),
			'singular_name' => _x( 'Slide', 'post type singular name', 'classy' ),
			'add_new' => _x( 'Add New', 'Slide', 'classy' ),
			'add_new_item' => __( 'Add New Slide', 'classy' ),
			'edit_item' => __( 'Edit Slide', 'classy' ),
			'new_item' => __( 'New Slide', 'classy' ),
			'view_item' => __( 'View Slide', 'classy' ),
			'search_items' => __( 'Search Slides', 'classy' ),
			'not_found' =>  __( 'No Slides found', 'classy' ),
			'not_found_in_trash' => __( 'No Slides found in Trash', 'classy' ),
			'parent_item_colon' => ''
		  ),
		  'public' => true,
		  'show_in_nav_menus' => false,
		  'exclude_from_search' => true,
		  'supports' => array('title','editor','thumbnail'),
		)
);
// Services Post Type
register_post_type( 'services',
    array(
      'labels' => array(
        'name' => _x( 'Service', 'post type general name', 'classy' ),
        'singular_name' => _x( 'Service', 'post type singular name', 'classy' ),		
		'add_new' => _x( 'Add New', 'Service', 'classy' ),
		'add_new_item' => __( 'Add New Service', 'classy' ),
		'edit_item' => __( 'Edit Service', 'classy' ),
		'new_item' => __( 'New Service', 'classy' ),
		'view_item' => __( 'View Service', 'classy' ),
		'search_items' => __( 'Search Services', 'classy' ),
		'not_found' =>  __( 'No Services found', 'classy' ),
		'not_found_in_trash' => __( 'No Services found in Trash', 'classy' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail'),
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'services' ),
    )
  );
register_post_type( 'staff',
    array(
      'labels' => array(
        'name' => _x( 'Staff', 'post type general name', 'classy' ),
        'singular_name' => _x( 'Staff', 'post type singular name', 'classy' ),		
		'add_new' => _x( 'Add New', 'Staff Member', 'classy' ),
		'add_new_item' => __( 'Add New Staff Member', 'classy' ),
		'edit_item' => __( 'Edit Staff Member', 'classy' ),
		'new_item' => __( 'New Staff Member', 'classy' ),
		'view_item' => __( 'View Staff Member', 'classy' ),
		'search_items' => __( 'Search Staff Members', 'classy' ),
		'not_found' =>  __( 'No Staff Member found', 'classy' ),
		'not_found_in_trash' => __( 'No Staff Member found in Trash', 'classy' ),
		'parent_item_colon' => ''
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail','comments'),
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'staff' ),
    )
  );
// Testimonials Post Type
register_post_type( 'testimonials',
    array(
      'labels' => array(
        'name' => _x( 'Testimonials', 'post type general name', 'classy' ),
        'singular_name' => _x( 'Testimonials', 'post type singular name', 'classy' ),		
		'add_new' => _x( 'Add New', 'Testimonials', 'classy' ),
		'add_new_item' => __( 'Add New Testimonials', 'classy' ),
		'edit_item' => __( 'Edit Testimonials', 'classy' ),
		'new_item' => __( 'New Testimonials', 'classy' ),
		'view_item' => __( 'View Testimonials', 'classy' ),
		'search_items' => __( 'Search Testimonials', 'classy' ),
		'not_found' =>  __( 'No Testimonials found', 'classy' ),
		'not_found_in_trash' => __( 'No Testimonials found in Trash', 'classy' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail'),
	  'query_var' => true,
	  'show_in_nav_menus' => false,
	  'exclude_from_search' => true,
	  'rewrite' => array( 'slug' => 'testimonials' ),
    )
  );
// Portfolio Post Type
register_post_type( 'portfolio',
    array(
      'labels' => array(
        'name' => _x( 'Portfolio', 'post type general name', 'classy' ),
        'singular_name' => _x( 'Portfolio', 'post type singular name', 'classy' ),		
		'add_new' => _x( 'Add New', 'Portfolio Project', 'classy' ),
		'add_new_item' => __( 'Add New Portfolio Project', 'classy' ),
		'edit_item' => __( 'Edit Portfolio Project', 'classy' ),
		'new_item' => __( 'New Portfolio Project', 'classy' ),
		'view_item' => __( 'View Portfolio Project', 'classy' ),
		'search_items' => __( 'Search Portfolio Projects', 'classy' ),
		'not_found' =>  __( 'No Portfolio Projects found', 'classy' ),
		'not_found_in_trash' => __( 'No Portfolio Projects found in Trash', 'classy' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor','thumbnail' ),
	  'query_var' => true,
	  'rewrite' => array( 'slug' => 'portfolio' ),
    )
  );
// Pricing Tables Post Type
register_post_type( 'pricing_tables',
    array(
      'labels' => array(
        'name' => _x( 'Pricing Column', 'post type general name', 'classy' ),
        'singular_name' => _x( 'Pricing Column', 'post type singular name', 'classy' ),		
		'add_new' => _x( 'Add New', 'Pricing Column', 'classy' ),
		'add_new_item' => __( 'Add New Pricing Column', 'classy' ),
		'edit_item' => __( 'Edit Pricing Column', 'classy' ),
		'new_item' => __( 'New Pricing Column', 'classy' ),
		'view_item' => __( 'View Pricing Column', 'classy' ),
		'search_items' => __( 'Search Pricing Columns', 'classy' ),
		'not_found' =>  __( 'No Pricing Columns', 'classy' ),
		'not_found_in_trash' => __( 'No Pricing Columns found in Trash', 'classy' ),
		'parent_item_colon' => ''
		
      ),
      'public' => true,
	  'supports' => array('title','editor' ),
	  'query_var' => true,
	  'show_in_nav_menus' => false,
	  'exclude_from_search' => true,
	  'rewrite' => array( 'slug' => 'pricing-column' ),
    )
  );
}

// Add taxonomies
add_action( 'init', 'create_taxonomies' );

//create taxonomies
function create_taxonomies() {
	
// portfolio taxonomies
	$cat_labels = array(
		'name' => __( 'Portfolio Categories', 'classy' ),
		'singular_name' => __( 'Portfolio Category', 'classy' ),
		'search_items' =>  __( 'Search Portfolio Categories', 'classy' ),
		'all_items' => __( 'All Portfolio Categories', 'classy' ),
		'parent_item' => __( 'Parent Portfolio Category', 'classy' ),
		'parent_item_colon' => __( 'Parent Portfolio Category:', 'classy' ),
		'edit_item' => __( 'Edit Portfolio Category', 'classy' ),
		'update_item' => __( 'Update Portfolio Category', 'classy' ),
		'add_new_item' => __( 'Add New Portfolio Category', 'classy' ),
		'new_item_name' => __( 'New Portfolio Category Name', 'classy' ),
		'choose_from_most_used'	=> __( 'Choose from the most used portfolio categories', 'classy' )
	); 	

	register_taxonomy('portfolio_cats','portfolio',array(
		'hierarchical' => true,
		'labels' => $cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio-category' ),
	));
	
	
	// staff taxonomies
	$staff_cat_labels = array(
		'name' => __( 'Staff Departments', 'classy' ),
		'singular_name' => __( 'Staff Department', 'classy' ),
		'search_items' =>  __( 'Search Staff Departments', 'classy' ),
		'all_items' => __( 'All Staff Departments', 'classy' ),
		'parent_item' => __( 'Parent Staff Department', 'classy' ),
		'parent_item_colon' => __( 'Parent Staff Department:', 'classy' ),
		'edit_item' => __( 'Edit Staff Department', 'classy' ),
		'update_item' => __( 'Update Staff Department', 'classy' ),
		'add_new_item' => __( 'Add New Staff Department', 'classy' ),
		'new_item_name' => __( 'New Department Staff Name', 'classy' ),
		'choose_from_most_used'	=> __( 'Choose from the most used staff departments', 'classy' )
	); 	

	register_taxonomy('staff_departments','staff',array(
		'hierarchical' => true,
		'labels' => $staff_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'department' ),
	));
	
	// service taxonomies
	$service_cat_labels = array(
		'name' => __( 'Service Categories', 'classy' ),
		'singular_name' => __( 'Service Category', 'classy' ),
		'search_items' =>  __( 'Search Service Categories', 'classy' ),
		'all_items' => __( 'All Service Categories', 'classy' ),
		'parent_item' => __( 'Parent Service Category', 'classy' ),
		'parent_item_colon' => __( 'Parent Service Category:', 'classy' ),
		'edit_item' => __( 'Edit Service Category', 'classy' ),
		'update_item' => __( 'Update Service Category', 'classy' ),
		'add_new_item' => __( 'Add New Service Category', 'classy' ),
		'new_item_name' => __( 'New Service Category Name', 'classy' ),
		'choose_from_most_used'	=> __( 'Choose from the most used service categories', 'classy' )
	); 	

	register_taxonomy('service_cats','services',array(
		'hierarchical' => true,
		'labels' => $service_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'our-services' ),
	));
	
	//Pricing Table Taxonomies
	$pricing_tables_cat_labels = array(
		'name' => __( 'Pricing Tables' ),
		'singular_name' => __( 'Pricing Table', 'classy' ),
		'search_items' =>  __( 'Search Pricing Tables', 'classy' ),
		'all_items' => __( 'All Pricing Tables', 'classy' ),
		'parent_item' => __( 'Parent Pricing Table', 'classy' ),
		'parent_item_colon' => __( 'Parent Pricing Table:', 'classy' ),
		'edit_item' => __( 'Edit Pricing Table', 'classy' ),
		'update_item' => __( 'Update Pricing Table', 'classy' ),
		'add_new_item' => __( 'Add New Pricing Table', 'classy' ),
		'new_item_name' => __( 'New Pricing Table Name', 'classy' ),
		'choose_from_most_used'	=> __( 'Choose from the most used Pricing Tables', 'classy' )
	); 	

	register_taxonomy('pricing_tables_cats','pricing_tables',array(
		'show_in_nav_menus' => false,
		'hierarchical' => true,
		'labels' => $pricing_tables_cat_labels,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'pricing-tables' ),
));
}


// Set number of posts per page for taxonomy pages
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
	global $options;
	
	// Get theme panel admin
	if($options['portfolio_post_count']) {
		$portfolio_posts_per_page = $options['portfolio_post_count'];
		} else {
			$portfolio_posts_per_page = '-1';
			}
	
    if ( is_tax( 'portfolio_cats') ) {
        return $portfolio_posts_per_page;
    }
	elseif( is_tax( 'staff_departments') ) {
		return '-1';
	}
	elseif( is_tax( 'service_cats') ) {
		return '-1';
	}
	else {
        return $option_posts_per_page;
    }
}

//Register Sidebars
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Sidebar - Blog',
		'id' => 'sidebar_blog',
		'description' => 'Widgets in this area will be shown in the sidebar on the blog and regular posts.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Sidebar - Pages',
		'id' => 'sidebar_pages',
		'description' => 'Widgets in this area will be shown in the sidebar on pages.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'First Footer Area',
		'description' => 'Widgets in this area will be shown in the footer - left side.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Second Footer Area',
		'description' => 'Widgets in this area will be shown in the footer - middle left.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Third Footer Area',
		'description' => 'Widgets in this area will be shown in the footer - middle right.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	register_sidebar(array(
		'name' => 'Fourth Footer Area',
		'description' => 'Widgets in this area will be shown in the footer - right side.',
		'before_widget' => '<div id="%1$s" class="widget-container %2$s clearfix">',
		'after_widget' => '</div>',
		'before_title' => '<h4>',
		'after_title' => '</h4>',
	));
	
// Localization Support
load_theme_textdomain( 'classy', TEMPLATEPATH.'/lang' );

//get image id
// retrieves the attachment ID from the file URL
function classy_get_image_id($image_url) {
	global $wpdb;
	$prefix = $wpdb->prefix;
	$attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $prefix . "posts" . " WHERE guid='" . $image_url . "';"));
	return $attachment[0];
}

// Functions run on activation --> important flush to clear rewrites
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	$wp_rewrite->flush_rules();
}
?>