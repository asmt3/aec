<?php
//get theme options
$options = get_option( 'classy_theme_settings' ); ?>
<?php
// start loop
while (have_posts()) : the_post();
global $more;
$more = 0;
// get featured image
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog' );
//get post meta
$posts_meta = get_post_meta($post->ID, 'classy_posts_meta', TRUE);
?>
<div class="entry clearfix">	
<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
	<?php
	if($posts_meta !='Hide') { ?> 
	<div class="post-meta-entry loop-full-meta clearfix">
		<span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span><span class="meta-category"><?php the_category(', '); ?></span>
    </div>
    <!-- END .post-meta-entry -->
    <?php } else { echo '<br />'; } ?>
	<?php
	//if thumbnails are not disabled
	if($options['disable_entry_thumbnail'] != 'disable') { 
	//if post has thumbnail
    if( has_post_thumbnail() ) { ?>
	<img src="<?php echo $featured_image[0]; ?>" alt ="<?php the_title(''); ?>" class="single-featured-image" height="140" width="140" />
    <?php } ?>
    <?php the_content(); ?>
    <?php } else { ?>  
	<?php the_content(); ?>
	<?php } ?>
</div>
<!-- END entry -->
<?php endwhile; ?>
