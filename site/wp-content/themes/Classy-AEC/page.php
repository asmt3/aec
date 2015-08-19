<?php $options = get_option( 'classy_theme_settings' ); ?>
<?php get_header(''); ?>
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
<div id="post">	
    <h1 class="page-title"><?php the_title(); ?></h1>			
    <?php the_content(); ?>
    <?php comments_template(); ?>           
</div>
<!-- END post-content -->
<?php endwhile; ?>
<?php endif; ?>	
<?php get_sidebar('pages'); ?>
<?php get_footer(''); ?>