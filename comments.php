<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'framework') ?></p>
	<?php
		return;
	}

/*-----------------------------------------------------------------------------------*/
/*	Display the comments + Pings
/*-----------------------------------------------------------------------------------*/

		if ( have_comments() ) : // if there are comments ?>
        
        <?php if ( ! empty($comments_by_type['comment']) ) : // if there are normal comments ?>
		
		<h3 id="comments"></h3>
		
		<ol class="commentlist">
        <?php wp_list_comments('type=comment&callback=comment_results'); ?>
        </ol>

        <?php endif; ?>

        <?php if ( ! empty($comments_by_type['pings']) ) : // if there are pings ?>
		
		<h3 id="pings"><?php _e('Trackbacks for this post', 'framework') ?></h3>
		
		<ol class="pinglist">
        <?php wp_list_comments('type=pings'); ?>
        </ol>

        <?php endif; ?>
		
		
		
		<?php
		
		
/*-----------------------------------------------------------------------------------*/
/*	Deal with no comments or closed comments
/*-----------------------------------------------------------------------------------*/
		
		if ('closed' == $post->comment_status ) : // if the post has comments but comments are now closed ?>
		
		<p class="nocomments"><?php _e('Comments are now closed for this article.', 'framework') ?></p>
		
		<?php endif; ?>

 		<?php else :  ?>
		
        <?php if ('open' == $post->comment_status) : // if comments are open but no comments so far ?>

        <?php else : // if comments are closed ?>
		
		<?php if (is_single()) { ?><p class="nocomments"><?php _e('Comments are closed.', 'framework') ?></p><?php } ?>

        <?php endif; ?>
        
<?php endif;


/*-----------------------------------------------------------------------------------*/
/*	Comment Form
/*-----------------------------------------------------------------------------------*/

	if ( comments_open() ) : ?>

	<div id="respond">

		<h3><?php comment_form_title( __('Leave a Reply', 'framework'), __('Leave a Reply to %s', 'framework') ); ?></h3>
	
		<div class="cancel-comment-reply">
			<?php cancel_comment_reply_link(); ?>
		</div>
	
		<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
		<p><?php printf(__('You must be %1$slogged in%2$s to post a comment.', 'framework'), '<a href="'.get_option('siteurl').'/wp-login.php?redirect_to='.urlencode(get_permalink()).'">', '</a>') ?></p>
		<?php else : ?>
	
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
	
			<?php if ( is_user_logged_in() ) : ?>
		
			<p><?php printf(__('Logged in as %1$s. %2$sLog out &raquo;%3$s', 'framework'), '<a href="'.get_option('siteurl').'/wp-admin/profile.php">'.$user_identity.'</a>', '<a href="'.(function_exists('wp_logout_url') ? wp_logout_url(get_permalink()) : get_option('siteurl').'/wp-login.php?action=logout" title="').'" title="'.__('Log out of this account', 'framework').'">', '</a>') ?></p>
		
			<?php else : ?>
		
			<p><input type="text" name="author" id="author" value="<?php echo esc_attr($comment_author); ?>" size="22" tabindex="1" />
			<label for="author"><small><?php _e('Name', 'framework') ?> <?php if ($req) _e("*", 'framework'); ?></small></label></p>
		
			<p><input type="text" name="email" id="email" value="<?php echo esc_attr($comment_author_email); ?>" size="22" tabindex="2" />
			<label for="email"><small><?php _e('Mail <span>(will not be published)</span>', 'framework') ?> <?php if ($req) _e("*", 'framework'); ?></small></label></p>
		
			<p><input type="text" name="url" id="url" value="<?php echo esc_attr($comment_author_url); ?>" size="22" tabindex="3" />
			<label for="url"><small><?php _e('Website', 'framework') ?></small></label></p>
		
			<?php endif; ?>
		
			<p><textarea name="comment" id="comment" cols="58" rows="10" tabindex="4"></textarea></p>
			
			<!--<p class="allowed-tags"><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->
		
			<p><input name="submit" type="submit" id="submit" tabindex="5" value="<?php _e('Submit Comment', 'framework') ?>" />
			<?php comment_id_fields(); ?>
			</p>
			<?php do_action('comment_form', $post->ID); ?>
	
		</form>

	<?php endif; // If registration required and not logged in ?>
	</div>

	<?php endif; // if you delete this the sky will fall on your head ?>
