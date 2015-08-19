<?php
//get theme options
$options = get_option( 'classy_theme_settings' );
//get slider type and set slides as default
if($options['slider_type'] !='') {
	$slider_type = $options['slider_type'];
	} else {
		$slider_type = 'nivo';
}
?>
<!DOCTYPE html>

<!-- BEGIN html -->
<html <?php language_attributes(); ?>>
<!-- Design by AJ Clarke (http://www.wpexplorer.com) - Powered by WordPress (http://wordpress.org) -->

<!-- BEGIN head -->
<head>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<!-- Title -->	
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>
    
<!-- Favicon -->
<?php if($options['upload_favicon'] !='') { ?>
<link rel="icon" type="image/png" href="<?php echo $options['upload_favicon']; ?>" />
<?php } ?>

<!-- Main Stylesheet -->
<link rel="stylesheet" type="text/css" href="<?php bloginfo('stylesheet_url'); ?>" />
<?php if($options['theme_skin'] !='') { if($options['theme_skin'] !='default') { ?>

<!-- Color Style -->
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/skins/<?php echo $options['theme_skin']; ?>.css" />
<?php } } ?>

<?php
// includes custom fonts output
include( TEMPLATEPATH . '/includes/custom-fonts.php');
if($options['disable_custom_colors'] != 'disable') {
	// includes custom colors output
	include( TEMPLATEPATH . '/includes/custom-style.php');
} 
?>

<!-- WP Head -->
<?php
//WordPress hook, do not remove
wp_head(); ?>

<?php if(is_front_page()) { ?>
<script>
jQuery(function($){
	$(document).ready(function(){
		<?php if ($options['disable_home_slider'] != 'disable') { ?>
		<?php if($slider_type =='content') { ?>
		// slides for homepage
		$('#slides').slides({
			generateNextPrev: false,
			pagination: true,
			play: <?php if($options['slides_play_time']) { echo $options['slides_play_time']; } else { echo '5000'; } ?>,
			slideSpeed: <?php if($options['slides_speed']) { echo $options['slides_speed']; } else { echo '350'; } ?>,
    		pause: 2500,
    		hoverPause: true,
			autoHeight: true
		});	
		<?php } ?>
		<?php if($slider_type =='nivo') { ?>
		//nivo slider
		$('#slider_nivo').nivoSlider({
			effect: '<?php if($options['nivo_transition_effect'] != '') { echo $options['nivo_transition_effect']; } else { echo 'random'; } ?>',
			slices: <?php if($options['nivo_slices']) { echo $options['nivo_slices']; } else { echo '15'; } ?>,
			boxCols: <?php if($options['nivo_box_columns']) { echo $options['nivo_box_columns']; } else { echo '8'; } ?>,
			boxRows: <?php if($options['nivo_box_rows']) { echo $options['nivo_box_rows']; } else { echo '4'; } ?>,
			animSpeed: <?php if($options['nivo_animation_speed']) { echo $options['nivo_animation_speed']; } else { echo '250'; } ?>,
			pauseTime: <?php if($options['nivo_pause_time']) { echo $options['nivo_pause_time']; } else { echo '3000'; } ?>,
			directionNav: <?php if($options['disable_nivo_buttons'] != 'disable' ) { echo 'true'; } else { echo 'false'; } ?>,
			controlNav: <?php if($options['disable_nivo_bullets'] != 'disable' ) { echo 'true'; } else { echo 'false'; } ?>,
			prevText: '',
			nextText: ''
		});	
		<?php } ?>
		<?php } ?>
		<?php if($options['disable_home_portfolio'] != 'disable') { ?>
		//portfolio carousel
		$('.carousel').elegantcarousel({
			delay: <?php if($options['home_portfolio_slide_delay'] != '') { echo $options['home_portfolio_slide_delay']; } else { echo '150'; } ?>,
			fade:300,
			slide: <?php if($options['home_portfolio_slide_speed'] != '') { echo $options['home_portfolio_slide_speed']; } else { echo '500'; } ?>,
			effect:'slide',					  
			orientation:'horizontal',
			loop: false,
			autoplay: <?php if($options['home_portfolio_auto_play'] != 'disable' ) { echo 'true'; } else { echo 'false'; } ?>
		});
	<?php } ?>
	});
});
</script>
<?php } ?>

<?php 
// Get And Show Analytics Code 
echo stripslashes($options['analytics']); 
?>

</head>
<!-- END Head -->

<!-- START Body -->
<body <?php body_class(''); ?>>

<div id="wrap" class="container_24 clearfix">

	<div id="header" class="clearfix"> 
    
    	<div id="header-logo" class="<?php if($options['enable_full_logo'] =='enable') { echo 'full-logo'; } else { echo 'grid_16'; } ?>">	
            <?php if($options['upload_mainlogo'] !='') { ?>
            	<a href="<?php echo home_url('') ?>/" title="<?php bloginfo( 'name' ); ?>"><img src="<?php echo $options['upload_mainlogo']; ?>" alt="<?php bloginfo( 'name' ) ?>" /></a>
            <?php } else { ?>
				<?php if (is_front_page()) { ?>
                <h1><a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                <?php } else { ?>
                <h2><a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ); ?>"><?php bloginfo( 'name' ); ?></a></h2>
                <?php } ?>
                <p><?php bloginfo( 'description' ); ?></p>
            <?php } ?>        
        </div>
        <!-- END #header-logo .<?php if($options['enable_full_logo'] =='enable') { echo 'full-logo'; } else { echo 'grid_16'; } ?> -->  
        
		<?php if($options['phone'] !='') { ?>
        <div id="phone">
			<?php echo $options['phone']; ?>
        </div>
        <?php } ?>
           
		<?php
		//show search form unless disabled
        if($options['disable_search'] != 'disable') { get_search_form(' '); } ?>
    
</div><!-- END header -->

<div id="navigation" class="clearfix">
    <?php
    //define main navigation
    wp_nav_menu( array(
        'theme_location' => 'main nav',
        'sort_column' => 'menu_order',
        'menu_class' => 'sf-menu',
        'fallback_cb' => 'default_menu'
    )); ?>
</div>
<!-- END navigation -->

<div id="main" class="grid_24 clearfix">

<?php
if(is_front_page()) {
	if ($options['disable_home_slider'] != 'disable') { 
		//include homepage slider
		include( TEMPLATEPATH . '/includes/sliders/'.$slider_type.'.php');
	}
	
	if($options['home_static'] !='') {
		echo '<div id="static-home-content">'.$options['home_static'].'</div>';
	}
}
?>