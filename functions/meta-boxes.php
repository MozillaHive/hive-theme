<?php

add_action( 'add_meta_boxes', 'cnkt_add_banner_metaboxes' );
// Add the Banner Meta Boxes
function cnkt_add_banner_metaboxes() {
    add_meta_box('meta_url', 'Banner Options', 'meta_url', 'banner', 'side', 'default');
	//<?php add_meta_box( $id, $title, $callback, $page, $context, $priority, $callback_args );
}

// Banner URL Metabox
function meta_url() {
    global $post;
    // Noncename needed to verify where the data originated
    echo '<input type="hidden" name="urlmeta_noncename" id="urlmeta_noncename" value="' .
    wp_create_nonce( plugin_basename(__FILE__) ) . '" />';
    // Get the location data if its already been entered
    $url = get_post_meta($post->ID, '_url', true);
    // Echo out the field
	echo '<p>';
	echo 'Optional URL';
    echo '<input type="text" name="_url" value="' . $url  . '" class="widefat" />';
	echo '</p>';
}

// Save the Metabox Data
function save_url_meta($post_id, $post) {
    // verify this came from the our screen and with proper authorization, because save_post can be triggered at other times
    if ( !wp_verify_nonce( $_POST['urlmeta_noncename'], plugin_basename(__FILE__) )) {
    return $post->ID;
    }
    // Is the user allowed to edit the post or page?
    if ( !current_user_can( 'edit_post', $post->ID ))
        return $post->ID;
    // OK, we're authenticated: we need to find and save the data - We'll put it into an array to make it easier to loop though.
    $url_meta['_url'] = $_POST['_url'];
    // Add values of $events_meta as custom fields
    foreach ($url_meta as $key => $value) { // Cycle through the $events_meta array!
        if( $post->post_type == 'revision' ) return; // Don't store custom data twice
        $value = implode(',', (array)$value); 
		// If $value is an array, make it a CSV (unlikely)
        if(get_post_meta($post->ID, $key, FALSE)) { 
			// If the custom field already has a value
            update_post_meta($post->ID, $key, $value);
        } else { 
			// If the custom field doesn't have a value
            add_post_meta($post->ID, $key, $value);
        }
        if(!$value) delete_post_meta($post->ID, $key); // Delete if blank
    }
}
add_action('save_post', 'save_url_meta', 1, 2); // save the custom fields