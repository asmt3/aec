<?php
/*
Template Name: Site Map
*/
?>
<?php get_header(''); ?>
<div id="post" class="full-width">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<h1 class="page-title"><?php the_title(); ?></h1>		
	<?php the_content(); ?>
	<?php endwhile; ?>
	<?php endif; ?>
    <div class="divider"></div>
    
    <div id="sitemap-template" class="container_24">
    
    	<div class="grid_8 alpha">
			<h2><?php _e('Feeds','classy'); ?></h2>
				<ul>  
        			<li><a title="Full content" href="feed:<?php bloginfo('rss2_url'); ?>">Main RSS</a></li>  
        			<li><a title="Comment Feed" href="feed:<?php bloginfo('comments_rss2_url'); ?>">Comment Feed</a></li>  
   				</ul>  
			<h2><?php _e('Categories','classy'); ?></h2>
            	
				<?php $args = array(
						  'orderby'            => 'name',
						  'order'              => 'ASC',
						  'style'              => 'list',
						  'show_count'         => 1,
						  'hide_empty'         => 1,
						  'use_desc_for_title' => 1,
						  'child_of'           => 0,
						  'hierarchical'       => true,
						  'title_li'           => __( '' ),
						  'number'             => NULL
						);
					?> 
                    <ul>
                    <?php wp_list_categories( $args ); ?>
                    </ul>
            
            <h2><?php _e('Tags','classy'); ?></h2>
            <?php wp_tag_cloud(array(
				'format' => 'list',
				'smallest' => 12,
				'largest' => 12,
				'unit' => 'px',
				'number' => 20,
				'orderby'  => 'name',
				'order' => 'ASC',
				'taxonomy' => 'post_tag'
				));
			?>
            
            <h2><?php _e('Archives by Month','classy'); ?></h2>
            <ul>
            	<?php wp_get_archives('type=monthly&limit=10'); ?>
            </ul>

        </div>
        <!-- END .grid_8 .alpha -->
        
        
		<div class="grid_8">
			<h2><?php _e('Pages','classy'); ?></h2>
       		<ul><?php wp_list_pages("title_li=" ); ?></ul>  
        </div>
        <!-- END .grid_8 -->
        
        
		<div class="grid_8 omega">
        	<h2><?php _e('All Posts','classy'); ?></h2>
            <ul><?php $archive_query = new WP_Query('showposts=1000&cat=-8');  
                    while ($archive_query->have_posts()) : $archive_query->the_post(); ?>  
                        <li>  
                            <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
								<?php the_title(); ?>
                            </a>
                        </li>  
                    <?php endwhile; ?>  
            </ul>  
        </div>
        <!-- END .grid_8 omega -->
        
         <div class="clear"></div>

    </div>
    <!-- END .container_24 -->
    
</div><!-- END #post .full-width -->    
<?php get_footer(''); ?>