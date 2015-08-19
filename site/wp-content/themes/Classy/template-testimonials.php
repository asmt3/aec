<?php $options = get_option( 'classy_theme_settings' ); ?>
<?php
/*
Template Name: Testimonials
*/
?>
<?php get_header(' '); ?>
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
<div id="post" class="full-width">
<h1><?php the_title(); ?></h1>
<?php the_content(''); ?>
<div class="divider"></div>

<div id="testimonials-wrap" class="clearfix">
<?php
	global $post;
	$args = array(
		'post_type' =>'testimonials',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$testimonials_posts = get_posts($args);
?>
<?php if($testimonials_posts) { ?>
<?php
    $count=0; //start post count at "0"
    foreach($testimonials_posts as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	//get testimonials thumbnail
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'small-thumbnail');
	//get testimonials meta
	$testimonials_testimonial_by = get_post_meta($post->ID, 'classy_testimonial_by', TRUE);
    ?>
    	<div class="testimonial testimonial-<?php if($count =='1') { echo 'left'; } else { echo 'right'; } ?>">
            <h2><?php the_title(); ?></h2>
            <?php the_content(''); ?>
			<?php if ( has_post_thumbnail() ) {  ?>
                <img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" class="testimonial-avatar" height="50" width="50" />
                <div class="testimonial-meta">
                	<span class="testimonial-by"><?php _e('by','classy'); ?> <strong><?php echo $testimonials_testimonial_by; ?></strong></span>
                    <br />
                    <span class="testimonial-date"><?php the_time('F') ?> <?php the_time('j') ?>, <?php the_time('Y') ?></span>
                </div>
                <!-- END .testimonial-meta -->
            <span class="testimonial-arrow"></span>
            <?php } else { ?>
                <div class="testimonial-by-alternative">
                    <?php _e('by','classy'); ?> <strong><?php echo $testimonials_testimonial_by; ?></strong>
                </div>
                <!-- END .testimonial-meta -->
                
            <?php } ?>
        </div>
        <!-- END .testimonial -->
    <div class="clear"></div>
	<?php
    //reset the count to "0"
    if($count===2){ $count=0; } ?>
    <?php endforeach; ?>
<?php } wp_reset_postdata(); ?>
</div>
<!-- END #testimonials-wrap -->     
</div><!-- END #post .full-width -->   
<?php endwhile; ?>
<?php endif; ?> 
<?php get_footer(' '); ?>