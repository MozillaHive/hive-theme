<?php get_header(); ?>

<div class="grid_9 content-area hfeed">
  <div class="inner">
    <h1><span>Tag:</span><?php printf( __( '%s'), '' . single_cat_title( '', false ) . '' );?></h1>
    <?php $tag = get_query_var('tag'); ?>
  	<!-- Ajax Load More script block -->
	<section id="ajax-load-more">
	<ul class="listing" data-path="<?php echo get_template_directory_uri(); ?>" data-post-type="post" data-tag="<?php echo $tag; ?>" data-display-posts="6" data-button-text="Older Posts">
	<!-- Load Ajax Posts Here -->
	</ul>
	</section>
	<!-- /Ajax Load More -->  
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

