<?php
/*
    Plugin Name: PMPro Integration for Devllo Events
    Plugin URI: https://devlloplugins.com/
    Description: This adds an integration with PMPro to restrict events to PMPro members
    Author: Devllo Plugins
    Version: 0.0.1
    Author URI: https://devllo.com/
    Text Domain: devllo-events-pmpro
    Domain Path: /languages
 */

add_action( 'wp_enqueue_scripts', 'devllo_events_pmpro_enqueue_styles' );
require_once plugin_dir_path( __FILE__ ) . 'inc/devllo-events-pmpro-admin.php';

function devllo_events_pmpro_enqueue_styles(){
wp_enqueue_style( 'devllo-events-pmpro-styles', plugin_dir_url( __FILE__ ) . 'assets/css/style.css');	
}


function devllo_events_pmpro_page_meta_wrapper( ) {
	if ( defined( 'PMPRO_VERSION' ) ) {
		add_meta_box( 'pmpro_page_meta', 'Require Membership', 'pmpro_page_meta', 'devllo_event', 'side', 'high' );
	}
}
add_action( 'admin_menu', 'devllo_events_pmpro_page_meta_wrapper' );




function devllo_events_pmpro_has_membership_access( $hasaccess, $post, $user, $levels ) {
	
	if ( $post->post_type == 'devllo_event' && ! $hasaccess ) {
        // Do something here if user has no access


    }
    return $hasaccess;

}
add_filter( 'pmpro_has_membership_access_filter', 'devllo_events_pmpro_has_membership_access', 10, 4 );

function devllo_events_show_details(){
global $post;

    $id = get_the_ID();

  //  $map_location = get_post_meta( $post->ID, 'devllo_event_location_key', true );


    $show_event_website = get_post_meta($id, 'show_event_website', true);
    $show_event_online_link = get_post_meta($id, 'show_event_online_link', true);
    $show_event_location = get_post_meta($id, 'show_event_location', true);
    $show_event_map = get_post_meta($id, 'show_event_map', true);

    if ($show_event_website)
    {
        add_filter('event_website_content_filter', '__return_false' );
    }

    if ($show_event_online_link)
    {
        add_filter('event_online_link_content_filter', '__return_false' );
    }

    if ($show_event_location)
    {
        add_filter('event_location_name_content_filter', '__return_false' );
    }

    if ($show_event_map)
    {
        add_filter('event_map_location_content_filter', '__return_false' );
    }
}
add_action( 'wp', 'devllo_events_show_details' ); 
