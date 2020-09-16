<?php
/*********************************************************************/
/* Add featured post checkbox
/********************************************************************/
add_action( 'add_meta_boxes', 'add_featured_checkbox_function' );
function add_featured_checkbox_function() {
   add_meta_box('devllo_events_show_details_id','Show Event Details to non-members', 'devllo_events_show_details_callback_function', 'devllo_event', 'side', 'high');
}
function devllo_events_show_details_callback_function( $post ) {
   global $post;
   $dvshoweventWebsite=get_post_meta( $post->ID, 'show_event_website', true );
   $dvshoweventOnlineLink=get_post_meta( $post->ID, 'show_event_online_link', true );
   $dvshoweventLocation=get_post_meta( $post->ID, 'show_event_location', true );
   $dvshoweventMap=get_post_meta( $post->ID, 'show_event_map', true );

?>
Show Event Webiste: <input type="checkbox" name="show_event_website" value="yes" <?php echo (($dvshoweventWebsite=='yes') ? 'checked="checked"': '');?>/><br/>
Show Event Online Link: <input type="checkbox" name="show_event_online_link" value="yes" <?php echo (($dvshoweventOnlineLink=='yes') ? 'checked="checked"': '');?>/><br/>
Show Event Location: <input type="checkbox" name="show_event_location" value="yes" <?php echo (($dvshoweventLocation=='yes') ? 'checked="checked"': '');?>/><br/>
Show Event Map: <input type="checkbox" name="show_event_map" value="yes" <?php echo (($dvshoweventMap=='yes') ? 'checked="checked"': '');?>/><br/>
<?php
}
add_action('save_post', 'save_featured_post'); 
function save_featured_post($post_id){ 
   update_post_meta( $post_id, 'show_event_website', $_POST['show_event_website']);
   update_post_meta( $post_id, 'show_event_online_link', $_POST['show_event_online_link']);
   update_post_meta( $post_id, 'show_event_location', $_POST['show_event_location']);
   update_post_meta( $post_id, 'show_event_map', $_POST['show_event_map']);

}