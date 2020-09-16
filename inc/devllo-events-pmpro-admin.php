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
add_action('save_post', 'save_featured_post'); 
function save_featured_post($post_id){


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
        }
    
    if (isset($_POST['devllo_show_event_online_link_field'])){
        update_post_meta( $post_id, 'devllo_show_event_online_link_key', $devllo_show_event_online_link );
        }

    if (isset($_POST['devllo_show_event_location_field'])){
        update_post_meta( $post_id, 'devllo_show_event_location_key', $devllo_show_event_location );
        }

    if (isset($_POST['devllo_show_event_map_field'])){
        update_post_meta( $post_id, 'devllo_show_event_map_key', $devllo_show_event_map );
        }
}