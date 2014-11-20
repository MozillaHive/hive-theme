		</div>
		<!-- end .grid_12 -->				
		</div>
		<!-- End container_12 -->
	</div>
	<!-- End #page-content -->
	<footer id="page-footer">
		<div class="container_12">
			<?php if ( has_nav_menu('primary-menu')):?> 
			<nav class="footer-nav grid_12">	
				<?php get_search_form(); ?>			
				<?php dynamic_sidebar('social-media'); ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container'=>'' ) ); ?>
			</nav>
			<?php endif ?> 
			<div class="grid_12">
				<p id="copyright">&copy;<?php echo date( 'Y' ); ?> <a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a>. All Rights Reserved.</p>
			</div>
		</div>
	</footer>
</div>
<!-- end wrapper -->

<?php if( is_user_logged_in() ) {} ?>
<?php edit_post_link( __('edit', 'framework'), '<span class="edit-post">','</span>' ); ?>
<?php wp_footer(); ?>
</body>
</html>