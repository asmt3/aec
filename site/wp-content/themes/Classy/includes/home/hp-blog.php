<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default variables
if($options['hp_blog_column'] !='') {
	$hp_blog_columns = $options['hp_blog_column']; 
	} else {
		$hp_blog_columns = '4';
}
//set variables to their corresponding 960gs classes
if($hp_blog_columns == '2') {
	$hp_blog_grid_class = 'grid_12';
}
if($hp_blog_columns == '3') {
	$hp_blog_grid_class = 'grid_8';
}
if($hp_blog_columns == '4') {
	$hp_blog_grid_class = 'grid_6';
}
// get post count
if($options['home_blog_count'] !='') {
	$post_count = $options['home_blog_count'];
	} else {
		$post_count = '4';
}
	global $post;
	$args = array(
		'post_type' =>'post',
		'numberposts' => $post_count,
		'orderby' => 'ASC'
	);
	$latest_posts = get_posts($args);
?>
<?php if($latest_posts) { ?>
<div id="home-blog" class="clearfix">
<h2><span><?php if ($options['home_blog_title'] !='') { echo $options['home_blog_title']; } else {  _e('Latest News','classy'); } ?></span></h2>
	<?php
    $count=0; //start post count at "0"
    foreach($latest_posts as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	// get featured image
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumbnail' )
    ?>
    <div class="<?php echo $hp_blog_grid_class; ?> <?php if($count==1){ echo 'alpha'; } ?> <?php if($count==$hp_blog_columns){ echo 'omega'; } ?>">
    	<div class="home-blog-item clearfix">
            <h3>
                <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>">
                <?php
					$thetitle = $post->post_title; /* or you can use get_the_title() */
					$getlength = strlen($thetitle);
					$thelength = 55;
					echo substr($thetitle, 0, $thelength);
					if ($getlength > $thelength) echo "...";
				?>
                </a>
            </h3>
            <div class="home-blog-meta"><?php _e('Posted on','classy'); ?> <?php the_time('F d, y'); ?></div>
            <?php if( has_post_thumbnail() ) {  ?>
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" /></a>
            <?php } ?>
            <?php
            if($options['home_blog_excerpt'] !='') {
                $home_blog_excerpt =  $options['home_blog_excerpt'];
            } else {
				$home_blog_excerpt = '25'; }
			?>
			<p><?php echo excerpt($home_blog_excerpt); ?></p>
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more"><?php _e('Read More', 'classy') ?></a>
        </div>
        <!-- END home-blog-item -->
    </div>
    <!-- END <?php echo $hp_blog_grid_class; ?> -->
	<?php
    //reset the count to "0" and clear the divs
    if($count==$hp_blog_columns){ echo '<div class="clear"></div>'; $count=0; } ?>
    <?php endforeach; ?>
</div>
<!--END home-blog -->
<?php } wp_reset_postdata(); ?>