<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//get and set post count for loop
if($options['related_portfolio_count'] !='') {
	$related_portfolio_count = $options['related_portfolio_count'];
	} else{
	$related_portfolio_count ='8';
}
//get related portfolio posts
$cats = wp_get_post_terms($post->ID, 'portfolio_cats');
if ($cats) {  ?>
<div id="related-portfolio" class="clearfix">
	<h2><span><?php if ($options['related_portfolio_title'] !='') { echo $options['related_portfolio_title']; } else {  _e('Related Projects','classy'); } ?></span></h2>
    <div id="portfolio-carousel" class="horizontal">
    <div class="carousel">
        <div class="carousel_container">
            <ul class="portfolio-wrap">
				<?php
                $args = array(
                    'post_type' => 'portfolio',
                    'posts_per_page' => $related_portfolio_count,
                    'tax_query' => array(
                        'relation' => 'OR',
                        array(
                            'taxonomy' => 'portfolio_cats',
                            'terms' => $cats[0]->term_id
                        ),
                    )
                );
                $my_query = new WP_Query($args);
                if( $my_query->have_posts() ) {
				$count=0; //start post count at "0"
                while ($my_query->have_posts()) : $my_query->the_post();
				$count++; //add 1 to the total count
                //get portfolio thumbnail
                $thumbail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'portfolio');
                //get portfolio meta
                $portfolio_url = get_post_meta($post->ID, 'portfolio_url', TRUE);
                ?>
                <?php if ( has_post_thumbnail() ) {  ?>
                <li <?php if($count===4){ ?> class="remove-margin" <?php } ?>><div class="inner"><a href="<?php the_permalink(' ') ?>" title="<?php the_title(); ?>"><img src="<?php echo $thumbail[0]; ?>" alt="<?php the_title(); ?>" width="200" height="140" /></a></div></li>
			<?php } ?>
			<?php
			//reset the count to "0" and clear the divs
			if($count===4){ $count=0; } ?>
		<?php endwhile; wp_reset_query(); } ?>
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
<!--END related-portfolio -->
<?php } ?>