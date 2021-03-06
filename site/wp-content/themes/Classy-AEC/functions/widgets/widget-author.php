<?php
/**
 * Classy - Authors Widget Class
 */
class classy_simple_authors_widget extends WP_Widget {
 
    /** constructor */
    function classy_simple_authors_widget() {
        parent::WP_Widget(false, $name = 'Simple Authors Widget');
    }
 
    /** @see WP_Widget::widget */
    function widget($args, $instance) {
        extract( $args );
        global $wpdb;
 
        $title = apply_filters('widget_title', $instance['title']);
        $count = $instance['count'];
 
        if(!$size)
            $size = 40;
 
        ?>
              <?php echo $before_widget; ?>
                  <?php if ( $title )
                        echo $before_title . $title . $after_title; ?>
                            <ul class="classy-widget-authors">
                            <?php
 
                                $authors = $wpdb->get_results("SELECT ID FROM $wpdb->users ORDER BY ID");
 
                                foreach($authors as $author) {
 
                                    $author_info = get_userdata($author->ID);
 
                                    echo '<li class="clearfix">';
 
                                        echo '<div style="float: left; margin-left: 5px;">';
 
                                        	echo get_avatar($author->ID, 40);
 
                                        echo '</div>';
 
                                        echo '<a href="' . get_author_posts_url($author->ID) .'" title="View author archive">';
                                            echo $author_info->display_name;
                                            if($count) {
                                                echo '(' . count_user_posts($author->ID) . ')';
                                            }
                                        echo '</a>';
 
                                    echo '</li>';
                                }
                            ?>
                            </ul>
              <?php echo $after_widget; ?>
        <?php
    }
 
    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['count'] = strip_tags($new_instance['count']);
        return $instance;
    }
 
    /** @see WP_Widget::form */
    function form($instance) { 
 
        $title = esc_attr($instance['title']);
        $count = esc_attr($instance['count']);
 
        ?>
         <p>
          <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'clasy'); ?></label>
          <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
        </p>
 
        <p>
          <input id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" type="checkbox" value="1" <?php checked( '1', $count ); ?>/>
          <label for="<?php echo $this->get_field_id('count'); ?>"><?php _e('Display Post Count?', 'classy'); ?></label>
        </p>
        <?php
    }
 
}
// class utopian_recent_posts
add_action('widgets_init', create_function('', 'return register_widget("classy_simple_authors_widget");'));
?>