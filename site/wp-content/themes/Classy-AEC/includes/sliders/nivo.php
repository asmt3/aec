<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
?>
<?php
	//get custom post type === > Slides
	global $post;
	$args = array(
		'post_type' =>'slides',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$slides = get_posts($args);
?>
<?php if($slides) { ?>
<div id="slider-wrap">
	<div id="slider_nivo" class="nivoSlider"> 
		<?php
		// start loop
        foreach($slides as $post) : setup_postdata($post);
		//get featured image ==> full size
		$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'nivo-slider');
		// get metabox data
		$slidelink = get_post_meta($post->ID, 'classy_slides_url', TRUE);
		?>
        <?php
        //only show slide if featured thumbnail is defined
		if ( has_post_thumbnail() ) { ?>
             <?php
			// show link with slide if meta exists
			if($slidelink != '') { ?>
				<a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" <?php if($options['disable_caption'] != 'disable') { ?>title="<?php the_title(); ?>"<?php } ?> width="980" height="280" /></a>
         <?php
         // no meta link defined, show plain img
        } else { ?> 
		<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" <?php if($options['disable_caption'] != 'disable') { ?>title="<?php the_title(); ?>"<?php } ?> width="980" height="280" />
       <?php } ?>
       <?php } ?>
		<?php endforeach; ?>
	</div><!--/slider nivoSlider-->
	<div id="slider-telephone-overlay">Telephone: 01622 763972</div>
</div><!--/slider-wrap -->
<?php } wp_reset_postdata(); ?>