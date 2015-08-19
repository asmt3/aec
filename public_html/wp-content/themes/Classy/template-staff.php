<?php $options = get_option( 'classy_theme_settings' ); ?>
<?php
/*
Template Name: Staff
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
<h1 class="page-title"><?php the_title(); ?></h1>
<?php the_content(''); ?>
<div class="divider"></div>

<?php if($options['disable_staff_cats'] != 'disable') { ?>
    <div id="staff-cats" class="clearfix">
        <?php 
                $taxonomy     = 'staff_departments';
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
            <?php if($options['staff_url'] !='') { ?>
            <li class="current-cat"><a href="<?php echo $options['staff_url']; ?>" title="<?php _e('All Staff'); ?>"><?php _e('All'); ?></a></li>
            <?php } ?>
            <?php wp_list_categories( $args ); ?>
        </ul>
    </div>
    <!-- END staff-cats -->
    <?php } ?>

<div id="staff-wrap" class="clearfix">
<?php
	global $post;
	$args = array(
		'post_type' =>'staff',
		'numberposts' => -1,
		'orderby' => 'ASC'
	);
	$staff_posts = get_posts($args);
?>
<?php if($staff_posts) { ?>
<?php
    $count=0; //start post count at "0"
    foreach($staff_posts as $post) : setup_postdata($post);
    $count++; //add 1 to the total count
	//get staff thumbnail
	$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'staff');
	//get staff meta
	$staff_position = get_post_meta($post->ID, 'classy_staff_position', TRUE);
    ?>
    <div class="grid_4 <?php if($count===1){ echo 'alpha'; } if($count===6){ echo 'omega'; } ?>">
    	<div class="staff-member">
			<?php if ( has_post_thumbnail() ) {  ?>
                <a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="110" height="110" /></a>
            <?php } ?>
            <h2><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
            <?php echo $staff_position; ?>
		</div>
		<!-- END staff-member -->
    </div>
    <!-- END grid_4 -->
    <?php
    //reset the count to "0" and clear the divs
    if($count===6){ echo '<div class="clear"></div>'; $count=0; } ?>
    <?php endforeach; ?>
<?php } wp_reset_postdata(); ?>            

</div>
<!-- END post-content -->       
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(' '); ?>