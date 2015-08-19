<?php
/*
Template Name: Services
*/
?>
<?php get_header(' '); ?>
<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default variables
if($options['services_column'] !='') {
	$services_columns = $options['services_column']; 
	} else {
		$services_columns = '4';
}
//set variables to their corresponding 960gs classes
if($services_columns == '1') {
	$services_grid_class = 'grid_24';
}
if($services_columns == '2') {
	$services_grid_class = 'grid_12';
}
if($services_columns == '3') {
	$services_grid_class = 'grid_8';
}
if($services_columns == '4') {
	$services_grid_class = 'grid_6';
}
?>

<?php
//start loop
if (have_posts()) : while (have_posts()) : the_post();
//get featured image
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'page-header' );
?>
<?php
//if post has thumbnail
if( has_post_thumbnail() ) { ?>

<div id="page-header">
<img src="<?php echo $featured_image[0]; ?>" alt ="<?php the_title(''); ?>" width="980" />
</div>
<!-- END #page-header -->

<?php } ?>

<h1 class="page-title"><?php the_title(); ?></h1>
<?php the_content(''); ?>
<div class="divider"></div>


<?php if($options['disable_services_cats'] != 'disable') { ?>
    <div id="service-cats" class="clearfix">
        <?php 
                $taxonomy     = 'service_cats';
                $orderby      = 'name'; 
                $show_count   = 0;      // 1 for yes, 0 for no
                $pad_counts   = 0;      // 1 for yes, 0 for no
                $hierarchical = 1;      // 1 for yes, 0 for no
                $title        = '';
                $args = array(
                'taxonomy'     => $taxonomy,
                'orderby'      => $orderby,
                'show_count'   => $show_count,
                'pad_counts'   => $pad_counts,
                'hierarchical' => $hierarchical,
                'title_li'     => $title
        );
        ?>
        <ul class="clearfix">
            <?php if($options['service_url'] !='') { ?>
            <li class="current-cat"><a href="<?php echo $options['service_url']; ?>" title="<?php _e('Services', 'fotos'); ?>"><?php _e('All', 'classy'); ?></a></li>
            <?php } ?>
            <?php wp_list_categories( $args ); ?>
        </ul>
    </div>
    <!-- END service-cats -->
    <?php } ?>

<div id="services-wrap" class="clearfix" <?php if($options['disable_services_cats'] == 'disable') { ?> style="margin-top: -20px;" <?php } ?>>
<?php
	global $post;
	$args = array(
		'post_type' =>'services',
		'numberposts' => -1,
		'orderby' => 'title', //PMC
		'order' => 'ASC', //PMC
	);
	$services_posts = get_posts($args);
?>
<?php if($services_posts) { ?>
<?php
    $count=0; //start post count at "0"
    foreach($services_posts as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	//get services meta
	$services_icon = get_post_meta($post->ID, 'classy_services_icon', TRUE);
	$services_description = get_post_meta($post->ID, 'classy_services_description', TRUE);
	//get featured image
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full-size');
    ?>
    <div class="<?php echo $services_grid_class; ?> <?php if($count==1){ echo 'alpha'; } ?> <?php if($count==$services_columns){ echo 'omega'; } ?>">
   	<div class="service-item <?php if($services_icon !='') {  echo 'service-item-margin'; } ?>">
				<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail( 'home-services' , array('alt' => get_the_title(), 'title' => get_the_title())); // PMC ?> 
				</a>
        <h2><?php if($options['disable_services_title_link'] !='disable') { ?><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a><?php } else { the_title(); } ?></h2>
		<?php if($services_icon !='') {  ?>
        	<img src="<?php echo $services_icon; ?>" alt="<?php the_title(''); ?>" width="25" height="25" class="service-item-icon" />
		<?php } ?>
		
        <?php
			if(($services_description) !='') {
				echo $services_description;
			}
			else { 
				//echo excerpt(15);
				the_excerpt(); //PMC
			}
		?>
        </div>
        <!-- END .service-item -->
	</div>
    <!-- END <?php echo $services_grid_class; ?> -->
	<?php
    //reset the count to "0" and clear the divs
    if($count==$services_columns){ echo '<div class="clear"></div>'; $count=0; } ?>
    <?php endforeach; ?>
<?php } wp_reset_postdata(); ?>
</div>
<!-- END service-wrap -->     
<?php endwhile; ?>
<?php endif; ?>  
<?php get_footer(' '); ?>