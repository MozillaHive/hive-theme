<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>
<section class="home-content">	
	<div class="grid_8 hfeed">
	<?php 
		$args=array(
			'post_type' => 'post',
	        'order'     => 'DESC',
			'post_status' => 'publish',
			'posts_per_page' => 8,
		);
        query_posts( $args );
    ?>
    <?php if(have_posts() ):?>
    <h2>Latest Blog Posts</h2>
	<ul class="listing">
	    <?php while ( have_posts() ) : the_post(); ?>
		<li>	
			<?php if (has_post_thumbnail()) : ?>
	        <div class="img"> <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
	          <?php the_post_thumbnail('post-thumnbail', array('title' => ''.get_the_title().''));  ?>
	          </a> </div>
	        <?php endif; ?>
	        <div class="text<?php if(!has_post_thumbnail()) echo ' no-image';?>">	
			<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
			<p class="meta"><span><i class="icon-calendar"></i> <?php the_time('M d, Y'); ?></span> <span><i class="icon-user"></i> <?php the_author_posts_link(); ?></span></p>
			<?php echo excerpt(25); ?>
	        </div>
		</li>
		<?php endwhile;wp_reset_query(); ?>
	</ul>
	<p class="more"><a href="/blog"><i class="icon-arrow-right"></i> View All Blog Posts</a></p>
	<?php endif; ?>
	</div>
	<aside class="grid_4 sidebar">
		<?php if ( is_active_sidebar( 'generic' ) ) : 
			dynamic_sidebar('generic'); 
		endif; ?>
		<?php 
		//Tweets
		if(ot_get_option('cnkt_twitter_widget')) echo '<div class="tweets widget">'.ot_get_option('cnkt_twitter_widget').'</div>';
		?>
	</aside>
</section>

<?php get_footer(); ?>
