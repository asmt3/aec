<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default variables
if($options['hp_services_columns'] !='') {
	$hp_services_columns = $options['hp_services_columns']; 
	} else {
		$hp_services_columns = '4';
}
//set variables to their corresponding 960gs classes
if($hp_services_columns == '1') {
	$hp_services_grid_class = 'grid_24';
}
if($hp_services_columns == '2') {
	$hp_services_grid_class = 'grid_12';
}
if($hp_services_columns == '3') {
	$hp_services_grid_class = 'grid_8';
}
if($hp_services_columns == '4') {
	$hp_services_grid_class = 'grid_6';
}
// get post count
if($options['home_services_count'] !='') {
	$post_count = $options['home_services_count'];
	} else {
		$post_count = '-1';
}
?>
<?php
	global $post;
	// $args = array(
	// 	'post_type' =>'services',
	// 	'numberposts' => $post_count,
	// 	'service_cats' => $options['service_home_slug'],
	// 	'orderby' => 'title', //PMC
	// 	'order' => 'ASC', //PMC
	// );
	// $posts = get_posts($args);
	
	
	$services_sql = "
		SELECT wp_posts.* 
		FROM wp_posts
		INNER JOIN wp_postmeta ON wp_postmeta.post_id = wp_posts.id
		WHERE 1=1 
			AND (wp_posts.post_type = 'services') 
			AND (wp_posts.post_status = 'publish')
			AND (wp_postmeta.meta_key = 'classy_services_order')
		ORDER BY (0+wp_postmeta.meta_value) ASC, wp_posts.post_title
	";
	

	
	$posts = $wpdb->get_results($services_sql);
	
	
?>
<?php if($posts) { ?>
<div id="home-services" class="clearfix">
	
<h2><span><?php if ($options['home_services_title'] !='') { echo $options['home_services_title']; } else {  _e('Our Services','classy'); } ?></span></h2>
<?php
    $count=0; //start post count at "0"
    foreach($posts as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	//get services meta
	$services_icon = get_post_meta($post->ID, 'classy_services_icon', TRUE);
	$services_description = get_post_meta($post->ID, 'classy_services_description', TRUE);    ?>
    <div class="<?php echo $hp_services_grid_class; ?> <?php if($count==1){ echo 'alpha'; } ?> <?php if($count==$hp_services_columns){ echo 'omega'; } ?>">
   	<div class="service-item  <?php if($services_icon !='') {  echo 'service-item-margin'; } ?>">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
				<?php the_post_thumbnail( 'home-services', array(
					'alt' => trim(strip_tags($post->post_title)),
					'title' => trim(strip_tags($post->post_title)),
				)); // PMC ?> 
			</a>
	
        <h3><?php if($options['disable_hp_services_title_link'] !='disable') { ?><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><?php } else { the_title(); } ?></h3>


		<?php if($services_icon !='') {  ?>
					<a href="<?php the_permalink(' ') ?>
        		<img src="<?php echo $services_icon; ?>" alt="<?php the_title(''); ?>" width="25" height="25" class="service-item-icon" />
					</a>
		<?php } ?>
        <?php /* PMC: no description to be shown
			if(($services_description) !='') {
				echo $services_description;
			}
			else { 
				the_excerpt();
			} */
		?>
        </div>
        <!-- END .service-item -->
	</div>
    <!-- END <?php echo $hp_services_grid_class; ?> -->
	<?php
    //reset the count to "0" and clear the divs
    if($count==$hp_services_columns){ echo '<div class="clear"></div>'; $count=0; } ?>
    <?php endforeach; ?>
    </div>
    <!-- END #home-services-wrap -->
<?php } wp_reset_postdata(); ?>