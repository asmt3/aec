<?php
//get theme options
$options = get_option( 'classy_theme_settings' ); ?>
<?php
/*
Template Name: Static Homepage
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

<div id="post" class="full-width clearfix">
    <?php the_content(); ?>
</div>
<!-- END post-content -->
<p class="clearfix"></p>
<div class="divider"></div>
<?php endwhile; ?>
<?php endif; ?>

<?php 
//include homepage callout
require( TEMPLATEPATH . '/includes/home/hp-highlights.php');

if ($options['disable_home_services'] != 'disable') {
//include homepage portfolio items
require( TEMPLATEPATH . '/includes/home/hp-services.php');
}

if ($options['disable_home_portfolio'] != 'disable') {
//include homepage portfolio items
require( TEMPLATEPATH . '/includes/home/hp-portfolio.php');
}

if ($options['disable_home_blog'] != 'disable') {
//include homepage latest blog posts
require( TEMPLATEPATH . '/includes/home/hp-blog.php');
}
?>


<?php get_footer(' '); ?>