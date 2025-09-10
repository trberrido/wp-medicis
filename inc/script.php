<?php if ( ! defined( 'ABSPATH' ) ) exit;


function my_load_scripts() {

	wp_enqueue_script( 'openyear', get_template_directory_uri() . '/assets/main.js', array(), filemtime( get_template_directory() . '/assets/main.js' ), true );

}
add_action('wp_enqueue_scripts', 'my_load_scripts');