<?php

// Images
add_image_size( 'home-services',  210, 150, true ); // Single Home Services Thumbnail
add_image_size( 'page-header',  980, 280, true ); // Single Home Services Thumbnail


// Additional CSS
add_action('wp_enqueue_scripts', 'PMC_css');
function PMC_css(){
	wp_register_style('style-PMC', get_bloginfo('stylesheet_directory') . '/style-PMC.css');
	wp_enqueue_style( 'style-PMC');
}

