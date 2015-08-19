<?php 
//get theme options
$options = get_option( 'classy_theme_settings' );
/******************************************
* output custom fonts
******************************************/
?>
<?php $fonts = array('Arial','Arial','Lucida Sans Unicode','Times New Roman','Verdana'); ?>
<?php if($options['body_font'] != 'Default') { ?>
<?php if (!empty($options['body_font']) && !in_array($options['body_font'], $fonts)) { ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $options['body_font']); ?>' rel='stylesheet' type='text/css'>
<?php array_push($fonts, $options['body_font']); ?>
<?php } } ?>
<?php if($options['header_font'] != 'Default') { ?>
<?php if (!empty($options['header_font']) && !in_array($options['header_font'], $fonts)) { ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $options['header_font']); ?>' rel='stylesheet' type='text/css'>
<?php array_push($fonts, $options['header_font']); ?>
<?php } } ?>
<?php if($options['nav_font'] != 'Default') { ?>
<?php if (!empty($options['nav_font']) && !in_array($options['nav_font'], $fonts)) { ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $options['nav_font']); ?>' rel='stylesheet' type='text/css'>
<?php array_push($fonts, $options['nav_font']); ?>
<?php } } ?>
<?php if($options['phone_font'] != 'Default') { ?>
<?php if (!empty($options['phone_font']) && !in_array($options['phone_font'], $fonts)) { ?>
<link href='http://fonts.googleapis.com/css?family=<?php echo str_replace(' ', '+', $options['phone_font']); ?>' rel='stylesheet' type='text/css'>
<?php array_push($fonts, $options['phone_font']); ?>
<?php } } ?>
<style type="text/css">
<?php if($options['body_font'] != 'Default') { ?>
body { <?php if (!empty($options['body_font'])) { echo 'font-family: ' . $options['body_font']; } ?> !important; }
#navigation{ font-family: 'Helvetica Nue', Arial, Helvetica, sans-serif; }
<?php } else { ?>
<?php } ?>
<?php if($options['header_font'] != 'Default') { ?>
h1,h2,h3,h4,h5,h6 {<?php if (!empty($options['header_font'])) { echo 'font-family: ' . $options['header_font']; } ?> !important; }
<?php } else { ?>
<?php } ?>
<?php if($options['nav_font'] != 'Default') { ?>
#navigation { <?php if (!empty($options['nav_font'])) { echo 'font-family: ' . $options['nav_font']; } ?>  !important; }
<?php } else { ?>
<?php } ?>
<?php if($options['phone_font'] != 'Default') { ?>
#phone { <?php if (!empty($options['phone_font'])) { echo 'font-family: ' . $options['phone_font']; } ?>  !important; }
<?php } ?>
</style>