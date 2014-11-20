<?php 
	//get top level parent page
	$parent = array_reverse(get_post_ancestors($post->ID));
	$first_parent = get_page($parent[0]);
?>
<?php $snav_args=array(
	//use these args to gather sub page details.
	'posts_per_page' => -1, 
	'child_of' => $first_parent->ID, 
	'post_type' => 'page',
	'sort_column' => 'menu_order', 
	'sort_order' => 'ASC',	
	'title_li' => '',
);

$children = get_pages('child_of='.$first_parent->ID);
if( count( $children ) != 0 ) { 
?>

<nav class="widget snav">
	<div class="inner">
		<!-- <h3 class="widget-title"><?php echo get_the_title($first_parent->ID); ?></h3> -->
		<ul>
			<li class="lg <?php if($first_parent->ID == $post->ID) echo 'current_page_item'; ?>">		
			<a href="<?php echo get_permalink($first_parent->ID); ?>"><?php echo get_the_title($first_parent->ID); ?></a>
			</li>
			<?php wp_list_pages($snav_args); ?>
		</ul>
	</div>
</nav>
<?php } ?>