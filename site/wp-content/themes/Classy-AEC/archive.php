<?php get_header(); ?>
<?php if (have_posts()) : ?>
<div id="post">
	<?php $post = $posts[0]; ?>
	<?php if (is_category()) { ?>
	<h1 id="archive-title"><?php single_cat_title(); ?></h1>
	<?php } elseif( is_tag() ) { ?>
	<h1 id="archive-title"><?php _e('Posts Tagged','classy')?> &quot;<?php single_tag_title(); ?>&quot;</h1>
	<?php  } elseif (is_day()) { ?>
	<h1 id="archive-title"><?php _e('Archive for','classy')?> <?php the_time('F jS, Y'); ?></h1>
	<?php  } elseif (is_month()) { ?>
	<h1 id="archive-title"><?php _e('Archive for','classy')?> <?php the_time('F, Y'); ?></h1>
	<?php  } elseif (is_year()) { ?>
	<h1 id="archive-title"><?php _e('Archive for','classy')?> <?php the_time('Y'); ?></h1>
	<?php  } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 id="archive-title"><?php _e('Blog Archives', 'classy')?></h1>
	<?php } ?>
    <div id="page-description">
		<?php echo category_description(); ?> 
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