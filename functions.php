<?php

/*-----------------------------------------------------------------------------------

	Custom Theme Functions
	Author: ecentricarts
	Author URI: http://ecentricarts.com
	
-----------------------------------------------------------------------------------*/


//Load theme options
/*-----------------------------------------------------------------------------------*/
require_once ( get_template_directory() . '/functions/post-types.php' );
require_once ( get_template_directory() . '/functions/short-codes.php' );

//Include OptionsTree
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );

require_once ( get_template_directory() . '/functions/theme-options.php' );

	
//Get page ID by Slug
/*-----------------------------------------------------------------------------------*/
function get_page_id($page_name){
	global $wpdb;
	$page_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name;
}

function get_category_id($cat_name){
	$term = get_term_by('slug', $cat_name, 'category');
	return $term->term_id;
}

function get_cat_slug($cat_id) {
	$cat_id = (int) $cat_id;
	$category = &get_category($cat_id);
	return $category->slug;
}
	
//Add Editor Styles
/*-----------------------------------------------------------------------------------*/

require_once(dirname(__FILE__) . "/functions/editor/add-styles.php");
	
/*	Remove Links, Comments from Admin bar
/*-----------------------------------------------------------------------------------*/
/*
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');
*/


/*	Add excerpts to pages
/*-----------------------------------------------------------------------------------*/
add_action( 'init', 'my_add_excerpts_to_pages' );
function my_add_excerpts_to_pages() {
     add_post_type_support( 'page', 'excerpt' );
}

/*	SHORTCODE - Whitespace Removal
/*-----------------------------------------------------------------------------------*/
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);

	return $content;
}

/*	Show Kitchen Sink
/*-----------------------------------------------------------------------------------*/
function unhide_kitchensink( $args ) {
$args['wordpress_adv_hidden'] = false;
return $args;
}
add_filter( 'tiny_mce_before_init', 'unhide_kitchensink' );


//Remove demensions from post images
/*-----------------------------------------------------------------------------------*/
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}


/*	PAGING
/*-----------------------------------------------------------------------------------*/
function cnkt_pagenav($before = '', $after = '') {
    global $wpdb, $wp_query;

    $request = $wp_query->request;
    $posts_per_page = intval(get_query_var('posts_per_page'));
    $paged = intval(get_query_var('paged'));
    $numposts = $wp_query->found_posts;
    $max_page = $wp_query->max_num_pages;

    if(empty($paged) || $paged == 0) {
        $paged = 1;
    }
    $pages_to_show = 8;
    $pages_to_show_minus_1 = $pages_to_show-1;
    $half_page_start = floor($pages_to_show_minus_1/2);
    $half_page_end = ceil($pages_to_show_minus_1/2);
    $start_page = $paged - $half_page_start;
    if($start_page <= 0) {
        $start_page = 1;
    }
    $end_page = $paged + $half_page_end;
    if(($end_page - $start_page) != $pages_to_show_minus_1) {
        $end_page = $start_page + $pages_to_show_minus_1;
    }
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = $max_page;
    }
    if($start_page <= 0) {
        $start_page = 1;
    }

    if ($max_page > 1) {
        echo $before.'<div class="pagenav clearfix"><span class="number pages">Pages:</span> ';
        if ($start_page >= 2 && $pages_to_show < $max_page) {
            $first_page_text = "&laquo;";
            echo '<a href="'.get_pagenum_link().'" title="'.$first_page_text.'" class="number">'.$first_page_text.'</a>';
        }
        //previous_posts_link('&lt;');
        for($i = $start_page; $i  <= $end_page; $i++) {
            if($i == $paged) {
                echo ' <span class="number current">'.$i.'</span> ';
            } else {
                echo ' <a href="'.get_pagenum_link($i).'" class="number">'.$i.'</a> ';
            }
        }
        //next_posts_link('&gt;');
        if ($end_page < $max_page) {
            $last_page_text = "&raquo;";
            echo '<a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'" class="number">'.$last_page_text.'</a>';
        }
        echo '</div>'.$after;
    }
}


//Excerpt Length
/*-----------------------------------------------------------------------------------*/
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return '<p>'.$excerpt.'</p>';
}

function content($limit) {
  $content = explode(' ', get_the_content(), $limit);
  if (count($content)>=$limit) {
    array_pop($content);
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }
  $content = preg_replace('/[.+]/','', $content);
  $content = apply_filters('the_content', $content);
  $content = str_replace(']]>', ']]&gt;', $content);
  return $content;
}


/*	Register WP3.0+ Menus
/*-----------------------------------------------------------------------------------*/

if( !function_exists( 'init_menus' ) ) {
    function init_menus() {
	    register_nav_menu('primary-menu', __('Primary Menu'));
    	register_nav_menu('secondary-menu', __('Secondary Menu'));
    	register_nav_menu('footer-menu', __('Footer Menu'));
    }
    add_action('init', 'init_menus');
}


/*	Register Sidebars
/*-----------------------------------------------------------------------------------*/
if( function_exists('register_sidebar') ) {		
	register_sidebar(array(
        'name' => 'Social Media',
        'id' => 'social-media',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    
    register_sidebar(array(
        'name' => 'Generic Sidebar',
        'id' => 'generic',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="inner">',
        'after_widget' => '</div></div>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3>',
    ));
    
	register_sidebar(array(
        'name' => 'Blog Sidebar',
        'id' => 'blog',
        'before_widget' => '<section id="%1$s" class="content-area widget %2$s">',
        'after_widget' => '</div></section>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="inner">',
    ));
}


function get_top_parent_page_id() {
    global $post;
    // Check if page is a child page (any level)
    if ($post->ancestors) {
        //  Grab the ID of top-level page from the tree
        $end = end($post->ancestors);
        return strtolower(get_the_title($end));
    } else {
        // Page is the top level, so use  it's own id
        return $post->post_name;
    }
}

function custom_taxonomies_terms_links() {
	global $post, $post_id;
	// get post by post id
	$post = &get_post($post->ID);
	// get post type by post
	$post_type = $post->post_type;
	// get post type taxonomies
	$taxonomies = get_object_taxonomies($post_type);
	foreach ($taxonomies as $taxonomy) {
		// get the terms related to post
		$terms = get_the_terms( $post->ID, $taxonomy );
		if ( !empty( $terms ) ) {
			$out = array();
			foreach ( $terms as $term )
				$out[] = '<a href="' .get_term_link($term->slug, $taxonomy) .'">'.$term->name.'</a>';
			$return = join( ', ', $out );
		}
	}
	return $return;
}

/*	Configure WP2.9+ Thumbnails 
/*-----------------------------------------------------------------------------------*/
if( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 70, 70, true ); // Normal post thumbnails
	add_image_size('feature-banner', 620, 350, true); // Banner Images
	add_image_size('project-thumnbail', 300, 300, true); // Project/Blog featured images
	add_image_size('post-thumnbail', 320, 240, true); // Post Thumbnail
}

/*	Load Widgets & Shortcodes
/*-----------------------------------------------------------------------------------*/
include("widgets/widget-social-media.php");
//Allow shortcodes across the site
add_filter('widget_text', 'shortcode_unautop');
add_filter('widget_text', 'do_shortcode');


/*	Load All Javascript
/*-----------------------------------------------------------------------------------*/
if( !is_admin()){ 
	$url = 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'; 
	$test_url = @fopen($url,'r');
	if($test_url !== false) {
		function load_external_jQuery() {
			wp_deregister_script( 'jquery' );
			wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js'); 
			wp_enqueue_script('jquery');
			load_my_scripts();
		}
	add_action('wp_enqueue_scripts', 'load_external_jQuery');
	} else {
		function load_local_jQuery() {
			wp_deregister_script('jquery');
			wp_register_script('jquery', get_bloginfo('template_url').'/js/jquery-1.8.3.min.js', __FILE__, false, '1.8.3', true);
			wp_enqueue_script('jquery');
			load_my_scripts();
		}
	add_action('wp_enqueue_scripts', 'load_local_jQuery'); 
	}
}

function load_my_scripts() {	
	wp_enqueue_script('modernizr', get_bloginfo('template_url') . '/js/modernizr.js', array('jquery'), '1.0', false);
	wp_enqueue_script('easing', get_bloginfo('template_url') . '/js/jquery.easing.1.3.js', array('jquery'), '1.0', true);
	wp_enqueue_script('flexslider', get_bloginfo('template_url') . '/js/jquery.flexslider.js', array('jquery'), '1.0', true);
	wp_enqueue_script('hoverintent', get_bloginfo('template_url') . '/js/jquery.hoverIntent.js', array('jquery'), '1.0', true);
	
	wp_enqueue_script('isotope', get_bloginfo('template_url') . '/js/jquery.isotope.min.js', array('jquery'), '1.0', true);
	
	wp_enqueue_script('global_js', get_bloginfo('template_url') . '/js/functions.js', array('jquery'), '1.0', true);
}

/*	Custom post type in author pages
/*-----------------------------------------------------------------------------------*/

function custom_post_author_archive($query) {
    if ($query->is_author)
        $query->set( 'post_type', array('project', 'post') );
    remove_action( 'pre_get_posts', 'custom_post_author_archive' );
}
add_action('pre_get_posts', 'custom_post_author_archive');

/*	Remove .wp-caption 'style' attributes
/*-----------------------------------------------------------------------------------*/
add_shortcode('wp_caption', 'fixed_img_caption_shortcode');
add_shortcode('caption', 'fixed_img_caption_shortcode');
function fixed_img_caption_shortcode($attr, $content = null) {
    if ( ! isset( $attr['caption'] ) ) {
        if ( preg_match( '#((?:<a [^>]+>\s*)?<img [^>]+>(?:\s*</a>)?)(.*)#is', $content, $matches ) ) {
            $content = $matches[1];
            $attr['caption'] = trim( $matches[2] );
        }
    }
    $output = apply_filters('img_caption_shortcode', '', $attr, $content);
    if ( $output != '' )
        return $output;
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => 'alignnone',
        'width' => '',
        'caption' => ''
    ), $attr));
    if ( 1 > (int) $width || empty($caption) )
        return $content;
    if ( $id ) $id = 'id="' . esc_attr($id) . '" ';
    return '<div ' . $id . 'class="wp-caption ' . esc_attr($align) . '" style="width: ' . $width . 'px">'
    . do_shortcode( $content ) . '<p class="wp-caption-text">' . $caption . '</p></div>';
}

//	Discuss Comments
/*-----------------------------------------------------------------------------------*/
function disqus_embed($disqus_shortname) {
	global $post;
	wp_enqueue_script('disqus_embed','http://'.$disqus_shortname.'.disqus.com/embed.js');
	echo '<div id="disqus_thread"></div>
	<script type="text/javascript">
		var disqus_shortname = "'.$disqus_shortname.'";
		var disqus_title = "'.$post->post_title.'";
		var disqus_url = "'.get_permalink($post->ID).'";
		var disqus_identifier = "'.$disqus_shortname.'-'.$post->ID.'";
	</script>';
}
function disqus_count($disqus_shortname) {
    wp_enqueue_script('disqus_count','http://'.$disqus_shortname.'.disqus.com/count.js');
    echo '<a href="'. get_permalink() .'#disqus_thread"></a>';
}
// Disqus: Prevent from replacing comment count
remove_filter('comments_number', 'dsq_comments_text');
remove_filter('get_comments_number', 'dsq_comments_number');
remove_action('loop_end', 'dsq_loop_end');


//Options Framework
/*-----------------------------------------------------------------------------------*/
/* 
 * Helper function to return the theme option value. If no value has been saved, it returns $default.
 * Needed because options are saved as serialized strings.
 *
 * This code allows the theme to work without errors if the Options Framework plugin has been disabled.
 */

if ( !function_exists( 'of_get_option' ) ) {
	function of_get_option($name, $default = false) {
	
		$optionsframework_settings = get_option('optionsframework');
		
		// Gets the unique option id
		$option_name = $optionsframework_settings['id'];
		
		if ( get_option($option_name) ) {
			$options = get_option($option_name);
		}
			
		if ( isset($options[$name]) ) {
			return $options[$name];
		} else {
			return $default;
		}
	}
}








