<?php
/* custom staff columns */
add_filter("manage_edit-staff_columns", "edit_staff_columns" );
add_action("manage_posts_custom_column", "custom_staff_columns");

function edit_staff_columns($staff_columns)
{
        $staff_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Staff Member",
                "staff_image" => "Profile Image",
				"staff_department" => "Department",
				"staff_position" => "Position",
				"staff_phone" => "Phone",
				"staff_email" => "Email"
        );
        return $staff_columns;
}

function custom_staff_columns($staff_column)
{
        global $post;
        switch ($staff_column)
        {
                case "staff_image":
						if(the_post_thumbnail( 'small-thumbnail' ) !='') {
                        	the_post_thumbnail( 'small-thumbnail' );
						}
                        break;
						
				case "staff_department":
					echo get_the_term_list( get_the_ID(), 'staff_departments', ' ', ' , ', ' ');
				break;
				
				case "staff_position":
					if(get_post_meta($post->ID, 'classy_staff_position', true) !='') {
						echo get_post_meta($post->ID, 'classy_staff_position', true);
					}
				break;
				case "staff_phone":
					if(get_post_meta($post->ID, 'classy_staff_phone', true) !='') {
						echo get_post_meta($post->ID, 'classy_staff_phone', true);
					}
				break;
				case "staff_email":
					if(get_post_meta($post->ID, 'classy_staff_email', true) !='') {
						echo get_post_meta($post->ID, 'classy_staff_email', true);
					}
				break;
        }

}


/* custom testimonials columns */
add_filter("manage_edit-testimonials_columns", "edit_testimonials_columns" );
add_action("manage_posts_custom_column", "custom_testimonials_columns");

function edit_testimonials_columns($testimonials_columns)
{
        $testimonials_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Testimonial",
				"testimonial_by" => "By",
                "testimonial_image" => "Featured Image",
        );
        return $testimonials_columns;
}

function custom_testimonials_columns($testimonials_column)
{
        global $post;
        switch ($testimonials_column)
        {
			 case "testimonial_by":
			 if(get_post_meta($post->ID, 'classy_testimonial_by', true) !='') {
						echo get_post_meta($post->ID, 'classy_testimonial_by', true);
					}
			 break;
                case "testimonial_image":
						if(the_post_thumbnail( 'small-thumbnail' ) !='') {
                        	the_post_thumbnail( 'small-thumbnail' );
						}
                        break;
        }

}



/* custom slides columns */
add_filter("manage_edit-slides_columns", "edit_slides_columns" );
add_action("manage_posts_custom_column", "custom_slides_columns");

function edit_slides_columns($slides_columns)
{
        $slides_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Slide",
                "slides_image" => "Featured Image",
				"slides_url" => "Slide URL"
        );
        return $slides_columns;
}

function custom_slides_columns($slides_column)
{
        global $post;
        switch ($slides_column)
        {
                case "slides_image":
						if(the_post_thumbnail( 'small-thumbnail' ) !='') {
                        	the_post_thumbnail( 'small-thumbnail' );
						}
                        break;
				case "slides_url":
					if(get_post_meta($post->ID, 'classy_slides_url', true) !='') {
						echo get_post_meta($post->ID, 'classy_slides_url', true);
					}
				break;
        }

}


/* custom services columns */
add_filter("manage_edit-services_columns", "edit_services_columns" );
add_action("manage_posts_custom_column", "custom_services_columns");

function edit_services_columns($services_columns)
{
        $services_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Service",
				"services_icon" => "Service Icon (25x25)",
                "services_image" => "Featured Image",
				"services_description" => "Description"
        );
        return $services_columns;
}

function custom_services_columns($service_column)
{
        global $post;
        switch ($service_column)
        {
				case "services_icon":
						if(get_post_meta($post->ID, 'classy_services_icon', true) !='') {
							echo '<img src="'.get_post_meta($post->ID, 'classy_services_icon', true).'" />';
						}
                        break;
                case "services_image":
						if(the_post_thumbnail( 'small-thumbnail' ) !='') {
                        	the_post_thumbnail( 'small-thumbnail' );
						}
                        break;
				case "services_description":
					if(get_post_meta($post->ID, 'classy_services_description', true) !='') {
						echo get_post_meta($post->ID, 'classy_services_description', true);
					}
				break;
        }

}


/* custom portfolio columns */
add_filter("manage_edit-portfolio_columns", "edit_portfolio_columns" );
add_action("manage_posts_custom_column", "custom_portfolio_columns");

function edit_portfolio_columns($portfolio_columns)
{
        $portfolio_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Portfolio Item",
				"portfolio_category" => "Category",
                "portfolio_image" => "Featured Image",
				"portfolio_description" => "Description"
        );
        return $portfolio_columns;
}

function custom_portfolio_columns($portfolio_column)
{
        global $post;
        switch ($portfolio_column)
        {
				case "portfolio_category":
					echo get_the_term_list( get_the_ID(), 'portfolio_cats', ' ', ' , ', ' ');
				break;
                case "portfolio_image":
						if(the_post_thumbnail( 'small-thumbnail' ) !='') {
                        	the_post_thumbnail( 'small-thumbnail' );
						}
                        break;
				case "portfolio_description":
					if(get_post_meta($post->ID, 'classy_portfolio_description', true) !='') {
						echo get_post_meta($post->ID, 'classy_portfolio_description', true);
					}
				break;
        }

}


/* custom pricing tables columns */
add_filter("manage_edit-pricing_tables_columns", "edit_pricing_tables_columns" );
add_action("manage_posts_custom_column", "custom_pricing_tables_columns");

function edit_pricing_tables_columns($pricing_tables_columns)
{
        $pricing_tables_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Pricing Column",
				"pricing_tables_price" => "Cost",
				"pricing_tables_featured" => "Featured?",
				"pricing_tables_table" => "Pricing Table"
        );
        return $pricing_tables_columns;
}

function custom_pricing_tables_columns($pricing_tables_column)
{
        global $post;
        switch ($pricing_tables_column)
        {
				case "pricing_tables_price":
					if(get_post_meta($post->ID, 'classy_pricing_tables_money_symbol', true) !='') {
							echo get_post_meta($post->ID, 'classy_pricing_tables_money_symbol', true);
						}
					if(get_post_meta($post->ID, 'classy_pricing_tables_price', true) !='') {
						echo get_post_meta($post->ID, 'classy_pricing_tables_price', true);
					}
					if(get_post_meta($post->ID, 'classy_pricing_tables_rate', true) !='') {
						echo get_post_meta($post->ID, 'pricing_tables_rate', true);
					}
				break;
				case "pricing_tables_featured":
					if(get_post_meta($post->ID, 'classy_pricing_tables_featured', true) !='') {
						echo get_post_meta($post->ID, 'classy_pricing_tables_featured', true);
					}
				break;
				break;
				case "pricing_tables_table":
				echo get_the_term_list( get_the_ID(), 'pricing_tables_cats', ' ', ' , ', ' ');
        }

}

/* HP Highlights */
add_filter("manage_edit-hp_highlights_columns", "edit_hp_highlights_columns" );
add_action("manage_posts_custom_column", "custom_hp_highlights_columns");

function edit_hp_highlights_columns($hp_highlights_columns)
{
        $hp_highlights_columns = array(
                "cb" => "<input type ='checkbox' />",
                "title" => "Homepage Highlight",
        );
        return $hp_highlights_columns;
}

function custom_hp_highlights_columns($hp_highlights_column)
{
        global $post;
        switch ($hp_highlights_column)
        {
        }

}


/* regular posts */
add_filter('manage_posts_columns', 'posts_columns', 5);
add_action('manage_posts_custom_column', 'posts_custom_columns', 5, 2);
function posts_columns($defaults){
    $defaults['riv_post_thumbs'] = __('Thumbs', 'classy');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'riv_post_thumbs'){
        echo the_post_thumbnail( 'small-thumbnail' );
    }
}
?>