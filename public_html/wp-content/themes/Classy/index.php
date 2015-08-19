<?php
//get theme options
$options = get_option( 'classy_theme_settings' ); ?>
<?php get_header(' '); ?>


<?php if ($options['enable_blog_home'] != 'enable') { ?> 

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

<?php } else { ?>

<div id="post">
    <h1><?php bloginfo( 'name' ) ?></h1>
    <div id="page-description">
        <?php bloginfo( 'description' ) ?>
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
        <?php get_template_part('loop', 'entry'); ?>
        <?php endif; ?>                
        <?php if (function_exists("pagination")) { pagination(); } ?>
</div>
<!-- END post -->
<?php wp_reset_query(); ?>
<?php get_sidebar(''); ?>

<?php } ?>

<?php get_footer(' '); ?>