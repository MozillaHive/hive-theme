<?php get_header(); ?>

<article class="grid_9 content-area hfeed">	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<header>
		<div class="date-wrap">
			<div class="date">
				<span class="month"><?php the_time('M'); ?></span>
				<span class="day"><?php the_time('d'); ?></span>
				<span class="year"><?php the_time('Y'); ?></span>
			</div>
		</div>
		<div class="title-wrap">
		<h1><?php the_title();?></h1>
		<p class="meta">
		<span><i class="icon-user"></i> <?php the_author_posts_link(); ?></span> 
		<span><i class="icon-folder-open"></i> <?php 
		  		$cats = get_the_category(); 
		  		$sep = ''; 
		  		$sep = '';
		  		foreach($cats as $cat) { 
		  			$category_id = get_cat_ID($cat->cat_name);
		  			$category_link = get_category_link($category_id);
		  			echo $sep.'<a href="'.esc_url( $category_link ).'">'.$cat->cat_name.'</a>'; 
		  			$sep = ', ';
		  		}
		  	?>
		  	</span>
		  	<!-- <span class="comment"><i class="icon-comment"></i> View Comments</span></p> -->
		</div>
	</header>
	<?php if(has_post_thumbnail() && get_field('show_featured_image') == 'yes'){
		the_post_thumbnail('project-thumnbail', array('class' => 'alignleft'));
	}
    ?>
	<?php the_content(); ?>
	<?php //the_tags('<div class="tags"><i class="icon-tag"></i><p>',', ','</p></div>'); ?>
	<?php 
		if(get_the_tag_list()) {
			echo get_the_tag_list('<div class="tags"><ul><li>','</li><li>','</li></ul></div>'); 
		}	
	?>
	
	<?php include (TEMPLATEPATH . '/includes/share.php'); ?>
	<div class="blog-navigation">
		<div class="prev"> <?php previous_post_link('<i class="icon-chevron-sign-left"></i> <div>%link</div>'); ?> </div>
		<div class="next"> <?php next_post_link('<i class="icon-chevron-sign-right"></i> <div>%link</div>'); ?> </div>
	</div>
	<footer id="comments">		
	  	<h2 id="comment">Leave a Comment</h2>
	  	<?php disqus_embed('hivenycorg'); ?>
	  	
  </footer>	
<?php endwhile; endif; ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>