<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
?>
<?php get_header(''); ?>

<?php
//start loop
if (have_posts()) :
while (have_posts()) : the_post();
//get post meta
$posts_full_width = get_post_meta($post->ID, 'classy_posts_full_width', TRUE);
$posts_meta = get_post_meta($post->ID, 'classy_posts_meta', TRUE);
$posts_author = get_post_meta($post->ID, 'classy_posts_author', TRUE);
$posts_related = get_post_meta($post->ID, 'classy_posts_related', TRUE);
$posts_tags = get_post_meta($post->ID, 'classy_posts_tags', TRUE);
// get featured image
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'blog' );
?>

<div id="post" <?php if($posts_full_width == 'Yes') { echo 'class="full-width"'; } ?>>  
	<h1 id="post-title"><?php the_title(); ?></h1>    
	<?php
	if($posts_meta !='Hide') { ?>  
    <div class="post-meta clearfix">
    	<span class="meta-date"><?php the_time('j'); ?> <?php the_time('M'); ?>, <?php the_time('Y'); ?></span><span class="meta-category"><?php the_category(', '); ?></span>
	</div>
    <!-- END .post-meta -->
    <?php } else { echo '<br />'; } ?>

    <?php
	//if thumbnails are not disabled
	if($options['disable_post_thumbnail'] != 'disable') { 
	//if post has thumbnail
    if( has_post_thumbnail() ) { ?>
	<img src="<?php echo $featured_image[0]; ?>" alt ="<?php the_title(''); ?>" class="single-featured-image" height="140" width="140" />
    <?php } } ?>
    
	<?php the_content(); ?>
    
    <!-- Clear Post Floats -->
    <div class="clear"></div>
    
    <?php wp_link_pages('before=<div id="post-page-navigation">&after=</div>'); ?>
             
    <?php
	if($posts_tags !='Hide') {
    	the_tags('<div class="post-tags clearfix">',' ','</div>');
	}
	?>
            
	<?php
    if ($options['disable_author'] != 'disable') {
	if ($posts_author !='Disable') {
	?>
        <div id="post-author" class="clearfix">
        <h3><?php _e('About The Author','classy'); ?></h3>
        <div class="grid_2 alpha">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'platformbase_author_bio_avatar_size', 50 ) ); ?>
		</div>
        <!-- END .grid_2 alpha -->
        <div class="grid_15 omega">
        <?php the_author_meta('description') ?>
		</div>
		<!-- END .grid_15 omega -->
        </div><!-- END #post-author -->
    <?php } } ?> 
    <?php
    if ($options['disable_related_posts'] != 'disable') {
	if ($posts_related !='Disable') {	
	?> 
		<?php
		global $post;
		$tmp_post = $post;
        $category = get_the_category(); //get first current category ID
        $this_post = $post->ID; // get ID of current post
        $related_post = get_posts('numberposts=3&orderby=rand&category=' . $category[0]->cat_ID . '');
		if($posts) {
        ?>
        <div id="related-posts" class="clearfix">
            <h3><?php _e('Related Posts','classy') ?></h3>
            <?php
            foreach($related_post as $post) : setup_postdata($post);
            ?>
            <?php if ( has_post_thumbnail() ) { ?>
            <div class="related-post clearfix">
            	<div class="grid_2 alpha">
               		<a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail('small-thumbnail'); ?></a>
            	</div>
            	<!-- END .grid_2 alpha -->
            	<div class="grid_15 omega">
                	<h4><a href="<?php the_permalink() ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h4>  
                	<p><?php echo excerpt(13); ?></p>
            	</div>
            	<!-- END .grid_15 omega -->
            </div>
            <!-- END .related-post -->             
            <?php } ?>
            <?php endforeach; $post = $tmp_post; ?>
        </div>
        <!-- END #related-posts -->
		<?php } } ?>
    <?php } ?>
    <?php comments_template(); ?>  
</div>
<!-- END #post -->
<?php endwhile; ?>
<?php endif; ?>	

<?php
if($posts_full_width != 'Yes') {
	get_sidebar('');
}
?>
<?php get_footer(''); ?>