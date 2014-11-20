<?php get_header(); ?>

<div class="grid_9 content-area hfeed">
  <div class="inner">
  	<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); ?>
    <h1><span>Portfolio Type:</span> <?php echo $term->name; ?></h1>
    <?php $tag = get_query_var('tag'); ?>
  	<!-- Ajax Load More script block -->
	<section id="ajax-load-more">
	<ul class="listing" data-path="<?php echo get_template_directory_uri(); ?>" data-post-type="project" data-taxonomy="project_type" data-tag="<?php echo $term->slug; ?>" data-display-posts="6" data-button-text="Older Posts">
	<!-- Load Ajax Posts Here -->
	</ul>
	</section>
	<!-- /Ajax Load More -->  
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>

