<?php

/**
 * Plugin Name: Plugin Final
 * Description: Plugin final, alerts and timer
 * Author:      Céline Même
 * Version:     0.1
*/


function _my_func_enqueue_script() {
wp_enqueue_script( 'my-js', plugin_dir_url( __FILE__ ).'js/plugin-final.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', '_my_func_enqueue_script' );


function _HTML_for_timer($content){
	$html = "<div>	
		<span id='hh'></span> : 
		<span id='mm'></span> : 
		<span id='ss'></span> 
	</div>";
	return $content.$html;
}
add_action( 'the_content', '_HTML_for_timer' );


function _diff_post_date_and_curent_date($content){
	global $post;
	$post_date = $post->post_date;
	$current_date = date("Y-m-d H:i:s");
	$html = "L'article a été publié : " . $post_date;


	global $wpdb;
	$year = $wpdb->get_var ( "SELECT YEAR(post_date) hour, COUNT(*) posts FROM wp_posts");
	$month = $wpdb->get_var ( "SELECT MONTH(post_date) hour, COUNT(*) posts FROM wp_posts");
	$day = $wpdb->get_var ( "SELECT DAY(post_date) hour, COUNT(*) posts FROM wp_posts");
	$hour = $wpdb->get_var ( "SELECT HOUR(post_date) hour, COUNT(*) posts FROM wp_posts");
	$minute = $wpdb->get_var ( "SELECT MINUTE(post_date) hour, COUNT(*) posts FROM wp_posts");
	$second = $wpdb->get_var ( "SELECT SECOND(post_date) hour, COUNT(*) posts FROM wp_posts");

	

	if($month = 12){
		$month = 11;
	}
	else if($day = 30){
		$day = 29;
	}
	else if($hour = 24){
		$hour = 23;
	}
	else if($minute = 60){
		$minute = 59;
	}
	else if($second = 60){
		$second = 59;
	}



	if( ($year>date("Y")+1) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}
	else if( ($year>date("Y")) && ($month>date("m")) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}
	else if( ($year>date("Y")) && ($month>=date("m")) && ($day>date("d")) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}
	else if( ($year>date("Y")) && ($month>=date("m")) && ($day>=date("d")) && ($hour>date("H")) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}
	else if( ($year>date("Y")) && ($month>=date("m")) && ($day>=date("d")) && ($hour>=date("H")) && ($minute>date("i")) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}
	else if( ($year>date("Y")) && ($month>=date("m")) && ($day>=date("d")) && ($hour>=date("H")) && ($minute>=date("i")) && ($second>date("s")) ){
			$html = "L'article a été publié : " . $post_date. "(plus d'1 an)";
	}


	return $content.$html;
}
add_action( 'the_content', '_diff_post_date_and_curent_date' );
