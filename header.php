<!doctype html>
<!--[if lt IE 7 ]><html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]><html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]><html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]><html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title>
<?php wp_title(''); ?>
</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<?php if ( function_exists( 'ot_get_option' ) ) { ?>
<?php if(ot_get_option('cnkt_appletouch')) { ?>
<link rel="apple-touch-icon" href="<?php echo ot_get_option( 'cnkt_appletouch'); ?>">
<?php } else { ?>
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">
<?php  } ?>

<?php if(ot_get_option('cnkt_favicon')) { ?>
<link href="<?php echo ot_get_option( 'cnkt_favicon'); ?>" rel="shortcut icon" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ot_get_option( 'cnkt_favicon'); ?>">
<?php } else { ?>
<link href="<?php echo get_template_directory_uri(); ?>/favicon.ico" rel="shortcut icon" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
<?php  } ?>
<?php  } ?>

<!-- Stylesheets -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/grid.css" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" type="text/css" media="screen" />

<!-- TabZilla -->
<link href="//mozorg.cdn.mozilla.net/media/css/tabzilla-min.css" rel="stylesheet" />
<script src="//mozorg.cdn.mozilla.net/tabzilla/tabzilla.js"></script>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php 
	if ( function_exists( 'ot_get_option' ) ) {
	  echo '<style>';
	  
	  if(ot_get_option('cnkt_bkg_color')) {
	  	echo 'header#branding, #page-content{background-color: '.ot_get_option('cnkt_bkg_color').'}';
	  }
	  if(ot_get_option('cnkt_link_color')){
	  	echo 'a, ul#portfolio-list li.disabled a:hover{color: '.ot_get_option('cnkt_link_color').'}';
	  	echo '.main-nav ul > li > a:hover, .main-nav ul > li:hover > a{color: '.ot_get_option('cnkt_link_color').'}';
	  	echo '.main-nav ul > li.current-menu-item > a, .main-nav ul > li.current-page-parent > a, .author .main-nav ul > li#menu-item-4847 > a, .tag .main-nav ul > li#menu-item-4847 > a, .category .main-nav ul > li#menu-item-4847 > a, .single-post .main-nav ul > li#menu-item-4847 > a, .single-project .main-nav ul > li#menu-item-4848 > a, .tax-project_type .main-nav ul > li#menu-item-4848 > a{color: '.ot_get_option('cnkt_link_color').'}';
	  }
	  
	  echo '</style>';
	}
?>

<?php 
	if ( function_exists( 'ot_get_option' ) ) {
	   //Google Analytics
	   echo ot_get_option( 'cnkt_google_analytics' );
	}
?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php 
	global $post; 
	global $parent_page;
	$parent_page = get_top_parent_page_id($post->ID);
?>
<div id="wrapper" class="<?php echo $parent_page; ?>">

	<header id="branding" class="clearfix">
		<div class="container_12 navigation">
		  
			<div class="grid_12">			 
             <a href="https://www.mozilla.org/" id="tabzilla">mozilla</a>
			 <?php echo of_get_option('link_color'); ?>
			 	<div id="mnav-toggle"></div>
				<div id="logo">
				<a href="<?php echo home_url(); ?>">
				<?php
					if ( function_exists( 'ot_get_option' ) ) {
					  $logo = ot_get_option( 'cnkt_logo');
					  $alt = get_bloginfo( "name" );
					  echo '<img class="desktop" src="'. $logo .'" alt="'.$alt .'">';
					}
	  			?>
	  			<?php
					if ( function_exists( 'ot_get_option' ) ) {
					  $logo = ot_get_option( 'cnkt_mobile_logo');
					  $alt = get_bloginfo( "name" );
					  echo '<img class="mobile" src="'. $logo .'" alt="'.$alt .'">';
					}
	  			?>
				</a></div>
				<?php get_search_form(); ?>
				<?php dynamic_sidebar('social-media'); ?>
				<?php if ( has_nav_menu('primary-menu')):?> 
				<nav class="main-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'container'=>'' ) ); ?>					
				</nav>
				<?php endif ?>
			</div>
		</div>
	</header>
<div id="page-content" class="clearfix">
<div class="container_12">

<?php if(is_page('home')) { ?>
<?php $posts = get_field('featured_articles'); ?>
<?php if( $posts ): ?>
<section class="grid_12" id="homepage-banner">
	<div class="flexslider">
		<ul class="slides"> 
			<?php foreach( $posts as $post) : ?>
			<?php setup_postdata($post); ?>	
			<?php $image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src($image_id,'feature-banner', true);
				?>
				<li>
				<div class="img" style="background:url(<?php echo $image_url[0]; ?>); background-position: center center; background-repeat: no-repeat; background-size:cover; -webkit-background-size:cover; -moz-background-size:cover;">
			    	<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"></a>
				</div>
				<div class="text">
					<h2><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<?php echo excerpt(25); ?>
					<p class="readmore"><a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><i class="icon-arrow-right"></i> Read More</a></p>
				</div>
			</li>  
			<?php endforeach; ?>          
		</ul>
	</div>
</section>
<?php wp_reset_postdata(); endif; ?>

<?php } ?>

<div class="grid_12 main-wrap">
