<?php get_header(); ?>

<div class="grid_9 content-area hfeed">	
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<div class="inner">
	<h1><?php the_title(); ?></h1>
	<?php the_content(); ?>	
	</div>
	<?php endwhile; endif; ?>
</div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>
