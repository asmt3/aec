<?php get_header(); ?>
<?php if (have_posts()) : ?>
<div id="post">
	<?php
	if(isset($_GET['author_name'])) :
	$curauth = get_userdatabylogin($author_name);
	else :
	$curauth = get_userdata(intval($author));
	endif;
	?>
	<h1 id="archive-title">About: <?php echo $curauth->nickname; ?></h1>
    
    <div id="page-description">
		<?php echo $curauth->user_description; ?>
	</div>
    <!-- END #page-description -->   
	<?php
    // get post entry
	get_template_part('loop', 'entry') ?>    
	<?php
    //get pagination
	if (function_exists("pagination")) { pagination(); } ?>
</div>
<!-- END #post -->
<?php endif; ?>     
<?php get_sidebar(' '); ?>	   
<?php get_footer(' '); ?>