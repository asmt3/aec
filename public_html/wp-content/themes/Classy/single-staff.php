<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
?>
<?php get_header(''); ?>

<?php
//start loop
if (have_posts()) :
while (have_posts()) : the_post();
//get featured image
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-staff');
//get staff meta
$position = get_post_meta($post->ID, 'classy_staff_position', true);
$qualification = get_post_meta($post->ID, 'classy_staff_qualification', true);
$phone = get_post_meta($post->ID, 'classy_staff_phone', true);
$email = get_post_meta($post->ID, 'classy_staff_email', true);
$blog = get_post_meta($post->ID, 'classy_staff_blog', true);
$twitter = get_post_meta($post->ID, 'classy_staff_twitter', true);
$facebook = get_post_meta($post->ID, 'classy_staff_facebook', true);
$googleplus = get_post_meta($post->ID, 'classy_staff_googleplus', true);
$skype = get_post_meta($post->ID, 'classy_staff_skype', true);
$linkedin = get_post_meta($post->ID, 'classy_staff_linkedin', true);
$dribbble = get_post_meta($post->ID, 'classy_staff_dribbble', true);
$forrst = get_post_meta($post->ID, 'classy_staff_forrst', true);
$vimeo = get_post_meta($post->ID, 'classy_staff_vimeo', true);
?>    
<div id="post">  
    <h1><?php the_title(); ?></h1>
    
    <div class="grid_8 alpha">
    	<img src="<?php echo $featured_image[0]; ?>" alt="<?php the_title(); ?>" width="290" height="310" id="single-staff-image" />
    </div>
    <!-- END .grid_8 alpha --->
    
    <div class="grid_9 omega">
        <div id="staff-meta">
        
        <?php if(get_the_term_list( get_the_ID(), 'staff_departments', ' ', ' , ', ' ') !='') { ?>
        <p>
        	<span><?php _e('Department','classy'); ?>:</span> <?php echo get_the_term_list( get_the_ID(), 'staff_departments', ' ', ' , ', ' ') ?>
        </p>
        <?php } ?>
        
        <?php if($position !='') { ?>
            <p>
                <span><?php _e('Position','classy'); ?>:</span> <?php echo $position; ?>
            </p>
		<?php } ?>
           
		<?php if($qualification !='') { ?>
			<p>
                <span><?php _e('Qualification','classy'); ?>:</span> <?php echo $qualification; ?>
            </p>
		<?php } ?>
           
		<?php if($phone !='') { ?> 
			<p>
                <span><?php _e('Phone','classy'); ?>:</span> <?php echo $phone; ?>
            </p>
		<?php } ?>
            
		<?php if($email !='') { ?>
			<p>
                <span><?php _e('Email','classy'); ?>:</span> <?php echo $email; ?>
            </p>
		<?php } ?>

		<?php if($blog !='') { ?>
			<p>
                <span><?php _e('Blog','classy'); ?>:</span> <a href="<?php echo $blog; ?>"><?php echo $blog; ?></a>
            </p>
		<?php } ?>
        
        <ul id="staff-social" class="clearfix">
			<?php if($twitter != '') { ?>
            <li><a href="<?php echo $twitter; ?>" title="Twitter" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/twitter.png" alt="Twitter" height="16"  width="16" /></a></li>
            <?php } if($facebook != '') { ?>
            <li><a href="<?php echo $facebook; ?>" title="Facebook" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/facebook.png" alt="Facebook"  height="16"  width="16" /></a></li>
            <?php } if($googleplus != '') { ?>
            <li><a href="<?php echo $googleplus; ?>" title="Google Plus"class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/googleplus.png" alt="Google Plus" height="16"  width="16" /></a></li>
            <?php } if($skype != '') { ?>
            <li><a href="<?php echo $skype; ?>" title="Skype" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/skype.png" alt="Skype"  height="16"  width="16" /></a></li>
            <?php } if($linkedin != '' ) { ?>
            <li><a href="<?php echo $linkedin; ?>" title="Linkedin" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/linkedin.png" alt="Linkedin"  height="16"  width="16" /></a></li> 
            <?php } if($dribbble != '') { ?>
            <li><a href="<?php echo $dribbble; ?>" title="Dribbble" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/dribbble.png" alt="Dribbble"  height="16"  width="16" /></a></li>
            <?php } if($forrst != '' ) { ?>
            <li><a href="<?php echo $forrst; ?>" title="Forrst" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/forrst.png" alt="Forrst"  height="16"  width="16" /></a></li>
            <?php } if($vimeo != '' ) { ?>
            <li><a href="<?php echo $vimeo; ?>" title="Vimeo" class="tooltip"><img src="<?php echo get_template_directory_uri(); ?>/images/social/vimeo.png" alt="Forrst"  height="16"  width="16" /></a></li>
            <?php } ?>
        </ul>
        
        </div>
        <!-- END #staff-meta -->
    </div>
    <!-- END .grid_8 --->
    
    <div  class="grid_17 alpha omega">
    	<h2><?php _e('About Me','classy') ?></h2>
    	<?php the_content(); ?>
        <?php comments_template(); ?>  
    </div>
    <!-- END grid_!7 -->
    
</div>
<!-- END #post -->
<?php endwhile; ?>
<?php endif; ?>	
            
<?php get_sidebar('pages'); ?>
<?php get_footer(''); ?>