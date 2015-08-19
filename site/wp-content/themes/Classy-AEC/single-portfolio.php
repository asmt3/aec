<?php
//get theme options
$options = get_option( 'classy_theme_settings' ); ?>
<?php get_header(''); ?>
	<div id="post" class="full-width clearfix">
	<?php
    if (have_posts()) :
	while (have_posts()) : the_post();
	//get single portfolio images
	$portfolio_url = get_post_meta($post->ID, 'classy_portfolio_url', true);
	$portfolio_url_text = get_post_meta($post->ID, 'classy_portfolio_url_text', true);
	$portfolio_below_right = get_post_meta($post->ID, 'classy_portfolio_below_right', true);
	//get featured image data
	$single_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'single-portfolio' );
	//get portfolio video
	$portfolio_video_embed = get_post_meta($post->ID, 'classy_portfolio_video_embed', true);
	//get first portfolio slider image
	$portfolio_slider_1 = get_post_meta($post->ID, 'classy_portfolio_slider_1' . $count, true);
	?>
    
    <div id="portfolio-single-left">
    
        <h1 id="post-title"><?php the_title(); ?></h1>
		<div class="post-meta clearfix">
    	<?php _e('Posted Under:','classy') ?><?php echo get_the_term_list( get_the_ID(), 'portfolio_cats', ' ', ' , ', ' ') ?>
		</div>
    	<!-- END .post-meta -->
		<?php the_content(''); ?>
        
        <div class="clear"></div>
        
        <?php if($portfolio_url !='') { ?>
        	<p id="single-portfolio-link"><a href="<?php echo $portfolio_url; ?>" title="<?php if($portfolio_url_text !='') { echo $portfolio_url_text; } else { echo 'View Project'; } ?>" target="_blank" rel="nofollow"><?php if($portfolio_url_text !='') { echo $portfolio_url_text; } else { echo 'View Project'; } ?> &rarr;</a></p>
        <?php } ?>
        
	</div>
	<!-- END portfolio-single-left -->
    
    <div id="portfolio-single-right">
    
    	<?php
		//show slider if at least 1 meta image exists
        if($portfolio_slider_1 !='') { ?>

			<div id="slides_single" class="slides-js clearfix">
				<div class="slides_container">
					<?php if(has_post_thumbnail()) { ?>
                    <div>
                    	<img src="<?php echo $single_image[0]; ?>" height="<?php echo $single_image[2]; ?>" width="<?php echo $single_image[1]; ?>" />
                    </div>
                    <?php } ?>
                    
                    <?php
					//Display all of the extra portfolio images for image slider
					$count = 1;
					while($count <= 9) {	
						$image_url = get_post_meta($post->ID, 'classy_portfolio_slider_' . $count, true);
						$image_id = classy_get_image_id($image_url);
						if($image_id) {
							$image = wp_get_attachment_image_src($image_id, 'single-portfolio');
								echo '<div>';
								echo '<img src="' . $image[0] . '"/>';
								echo '</div>';
						} else {
							break;
						}
						$count++;
					}
                ?>
        		</div>
        		<!-- end slides_container -->
    		</div>
    		<!-- end slides -->      
            
            <?php } else { ?>
                
			<?php
            //show embedded video if option isn't blank
            if($portfolio_video_embed !='') { ?>
            
            <?php echo do_shortcode($portfolio_video_embed); ?>
            
            <?php } else { ?>
                
			<?php if(has_post_thumbnail()) { ?>
                <?php the_post_thumbnail( 'single-portfolio'); ?>
            <?php } ?>
            <?php } ?>
            <?php } ?>
            
            <?php if($portfolio_below_right !=='') {
				echo '<div id="portfolio-single-right-below"> '. do_shortcode($portfolio_below_right) .' </div>';
				} ?>
            
	</div>
	<!-- END portfolio-single-right -->
    
    <div class="clear"></div> <!-- clear floats -->
    
    <?php
	//include related portfolio items if not disabled
	if($options['disable_related_portfolio'] != 'disable') {
    	include( TEMPLATEPATH . '/includes/portfolio/related-portfolio.php'); 
	}
	?>
    
    <?php endwhile; ?>
    <?php endif; ?>	
    
</div>
<!-- END #post .full-width -->
<?php get_footer(''); ?>