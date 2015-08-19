<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default variables
if($options['hp_highlights_column'] !='') {
	$hp_highlights_columns = $options['hp_highlights_column']; 
	} else {
		$hp_highlights_columns = '3';
}
//set variables to their corresponding 960gs classes
if($hp_highlights_columns == '1') {
	$hp_highlights_grid_class = 'grid_24';
}
if($hp_highlights_columns == '2') {
	$hp_highlights_grid_class = 'grid_12';
}
if($hp_highlights_columns == '3') {
	$hp_highlights_grid_class = 'grid_8';
}
if($hp_highlights_columns == '4') {
	$hp_highlights_grid_class = 'grid_6';
}

//get custom post type ==> homepage highlights
	global $post;
	$args = array(
		'post_type' =>'hp_highlights',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$hp_highlights = get_posts($args);
?>
<?php if($hp_highlights) { ?>
<div id="home-highlights" class="clearfix">
	<?php
    $count=0; //start post count at "0"
    foreach($hp_highlights as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	//get portfolio thumbnail
	$thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'home-highlights');
	//get portfolio meta
	$hp_highlights_url = get_post_meta($post->ID, 'classy_hp_highlights_url', TRUE);
    ?>
    <div class="<?php echo $hp_highlights_grid_class; ?> <?php if($count===1){ echo 'alpha'; } ?> <?php if($count==$hp_highlights_columns){ echo 'omega'; } ?>">
    	<div class="home-highlight-item">
            <h2><?php if(($hp_highlights_url) !='') {  ?><a href="<?php echo $hp_highlights_url; ?>" title="<?php the_title(''); ?>"><?php the_title(''); ?></a><?php } else { the_title(''); } ?></h2>
            <?php the_content(); ?>
        </div>
    </div>
    <!-- END <?php echo $hp_highlights_grid_class; ?> -->
    <?php
    //reset the count to "0" and clear the divs
    if($count==$hp_highlights_columns){ $count=0; echo '<div class="clear"></div>'; } ?>
    <?php endforeach; ?>
</div>
<!--END home-highlights -->
<?php } wp_reset_postdata(); ?>