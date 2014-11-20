<section class="widget">
	<h3 class="widget-title">Recent Posts</h3>
	<?php 
		$args=array(
			'post_type' => 'post',
			'orderby'   => 'date',
	    	'order'     => 'DESC',
			'posts_per_page' => 4,
	    	'post__not_in' => array($post->ID),
		);
		$recents = new WP_Query($args);
		?>
		<div class="inner">
			<ul class="listing">
			    <?php while ($recents->have_posts()) : $recents->the_post();?>
				<li class="post">
					<?php if (has_post_thumbnail()) : ?>
					<div class="img"> <a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
						<?php the_post_thumbnail('post-thumnbail', array('title' => ''.get_the_title().''));  ?>
					</a> </div>
					<?php endif; ?>
						<div class="text<?php if(!has_post_thumbnail()) echo ' no-image';?>">
							<p><a href="<?php the_permalink();?>" title="<?php the_title(); ?>">
								<?php the_title(); ?>
						</a></p>
						<p class="meta"><?php the_time('M d, Y'); ?></p>
					</div>
				</li>
				<?php endwhile; wp_reset_query(); ?>
			</ul>
		</div>
</section>