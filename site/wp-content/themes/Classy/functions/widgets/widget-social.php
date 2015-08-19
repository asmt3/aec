<?php
/******************************************
/* Recent Posts Widget
******************************************/
class classy_social extends WP_Widget {
    /** constructor */
    function classy_social() {
        parent::WP_Widget(false, $name = 'Social Widget');	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $title = apply_filters('widget_title', $instance['title']);
		$linkedin_id = apply_filters('widget_title', $instance['linkedin_id']);
		$linkedin_name = apply_filters('widget_title', $instance['linkedin_name']);
		$twitter_id = apply_filters('widget_title', $instance['twitter_id']);
		$twitter_name = apply_filters('widget_title', $instance['twitter_name']);
		$facebook_url = apply_filters('widget_title', $instance['facebook_url']);
		$facebook_name = apply_filters('widget_title', $instance['facebook_name']);
		$flickr_url = apply_filters('widget_title', $instance['flickr_url']);
		$flickr_name = apply_filters('widget_title', $instance['flickr_name']);
		$dribbble_url = apply_filters('widget_title', $instance['dribbble_url']);
		$dribbble_name = apply_filters('widget_title', $instance['dribbble_name']);
		$googleplus_url = apply_filters('widget_title', $instance['googleplus_url']);
		$googleplus_name = apply_filters('widget_title', $instance['googleplus_name']);
		$vimeo_url = apply_filters('widget_title', $instance['vimeo_url']);
		$vimeo_name = apply_filters('widget_title', $instance['vimeo_name']);
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title ) echo $before_title . $title . $after_title; ?>
							<ul class="classy-widget-social">
                            	<?php if(($linkedin_id) !='') { ?>
                                <!-- linkedin -->
                            	<li><a href="<?php echo $linkedin_id; ?>" title="<?php if(($linkedin_name) !='') { echo $linkedin_name; } else { echo _e('LinkedIn Profile', 'classy'); } ?>" class="linkedin" target="_blank"><?php if(($linkedin_name) !='') { echo $linkedin_name; } else { echo _e('LinkedIn Profile', 'classy'); } ?></a></li>
								<?php } ?>
								<?php if(($twitter_id) !='') { ?>
                                <!-- twitter -->
                                <li><a href="http://www.twitter.com/<?php echo $twitter_id; ?>" title="<?php if(($twitter_name) !='') { echo $twitter_name; } else { echo _e('Follow Us', 'classy'); } ?>" class="twitter" target="_blank"><?php if(($twitter_name) !='') { echo $twitter_name; } else { echo _e('Follow Us', 'classy'); } ?></a></li>
								<?php } ?>
								<?php if(($facebook_url) !='') { ?>
                                <!-- facebook -->
                                <li><a href="<?php echo $facebook_url; ?>" title="<?php if(($facebook_name) !='') { echo $facebook_name; } else { echo _e('Facebook Page', 'classy'); } ?>" class="facebook" target="_blank"><?php if(($facebook_name) !='') { echo $facebook_name; } else { echo _e('Facebook Page', 'classy'); } ?></a></li>
								<?php } ?>
								<?php if(($googleplus_url) !='') { ?> 
                                <!-- Google Plus -->
                                <li><a href="<?php echo $googleplus_url; ?>" title="<?php if(($googleplus_name) !='') { echo $googleplus_name; } else { echo _e('Google Plus', 'classy'); } ?>" class="googleplus" target="_blank"><?php if(($googleplus_name) !='') { echo $googleplus_name; } else { echo _e('Google Plus', 'classy'); } ?></a></li>
                               <?php } ?>
                                <?php if(($flickr_url) !='') { ?>
                                <!-- flickr -->
                                <li><a href="<?php echo $flickr_url; ?>" title="<?php if(($flickr_name) !='') { echo $flickr_name; } else { echo _e('My Flickr', 'classy'); } ?>" class="flickr" target="_blank"><?php if(($flickr_name) !='') { echo $flickr_name; } else { echo _e('My Flickr', 'classy'); } ?></a></li>
								<?php } ?>
                            	<?php if(($dribbble_url) !='') { ?>
                            	<!-- dribbble -->
                                <li><a href="<?php echo $dribbble_url; ?>" title="<?php if(($dribbble_name) !='') { echo $dribbble_name; } else { echo _e('My Dribbbles', 'classy'); } ?>" class="dribbble" target="_blank"><?php if(($dribbble_name) !='') { echo $dribbble_name; } else { echo _e('My Dribbbles', 'classy'); } ?></a></li>
								<?php } ?>
								<?php if(($vimeo_url) !='') { ?>
                            	<!-- vimeo -->
                                <li><a href="<?php echo $vimeo_url; ?>" title="<?php if(($vimeo_name) !='') { echo $vimeo_name; } else { echo _e('Vimeo', 'classy'); } ?>" class="vimeo" target="_blank"><?php if(($vimeo_name) !='') { echo $vimeo_name; } else { echo _e('Vimeo', 'classy'); } ?></a></li>
								<?php } ?>
							</ul>
              <?php echo $after_widget; ?>
        <?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {				
	$instance = $old_instance;
	$instance['title'] = strip_tags($new_instance['title']);
	$instance['linkedin_id'] = strip_tags($new_instance['linkedin_id']);
	$instance['linkedin_name'] = strip_tags($new_instance['linkedin_name']);	
	$instance['twitter_id'] = strip_tags($new_instance['twitter_id']);
	$instance['twitter_name'] = strip_tags($new_instance['twitter_name']);	
	$instance['facebook_url'] = strip_tags($new_instance['facebook_url']);
	$instance['facebook_name'] = strip_tags($new_instance['facebook_name']);
	$instance['flickr_url'] = strip_tags($new_instance['flickr_url']);
	$instance['flickr_name'] = strip_tags($new_instance['flickr_name']);
	$instance['dribbble_url'] = strip_tags($new_instance['dribbble_url']);
	$instance['dribbble_name'] = strip_tags($new_instance['dribbble_name']);
	$instance['googleplus_url'] = strip_tags($new_instance['googleplus_url']);
	$instance['googleplus_name'] = strip_tags($new_instance['googleplus_name']);
	$instance['vimeo_url'] = strip_tags($new_instance['vimeo_url']);
	$instance['vimeo_name'] = strip_tags($new_instance['vimeo_name']);
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $title = esc_attr($instance['title']);
		$linkedin_id = esc_attr($instance['linkedin_id']);
		$linkedin_name = esc_attr($instance['linkedin_name']);
        $twitter_id = esc_attr($instance['twitter_id']);
		$twitter_name = esc_attr($instance['twitter_name']);
		$facebook_url = esc_attr($instance['facebook_url']);
		$facebook_name = esc_attr($instance['facebook_name']);
		$flickr_url = esc_attr($instance['flickr_url']);
		$flickr_name = esc_attr($instance['flickr_name']);
		$dribbble_url = esc_attr($instance['dribbble_url']);
		$dribbble_name = esc_attr($instance['dribbble_name']);
		$googleplus_url = esc_attr($instance['googleplus_url']);
		$googleplus_name = esc_attr($instance['googleplus_name']);
		$vimeo_url = esc_attr($instance['vimeo_url']);
		$vimeo_name = esc_attr($instance['vimeo_name']);
		?>
        
         <!-- title -->
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
        
 		<!-- linkedin -->
		<p>
          <label for="<?php echo $this->get_field_id('linkedin_id'); ?>"><?php _e('LinkedIn URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('linkedin_id'); ?>" name="<?php echo $this->get_field_name('linkedin_id'); ?>" type="text" value="<?php echo $linkedin_id; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('linkedin_name'); ?>"><?php _e('LinkedIn Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('linkedin_name'); ?>" name="<?php echo $this->get_field_name('linkedin_name'); ?>" type="text" value="<?php echo $linkedin_name; ?>" />
        </p>
        
        <!-- twitter -->
		<p>
          <label for="<?php echo $this->get_field_id('twitter_id'); ?>"><?php _e('Twitter ID', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('twitter_name'); ?>"><?php _e('Twitter Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('twitter_name'); ?>" name="<?php echo $this->get_field_name('twitter_name'); ?>" type="text" value="<?php echo $twitter_name; ?>" />
        </p>
        
        <!-- facebook -->
		<p>
          <label for="<?php echo $this->get_field_id('facebook_url'); ?>"><?php _e('Facebook URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" type="text" value="<?php echo $facebook_url; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('facebook_name'); ?>"><?php _e('Facebook Link Name'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('facebook_name'); ?>" name="<?php echo $this->get_field_name('facebook_name'); ?>" type="text" value="<?php echo $facebook_name; ?>" />
        </p>
        
		<!-- Google Plus -->
		<p>
          <label for="<?php echo $this->get_field_id('googleplus_url'); ?>"><?php _e('Google Plus URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('googleplus_url'); ?>" name="<?php echo $this->get_field_name('googleplus_url'); ?>" type="text" value="<?php echo $googleplus_url; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('googleplus_name'); ?>"><?php _e('Google Plus Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('googleplus_name'); ?>" name="<?php echo $this->get_field_name('googleplus_name'); ?>" type="text" value="<?php echo $googleplus_name; ?>" />
        </p>
        
		<!-- flickr -->
		<p>
          <label for="<?php echo $this->get_field_id('flickr_url'); ?>"><?php _e('Flickr URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('flickr_url'); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" type="text" value="<?php echo $flickr_url; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('flickr_name'); ?>"><?php _e('Flickr Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('flickr_name'); ?>" name="<?php echo $this->get_field_name('flickr_name'); ?>" type="text" value="<?php echo $flickr_name; ?>" />
        </p>
        
		<!-- dribbble -->
		<p>
          <label for="<?php echo $this->get_field_id('dribbble_url'); ?>"><?php _e('Dribbble URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('dribbble_url'); ?>" name="<?php echo $this->get_field_name('dribbble_url'); ?>" type="text" value="<?php echo $dribbble_url; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('dribbble_name'); ?>"><?php _e('Dribbble Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('dribbble_name'); ?>" name="<?php echo $this->get_field_name('dribbble_name'); ?>" type="text" value="<?php echo $dribbble_name; ?>" />
        </p>    
		
        <!-- vimeo -->
		<p>
          <label for="<?php echo $this->get_field_id('vimeo_url'); ?>"><?php _e('Vimeo URL', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('vimeo_url'); ?>" name="<?php echo $this->get_field_name('vimeo_url'); ?>" type="text" value="<?php echo $vimeo_url; ?>" />
        </p>
		<p>
          <label for="<?php echo $this->get_field_id('vimeo_name'); ?>"><?php _e('Vimeo Link Name', 'classy'); ?></label> 
          <input class="widefat" id="<?php echo $this->get_field_id('vimeo_name'); ?>" name="<?php echo $this->get_field_name('vimeo_name'); ?>" type="text" value="<?php echo $vimeo_name; ?>" />
        </p>    
        
        
        <?php 
    }


} // class classy_social
// register Recent Posts widget
add_action('widgets_init', create_function('', 'return register_widget("classy_social");'));	
?>