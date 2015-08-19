<?php 
$options = get_option( 'classy_theme_settings' ); 
/******************************************
* output custom css from options panel
******************************************/
?>
<style type="text/css">
<?php if($options['custom_css'] != '') { ?>
<?php echo $options['custom_css']; ?>
<?php } if($options['body_background'] != 'none') { ?>
body{ background-image: url('<?php echo get_template_directory_uri(); ?>/images/backgrounds/<?php echo $options['body_background']; ?>.png'); background-repeat: repeat; }
<?php } if($options['background_color']) { ?>
body { background-color: <?php echo $options['background_color']; ?> !important; }
<?php } if($options['body_font_sizes'] !='12px') { ?>
body { font-size: <?php echo $options['body_font_sizes']; ?>; }
#navigation { font-size: 12px !important; }
<?php } if($options['content_text_color']) {?>
#main, #main p, #main li, #main em { color: <?php echo $options['content_text_color']; ?>; }
<?php } if($options['headings_color']) { ?>
#main h1, #main h2, #main h3, #main h4, #main h5, #main h6 { color: <?php echo $options['headings_color']; ?> !important; }
#main .pricing-table-header h3{ color: #FFF !important; }
<?php } if($options['link_color']) {?>
#main a { color: <?php echo $options['link_color']; ?>; }
h2 a, h3 a, h4 a { color: #000 !important; }
 <?php } if($options['link_hover_color']) {?>
#main a:hover { color: <?php echo $options['link_hover_color']; ?>; }
h2 a:hover,
h3 a:hover,
h4 a:hover { color: <?php echo $options['link_hover_color']; ?> !important; }
<?php } ?>
</style>
<?php ?>