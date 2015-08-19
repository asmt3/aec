<?php
/**
 * Registering meta boxes
 *
 * In this file, I'll show you how to extend the class to add more field type (in this case, the 'taxonomy' type)
 * All the definitions of meta boxes are listed below with comments, please read them carefully.
 * Note that each validation method of the Validation Class MUST return value instead of boolean as before
 *
 * You also should read the changelog to know what has been changed
 *
 * For more information, please visit: http://www.deluxeblogtips.com/2010/04/how-to-create-meta-box-wordpress-post.html
 *
 */

/********************* BEGIN DEFINITION OF META BOXES ***********************/

// prefix of meta keys, optional
// use underscore (_) at the beginning to make keys hidden, for example $prefix = '_rw_';
// you also can make prefix empty to disable it
$prefix = 'classy_';

$classy_meta_boxes = array();


// meta box ===> All Posts
$classy_meta_boxes[] = array(
	'id' => 'all_posts_meta',
	'title' => 'Post Layout',
	'pages' => array('post' , 'services'),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
	array(
		'name' => 'Full Width?',
		'id' => $prefix . 'posts_full_width',
		'type' => 'select', // select box
		'options' => array(
			'No' => 'No',
			'Yes' => 'Yes'
			),
			'multiple' => false,
			'std' => 'No',
			'desc' => ''
		),
	)
);


// meta box ===> Pages
$classy_meta_boxes[] = array(
	'id' => 'pages_meta',
	'title' => 'Page Options',
	'pages' => array('page' , 'services'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name' => 'Custom Excerpt',
			'desc' => 'Enter a custom excerpt for this page. Used only for search results.',
			'id' => $prefix . 'page_excerpt',
			'type' => 'textarea',
			'std' => ''
		),
	)
);

// meta box ===> Posts
$classy_meta_boxes[] = array(
	'id' => 'single_posts_meta',
	'title' => 'Post Options',
	'pages' => array('post'),
	'context' => 'side', // where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'low', // order of meta box: high (default), low; optional
	'fields' => array(
	array(
			'name' => 'Post Meta',
			'id' => $prefix . 'posts_meta',
			'type' => 'select', // select box
			'options' => array(
				'Show' => 'Show',
				'Hide' => 'Hide'
			),
			'multiple' => false,
			'std' => 'Show',
			'desc' => ''
		),
	array(
			'name' => 'Tags',
			'id' => $prefix . 'posts_tags',
			'type' => 'select', // select box
			'options' => array(
				'Show' => 'Show',
				'Hide' => 'Hide'
			),
			'multiple' => false,
			'std' => 'Show',
			'desc' => ''
	),
		array(
			'name' => 'Author Bio',
			'id' => $prefix . 'posts_author',
			'type' => 'select', // select box
			'options' => array(
				'Enable' => 'Enable',
				'Disable' => 'Disable'
			),
			'multiple' => false,
			'std' => 'Enable',
			'desc' => ''
		),
		array(
			'name' => 'Related Posts?',
			'id' => $prefix . 'posts_related',
			'type' => 'select', // select box
			'options' => array(
				'enable' => 'Enable',
				'disable' => 'Disable'
			),
			'multiple' => false,
			'std' => 'enable',
			'desc' => ''
		),
	)
);



// meta box ==> Homepage Highlights
$classy_meta_boxes[] = array(
	'id' => 'hp_highlights_meta', // meta box id, unique per meta box
	'title' => 'HP Highlight Options', // meta box title
	'pages' => array('hp_highlights'),	// post types, accept custom post types as well, default is array('post'); optional
	'context' => 'normal', // where the meta box appear: normal (default), advanced, side; optional
	'priority' => 'high', // order of meta box: high (default), low; optional

	'fields' => array( // list of meta fields
		array(
			'name' => 'URL', // field name
			'desc' => 'Enter a URL to link your homepage highlight to.', // field description, optional
			'id' => $prefix . 'hp_highlights_url', // field id, i.e. the meta key
			'type' => 'text', // text box
			'std' => '', // default value, optional
			'validate_func' => '' // validate function, created below, inside RW_Meta_Box_Validate class
		),
	)
);

// meta box ===> Slides
$classy_meta_boxes[] = array(
	'id' => 'slides_meta',
	'title' => 'Slider Options',
	'pages' => array('slides'),

	'fields' => array(
		array(
            'name' => 'Image Slide URL',
            'desc' => 'Enter a URL to link this slide to - perfect for linking slides to pages or other sites or other pages on your own site.',
            'id' => $prefix . 'slides_url',
            'type' => 'text',
            'std' => ''
        ),
		array(
			'name' => 'Add Padding Around Slide Content?',
			'id' => $prefix . 'slides_padding',
			'type' => 'select',
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			'multiple' => false,
			'desc' => 'Select yes to add a padding around your slider. Great for text/shortcodes/floated image slides.'
		),
	)
);


// meta box ==> Services
$classy_meta_boxes[] = array(
	'id' => 'services_meta',
	'title' => 'Service Item Options',
	'pages' => array('services'),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name' => 'Description',
			'desc' => 'Enter a description for this item to show instead of the default excerpt',
			'id' => $prefix . 'services_description',
			'type' => 'textarea',
			'std' => ''
		),
		array(
			'name' => 'Icon',
			'desc' => 'Choose an icon for this service post. Click the button, upload or find an image, then click "Insert To Post". Icons will be scaled to 25x25 pixels.',
			'id' => $prefix . 'services_icon',
			'type' => 'single_image',
			'std' => ''
		),
	)
);


// meta box ==> Staff
$classy_meta_boxes[] = array(
	'id' => 'staff_meta',
	'title' => 'Staff Member Options',
	'pages' => array('staff'),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
            'name' => 'Position',
			'desc' => '',
            'id' => $prefix . 'staff_position',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Qualification',
			'desc' => '',
            'id' => $prefix . 'staff_qualification',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Phone',
			'desc' => '',
            'id' => $prefix . 'staff_phone',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Email',
			'desc' => '',
            'id' => $prefix . 'staff_email',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Blog',
			'desc' => '',
            'id' => $prefix . 'staff_blog',
            'type' => 'text',
            'std' => ''
        ),
		array(
            'name' => 'Twitter URL',
			'desc' => '',
            'id' => $prefix . 'staff_twitter',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Facebook Page',
			'desc' => '',
            'id' => $prefix . 'staff_facebook',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Google Plus URL',
			'desc' => '',
            'id' => $prefix . 'staff_googleplus',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Skype Plus URL',
			'desc' => '',
            'id' => $prefix . 'staff_skype',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'LinkedIn URL',
			'desc' => '',
            'id' => $prefix . 'staff_linkedin',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Dribbble Profile URL',
			'desc' => '',
            'id' => $prefix . 'staff_dribbble',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Forrst URL',
			'desc' => '',
            'id' => $prefix . 'staff_forrst',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'Vimeo URL',
			'desc' => '',
            'id' => $prefix . 'staff_vimeo',
            'type' => 'text',
            'std' => ''
        ),
	)
);


// meta box ==> Testimonials
$classy_meta_boxes[] = array(
	'id' => 'testimonials_meta',
	'title' => 'Testimonial Options',
	'pages' => array('testimonials'),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
            'name' => 'Testimonial Written By',
            'desc' => 'Enter the name of the person/business who wrote the testimonial',
            'id' => $prefix . 'testimonial_by',
            'type' => 'text',
            'std' => ''
        ),
	)
);

// meta box ==> Portfolio Main
$classy_meta_boxes[] = array(
	'id' => 'portfolio_meta',
	'title' => 'Main Options',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
            'name' => 'Description',
            'desc' => 'Enter a short description for your portfolio post. Used on the main portfolio page only.',
            'id' => $prefix . 'portfolio_description',
            'type' => 'textarea',
            'std' => ''
        ),
		array(
            'name' => 'URL',
            'desc' => 'Enter a url to create a link to the project',
            'id' => $prefix . 'portfolio_url',
            'type' => 'text',
            'std' => ''
        ),
	array(
            'name' => 'URL Text',
            'desc' => 'Enter a custom text for your URL. Default is "View Project"',
            'id' => $prefix . 'portfolio_url_text',
            'type' => 'text',
            'std' => ''
        ),
	)
);


// meta box ==> Portfolio Slider
$classy_meta_boxes[] = array(
	'id' => 'portfolio_meta_slider',
	'title' => 'Slider Options',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
            'name' => 'Additional Image 1',
            'desc' => 'Select an additional image for your single portfolio slider. Choose an image, make sure to select the "full size" image and hit "insert to post".',
            'id' => $prefix . 'portfolio_slider_1',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 2',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_2',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 3',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_3',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 4',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_4',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 5',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_5',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 6',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_6',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 7',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_7',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 8',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_8',
            'type' => 'single_image',
            'std' => ''
        ),
		array(
            'name' => 'Additional Image 9',
            'desc' => '',
            'id' => $prefix . 'portfolio_slider_9',
            'type' => 'single_image',
            'std' => ''
        ),
	)
);

// meta box ==> Portfolio Video
$classy_meta_boxes[] = array(
	'id' => 'portfolio_meta_video',
	'title' => 'Video Options',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
			array(
				'name' => 'Embedded Video Option',
				'desc' => 'Enter your embedd code if you wish to show a video INSTEAD of the image gallery. Max width of 530px',
				'id' => $prefix . 'portfolio_video_embed',
				'type' => 'textarea',
				'std' => ''
			),
		)
);

// meta box ==> Portfolio Extra
$classy_meta_boxes[] = array(
	'id' => 'portfolio_meta_extra',
	'title' => 'Extra Content',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
			array(
				'name' => 'Extra Content Below Your Image/Video/Slider - HTML Allowed',
				'id' => $prefix . 'portfolio_below_right',
				'type' => 'textarea',
				'std' => '',
				'desc' => 'You can use this field to add extra content below your single porfolio image slider, image or video.'
			),
		)
);

// meta box ==> Testimonials
$classy_meta_boxes[] = array(
	'id' => 'pricing_meta',
	'title' => 'Pricing Table Options',
	'pages' => array('pricing_tables'),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name' => 'Featured?',
			'id' => $prefix . 'pricing_tables_featured',
			'type' => 'select',
			'options' => array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			'multiple' => false,
			'std' => 'no',
			'desc' => 'Is this a featured pricing table?'
		),
		array(
				'name' => 'Price',
				'desc' => 'Enter a price for this pricing table',
				'id' => $prefix . 'pricing_tables_price',
				"type" => "text",
				"std" => ""
			),
		array(
				'name' => 'Monetary Symbol',
				'desc' => 'Enter your monetary symbol. Example: $',
				'id' => $prefix . 'pricing_tables_money_symbol',
				"type" => "text",
				"std" => ""
			),
		array(
				'name' => 'Rate',
				'desc' => 'Enter a rate for this pricing table. Example: (/month) or (per day)',
				'id' => $prefix . 'pricing_tables_rate',
				"type" => "text",
				"std" => ""
			),
		array(
				'name' => 'Signup/Buy URL',
				'desc' => 'Enter your sign up or buy now URL',
				'id' => $prefix . 'pricing_tables_url',
				"type" => "text",
				"std" => ""
			),
		array(
				'name' => 'Signup/Buy Text',
				'desc' => 'Enter your sign up or buy now text',
				'id' => $prefix . 'pricing_tables_btn_text',
				"type" => "text",
				"std" => ""
			),
	)
);

foreach ($classy_meta_boxes as $meta_box) {
	new classy_meta_box($meta_box);
}

/********************* END DEFINITION OF META BOXES ***********************/
?>