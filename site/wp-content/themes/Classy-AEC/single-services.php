<?php get_header(''); ?>
	<?php
    //start loop
    if (have_posts()) : while (have_posts()) : the_post();
    //get featured image
    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'page-header' );
	//get meta
	$posts_full_width = get_post_meta($post->ID, 'classy_posts_full_width', TRUE);
    ?>
    
    <?php
    //if post has thumbnail
    if( has_post_thumbnail() ) { ?>
    <div id="page-header">
    	<img src="<?php echo $featured_image[0]; ?>" alt ="<?php the_title(''); ?>" width="980" />
    </div>
    <!-- END #page-header -->
    <?php } ?>
    
    <div id="post" <?php if($posts_full_width == 'Yes') { echo 'class="full-width"'; } ?>>  
        <h1><?php the_title(); ?></h1>
        <?php the_content(); ?>
    </div>
    <!-- END #post -->
    <?php endwhile; ?>
    <?php endif; ?>	
<?php
if($posts_full_width != 'Yes') {
	get_sidebar('pages');
}
?>
<?php get_footer(''); ?>