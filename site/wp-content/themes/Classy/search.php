<?php get_header(' '); ?>
<div id="post"> 
<?php if (have_posts()) : ?>
	<div id="search-title"><h1><?php _e('Search results for','classy'); ?>: <span>"<?php the_search_query(); ?>"</span></h1></div>
<?php get_template_part('loop', 'entry') ?>

<?php if (function_exists("pagination")) { pagination($additional_loop->max_num_pages); } ?>
<?php else : ?>
	<div id="search-title"><h1><?php _e('Search results for','classy'); ?>: <span>"<?php the_search_query(); ?>"</span></h1></div>
	<p><?php _e('Sorry, nothing found for that search','classy'); ?></p>
<?php endif; ?>
</div>
<!-- END #post -->
<?php get_sidebar(' '); ?>
<?php get_footer(' '); ?>