<?php
/*
Plugin Name: Archive My WP
Plugin URI: http://wordpress.org/plugins/archive-my-wp/
Description: This plugin Push your Updated WordPress Pages/Post to Archive.org, so you can access them in WayBack Machine
Author: Rohit Gadgil
Version: 1.0
Author URI: http://twitter.com/gadgilrohit
*/

function archive_my_wp($post_id) {
	$post = get_post($post_id);
	if ( $post->post_status == 'publish')
		{
			//var_dump($post);
			$page_url = get_permalink( $post_id );
			
			$page_url = str_replace("https://", "", $page_url);
			$page_url = str_replace("http://", "", $page_url);
			
			$wayback_url = "https://web.archive.org/save/".$page_url;
			$response = wp_remote_get( $wayback_url, array( 'timeout' => 120, 'httpversion' => '1.1' ) );
			
			$response_code = wp_remote_retrieve_response_code( $response );
			//var_dump($response); 
	//		var_dump($response_code);
			
			
	//	die("you were here");
		}	
	
}

add_action( 'save_post', 'archive_my_wp' );


?>