<?php
/******************************************
/* Shortcodes
******************************************/
/**** Clean UP SHORTCODES ****///Clean Up WordPress Shortcode Formatting - important for nested shortcodes
//adjusted from http://donalmacarthur.com/articles/cleaning-up-wordpress-shortcode-formatting/
function parse_shortcode_content( $content ) {

   /* Parse nested shortcodes and add formatting. */
    $content = trim( do_shortcode( shortcode_unautop( $content ) ) );

    /* Remove '' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '' )
        $content = substr( $content, 4 );

    /* Remove '' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of ''. */
    $content = str_replace( array( '<p></p>' ), '', $content );
    $content = str_replace( array( '<p>  </p>' ), '', $content );

    return $content;
}

//move wpautop filter to AFTER shortcode is processed
remove_filter( 'the_content', 'wpautop' );
add_filter( 'the_content', 'wpautop' , 99);
add_filter( 'the_content', 'shortcode_unautop',100 );

//Divider
function divider_shortcode() {
   return '<span class="divider"></span>';
}
add_shortcode( 'divider', 'divider_shortcode' );


//Line
function line_shortcode() {
   return '<span class="line-space"></span>';
}
add_shortcode( 'line', 'line_shortcode' );

//Break
function line_break_shortcode() {
   return '<br />';
}

add_shortcode( 'br', 'line_break_shortcode' );


//clear
function clear_shortcode() {
   return '<div class="clear"></div>';
}

add_shortcode( 'clear', 'clear_shortcode' );

//tab shortcode
add_shortcode( 'tabs', 'tab_group' );
function tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a href="#'.$tab['id'].'">'.$tab['title'].'</a></li>';
$panes[] = '<div id="'.$tab['id'].'" class="tab_content">'.$tab['content'].'</div>';
}
$return = "\n".'<ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<div class="tab_container">'.implode( "\n", $panes ).'</div>'."\n";
}
return $return;
}

add_shortcode( 'tab', 'single_tab' );
function single_tab( $atts, $content ){
extract(shortcode_atts(array(
	'title' => 'Tab %d',
	'id' => ''
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'title' => sprintf( $title, $GLOBALS['tab_count'] ), 'id' => sprintf( $id, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}

//Dropcaps
function dropcap( $atts, $content = null ) {
	extract( shortcode_atts(
	array(
      'color' => 'gray',
      ),
	  $atts ) );
	  
   return '<span class="dropcap dropcap-'.$color.'">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'dropcap');

//Image
function image_shortcode( $atts, $content = null ) {
	extract( shortcode_atts(
	array(
      'style' => 'shadow',
      ),
	  $atts ) );
	  
   return '<span class="image-'.$style.'">' . $content . '</span>';
}
add_shortcode('image', 'image_shortcode');

//Divider With Title
function divider_title_shortcode( $atts ) {
	extract( shortcode_atts(
	array(
      'title' => '',
	  'heading' => '',
      ),
	  $atts ) );
	  
	  if($heading !='') { $header_tag = $heading; } else { $header_tag = 'h2'; }
	  
   return '<'.$header_tag.' class="divider-title"><span>' . $title . '</span></'.$header_tag.'>';
}
add_shortcode('divider_title', 'divider_title_shortcode');

//highlights
function highlight_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
	array(
      'color' => 'yellow',
      ),
	  $atts ) );

      return '<span class="text-highlight highlight-' . $color . '">' . $content . '</span>';

}
add_shortcode('highlight', 'highlight_shortcode');

//Toggle
function toggle_shortcode( $atts, $content = null )
{
	extract( shortcode_atts(
	array(
      'title' => 'Click To Open',
	  'color' => ''
      ),
	  $atts ) );
		return '<h3 class="trigger toggle-'.$color.'"><a href="#">'. $title .'</a></h3><div class="toggle_container">' . do_shortcode($content) . '</div>';
}
add_shortcode('toggle', 'toggle_shortcode');

//Buttons
function button_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'default',
	  'url' => '',
	  'text' => '',
	  'class' => '',
	  'target' => ''
      ), $atts ) );
	  if($url) {
		return '<a href="' . $url . '" class="button ' . $color . ' '. $class. '" target="_'. $target .'"><span>' . $text . $content . '</span></a>';
	  } else {
		return '<div class="button ' . $color . ' '. $class. '"><span>' . $text . $content . '</span></div>';
	}
}
add_shortcode('button', 'button_shortcode');


//Lists
function list_shortcode( $atts, $content = null )
{
	extract(
	shortcode_atts( array(
      'type' => ''
      ),
	  $atts ) );
		return '<div class="' . $type . '">' . $content . '</div>';
}
add_shortcode('list', 'list_shortcode');


//Boxes
function box_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
      'color' => 'orange',
      'size' => 'normal',
      'type' => '',
	  'align' => 'default',
      ), $atts ) );

      return '<div class="box-shortcode box-' . $color . '">' . $content . '</div>';

}
add_shortcode('box', 'box_shortcode');


//Columns
function column_shortcode( $atts, $content = null )
{
	extract( shortcode_atts( array(
	  'offset' =>'',
      'size' => '',
	  'position' =>''
      ), $atts ) );


	  if($offset !='') { $column_offset = $offset; } else { $column_offset ='one'; }
		
      return '<div class="'.$column_offset.'-' . $size . ' column-'.$position.'">' . do_shortcode($content) . '</div>';

}
add_shortcode('column', 'column_shortcode');

//- Pricing Tables -------*/
function pricing_tables_shortcode($atts, $content = null)	{

	extract( shortcode_atts(
	array(
      'columns' => 'four',
	  'slug' => ''
    ), $atts ) );
	
	//get column count and set post count
	if($columns == 'four') { $pricing_tables_count = '4'; } else { $pricing_tables_count = '3'; }
	
	//set loop arguments
	$post_args = array(
						'post_type' => 'pricing_tables',
						'pricing_tables_cats' => ''. $slug.'',
						'posts_per_page' => $pricing_tables_count,
						'order'=> 'DESC',
					);
					
	//get pricing table posts
	$pricing_tables = get_posts($post_args);
	
	//Start Content
	$content .= '<div class="pricing-table-wrap clearfix">';
	
	//start counter and loop
	$count=0;
	foreach ($pricing_tables as $pricing_table) {
	$count++;
	
	//get pricing tables meta
	$pricing_tables_featured = get_post_meta($pricing_table->ID, 'classy_pricing_tables_featured', TRUE);
	$pricing_tables_price = get_post_meta($pricing_table->ID, 'classy_pricing_tables_price', TRUE);
	$pricing_tables_money_symbol = get_post_meta($pricing_table->ID, 'classy_pricing_tables_money_symbol', TRUE);
	$pricing_tables_rate = get_post_meta($pricing_table->ID, 'classy_pricing_tables_rate', TRUE);
	$pricing_tables_url = get_post_meta($pricing_table->ID, 'classy_pricing_tables_url', TRUE);
	$pricing_tables_btn_text = get_post_meta($pricing_table->ID, 'classy_pricing_tables_btn_text', TRUE);
	//set variable for gs grid
	if($columns == 'four') { $pricing_grid = 'grid_6'; } else { $pricing_grid = 'grid_8'; }
	
	//set variable for alpha and omegas
	if($count==1){ $class = 'alpha'; }
	if($count==2){ $class = ''; }
	if($count==$pricing_tables_count) { $class = 'omega'; }
		
	//see if pricing table is featured, if so set variable class	
	if($pricing_tables_featured == 'Yes') { $featured = 'featured'; } else { $featured =''; }

					$content .= '<div class="'. $pricing_grid . ' '. $class .'">';
						$content .= '<div class="pricing-table '.$featured.' clearfix">';
							if($featured !='') {
								$content .= '<span class="pricing-popular-tag"></span>';
							}
							$content .='<div class="pricing-table-header">';
								$content .= '<h3>'. get_the_title($pricing_table->ID, 'testimonial') .'</h3>';
								$content .= '<div class="price"><span class="symbol">'. $pricing_tables_money_symbol .'</span>'. $pricing_tables_price .'<span class="rate">'.$pricing_tables_rate.'</span></div>';
								$content .= '</div>';
								$content .= wptexturize($pricing_table->post_content);
								if($pricing_tables_url !='') {
									$content .= '<div class="pricing-table-button"><a href="'.$pricing_tables_url.'" title="'.$pricing_tables_btn_text.'">'.$pricing_tables_btn_text.'</a></div>';
								}
						$content .= '</div>';	
						$content .='<span class="pricing-shadow-'.$columns.'"></span>';
					$content .= '</div>';
					
					//reset count
					if($count == $pricing_tables_count ) { $count=0; }
		}
	$content .= '</div>';
	return $content;  
	}
add_shortcode('pricing_table_shortcode', 'pricing_tables_shortcode');


//contact form
function contact_shortcode( $atts, $content = null)	{

	extract( shortcode_atts(
	array(
      'email' => get_bloginfo('admin_email')
    ), $atts ) );
	  
		$content .= '
		<script type="text/javascript"> 
			var $j = jQuery.noConflict();
			$j(window).load(function(){				
				$j("#contact-form").submit(function() {
				  //validate and process form here
					var str = $j(this).serialize();					 
					   $j.ajax({
					   type: "POST",
					   url: "' . get_template_directory_uri(). '/functions/contactform.php",
					   data: str,
					   success: function(msg){						
							$j("#contact-success").ajaxComplete(function(event, request, settings)
							{ 
								if(msg == "OK")
								{
									result = "<span>'.__('Your message has been sent. Thank you', 'classy') .'!</span>";
									$j("#fields").fadeOut();
								}
								else
								{
									result = msg;
								}								 
								$j(this).html(result);							 
							});					 
						}					 
					 });					 
					return false;
				});			
			});
		</script>';
		$content .= '<div id="dtl-contactform">';
			$content .= '<div id="fields">';
				$content .= '<form id="contact-form" action="">';
					$content .= '<input name="to_email" type="hidden" id="to_email" value="' . $email . '"/>';
					$content .= '<p>';
						$content .= '<div class="postform"><label class="errorfor="name">'.__('Name', 'classy') .': </label></div>';
						$content .= '<div class="postform"><input name="name" type="text" id="name" class="inputbox"/></div>';
					$content .= '</p>';
					$content .= '<p>';
						$content .= '<div class="postform"><label for="email">'.__('E-mail address', 'classy') .': </label></div>';
						$content .= '<div class="postform"><input name="email" type="text" id="email" class="inputbox"/></div>';
					$content .= '</p>';
					$content .= '<div class="postform"><label for="message">'.__('Your Message', 'classy') .': </label></div>';
					$content .= '<div class="postform"><textarea rows="10" cols="" name="message" class="inputboxmessage"></textarea></div>';
					$content .= '<p>';
					$content .= '<div class="postform"><label for="captcha">2+2 = </label></div>';
						$content .= '<div class="postform"><input name="captcha" type="text" id="captcha" class="inputboxsmall"/></div>';
					$content .= '</p>';
					$content .= '<div class="postform"><input type="submit" value="'.__('Send Email', 'classy') .'" class="contactbtn" id="contact-submit" /></div>';
				$content .= '</form>';
			$content .= '</div><!--end fields-->';
			$content .= '<div id="contact-success"></div>';
		$content .= '</div>';
	return $content;
}
add_shortcode('contact', 'contact_shortcode');


/*shortcode filters - alow shortcodes in widgets*/
add_filter('the_content', 'do_shortcode');
add_filter('widget_text', 'do_shortcode');
?>