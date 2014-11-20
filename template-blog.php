<?php
/*
Template Name: Blog Landing Page
*/
?>
<?php get_header(); ?>

<div class="grid_9 content-area hfeed">
  <div class="inner">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <h1>
      <?php the_title(); ?>
    </h1>
    <?php endwhile; endif; ?>
    <!-- Ajax Load More script block -->
	<section id="ajax-load-more">
	<ul class="listing" data-path="<?php echo get_template_directory_uri(); ?>" data-post-type="post" data-tag="" data-display-posts="6" data-button-text="Older Posts">
	<!-- Load Ajax Posts Here -->
	</ul>
	</section>
	<!-- /Ajax Load More -->
  </div>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
