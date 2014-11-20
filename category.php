<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

<div class="grid_9 content-area hfeed">
  <div class="inner">
    <h1><span>Category:</span> <?php printf( __( '%s'), '' . single_cat_title( '', false ) . '' );?> </h1>
    <?php
		$cur_cat_id = get_cat_id( single_cat_title("",false) ); 
		$category = get_cat_slug($cur_cat_id);	
	?>	 
    <!-- Ajax Load More script block -->
	<section id="ajax-load-more">
	<ul class="listing" data-path="<?php echo get_template_directory_uri(); ?>" data-post-type="post" data-tag="" data-category="<?php echo $category; ?>" data-display-posts="6" data-button-text="Older Posts">
	<!-- Load Ajax Posts Here -->
	</ul>
	</section>
	<!-- /Ajax Load More -->
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
