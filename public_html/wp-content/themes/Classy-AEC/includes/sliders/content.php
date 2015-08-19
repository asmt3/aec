<?php
// get custom post type ==> slides
global $post;
$args = array(
	'post_type' =>'slides',
	'numberposts' => -1,
	'orderby' => 'ASC'
);
$slider_posts = get_posts($args);
?>
<?php if($slider_posts) { ?>
<!-- Slider -->
<div id="slider-container" class="slides-js home-slides-slider clearfix">         
	<div id="slides">
		<div class="slides_container">
			<?php 
                foreach($slider_posts as $post) : setup_postdata($post);
				//get featured image ==> full size
                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'nivo-slider');
                // get metabox data
                $slidelink = get_post_meta($post->ID, 'classy_slides_url', true);
				$slides_padding = get_post_meta($post->ID, 'classy_slides_padding', true);

            ?>
			<div class="single_slide <?php if($slides_padding == 'Yes') { echo 'slide-padding'; } ?> clearfix">
          	<?php if ( has_post_thumbnail() ) { ?>
				<?php
                // show link with slide if meta exists
                if($slidelink != '') { ?>
                	<div class="slide-image">
                	<a href="<?php echo $slidelink ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="980" height="280" /></a>
					</div>
                    <!-- END .slide-image -->
                	<?php
                 	// no meta link defined, show plain img
                	} else { ?>
                    <div class="slide-image">
                	<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="980" height="280" />
                    </div>
                    <!-- END .slide-image -->
                <?php } } else { ?>
                <?php the_content(''); ?>
            <?php } ?>
			</div>
            <!-- end single_slide -->
    	<?php endforeach; ?>
        </div>
        <!-- end slides_container -->
    </div>
    <!-- end slides -->
</div>
<!-- end slider-container -->
<?php } wp_reset_postdata(); ?> 