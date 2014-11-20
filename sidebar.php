<?php wp_reset_query(); ?>
<aside class="grid_3 sidebar">
<?php // Blog and Archive ?>
<?php if(is_page('blog') || is_archive ()):?>
	<?php if(is_tax( 'project_type' )) : ?>
		<?php include (TEMPLATEPATH . '/includes/recent-portfolios.php'); ?>
	<?php else : ?>
		<?php dynamic_sidebar('blog'); ?>
	<?php endif; ?>
	
<?php // Single Post ?>
<?php elseif(is_singular( 'post')): ?>

	<?php include (TEMPLATEPATH . '/includes/recent-blogs.php'); ?>
	<?php dynamic_sidebar('blog'); ?>

<?php elseif(is_singular( 'project' )): ?>

	<?php include (TEMPLATEPATH . '/includes/recent-portfolios.php'); ?>
	
<?php else: ?>	
	<?php include (TEMPLATEPATH . '/includes/subnav.php'); ?>
	<?php dynamic_sidebar('generic'); ?>
<?php endif; ?>

</aside>