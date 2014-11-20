<?php get_header(); ?>
<div class="grid_12 content-area hfeed">	
	<?php 
		// set page to load all returned results
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			's' => $s,
			'paged' => $paged
		);
		query_posts( $args );
	?>
	<?php if( have_posts() ) : ?>
		<h1><?php printf( __('<span>Search results for: </span> %s', 'framework'), get_search_query()); ?></h1>		
		<?php 
		// rewind the posts to filter for portfolio items
		rewind_posts();
		$i = 0;
		echo '<ul class="listing">';
		while( have_posts() ) : the_post();?>
		<?php $i++; ?>
		<li>
			<h3><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
			<?php the_title(); ?>
			</a></h3>
			<?php echo excerpt(35); ?>
			<p class="more"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>">Continue Reading</a></p>
		</li>		
		<?php 
			endwhile; 
			echo '</ul>';
			if(function_exists('cnkt_pagenav')) : cnkt_pagenav(); endif;
			if( $i == 0 ) { printf('Sorry, we couldn\'t find any articles that match the search terms'); }
		?>
		<?php else : ?>
		<h3><?php printf( __('Your search for <em>"<strong>%s</strong>"</em> did not return any results...'), get_search_query() ); ?></h3>
		<p>
		<?php _e('Suggestions:','framework') ?>
		</p>
		<ul>
			<li><?php _e('Make sure all words are spelled correctly.', 'framework') ?></li>
			<li><?php _e('Try different keywords.', 'framework') ?></li>
			<li><?php _e('Try more general keywords.', 'framework') ?></li>
		</ul>
	<?php endif; ?>
</div>
<?php get_footer(); ?>
