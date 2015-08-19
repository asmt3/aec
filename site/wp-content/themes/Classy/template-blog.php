<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
?>
<?php
/*
Template Name: Blog
*/
?>
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
    <h1><?php the_title(); ?></h1>
    <div id="page-description">
        <?php the_content(''); ?>
    </div>
    <!-- END #page-description -->
	<?php
	//query posts
        query_posts(
            array(
            'post_type'=> 'post',
            'paged'=>$paged
        ));
    ?>
        <?php if (have_posts()) : ?>              
			<?php if ($options['disable_excerpt'] == 'enable') { ?> 
            <?php get_template_part('loop', 'full'); ?>
            <?php } else { ?>
            <?php get_template_part('loop', 'entry'); ?>
            <?php } ?>
        <?php endif; ?>                
        <?php if (function_exists("pagination")) { pagination(); } ?>
</div>
<!-- END post -->
<?php wp_reset_query(); endwhile; ?>
<?php endif; ?>
<?php get_sidebar(''); ?>
<?php get_footer(''); ?>