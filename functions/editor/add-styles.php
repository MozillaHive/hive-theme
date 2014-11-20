<?php
/** 
 * Filter TinyMCE Buttons
 *
 * Here we are filtering the TinyMCE buttons and adding a button
 * to it. In this case, we are looking to add a style select 
 * box (button) which is referenced as "styleselect". In this 
 * example we are looking to add the select box to the second
 * row of the visual editor, as defined by the number 2 in the
 * mce_buttons_2 hook.
 */
function themeit_mce_buttons_2( $buttons )
{
  array_unshift( $buttons, 'styleselect' );
  return $buttons;
}
add_filter( 'mce_buttons_2', 'themeit_mce_buttons_2' );

/**
 * Add Style Options
 *
 * First we provide available formats for the style format drop down.
 * This should contain a comma separated list of formats that 
 * will be available in the format drop down list.
 *
 * Next, we provide our style options by adding them to an array.
 * Each option requires at least a "title" value. If only a "title"
 * is provided, that title will be used as a divider heading in the
 * styles drop down. This is useful for creating "groups" of options.
 *
 * After the title, we set what type of element it is and how it should
 * be displayed. We can then provide class and style attributes for that
 * element. The example below shows a variety of options.
 *
 * Lastly, we encode the array for use by TinyMCE editor
 *
 * {@link http://tinymce.moxiecode.com/examples/example_24.php }
 */
function themeit_tiny_mce_before_init( $settings ){

	$settings['theme_advanced_blockformats'] = 'p,div,h1,h2,h3,h4,h5,h6';

	$style_formats = array(
		array( 'title' => 'Intro Text', 'inline' => 'span', 'classes' => 'intro-text' )
	);


	$settings['style_formats'] = json_encode( $style_formats );
	return $settings;
}
add_filter( 'tiny_mce_before_init', 'themeit_tiny_mce_before_init' );


/**
 * Add Editor Style
 *
 * This provides the theme with the functionality to add a custom
 * TinyMCE editor stylesheet. By default, the add_editor_style() will
 * look for a stylesheet named editor-style.css in your theme. Here
 * we have chosen to define our own stylesheet name, style-editor.css.
 * This stylesheet can be named whatever you want, just be sure it is
 * defined in the function below and included in your theme files.
 *
 *{@link http://codex.wordpress.org/Function_Reference/add_editor_style }
 */
 
function add_theme_editor_style() {
  add_editor_style( 'style-editor.css' );
}
add_action( 'after_setup_theme', 'add_theme_editor_style' );

?>