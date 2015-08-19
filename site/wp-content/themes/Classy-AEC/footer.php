<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//set default variables
if($options['footer_columns'] !='') {
	$footer_columns = $options['footer_columns']; 
	} else {
		$footer_columns = '4';
}
?>
</div>
<!-- END #main -->
</div>
<!-- END #wrap .container_24 -->

<span class="footer-top-pattern"></span>

<?php if ($options['disable_widgetized_footer'] != 'disable') { ?> 
<div  id="footer" class="container_24 clearfix">

<?php if($footer_columns == '4') { ?>
    <div class="grid_6">
    	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_6 --> 
    	<div class="grid_6">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_6 -->
    <div class="grid_6">
    	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_6 -->  
    <div class="grid_6 omega">   
    	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Fourth Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_6 -->
<?php } ?>

<?php if($footer_columns == '3') { ?>
    <div class="grid_8">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_8 -->
    <div class="grid_8">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_8 -->
    <div class="grid_8 omega">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Third Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_8 .omega -->
<?php } ?>

<?php if($footer_columns == '2') { ?>
    <div class="grid_12 ">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('First Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_12 -->
    <div class="grid_12 omega">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Second Footer Area') ) : ?><?php endif; ?>
    </div>
    <!-- END .grid_12 .omega -->
<?php } ?>

</div>
<!-- END #Footer .container_24 -->
<?php } ?>

<div id="footer-extended" class="container_24 clearfix">
	<div id="copyright" class="grid_20">
    	<?php if($options['copyright'] !='') { echo $options['copyright']; } else { ?>
		&copy; <?php echo date('Y'); ?>  <?php bloginfo( 'name' ); ?>
        <?php } ?>
	</div>
    <!-- END #copyright .grid_20 -->
    <div id="top" class="grid_4">
    	<a href="#top" title="Back To Top"><?php _e('Top', 'classy'); ?> &uarr;</a>
    </div>
    <!-- END #top .grid_4 -->
    <span id="footer-triangle-left"></span>
    <span id="footer-triangle-right"></span>
</div>
<!-- END #footer-extended .container_24  -->
<!-- WP Footer -->
<?php wp_footer(); ?>
</body>
</html>