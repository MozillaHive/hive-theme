<?php
/*
Plugin Name: Custom Social Media Widget
Plugin URI: http://cnkt.ca
Description: Displays social media links with images.
Author: Darren Cooney
Version: 1
Author URI: http://darrencooney.com
*/
 
 
class SocialMedia_Widget extends WP_Widget
{
  function SocialMedia_Widget()
  {
    $widget_ops = array('classname' => 'SocialMedia_Widget', 'description' => 'Displays social media links with images' );
    $this->WP_Widget('SocialMedia_Widget', 'CNKT Social Media Widget', $widget_ops);
  }
 
 /* Widget Form */
  function form($instance)
  {
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
    $twitter_url = $instance['twitter_url'];
    $facebook_url = $instance['facebook_url'];
    $youtube_url = $instance['youtube_url'];
    $linkedin_url = $instance['linkedin_url'];
    $flickr_url = $instance['flickr_url'];
    $pinterest_url = $instance['pinterest_url'];
    $rss_url = $instance['rss_url'];
?>

<p>
   <label for="<?php echo $this->get_field_id('title'); ?>"><strong>Title</strong>:
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" />
   </label>
</p>

<p>
   <label for="<?php echo $this->get_field_id('twitter_url'); ?>"><strong>Twitter URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('twitter_url'); ?>" name="<?php echo $this->get_field_name('twitter_url'); ?>" type="text" value="<?php echo attribute_escape($twitter_url); ?>" />
   </label>
</p>
<p>
   <label for="<?php echo $this->get_field_id('facebook_url'); ?>"><strong>Facebook URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('facebook_url'); ?>" name="<?php echo $this->get_field_name('facebook_url'); ?>" type="text" value="<?php echo attribute_escape($facebook_url); ?>" />
   </label>
</p>

<p>
   <label for="<?php echo $this->get_field_id('youtube_url'); ?>"><strong>YouTube URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('youtube_url'); ?>" name="<?php echo $this->get_field_name('youtube_url'); ?>" type="text" value="<?php echo attribute_escape($youtube_url); ?>" />
   </label>
</p>

<p>
   <label for="<?php echo $this->get_field_id('linkedin_url'); ?>"><strong>LinkedIn URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('linkedin_url'); ?>" name="<?php echo $this->get_field_name('linkedin_url'); ?>" type="text" value="<?php echo attribute_escape($linkedin_url); ?>" />
   </label>
</p>
<p>
   <label for="<?php echo $this->get_field_id('flickr_url'); ?>"><strong>Flickr URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('flickr_url'); ?>" name="<?php echo $this->get_field_name('flickr_url'); ?>" type="text" value="<?php echo attribute_escape($flickr_url); ?>" />
   </label>
</p>

<p>
   <label for="<?php echo $this->get_field_id('pinterest_url'); ?>"><strong>Pinterest URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('pinterest_url'); ?>" name="<?php echo $this->get_field_name('pinterest_url'); ?>" type="text" value="<?php echo attribute_escape($pinterest_url); ?>" />
   </label>
</p>

<p>
   <label for="<?php echo $this->get_field_id('rss_url'); ?>"><strong>RSS URL</strong>
      <input class="widefat" id="<?php echo $this->get_field_id('rss_url'); ?>" name="<?php echo $this->get_field_name('rss_url'); ?>" type="text" value="<?php echo attribute_escape($rss_url); ?>" />
   </label>
</p>


<?php
  }
 
  function update($new_instance, $old_instance)
  {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['twitter_url'] = $new_instance['twitter_url'];
    $instance['facebook_url'] = $new_instance['facebook_url'];
    $instance['youtube_url'] = $new_instance['youtube_url'];
    $instance['linkedin_url'] = $new_instance['linkedin_url'];
    $instance['flickr_url'] = $new_instance['flickr_url'];
    $instance['pinterest_url'] = $new_instance['pinterest_url'];
    $instance['rss_url'] = $new_instance['rss_url'];
    return $instance;
  }
 
  function widget($args, $instance)
  {
    extract($args, EXTR_SKIP);
 
    echo $before_widget;
    $title = empty($instance['title']) ? ' ' : apply_filters('widget_title', $instance['title']);
 
    if (!empty($title))
      echo $before_title . $title . $after_title;;
 
    // WIDGET CODE GOES HERE
    $twitter_url = $instance['twitter_url'];
    $facebook_url = $instance['facebook_url'];
    $youtube_url = $instance['youtube_url'];
    $linkedin_url = $instance['linkedin_url'];
    $flickr_url = $instance['flickr_url'];
    $pinterest_url = $instance['pinterest_url'];
    $rss_url = $instance['rss_url'];
    echo '<ul class="social-media-widget">';
    if($twitter_url != ''){
		echo "<li class=\"twitter\"><a href=\"$twitter_url\" target=\"_blank\">Twitter</a></li>";    	    
	}
	if($facebook_url != ''){
		echo "<li class=\"facebook\"><a href=\"$facebook_url\" target=\"_blank\">Facebook</a></li>";    	     
	}

	if($youtube_url != ''){
		echo "<li class=\"youtube\"><a href=\"$youtube_url\" target=\"_blank\">YouTube</a></li>";    	     
	}

	if($linkedin_url != ''){
		echo "<li class=\"linkedin\"><a href=\"$linkedin_url\" target=\"_blank\">LinkedIn</a></li>";    	     
	}	
	
	if($flickr_url != ''){
		echo "<li class=\"flickr\"><a href=\"$flickr_url\" target=\"_blank\">Flickr</a></li>";    	     
	}

	if($pinterest_url != ''){
		echo "<li class=\"pinterest\"><a href=\"$pinterest_url\" target=\"_blank\">Pinterest</a></li>";    	     
	}	

	if($rss_url != ''){
		echo "<li class=\"rss\"><a href=\"$rss_url\" target=\"_blank\">RSS</a></li>";    	     
	}	
    echo '</ul>';
    echo $after_widget;
  }
 
}
add_action( 'widgets_init', create_function('', 'return register_widget("SocialMedia_Widget");') );?>
