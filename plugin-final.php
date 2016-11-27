<?php

/**
 * Plugin Name: Plugin Final
 * Description: Plugin final, alerts and timer
 * Author:      Céline Même
 * Version:     0.1
*/


function my_func_enqueue_script() {
wp_enqueue_script( 'my-js', plugin_dir_url( __FILE__ ).'js/plugin-final.js', array(), '1.0', true );
}
add_action( 'wp_enqueue_scripts', 'my_func_enqueue_script' );


function HTML_for_timer($content){
	$html = "<div>	
		<span id='hh'></span> : 
		<span id='mm'></span> : 
		<span id='ss'></span> 
	</div>";
	return $content.$html;
}
add_action( 'the_content', 'HTML_for_timer' );
