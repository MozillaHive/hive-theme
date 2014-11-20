<?php

//Project Post Type
add_action( 'init', 'register_cpt_project' );

function register_cpt_project() {

    $labels = array( 
        'name' => _x( 'Portfolio', 'project' ),
        'singular_name' => _x( 'Portfolio', 'project' ),
        'add_new' => _x( 'Add New', 'project' ),
        'add_new_item' => _x( 'Add New', 'project' ),
        'edit_item' => _x( 'Edit', 'project' ),
        'new_item' => _x( 'New', 'project' ),
        'view_item' => _x( 'View', 'project' ),
        'search_items' => _x( 'Search', 'project' ),
        'not_found' => _x( 'Nothing found', 'project' ),
        'not_found_in_trash' => _x( 'No found in Trash', 'project' ),
        'parent_item_colon' => _x( 'Parent:', 'project' ),
        'menu_name' => _x( 'Portfolios', 'project' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        
        'supports' => array( 'title', 'editor', 'thumbnail' ),
        'taxonomies' => array( 'project_type' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,        
        
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array('slug'=>'portfolio','with_front'=>false),
        'menu_position' => 5,
        'menu_icon' => get_template_directory_uri() .'/functions/images/add.png',
        'capability_type' => 'post'
    );

    register_post_type( 'project', $args );
}

add_action( 'init', 'register_taxonomy_project_type' );

function register_taxonomy_project_type() {

    $labels = array( 
        'name' => _x( 'Portfolio Types', 'project_type' ),
        'singular_name' => _x( 'Portfolio Type', 'project_type' ),
        'search_items' => _x( 'Search Types', 'project_type' ),
        'popular_items' => _x( 'Popular Types', 'project_type' ),
        'all_items' => _x( 'All Types', 'project_type' ),
        'parent_item' => _x( 'Parent Type', 'project_type' ),
        'parent_item_colon' => _x( 'Parent Type:', 'project_type' ),
        'edit_item' => _x( 'Edit Type', 'project_type' ),
        'update_item' => _x( 'Update Type', 'project_type' ),
        'add_new_item' => _x( 'Add New Type', 'project_type' ),
        'new_item_name' => _x( 'New Type', 'project_type' ),
        'separate_items_with_commas' => _x( 'Separate types with commas', 'project_type' ),
        'add_or_remove_items' => _x( 'Add or remove types', 'project_type' ),
        'choose_from_most_used' => _x( 'Choose from the most used types', 'project_type' ),
        'menu_name' => _x( 'Portfolio Types', 'project_type' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'show_tagcloud' => true,
        'show_admin_column' => true,
        'hierarchical' => true,

        'rewrite' => array('slug'=>'portfolio-type','with_front'=>false),

        'query_var' => true
    );

    register_taxonomy( 'project_type', array('project'), $args );
}

