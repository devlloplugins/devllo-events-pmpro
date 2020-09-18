<?php
/*********************************************************************/
/* Add show details meta box
/********************************************************************/
add_action( 'add_meta_boxes', 'devllo_events_add_show_details_checkbox_function' );
function devllo_events_add_show_details_checkbox_function() {
   add_meta_box('devllo_events_show_details_id','Show Event Details to non-members', 'devllo_events_show_details_callback_function', 'devllo_event', 'side', 'high');
}


function devllo_events_show_details_callback_function( $post ) {
    global $post;
    wp_nonce_field( 'devllo_event_pmpro_inner_custom_box', 'devllo_event_pmpro_inner_custom_box_nonce' );

    $dvshoweventWebsite = get_post_meta( $post->ID, 'devllo_show_event_website_key', true );
    $dvshoweventOnlineLink = get_post_meta( $post->ID, 'devllo_show_event_online_link_key', true );
    $dvshoweventLocation = get_post_meta( $post->ID, 'devllo_show_event_location_key', true );
    $dvshoweventMap = get_post_meta( $post->ID, 'devllo_show_event_map_key', true );
    ?>

    <?php _e('Show Event Webiste:', 'devllo-events-pmpro'); ?> <input type="checkbox" id="devllo_show_event_website_field" name="devllo_show_event_website_field" value="yes" <?php echo (($dvshoweventWebsite=='yes') ? 'checked="checked"': '');?>/><br/>
    <?php _e('Show Event Online Link:', 'devllo-events-pmpro'); ?> <input type="checkbox" id="devllo_show_event_online_link_field" name="devllo_show_event_online_link_field" value="yes" <?php echo (($dvshoweventOnlineLink=='yes') ? 'checked="checked"': '');?>/><br/>
    <?php _e('Show Event Location:', 'devllo-events-pmpro'); ?> <input type="checkbox" id="devllo_show_event_location_field" name="devllo_show_event_location_field" value="yes" <?php echo (($dvshoweventLocation=='yes') ? 'checked="checked"': '');?>/><br/>
    <?php _e('Show Event Map:', 'devllo-events-pmpro'); ?> <input type="checkbox" id="devllo_show_event_map_field" name="devllo_show_event_map_field" value="yes" <?php echo (($dvshoweventMap=='yes') ? 'checked="checked"': '');?>/><br/>
    <?php
}



// Save checkbox
add_action('save_post', 'save_devllo_event_show_details_checkbox'); 

function save_devllo_event_show_details_checkbox($post_id){

       // Add nonce for security and authentication.
    if ( ! isset( $_POST['devllo_event_pmpro_inner_custom_box_nonce'] ) ) {
        return $post_id;
    }
    
    $nonce = $_POST['devllo_event_pmpro_inner_custom_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'devllo_event_pmpro_inner_custom_box' ) ) {
        return $post_id;
    }
    
    /*
     * If this is an autosave, our form has not been submitted,
     * so we don't want to do anything.
     */
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return $post_id;
    }

    //Sanitize fields
    if (isset($_POST['devllo_show_event_website_field'])){
        $devllo_show_event_website = sanitize_key($_POST['devllo_show_event_website_field']);
    }
    
    if (isset($_POST['devllo_show_event_online_link_field'])){
        $devllo_show_event_online_link= sanitize_key($_POST['devllo_show_event_online_link_field']);
    }
    
    if (isset($_POST['devllo_show_event_location_field'])){
        $devllo_show_event_location = sanitize_key($_POST['devllo_show_event_location_field']);
    }
    
    if (isset($_POST['devllo_show_event_map_field'])){
        $devllo_show_event_map = sanitize_key($_POST['devllo_show_event_map_field']);
    }
    


    //Update and save fields
    if (isset($_POST['devllo_show_event_website_field'])){
        update_post_meta( $post_id, 'devllo_show_event_website_key', $devllo_show_event_website );
    }else{
        delete_post_meta($post_id, 'devllo_show_event_website_key');
    }
    
    if (isset($_POST['devllo_show_event_online_link_field'])){
        update_post_meta( $post_id, 'devllo_show_event_online_link_key', $devllo_show_event_online_link );
    }else{
        delete_post_meta($post_id, 'devllo_show_event_online_link_key');
    }

    if (isset($_POST['devllo_show_event_location_field'])){
        update_post_meta( $post_id, 'devllo_show_event_location_key', $devllo_show_event_location );
    }else{
        delete_post_meta($post_id, 'devllo_show_event_location_key');
    }

    if (isset($_POST['devllo_show_event_map_field'])){
        update_post_meta( $post_id, 'devllo_show_event_map_key', $devllo_show_event_map );
    }else{
        delete_post_meta($post_id, 'devllo_show_event_map_key');
    }
}