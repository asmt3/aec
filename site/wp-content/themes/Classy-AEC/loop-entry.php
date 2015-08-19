<?php
//get theme options
$options = get_option( 'classy_theme_settings' ); ?>


<?php
//set default excerpt length
if($options['blog_excerpt_length'] !='') {
	$blog_excerpt_length = $options['blog_excerpt_length']; }
	else {
		$blog_excerpt_length = '35'; }
// start loop
while (have_posts()) : the_post();
// get featured image
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog' );
//get post meta
$posts_meta = get_post_meta($post->ID, 'classy_posts_meta', TRUE);
$page_excerpt = get_post_meta($post->ID, 'classy_page_excerpt', TRUE);
?>


<?php
//for page entries only - no thumbnails and no meta
if ( 'page' == get_post_type()) { ?>

<div class="entry page-entry clearfix">
	<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
    
    <?php if($page_excerpt !='') {
		echo $page_excerpt; } else { ?>
		<p><?php echo excerpt($blog_excerpt_length); ?></p>
    <?php } ?>
    
</div>
<!-- END entry -->

<?php } else { ?>

<div class="entry clearfix">	

<?php
//get thumbnails if not disabled
if($options['disable_entry_thumbnail'] != 'disable') {
?>
    
	<?php
	//check if thumbnails exist
    if( has_post_thumbnail() ) { 
	?> 
        <div class="entry-left">
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt ="<?php the_title(', '); ?>" width="140" height="140" /></a>	
		</div>
        <!-- END .entry-left -->
        <div class="entry-right">
            <h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            
			<?php if($posts_meta !='Hide') { ?> 
            <div class="post-meta-entry clearfix">
				<span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span><span class="meta-category"><?php the_category(', '); ?></span>
            	</div>
            	<!-- END .post-meta-entry -->
                <?php } else { echo '<br />'; } ?>
                
            <p><?php echo excerpt($blog_excerpt_length); ?></p>
            <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more"><?php _e('Read More', 'classy') ?></a>
		</div>
        <!-- END .entry-right -->
        
    <?php
	//if doesnt have thumbnail
    } else { ?>  
     
        <h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        
		<?php if($posts_meta !='Hide') { ?> 
		<div class="post-meta-entry clearfix">
    		<span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span><span class="meta-category"><?php the_category(', '); ?></span>
            </div>
            <!-- END .post-meta-entry -->
		<?php } else { echo '<br />'; } ?>
        
        <p><?php echo excerpt($blog_excerpt_length); ?></p>
		<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more"><?php _e('Read More', 'classy') ?></a>
    <?php } ?>


	<?php
    //if thumbnails are disabled
    } else { ?>

		<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
        
        <div class="post-meta-entry clearfix">
			<span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span><span class="meta-category"><?php the_category(', '); ?></span>
		</div>
		<!-- END .post-meta-entry -->
            
        <p><?php echo excerpt($blog_excerpt_length); ?></p>
		<a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>" class="read-more"><?php _e('Read More', 'classy') ?></a>    
     
	 <?php } ?>
     
	</div>
	<!-- END entry -->
     
<?php } ?> 
<?php endwhile; ?>