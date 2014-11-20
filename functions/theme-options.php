<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'admin_init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
function custom_theme_options() {
  /**
   * Get a copy of the saved settings array. 
   */
  $saved_settings = get_option( 'option_tree_settings', array() );
  
  /**
   * Custom settings array that will eventually be 
   * passes to the OptionTree Settings API Class.
   */
  $custom_settings = array( 
    'contextual_help' => array( 
      'sidebar'       => ''
    ),
    'sections'        => array( 
      array(
        'id'          => 'global_options',
        'title'       => 'Global Options'
      ),
      array(
        'id'          => 'admin_options',
        'title'       => 'Admin Options'
      )
    ),
    'settings'        => array( 
      array(
        'id'          => 'cnkt_logo',
        'label'       => 'Logo',
        'desc'        => 'Upload the site logo.',
        'std'         => '',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_mobile_logo',
        'label'       => 'Mobile Logo',
        'desc'        => 'Upload the site logo for the mobile version.',
        'std'         => '',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_favicon',
        'label'       => 'Favicon',
        'desc'        => 'Add a site favicon.',
        'std'         => '',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
       array(
        'id'          => 'cnkt_appletouch',
        'label'       => 'Apple Touch Icon',
        'desc'        => 'Add an Apple Touch Icon for mobile devices.',
        'std'         => '',
        'type'        => 'upload',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_bkg_color',
        'label'       => 'Background Color',
        'desc'        => 'Background color for the site.',
        'std'         => '',
        'type'        => 'colorpicker',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_link_color',
        'label'       => 'Link Color',
        'desc'        => 'Select site wide link color.',
        'std'         => '',
        'type'        => 'colorpicker',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_twitter_widget',
        'label'       => 'Twitter Tweet Widget',
        'desc'        => 'Enter the HTML code generated from https://twitter.com/settings/widgets/',
        'std'         => '',
        'type'        => 'textarea-simple',
        'rows'        => '5',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'global_options',
      ),
      array(
        'id'          => 'cnkt_contact_email',
        'label'       => 'Contact Email',
        'desc'        => 'Enter the e-mail address forms should be submitted to.',
        'std'         => '',
        'type'        => 'text',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',
        'section'     => 'admin_options',
      ),
      array(
        'id'          => 'cnkt_google_analytics',
        'label'       => 'Google Analytics',
        'desc'        => 'Enter your full GA code here, including the javascript tags.',
        'std'         => '',
        'type'        => 'textarea_simple',
        'rows'        => '',
        'post_type'   => '',
        'taxonomy'    => '',
        'class'       => '',        
        'section'     => 'admin_options',
      ),
      
    )
  );
  
  /* allow settings to be filtered before saving */
  $custom_settings = apply_filters( 'option_tree_settings_args', $custom_settings );
  
  /* settings are not the same update the DB */
  if ( $saved_settings !== $custom_settings ) {
    update_option( 'option_tree_settings', $custom_settings ); 
  }
  
}