<?php

/*-----------------------------------------------------------------------------------

	Theme Shortcodes

-----------------------------------------------------------------------------------*/


function one_third( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="one_third '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_third', 'one_third');

function two_third( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="two_third '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('two_third', 'two_third');

function one_fourth( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="one_fourth '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_fourth', 'one_fourth');

function one_half( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="one_half '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('one_half', 'one_half');

function block( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="content_block '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('block', 'block');




function grid_3( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_3 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_3', 'grid_3');

function grid_4( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_4 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_4', 'grid_4');

function grid_5( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_5 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_5', 'grid_5');

function grid_6( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_6 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_6', 'grid_6');

function grid_7( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_7 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_7', 'grid_7');

function grid_8( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'align' => ''
    ), $atts));	
   return '<div class="grid_8 '.$align.'">' . do_shortcode($content) . '</div>';
}
add_shortcode('grid_8', 'grid_8');


function content_block( $atts, $content = null ) {
   return '<section class="content_block"><div class="grid_12"></div>' . do_shortcode($content) . '</section>';
}
add_shortcode('content_block', 'content_block');


function button( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'url' => '',
		'text' => ''
    ), $atts));	
   return '<p class="btn"><a href="'.$url.'">'.$text.'</a></p>';
}
add_shortcode('button', 'button');


//Popcorn Video Embed
function popcorn( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'id' => ''
    ), $atts));	
   return '<div class="video-container"><iframe src="'.$id.'" frameborder="0" width="480" height="320" mozallowfullscreen webkitallowfullscreen allowfullscreen></iframe></div>';
}
add_shortcode('popcorn', 'popcorn');


//Vimeo Embed
function vimeo( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'id' => ''
    ), $atts));	
   return '<div class="video-container"><iframe src="http://player.vimeo.com/video/'.$id.'" frameborder="0" width="320" height="281"></iframe></div>';
}
add_shortcode('vimeo', 'vimeo');

//YouTube Embed
function youtube( $atts, $content = null ) {	
	extract(shortcode_atts(array(
		'id' => ''
    ), $atts));	
   return '<div class="video-container"><iframe src="http://www.youtube.com/embed/'.$id.'" frameborder="0" width="320" height="281"></iframe></div>';
}
add_shortcode('youtube', 'youtube');



?>