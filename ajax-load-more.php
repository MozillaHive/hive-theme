<?php
// Our include
define('WP_USE_THEMES', false);
require_once('../../../wp-load.php');

// Our variables
$postType = (isset($_GET['postType'])) ? $_GET['postType'] : 'post';
$category = (isset($_GET['category'])) ? $_GET['category'] : '';
$author = (isset($_GET['author'])) ? $_GET['author'] : '';
$taxonomy = (isset($_GET['taxonomy'])) ? $_GET['taxonomy'] : '';
$tag = (isset($_GET['tag'])) ? $_GET['tag'] : '';
$exclude = (isset($_GET['postNotIn'])) ? $_GET['postNotIn'] : '';
$numPosts = (isset($_GET['numPosts'])) ? $_GET['numPosts'] : 6;
$page = (isset($_GET['pageNumber'])) ? $_GET['pageNumber'] : 0;

$args = array(
	'post_type' => $postType,
	'category_name' => $category,
	'author' => $author,
	
	'posts_per_page' => $numPosts,
	'paged'          => $page,
	
	'orderby'   => 'date',
    'order'     => 'DESC',
	'post_status' => 'publish',
);

// EXCLUDE POSTS
// Create new array of excluded posts
/* Example array from parent page:
   $features = array();
   foreach( $posts as $post):
	   setup_postdata($post);
	   $features[] = $post->ID;
   endforeach;
   if($features){			
	   $postsNotIn = implode(",", $features);
   }
*/
if(!empty($exclude)){
	$exclude=explode(",",$exclude);
    $args['post__not_in'] = $exclude;
}

// QUERY BY TAXONOMY
if(empty($taxonomy)){
	$args['tag'] = $tag;
}else{
    $args[$taxonomy] = $tag;
}

query_posts($args); 
?>
<?php 
// our loop  
if (have_posts()) :  
	$i =0;
	while (have_posts()): the_post();?> 
	<?php 
	//If author var is > 1 and post type is not project
	$post_type = get_post_type( get_the_ID());
	if(count($author) > 0 && $post_type != 'project' ){
	?>
	
	
	
	<?php $i++; ?>
	<li <?php if($i == 2){ $i = 0; echo 'class="even"';}?>>	
		<?php if (has_post_thumbnail()) : ?>
        <div class="img"> <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
          <?php the_post_thumbnail('post-thumnbail', array('title' => ''.get_the_title().''));  ?>
          </a> </div>
        <?php endif; ?>
        
        <div class="text<?php if(!has_post_thumbnail()) echo ' no-image';?>">	
		<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
		<?php if($postType != 'project'){?>
		<p class="meta">
	      <span><i class="icon-calendar"></i> <?php the_time('M d, Y'); ?></span> <span><i class="icon-user"></i> <?php the_author_posts_link(); ?></span>
        </p>
        <?php } ?>
		<?php echo excerpt(25); ?>
        </div>
	</li>
	<?php } ?>
<?php endwhile; endif; wp_reset_query(); ?> 