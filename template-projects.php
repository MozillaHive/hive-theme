<?php
/*
Template Name: Projects Landing Page
*/
?>
<?php get_header(); ?>

	<div class="grid_12">
	    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	    <h1>
	      <?php the_title(); ?>
	    </h1>
	    <?php endwhile; endif; ?> 
	</div>
	<div class="clear"></div>
	<aside class="grid_3 push_9">
	    <nav id="portfolio-tax-terms">
	    	<div class="inner">
	    	<?php
			$taxonomyname = 'project_type';
			$toplevelterms = get_terms($taxonomyname, 'hide_empty=0&hierarchical=0&parent=0');
			$termchildren = array();
			foreach ($toplevelterms as $toplevelterm) {
				$termchildren[] = $toplevelterm->term_id;
			}
			foreach ($termchildren as $child) {
				$term = get_term_by('id', $child, $taxonomyname);
				$write .= '<li data-type="'.$term->slug.'">';
				$write .= '<a href="/portfolio-type/'.$term->slug.'" data-filter="'.$term->slug.'"><span><i class="icon-check"></i><i class="icon-check-empty"></i></span>' . $term->name . '</a>';
				if ($term->description) $write .= apply_filters('the_content', $term->description);
				$write .= '</li>';
			}
			if ($write) echo '<h3 class="widget-title">Filter by Type</h3><ul class="clearfix"><li data-type="all" class="all" class="active"><a href="/portfolio-type/" data-filter="*"><span><i class="icon-check"></i><i class="icon-check-empty"></i></span>All</a></li>' . $write . '</ul>';
	?>      
	    	</div>
	    </nav>  
	</aside>
    <section class="portfolio-list-wrapper grid_9 pull_3">
	    <ul id="portfolio-list">
		<?php 
			$n =0;
			$start_args=array(
			'post_type' => 'project',
			'orderby'   => 'title',
			'orderby'   => 'menu_order',
			'order'     => 'DESC',
			'showposts' => 1000,
			);
			query_posts($start_args); 
		?>
		<?php while ( have_posts() ) : the_post(); ?>
	    <?php
	    $taxonomy = 'project_type';
	    $theCats = Array(); 
	    $terms = get_the_terms( $post->ID, $taxonomy );	
	    if($terms) {
	        foreach( $terms as $projectCat ) {					
	            array_push($theCats, $projectCat->slug);
	        }
	    }						 
	    ?>
	    <?php 
			$length = count($theCats);					
		?>
	        <li id="<?php echo $post->post_name; ?>" class="<?php for ($i = 0; $i < $length; $i++){
				echo $theCats[$i].' ';
				} ?>" data-id="<?php echo $n; $n++ ?>">
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('post-thumnbail', array('title' => ''.get_the_title().''));  ?>				
				<div>
					<?php the_title();?>
				</div>
				</a>	        
	        </li>
	    <?php endwhile; 
	    wp_reset_query();  // Restore global post data stomped by the_post();
	    ?>
	    </ul>
	    <div class="clear"></div>
    </section>
      
<?php get_footer(); ?>
