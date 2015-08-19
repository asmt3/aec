<?php
/*-----------------------------------------------------------------------------------*/
/* Edit Theme Activation Message */
/*-----------------------------------------------------------------------------------*/


function optionsframework_admin_message() { 
	?>
    <script type="text/javascript">
    jQuery(function(){
    	
        var message = '<p><?php _e('New theme activated. This theme comes with an', 'classy'); ?> <a href="<?php echo admin_url('admin.php?page=classy-settings'); ?>"><?php _e('options panel', 'classy'); ?></a>';
    	jQuery('.themes-php #message2').html(message);
		
    });
    </script>
    <?php
	
}

add_action('admin_head', 'optionsframework_admin_message'); 

/*-----------------------------------------------------------------------------------*/
/* START Admin */
/*-----------------------------------------------------------------------------------*/

//Init theme options to white list our options
function classy_settings_init(){
register_setting( 'classy_settings', 'classy_theme_settings' );
}

// add js for admin
function classy_scripts() {
	wp_enqueue_script("theme-admin", get_template_directory_uri()."/admin/js/admin-scripts.js", false, "1.0");
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_script('bbq', get_template_directory_uri(). '/admin/js/jquery.ba-bbq.min.js');
	wp_enqueue_script( 'mfields-colorpicker', get_template_directory_uri(). '/admin/color-picker/colorpicker.js', array( 'jquery' ), false, true );
}

//add css for admin
function classy_style() {
	wp_enqueue_style('thickbox');
	wp_enqueue_style('admin-style', get_bloginfo('stylesheet_directory') . '/admin/css/admin-style.css' );
	wp_enqueue_style('mfields-colorpicker', get_bloginfo('stylesheet_directory') . '/admin/color-picker/colorpicker.css' );
}
function classy_echo_scripts()
{
?>

<script type="text/javascript">
//<![CDATA[
jQuery(document).ready(function() {

// Media Uploader
window.formfield = '';

jQuery('.upload_image_button').live('click', function() {
	window.formfield = jQuery('.upload_field',jQuery(this).parent());
	tb_show('', 'media-upload.php?type=image&TB_iframe=true');
	return false;
});

window.original_send_to_editor = window.send_to_editor;
window.send_to_editor = function(html) {
	if (window.formfield) {
		imgurl = jQuery('img',html).attr('src');
		window.formfield.val(imgurl);
		tb_remove();
	}
	else {
		window.original_send_to_editor(html);
	}
	window.formfield = '';
	window.imagefield = false;
}

});
//]]> 
</script>
<?php
}

if (isset($_GET['page']) && $_GET['page'] == 'classy-settings') {
	add_action('admin_print_scripts', 'classy_scripts'); 
	add_action('admin_print_styles', 'classy_style');
	add_action('admin_head', 'classy_echo_scripts');
}

/**
* Load up the menu page
*/
function classy_add_settings_page() {
add_menu_page( __( 'Theme Settings', 'classy' ), __( 'Theme Settings', 'classy' ), 'manage_options', 'classy-settings', 'classy_theme_settings_page');
}

add_action( 'admin_init', 'classy_settings_init' );
add_action( 'admin_menu', 'classy_add_settings_page' );

/************************************
* set up all the select field options
************************************/
$enable_disable = array('enable','disable');
$disable_enable = array('disable','enable');
$theme_skins = array('default', 'black', 'blue','brown','cyan','green','navy','orange','pink','purple','red');
$backgrounds = array('none','bright-squares','bricks', 'black-scales,','carbon-fiber','checker','circles','concrete','crosses','criss-xcross','cubes','dark-leather','dark-mosaic','dark-stripes','dark-wood','double-lined','fabric','freckles', 'mbossed','grass','green-dust','grey-blocks','grid','grunge','inflicted','light-leather','noisy','silver-scales','project-paper','padded','robots','vichy','wavecut','whitey','white-carbon');
$slider_types = array('nivo','content');
$slider_effects = array('random', 'fade', 'fold', 'slideInRight', 'slideInLeft', 'sliceDown', 'sliceDownLeft', 'sliceUp', 'sliceUpLeft', 'sliceUpDown', 'sliceUpDownLeft', 'boxRandom', 'boxRain', 'boxRainReverse', 'boxRainGrow', 'boxRainGrowReverse');
$hp_highlights_columns = array('4','3','2','1');
$hp_blog_columns = array('2','3','4');
$hp_services_columns = array('4','3','2','1');
$services_columns = array('4','3','2','1');
$portfolio_columns = array('4','3','2');
$footer_columns = array('4','3','2');
$post_orderby = array('date','title');
$post_order = array('DESC','ASC');
$body_font_sizes = array('12px', '14px', '16px', '18px');
$fonts = array('Default','Arial','Georgia','Lucida Sans Unicode','Times New Roman','Verdana','Aclonica', 'Allan','Allerta','Allerta Stencil','Amaranth','Annie Use Your Telescope','Anonymous Pro','Anton','Architects Daughter','Arimo','Artifika','Arvo','Astloch','Bangers','Bentham','Bevan','Bigshot One','Brawler','Buda','Cabin','Cabin','Cabin Sketch','Calligraffitti','Candal','Cantarell','Cardo','Carter One','Caudex','Cedarville Cursive','Cherry Cream Soda','Chewy','Coda','Coming Soon','Copse','Corben','Cousine','Covered By Your Grace','Crafty Girls','Crimson Text','Crushed','Cuprum','Damion','Dancing Script','Dawning of a New Day','Didact Gothic','Droid Sans','Droid Sans Mono','Droid Serif','EB Garamond','Expletus Sans','Fontdiner Swanky','Francois','Geo','Goudy Bookletter','Gruppo','Holtwood One SC','Homemade Apple','IM Fell','Inconsolata','Indie Flower', 'Istok Web', 'Irish Grover','Josefin Sans','Josefin Slab','Judson','Jura','Just Another Hand','Just Me Again Down Here','Kameron','Kenia','Kranky','Kreon','Kristi','La Belle Aurore','Lato','League Script','Lekton','Limelight','Lobster','Lobster Two','Lora','Luckiest Guy','Maiden Orange','Mako','Maven pro','Meddon','MedievalSharp','Megrim','Merriweather','Metrophobic','Michroma','Miltonian','Molengo','Monofett','Mountains of Christmas','Muli','Neucha','Neutron','News Cycle','Nixie One','Nobile','Nova','Nunito','OFL Sorts Mill Goudy TT','Old Standard','Open Sans','Orbitron','Oswald','Over the Rainbow','PT Sans','PT Serif','Pacifico','Paytone One','Permanent Marker','Philosopher','Play','Playfair Display','Podkova','Puritan','Quattrocento','Quattrocento Sans','Radley','Raleway','Redressed','Reenie Beanie','Rock Salt','Rokkitt','Ruslan Display','Schoolbell','Shadows Into Light','Shanti','Sigmar One','Six Caps','Slackey','Smythe','Sniglet','Special Elite','Sue Ellen Francisco','Sunshiney','Swanky and Moo Moo','Syncopate','Tangerine','Tenor','Terminal Dosis Light','The Girl next Door','Tinos','Ubunto','Ultra','UnifrakturCook','UnifrakturMaguntia','Unkempt','VT323','Vibur','Vollkorn','Waiting For The Sunrise','Wallpoet','Walter Turncoat','Wire One','Yanone Kaffeesatz','Zeyada');

/**********************************
* Create the options page
*********************************/
function classy_theme_settings_page() {
global $enable_disable, $disable_enable, $theme_skins, $backgrounds, $slider_types, $slider_effects, $hp_highlights_columns, $hp_blog_columns,  $portfolio_columns, $hp_services_columns, $services_columns, $footer_columns, $body_font_sizes, $fonts, $post_orderby, $post_order;

if ( ! isset( $_REQUEST['updated'] ) )
$_REQUEST['updated'] = false;

?>
<div class="wrap">

<?php
// If the form has just been submitted, this shows the notification
if ( $_GET['settings-updated'] ) { ?>
<div id="message" class="updated fade classy-message"><p><?php _e('Options Saved','classy'); ?></p></div>
<?php } ?>

<h2 class="dummy-heading"></h2>

<div id="options-header">
	<h2><?php _e( 'Theme Settings','classy'); ?><div id="icon-options-general" class="icon32"></div></h2>
</div>
<!-- END header -->

<div id="panel-content">
<form method="post" action="options.php">

<?php
settings_fields( 'classy_settings' );
$options = get_option( 'classy_theme_settings' );
?>


<div id="wrap-left">
    <ul class="tabs">
        <li><a href="#tab1"><?php _e('General Settings','classy'); ?></a></li>
        <li><a href="#tab2"><?php _e('Styling','classy'); ?></a></li>
        <li><a href="#tab3"><?php _e('Fonts','classy'); ?></a></li>
        <li><a href="#tab4"><?php _e('Homepage','classy'); ?></a></li>
        <li><a href="#tab5"><?php _e('Homepage Slider','classy'); ?></a></li>
        <li><a href="#tab6"><?php _e('Portfolio','classy'); ?></a></li>
        <li><a href="#tab7"><?php _e('Services','classy'); ?></a></li>
        <li><a href="#tab8"><?php _e('Staff','classy'); ?></a></li>
        <li><a href="#tab9"><?php _e('Blog','classy'); ?></a></li>
        <li><a href="#tab10"><?php _e('Footer','classy'); ?></a></li>
        <li><a href="#tab11"><?php _e('CSS','classy'); ?></a></li>
    </ul>
</div><!-- END wrap-left -->


<div id="wrap-right">
<div class="tab_container">


<!--  General Settings -->
<div id="tab1" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix">
<h3><?php _e('Site Logo','classy'); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[upload_mainlogo]" class="regular-text upload_field" type="text" size="36" name="classy_theme_settings[upload_mainlogo]" value="<?php esc_attr_e( $options['upload_mainlogo'] ); ?>" />
<input class="upload_image_button button-secondary" type="button" value="Choose Image" />

<?php if($options['upload_mainlogo']) { ?>
<br /><br />
<img src="<?php echo $options['upload_mainlogo']; ?>" alt="logo" width="220" class="ta_image_preview" />
<?php } ?>

</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[upload_mainlogo]"><?php _e( 'Upload an image, choose an image from your media libray (make sure to hit "insert to post") or type in the URL for the main logo. This is the main logo for your website','classy'); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Enable/Disable Full-Width Logo', 'classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[enable_full_logo]">
<?php foreach ($disable_enable as $option) { ?>
<option <?php if ($options['enable_full_logo'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[enable_full_logo]"><?php _e( 'Enable this option to show your image across the whole header. This means you can add a logo without any top, left, right or bottom margin.' ,'classy' ); ?></label>	
</div><!-- End one_half -->
			
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Favicon' ,'classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[upload_favicon]" class="regular-text upload_field" type="text" size="36" name="classy_theme_settings[upload_favicon]" value="<?php esc_attr_e( $options['upload_favicon'] ); ?>" />

<?php if($options['upload_favicon']) { ?>
<br /><br />
<img src="<?php echo $options['upload_favicon']; ?>" alt="favicon" class="ta_favicon_preview" />
<?php } ?>

</div><!-- End one_half -->

<div class="one_half">
<label class="description abouttxtdescription" for="classy_theme_settings[upload_favicon]"><?php _e( 'Type in the URL for the site favicon.' ,'classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Analytics Code', 'classy' ); ?></h3>

<div class="one_half">
<textarea id="classy_theme_settings[analytics]" class="regular-text" name="classy_theme_settings[analytics]" rows="5"><?php esc_attr_e( $options['analytics'] ); ?></textarea>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[analytics]"><?php _e( 'Enter your analytics tracking code. This code is added to your header tag.' ,'classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">

<h3><?php _e( 'Enable/Disable Search Bar', 'classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_search]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_search'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[phone]"><?php _e( 'Select to enable or disable the search bar in the theme header.' ,'classy' ); ?></label>

</div><!-- End one_half -->


</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Header Phone Number' ,'classy' ); ?></h3>

<div class="one_half">
<textarea id="classy_theme_settings[phone]" class="regular-text" name="classy_theme_settings[phone]" rows="5"><?php esc_attr_e( $options['phone'] ); ?></textarea>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[phone]"><?php _e( 'Enter a phone number for your header region above the search bar. Leave blank to disable.<br />HTML is allowed.' ,'classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


</ul>
</div>
<!--end main tab-->



<!--  Styling -->
<div id="tab2" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Color Skin','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[theme_skin]">
<?php foreach ($theme_skins as $option) { ?>
<option <?php if ($options['theme_skin'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</div><!-- End one_half -->		

<div class="one_half">
<label class="description" for="classy_theme_settings[theme_skin]"><?php _e( 'Choose your color skin. Default is white/gray.','classy' ); ?></label>	
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Enable/Disable Custom Color Options','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[disable_custom_colors]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_custom_colors'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_custom_colors]"><?php _e( 'Disable this option if you arent using the custom color options below to keep your header clean.','classy' ); ?></label>	
</div><!-- End one_half -->
	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Background Image','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[body_background]">
<?php foreach ($backgrounds as $option) { ?>
<option <?php if ($options['body_background'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->				

<div class="one_half">
<label class="description" for="classy_theme_settings[body_background]"><?php _e( 'Choose a body background image from the built-in patterns. To upload your own background set this option to "none" then go to Apperance --> Backgrounds in your editor.','classy' ); ?></label>	
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Background Color','classy' ); ?></h3>

<div class="one_half">
<script type="text/javascript">
jQuery(document).ready(function($) {  
  $('.cp_background_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		$('.cp_background_color').val('#'+hex);
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#cp_preview_background_color div').css({'backgroundColor':'#'+hex, 'backgroundImage': 'none', 'borderColor':'#'+hex});
		$('#cp_preview_background_color').prev('input').attr('value', '#'+hex);
	}
  })	
  .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
  });
});
</script>
<input id="classy_theme_settings[background_color]" class="regular-text cp_background_color" type="text" name="classy_theme_settings[background_color]" value="<?php esc_attr_e( $options['background_color'] ); ?>"/>
<div id="cp_preview_background_color" class="color-preview">
	<div style="background-color: <?php esc_attr_e( $options['background_color'] ); ?>;"></div>
</div>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[background_color]"><?php _e( 'Choose a color for the site background.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Main Text Color','classy' ); ?></h3>

<div class="one_half">
<script type="text/javascript">
jQuery(document).ready(function($) {  
  $('.cp_content_text_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		$('.cp_content_text_color').val('#'+hex);
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#cp_preview_content_text_color div').css({'backgroundColor':'#'+hex, 'backgroundImage': 'none', 'borderColor':'#'+hex});
		$('#cp_preview_content_text_color').prev('input').attr('value', '#'+hex);
	}
  })	
  .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
  });
});
</script>
<input id="classy_theme_settings[content_text_color]" class="regular-text cp_content_text_color" type="text" name="classy_theme_settings[content_text_color]" value="<?php esc_attr_e( $options['content_text_color'] ); ?>"/>
<div id="cp_preview_content_text_color" class="color-preview">
		<div style="background-color: <?php esc_attr_e( $options['content_text_color'] ); ?>;"></div>
</div>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[content_text_color]"><?php _e( 'Choose a color for the main content text.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Headings Color: h1,h2,h3...','classy' ); ?></h3>

<div class="one_half">
<script type="text/javascript">
jQuery(document).ready(function($) {  
  $('.cp_headings_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		$('.cp_headings_color').val('#'+hex);
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#cp_preview_headings_color div').css({'backgroundColor':'#'+hex, 'backgroundImage': 'none', 'borderColor':'#'+hex});
		$('#cp_preview_headings_color').prev('input').attr('value', '#'+hex);
	}
  })	
  .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
  });
});
</script>
<input id="classy_theme_settings[headings_color]" class="regular-text cp_headings_color" type="text" name="classy_theme_settings[headings_color]" value="<?php esc_attr_e( $options['headings_color'] ); ?>"/>
<div id="cp_preview_headings_color" class="color-preview">
		<div style="background-color: <?php esc_attr_e( $options['headings_color'] ); ?>;"></div>
</div>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[headings_color]"><?php _e( 'Choose a color for your headings.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Link Color','classy' ); ?></h3>
<div class="one_half">
<script type="text/javascript">
jQuery(document).ready(function($) {  
  $('.cp_link_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		$('.cp_link_color').val('#'+hex);
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#cp_preview_link_color div').css({'backgroundColor':'#'+hex, 'backgroundImage': 'none', 'borderColor':'#'+hex});
		$('#cp_preview_link_color').prev('input').attr('value', '#'+hex);
	}
  })	
  .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
  });
});
</script>
<input id="classy_theme_settings[link_color]" class="regular-text cp_link_color" type="text" name="classy_theme_settings[link_color]" value="<?php esc_attr_e( $options['link_color'] ); ?>"/>
<div id="cp_preview_link_color" class="color-preview">
		<div style="background-color: <?php esc_attr_e( $options['link_color'] ); ?>;"></div>
</div>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[link_color]"><?php _e( 'Choose a color for your main links.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Link Hover Color','classy' ); ?></h3>

<div class="one_half">
<script type="text/javascript">
jQuery(document).ready(function($) {  
  $('.cp_link_hover_color').ColorPicker({
	onSubmit: function(hsb, hex, rgb) {
		$('.cp_link_hover_color').val('#'+hex);
	},
	onBeforeShow: function () {
		$(this).ColorPickerSetColor(this.value);
		return false;
	},
	onChange: function (hsb, hex, rgb) {
		$('#cp_preview_link_hover_color div').css({'backgroundColor':'#'+hex, 'backgroundImage': 'none', 'borderColor':'#'+hex});
		$('#cp_preview_link_hover_color').prev('input').attr('value', '#'+hex);
	}
  })	
  .bind('keyup', function(){
	$(this).ColorPickerSetColor(this.value);
  });
});
</script>
<input id="classy_theme_settings[link_hover_color]" class="regular-text cp_link_hover_color" type="text" name="classy_theme_settings[link_hover_color]" value="<?php esc_attr_e( $options['link_hover_color'] ); ?>"/>
<div id="cp_preview_link_hover_color" class="color-preview">
		<div style="background-color: <?php esc_attr_e( $options['link_hover_color'] ); ?>;"></div>
</div>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[link_hover_color]"><?php _e( 'Choose a color for your main links.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div><!--end styling tab-->


<!--  Fonts -->

<div id="tab3" class="tab_content">
<h2><?php _e('Font Options','classy') ;?></h2>
<p class="ta_description"><span><?php _e('This theme allows you to choose between some really great Web fonts provided by Google. If you want to see what these fonts look like please checkout the','classy') ;?> <a href="http://www.google.com/webfonts"><?php _e('Google Web Fonts Directory','classy') ;?></a>. <br /><br /><strong><?php _e('Note:','classy') ;?></strong> <?php _e('Some fonts look better then others at different sizes. If the text looks bad, try changing the font-size. If you change the navigation font and it looks horrible, try removing the bold from the navigation in style.css under ".sf-menu a"','classy') ;?></span></p>

<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Body Font Size','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[body_font_sizes]">
<?php foreach ($body_font_sizes as $option) { ?>
<option <?php if ($options['body_font_sizes'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</div><!-- End one_half -->			

<div class="one_half">
<label class="description" for="classy_theme_settings[body_font_sizes]"><?php _e( 'Select a font size for your main body text. Default is 12.','classy' ); ?></label>	
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Body Font','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[body_font]">
<?php foreach ($fonts as $option) { ?>
<option <?php if ($options['body_font'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>		
</div><!-- End one_half -->	

<div class="one_half">	
<label class="description" for="classy_theme_settings[body_font]"><?php _e( 'Choose your body font. I really like "Open Sans".','classy' ); ?></label>	
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Headings Font','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[header_font]">
<?php foreach ($fonts as $option) { ?>
<option <?php if ($options['header_font'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</div><!-- End one_half -->	

<div class="one_half">
<label class="description" for="classy_theme_settings[header_font]"><?php _e( 'Choose your headings font. I really like "Open Sans" and "San Serif".','classy' ); ?></label>	
</div><!-- End one_half -->
			
</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Navigation Menu Font','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[nav_font]">
<?php foreach ($fonts as $option) { ?>
<option <?php if ($options['nav_font'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">	
<label class="description" for="classy_theme_settings[nav_font]"><?php _e( 'Choose your navigation bar font.','classy' ); ?></label>		
</div><!-- End one_half -->
	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Phone Number Font','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[phone_font]">
<?php foreach ($fonts as $option) { ?>
<option <?php if ($options['phone_font'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</div><!-- End one_half -->

<div class="one_half">		
<label class="description" for="classy_theme_settings[phone_font]"><?php _e( 'Choose your phone number font.','classy' ); ?></label>		
</div><!-- End one_half -->
	
</li>
<!-- option block -->

</ul>
</div>

<!--  Homepage -->

<div id="tab4" class="tab_content">
<ul>


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Blog Style Home','classy' ); ?></h3>	

<div class="one_half">	
<select name="classy_theme_settings[enable_blog_home]">
<?php foreach ($disable_enable as $option) { ?>
<option <?php if ($options['enable_blog_home'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->	

<div class="one_half">
<label class="description" for="classy_theme_settings[enable_blog_home]"><?php _e( 'Select to enable or disable the blog style homepage.','classy' ); ?></label>	
</div><!-- End one_half -->
		
</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Homepage Highlights Columns','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[hp_highlights_column]">
<?php foreach ($hp_highlights_columns as $option) { ?>
<option <?php if ($options['hp_highlights_column'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">					
<label class="description" for="classy_theme_settings[hp_highlights_column]"><?php _e( 'Select how many columns you want for the homepage highlights.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Home Services','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_home_services]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_home_services'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_home_services]"><?php _e( 'Select to enable or disable the services section on the homepage.','classy' ); ?></label>
</div><!-- End one_half -->
	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Services Title','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_services_title]" class="regular-text" type="text" name="classy_theme_settings[home_services_title]" value="<?php esc_attr_e( $options['home_services_title'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_services_title]"><?php _e( 'Enter a custom title for the services homepage section.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Service Category Slug','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[service_home_slug]" class="regular-text" type="text" name="classy_theme_settings[service_home_slug]" value="<?php esc_attr_e( $options['service_home_slug'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[service_home_slug]"><?php _e( 'Enter the slug of the service category you want for your homepage. This is used if you want just 1 category of services to show up on the home.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Services Columns?', 'classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[hp_services_columns]">
<?php foreach ($hp_services_columns as $option) { ?>
<option <?php if ($options['hp_services_columns'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>				
</div><!-- End one_half -->

<div class="one_half">	
<label class="description" for="classy_theme_settings[hp_services_columns]"><?php _e( 'Select how many columns you want for the homepage services.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Services?','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_services_count]" class="regular-text" type="text" name="classy_theme_settings[home_services_count]" value="<?php esc_attr_e( $options['home_services_count'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_services_count]"><?php _e( 'Select how many services you want to show on the homepage, based on published date - aka: your latest services.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Links On Services','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_hp_services_title_link]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_hp_services_title_link'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->	

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_hp_services_title_link]"><?php _e( 'Select to enable or disable links on your homepage services titles.','classy' ); ?></label>
</div><!-- End one_half -->

		
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Portfolio Carousel','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_home_portfolio]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_home_portfolio'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_home_portfolio]"><?php _e( 'Select to enable or disable the homepage portfolio carousel.','classy' ); ?></label>
</div><!-- End one_half -->

	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Carousel Title','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_portfolio_title]" class="regular-text" type="text" name="classy_theme_settings[home_portfolio_title]" value="<?php esc_attr_e( $options['home_portfolio_title'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_portfolio_title]"><?php _e( 'Enter a custom title for the Recent Work homepage section.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Item Count','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_portfolio_count]" class="regular-text" type="text" name="classy_theme_settings[home_portfolio_count]" value="<?php esc_attr_e( $options['home_portfolio_count'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_portfolio_count]"><?php _e( 'Enter the ammount of posts you want to show for the homepage portfolio carousel.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Portfolio Carousel Auto Play','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[home_portfolio_auto_play]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['home_portfolio_auto_play'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_portfolio_count]"><?php _e( 'Enter the ammount of posts you want to show for the homepage portfolio carousel.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Carousel Delay Time','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_portfolio_slide_delay]" class="regular-text" type="text" name="classy_theme_settings[home_portfolio_slide_delay]" value="<?php esc_attr_e( $options['home_portfolio_slide_delay'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_portfolio_slide_delay]"><?php _e( 'Enter a delay time in milliseconds for your homepage portfolio carousel. Default is 150.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Carousel Scroll Speed','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_portfolio_slide_speed]" class="regular-text" type="text" name="classy_theme_settings[home_portfolio_slide_speed]" value="<?php esc_attr_e( $options['home_portfolio_slide_speed'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_portfolio_slide_speed]"><?php _e( 'Enter a slide speed in milliseconds for your homepage portfolio carousel. Default is 500.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Latest Blog Posts','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_home_blog]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_home_blog'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_home_blog]"><?php _e( 'Select to enable or disable the latest blog posts section on the homepage.','classy' ); ?></label>
</div><!-- End one_half -->

		
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Latest Blog Posts Title','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_blog_title]" class="regular-text" type="text" name="classy_theme_settings[home_blog_title]" value="<?php esc_attr_e( $options['home_blog_title'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_blog_title]"><?php _e( 'Enter a custom title for the latest blog posts homepage section.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block --

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Recent Blog Posts Columns','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[hp_blog_column]">
<?php foreach ($hp_blog_columns as $option) { ?>
<option <?php if ($options['hp_blog_column'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">			
<label class="description" for="classy_theme_settings[hp_blog_column]"><?php _e( 'Select how many columns you want the homepage recent blog posts section.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Latest Blog Posts?','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_blog_count]" class="regular-text" type="text" name="classy_theme_settings[home_blog_count]" value="<?php esc_attr_e( $options['home_blog_count'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_blog_count]"><?php _e( 'How many latest blog posts do you want to show on the homepage?','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Latest Blog Posts Excerpt Length','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[home_blog_excerpt]" class="regular-text" type="text" name="classy_theme_settings[home_blog_excerpt]" value="<?php esc_attr_e( $options['home_blog_excerpt'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_blog_excerpt]"><?php _e( 'How many words do you want for the latest blog posts excerpt?','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div>
<!-- end homepage -->


<!--  Slider -->
<div id="tab5" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Homepage Slider','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[disable_home_slider]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_home_slider'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_home_slider]"><?php _e( 'Select to enable your homepage slider.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Static Slider Alternative','classy' ); ?></h3>

<div class="one_half">
<textarea id="classy_theme_settings[home_static]" class="regular-text" name="classy_theme_settings[home_static]" rows="8"><?php esc_attr_e( $options['home_static'] ); ?></textarea>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[home_static]"><?php _e( 'If you disabled the homepage slider you may want to add a static image or embeded video. Insert your HTML here. If the slider is not disabled it will show up right below the slider.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Homepage Slider Type','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[slider_type]">
<?php foreach ($slider_types as $option) { ?>
<option <?php if ($options['slider_type'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">			
<label class="description" for="classy_theme_settings[slider_type]"><?php _e( 'Select your slider style. Below are the options for each slider.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Content Slider - Slide Speed','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[slides_speed]" class="regular-text" type="text" name="classy_theme_settings[slides_speed]" value="<?php esc_attr_e( $options['slides_speed'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[slides_speed]"><?php _e( 'Type in the time in milliseconds for your desired sliding animation speed. Default is 350.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Content Slider - Play Time','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[slides_play_time]" class="regular-text" type="text" name="classy_theme_settings[slides_play_time]" value="<?php esc_attr_e( $options['slides_play_time'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[slides_play_time]"><?php _e( 'Type in the play time in milliseconds for your content slider. This is the transition speed. Default is 5000.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Transition','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[nivo_transition_effect]">
<?php foreach ($slider_effects as $option) { ?>
<option <?php if ($options['nivo_transition_effect'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>	
</div><!-- End one_half -->				

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_transition_effect]"><?php _e( 'Choose the type of transition you want your slider to have.Default is random.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Slices','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[nivo_slices]" class="regular-text" type="text" name="classy_theme_settings[nivo_slices]" value="<?php esc_attr_e( $options['nivo_slices'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_slices]"><?php _e( 'Type in the amount of slices for the slider.Default is 15.','classy' ); ?></label>
</div><!-- End one_half -->


</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Box Columns','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[nivo_box_columns]" class="regular-text" type="text" name="classy_theme_settings[nivo_box_columns]" value="<?php esc_attr_e( $options['nivo_box_columns'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_box_columns]"><?php _e( 'Type in the amount of box columns for the slider. Default is 4.','classy' ); ?></label>
</div><!-- End one_half -->


</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Box Rows','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[nivo_box_rows]" class="regular-text" type="text" name="classy_theme_settings[nivo_box_rows]" value="<?php esc_attr_e( $options['nivo_box_rows'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_box_rows]"><?php _e( 'Type in the amount of box rows for the slider. Default is 4.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Animation Speed','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[nivo_animation_speed]" class="regular-text" type="text" name="classy_theme_settings[nivo_animation_speed]" value="<?php esc_attr_e( $options['nivo_animation_speed'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_animation_speed]"><?php _e( 'Type in the speed for the slide transitions in milliseconds. Default is 500.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Pause Time','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[nivo_pause_time]" class="regular-text" type="text" name="classy_theme_settings[nivo_pause_time]" value="<?php esc_attr_e( $options['nivo_pause_time'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[nivo_pause_time]"><?php _e( 'This is the time the image is displayed before it transits to the next, in milliseconds. Default is 3000.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Enable/Disable Slider Caption','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[disable_caption]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_caption'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>		
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_caption]"><?php _e( 'Enable or disable the slider caption. This is the bar underneath the image slider that shows the title.','classy' ); ?></label>
</div><!-- End one_half -->

	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Enable/Disable Slider Arrow Navigation','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_nivo_buttons]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_nivo_buttons'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_nivo_buttons]"><?php _e( 'Enable or disable the nivo image slider arrow navigation (next and previous arrows)','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'NivoSlider - Enable/Disable Slider Bullet Navigation','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_nivo_bullets]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_nivo_bullets'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_nivo_bullets]"><?php _e( 'Enable or disable the nivo image slider bullet navigation.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div><!--end sldier tab-->



<!--  Portfolio -->
<div id="tab6" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Page URL','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[portfolio_url]" class="regular-text" type="text" name="classy_theme_settings[portfolio_url]" value="<?php esc_attr_e( $options['portfolio_url'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[portfolio_url]"><?php _e( 'Enter your portfolio page URL for use in the portfolio category navigation. This creates the all link','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Portfolio Template Columns','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[portfolio_columns]">
<?php foreach ($portfolio_columns as $option) { ?>
<option <?php if ($options['portfolio_columns'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">		
<label class="description" for="classy_theme_settings[portfolio_columns]"><?php _e( 'Select how many columns you want for the portfolio page template. Default is 4.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Portfolio Items Per Page','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[portfolio_post_count]" class="regular-text" type="text" name="classy_theme_settings[portfolio_post_count]" value="<?php esc_attr_e( $options['portfolio_post_count'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[portfolio_post_count]"><?php _e( 'How many portfolio items do you want to show per page (used for portfolio pagination).','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Organize Portfolio Items By','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[portfolio_orderby]">
<?php foreach ($post_orderby as $option) { ?>
<option <?php if ($options['portfolio_orderby'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[portfolio_orderby]"><?php _e( 'Select if you want your portfolio template items organized by date or title.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Portfolio Category Navigation','classy' ); ?></h3>

<div class="one_half">	
<select name="classy_theme_settings[disable_portfolio_cats]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_portfolio_cats'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_portfolio_cats]"><?php _e( 'Enable or disable your portfolio category navigation. These are the links at the top that go to the various portfolio categories.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Portfolio Page Titles','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[disable_portfolio_titles]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_portfolio_titles'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_portfolio_titles]"><?php _e( 'Enable or disable the portfolio titles on the main portfolio page.','classy' ); ?></label>
</div><!-- End one_half -->


</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Portfolio Descriptions','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_portfolio_description]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_portfolio_description'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_portfolio_description]"><?php _e( 'Enable or disable the portfolio descriptions on the main portfolio template.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Related Projects Title','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[related_portfolio_title]" class="regular-text" type="text" name="classy_theme_settings[related_portfolio_title]" value="<?php esc_attr_e( $options['related_portfolio_title'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[related_portfolio_title]"><?php _e( 'Enter a custom name for the "related projects" title.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Related Portfolio Items','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_related_portfolio]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_related_portfolio'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_related_portfolio]"><?php _e( 'Enable or disable the related portfolio items on single portfolio posts.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Related Portfolio Items','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[related_portfolio_count]" class="regular-text" type="text" name="classy_theme_settings[related_portfolio_count]" value="<?php esc_attr_e( $options['related_portfolio_count'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[related_portfolio_count]"><?php _e( 'How many related portfolio posts do you want to show in the single portfolio carousel. Default is 8.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


</ul>
</div>


<!--  Services -->
<div id="tab7" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Main Service Page URL','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[service_url]" class="regular-text" type="text" name="classy_theme_settings[service_url]" value="<?php esc_attr_e( $options['service_url'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[portfolio_url]"><?php _e( 'Enter your service page URL for use in the service category navigation. This creates the all link.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Services Category Navigation','classy' ); ?></h3>

<div class="one_half">	
<select name="classy_theme_settings[disable_services_cats]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_services_cats'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_services_cats]"><?php _e( 'Enable or disable your services category navigation. These are the links at the top that go to the various services categories.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Columns For The Services Template','classy'); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[services_column]">
<?php foreach ($services_columns as $option) { ?>
<option <?php if ($options['services_column'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">			
<label class="description" for="classy_theme_settings[services_column]"><?php _e( 'Select how many columns you want for the services page template.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Links On Services Titles','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_services_title_link]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_services_title_link'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_services_title_link]"><?php _e( 'Enable or disable the links on the services titles. Great if you do not want detailed service pages.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div>


<!--  Staff -->
<div id="tab8" class="tab_content">
<ul>


<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Staff Page URL','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[staff_url]" class="regular-text" type="text" name="classy_theme_settings[staff_url]" value="<?php esc_attr_e( $options['staff_url'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[staff_url]"><?php _e( 'Enter your staff page template URL to create the "all" link in the staff page navigation.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Staff Category Navigation','classy' ); ?></h3>

<div class="one_half">	
<select name="classy_theme_settings[disable_staff_cats]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_staff_cats'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_staff_cats]"><?php _e( 'Enable or disable your staff category navigation. These are the links at the top that go to the various staff categories on the main staff page.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div>


<!--  Blog -->
<div id="tab9" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Blog Excerpt Length','classy' ); ?></h3>

<div class="one_half">
<input id="classy_theme_settings[blog_excerpt_length]" class="regular-text" type="text" name="classy_theme_settings[blog_excerpt_length]" value="<?php esc_attr_e( $options['blog_excerpt_length'] ); ?>" />
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[blog_excerpt_length]"><?php _e( 'Enter your desidered blog excerpt length (# of words) for blog and archive pages. Default is 60 words.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Full Blog Posts Instead of Excerpts','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_excerpt]">
<?php foreach ($disable_enable as $option) { ?>
<option <?php if ($options['disable_excerpt'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_excerpt]"><?php _e( 'Enable or disable full blog posts instead of excerpts on the blog page and archive pages.','classy' ); ?></label>
</div><!-- End one_half -->
	
</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Thumbnails On Blog Entries','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_entry_thumbnail]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_entry_thumbnail'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_entry_thumbnail]"><?php _e( 'Enable or disable automatic thumbnails on blog entries.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Thumbnails On Blog Posts','classy' ); ?></h3>

<div class="one_half">	
<select name="classy_theme_settings[disable_post_thumbnail]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_post_thumbnail'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_post_thumbnail]"><?php _e( 'Enable or disable auto thumbnails on single blog posts.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable About The Author Sections','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_author]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_author'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_author]"><?php _e( 'Enable or disable about the author sections on single blog posts.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Related Posts','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_related_posts]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_related_posts'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_related_posts]"><?php _e( 'Enable or disable related posts on single blog posts.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</ul>
</div><!--end blog tab-->



<!--  Footer -->

<div id="tab10" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'Enable/Disable Widgetized Footer','classy' ); ?></h3>	

<div class="one_half">
<select name="classy_theme_settings[disable_widgetized_footer]">
<?php foreach ($enable_disable as $option) { ?>
<option <?php if ($options['disable_widgetized_footer'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[disable_widgetized_footer]"><?php _e( 'Enable or disable the widgetized footer region.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

<!-- option block -->
<li class="clearfix"><h3><?php _e( 'How Many Columns For The Footer','classy' ); ?></h3>

<div class="one_half">
<select name="classy_theme_settings[footer_columns]">
<?php foreach ($footer_columns as $option) { ?>
<option <?php if ($options['footer_columns'] == $option ){ echo 'selected="selected"'; } ?>><?php echo htmlentities($option); ?></option>
<?php } ?>
</select>
</div><!-- End one_half -->

<div class="one_half">	
<label class="description" for="classy_theme_settings[footer_columns]"><?php _e( 'Select how many columns do you want for your widgetized footer?','classy' ); ?></label>
</div><!-- End one_half -->


<!-- option block -->
<li class="clearfix">
<h3><?php _e( 'Custom Copyright Notice','classy' ); ?></h3>

<div class="one_half">
<textarea id="classy_theme_settings[copyright]" class="regular-text" name="classy_theme_settings[copyright]" rows="7"><?php esc_attr_e( $options['copyright'] ); ?></textarea>
</div><!-- End one_half -->

<div class="one_half">
<label class="description" for="classy_theme_settings[copyright]"><?php _e( 'Enter a custom copyright message for your footer area. HTML is allowed if you want links.','classy' ); ?></label>
</div><!-- End one_half -->

</li>
<!-- option block -->

</li>
<!-- option block -->

</ul>
</div><!--end footer tab-->




<!--  CSS -->

<div id="tab11" class="tab_content">
<ul>

<!-- option block -->
<li class="clearfix" style="border-top: 0px;">
<h3><?php _e( 'Custom CSS Code','classy' ); ?></h3>
<label class="description" for="classy_theme_settings[custom_css]"><?php _e( 'Enter your custom css here if you don not want to override the style.css file','classy' ); ?></label>
<textarea id="classy_theme_settings[custom_css]" class="regular-text" name="classy_theme_settings[custom_css]" rows="20"><?php esc_attr_e( $options['custom_css'] ); ?></textarea>


</li>
<!-- option block -->

</ul>
</div><!--end css tab-->


</div><!--end tab container-->
</div><!-- END wrap-right -->
<div class="clear"></div>

<p class="submit-changes">
<input type="submit" class="button-primary" value="<?php _e( 'Save Options', 'classy' ); ?>" />
</p>
</form>
</div><!-- END panel-content -->
</div><!-- END wrap -->
<?php
}
/**
* Sanitize and validate input. Accepts an array, return a sanitized array.
*/
function classy_options_validate( $input ) {
global $select_options, $radio_options;

// Our checkbox value is either 0 or 1
if ( ! isset( $input['option1'] ) )
$input['option1'] = null;
$input['option1'] = ( $input['option1'] == 1 ? 1 : 0 );

// Say our text option must be safe text with no HTML tags
$input['sometext'] = wp_filter_nohtml_kses( $input['sometext'] );


// Our radio option must actually be in our array of radio options
if ( ! isset( $input['radioinput'] ) )
$input['radioinput'] = null;
if ( ! array_key_exists( $input['radioinput'], $radio_options ) )
$input['radioinput'] = null;

// Say our textarea option must be safe text with the allowed tags for posts
$input['sometextarea'] = wp_filter_post_kses( $input['sometextarea'] );

return $input;
}