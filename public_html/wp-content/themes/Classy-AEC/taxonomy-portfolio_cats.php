<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default portfolio column variables
if($options['portfolio_columns'] !='') {
	$portfolio_columns = $options['portfolio_columns']; 
	} else {
		$portfolio_columns = '4';
}
//set variables to their corresponding 960gs classes
if($portfolio_columns == '4') {
	$portfolio_grid_class = 'grid_6';
}
if($portfolio_columns == '3') {
	$portfolio_grid_class = 'grid_8';
}
if($portfolio_columns == '2') {
	$portfolio_grid_class = 'grid_12';
}
?>
<?php get_header(' '); ?>

<div id="portfolio-details">
<?php
	$term =	$wp_query->queried_object;
	echo '<h1 class="page-title">'.$term->name.'</h1>';
	if(category_description() !='') {
		echo category_description();
	}
?>
</div>
<!-- END portfolio-details -->

<?php if($options['disable_portfolio_cats'] != 'disable') { ?>
<div id="portfolio-cats" class="clearfix">
	<?php 
            $taxonomy     = 'portfolio_cats';
            $orderby      = 'name'; 
            $show_count   = 0;      // 1 for yes, 0 for no
            $pad_counts   = 0;      // 1 for yes, 0 for no
            $hierarchical = 1;      // 1 for yes, 0 for no
            $title        = '';
            $args = array(
            'taxonomy'     => $taxonomy,
            'orderby'      => $orderby,
            'show_count'   => $show_count,
            'pad_counts'   => $pad_counts,
            'hierarchical' => $hierarchical,
            'title_li'     => $title
    );
    ?>
    <ul class="clearfix">
    	<?php if($options['portfolio_url'] !='') { ?>
        <li><a href="<?php echo $options['portfolio_url']; ?>" title="<?php _e('Portfolio', 'classy'); ?>"><?php _e('All', 'classy'); ?></a></li>
		<?php } ?>
		<?php wp_list_categories( $args ); ?>
	</ul>
</div>
<!-- END portfolio-cats -->
<?php } ?>

<div id="portfolio-wrap" class="clearfix">
<?php
    $count=0; //start post count at "0"
    while (have_posts()) : the_post();
    $count++; //add 1 to the total count
	//get portfolio thumbnail
	$portfolio_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio');
	//get portfolio meta
	$portfolio_url = get_post_meta($post->ID, 'classy_portfolio_url', TRUE);
	$portfolio_description = get_post_meta($post->ID, 'classy_portfolio_description', TRUE);
    ?>
       <div class="<?php echo $portfolio_grid_class; ?> <?php if($count==1){ echo 'alpha'; } ?> <?php if($count==$portfolio_columns){ echo 'omega'; } ?>">
    	<div class="portfolio-item">
			<?php if ( has_post_thumbnail() ) {  ?>
                <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>">
                <?php if($portfolio_columns == '4') { ?>
                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio'); ?>
                    <img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="200" height="140" />
                <?php } ?>
                <?php if($portfolio_columns == '3') { ?>
                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-three'); ?>
                    <img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="280" height="220" />
                <?php } ?>
                <?php if($portfolio_columns == '2') { ?>
                    <?php $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio-two'); ?>
                    <img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="440" height="380" />
                <?php } ?>
                </a>
            <?php } ?>
            <?php if($options['disable_portfolio_titles'] != 'disable') { ?>
    		<h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <?php } ?>
            <?php
             if($options['disable_portfolio_description'] != 'disable') {
                if(($portfolio_description) !='') {
                    echo $portfolio_description;
                }
                else { 
                    echo excerpt(15);
                }
             }
            ?>
		</div>
        <!-- END .portfolio-item -->
	</div>
    <!-- END <?php echo $portfolio_grid_class; ?> -->
	<?php
    //reset the count to "0" and clear the divs
    if($count==$portfolio_columns){ $count=0; echo '<div class="clear"></div>'; } ?>
    <?php endwhile; ?>
</div>
<!-- END #portfolio-wrap -->
	<?php
    //get pagination
	if (function_exists("pagination")) { pagination(); } ?>
</div>
<!-- END post-content -->       
<?php get_footer(' '); ?>