<?php get_header(); ?>

<article class="grid_9 content-area hfeed">	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	<header>
		<h1 class="<?php if(get_field('show_featured_image')) echo 'tagline'; ?>"><?php the_title();?></h1>
		<?php if(get_field('tagline')){
			echo '<h3>'. get_field('tagline') .'</h3>';
		}?>		
		
		
			
	</header>
	<?php 
		if(has_post_thumbnail() && get_field('show_featured_image') == 'yes'){
			the_post_thumbnail('project-thumnbail', array('class' => 'alignleft'));
		}
    ?>
	<?php the_content(); ?>
	
	<section class="portfolio-meta">
		<?php if( get_field('lead_organization' )): ?>
			<p class="meta project-title">
			<span>Lead Organization:</span><br/>
			<?php if( get_field('lead_organization_link' )){ ?>
			<a href="<?php echo get_field('lead_organization_link' ); ?>" target="_blank">
			<?php } ?>
			<?php echo get_field('lead_organization' ); ?>
			<?php if( get_field('lead_organization_link' )){ ?>
			</a>
			<?php } ?>
			</p>
		<?php endif; ?>
			
		<?php if( get_field('partner_organization' )): ?>
			<p class="meta project-title">
			<span>Partner Organizations:</span><br/>
			<?php 
				$p = 0;
				while(has_sub_field('partner_organization')): ?> 
				<?php $p++; if($p > 1) echo', ';?>
				<a href="<?php the_sub_field('organiztion_website'); ?>"><?php the_sub_field('organization'); ?></a>
			<?php endwhile; ?>
			</p>   
			<?php endif; ?>
		
		<?php if( get_field('grant_information' )): ?>
			<p class="meta project-title">
			<span>Grant Information:</span><br/>
			<?php echo get_field('grant_information' ); ?>
			</p>
		<?php endif; ?>
			
		<?php if( get_field('project_goal' )): ?>
			<p class="meta project-title">
			<span>Project Goal:</span><br/>
			<?php echo get_field('project_goal' ); ?>
			</p>
		<?php endif; ?>
		
		<p class="meta project-title"><span>Project Tags:</span><br/>
		<?php echo custom_taxonomies_terms_links(); ?>
		</p>
	</section>
	
	
	<?php if(get_field('digital_portfolio')): ?>
	<section class="digital-portfolios">
	<h2>Project Portfolio</h2>
	<ul>
 
	<?php while(has_sub_field('digital_portfolio')): ?> 
		<li>
			<?php 
				$cat =  get_sub_field('category');
				$cat = str_replace('-', ' ', $cat);
			?>
			<h3 class="capitalize"><?php echo $cat;?></h3>
			<div class="icon">
			<?php 
			if(get_sub_field('category') == 'tools'){
				echo '<i class="icon-cog"></i>';
			}
			if(get_sub_field('category') == 'teaching-resources'){
				echo '<i class="icon-group"></i>';
			}
			if(get_sub_field('category') == 'sample-works'){
				echo '<i class="icon-desktop"></i>';
			}
			if(get_sub_field('category') == 'media'){
				echo '<i class="icon-camera"></i>';
			}
			if(get_sub_field('category') == 'documentation'){
				echo '<i class="icon-pencil"></i>';
			}
			?>
			</div>
			<div class="text">
				<h4>
				<?php if(get_sub_field('link')){?><a href="<?php echo get_sub_field('link'); ?>" target="<?php echo get_sub_field('link_target'); ?>"><?php } ?><?php the_sub_field('title'); ?>
				<?php if(get_sub_field('link')){?></a><?php } ?>
				</h4>
				<?php the_sub_field('description'); ?>
				<?php if(get_sub_field('link')){?>
					<!-- <p class="more"><a href="<?php echo get_sub_field('link'); ?>" target="<?php echo get_sub_field('link_target'); ?>"><i class="icon-arrow-right"></i> View Portfolio</a></p> -->
				<?php }?>
				<p>
			</div>
		</li>
 
	<?php endwhile; ?>
 
	</ul>
	</section> 
	<?php endif; ?>
	
	
	<?php include (TEMPLATEPATH . '/includes/share.php'); ?>
	
<?php endwhile; endif; ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>