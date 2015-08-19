<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//get and set post count for loop
if($options['home_portfolio_count'] !='') {
	$home_portfolio_count = $options['home_portfolio_count'];
	} else {
	$home_portfolio_count ='8';
}
//get post type ==> portfolio
	global $post;
	$args = array(
		'post_type' =>'portfolio',
		'numberposts' => $home_portfolio_count,
	);
	$portfolio_posts = get_posts($args);
?>
<?php if($portfolio_posts) { ?>
<div id="home-portfolio">
	<h2><span><?php if ($options['home_portfolio_title'] !='') { echo $options['home_portfolio_title']; } else {  _e('Recent Work','classy'); } ?></span></h2>
    <div id="portfolio-carousel" class="horizontal">
    <div class="carousel">
        <div class="carousel_container">
            <ul class="portfolio-wrap">
                    <?php
                    foreach($portfolio_posts as $post) : setup_postdata($post);
                    //get portfolio thumbnail
                    $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio');
                    ?>
                    <?php if ( has_post_thumbnail() ) {  ?>
                    <li><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" alt="<?php the_title(); ?>" width="200" height="140"  /></a></li>
                    <?php } ?>
                <?php endforeach; ?>
             </ul>
            <!-- end .portfolio-wrap -->
            </div>
            <!-- end .carousel_container -->
            <a class="carousel_prev" href=""><?php _e('Previous', 'classy') ?></a>
            <a class="carousel_next" href=""><?php _e('Next', 'classy') ?></a>
        </div>
        <!-- end .carousel -->
    </div>
    <!--END portfolio-carousel -->
</div>
<!--END home-portfolio -->
<?php } wp_reset_postdata(); ?>