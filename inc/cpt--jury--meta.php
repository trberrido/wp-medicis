<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'pm__jury__register_metas' );

function pm__jury__register_metas() {
	register_post_meta( 'jury', 'pm__jury__second_title', array(
		'show_in_rest'			=> true,
		'single'				=> true,
		'label'					=> 'Sous titre',
		'default'				=> '',
		'type'					=> 'string',
		'sanitize_callback'		=> 'sanitize_text_field',
		'auth_callback'			=> function() { return current_user_can('edit_posts'); }
	) );
   	register_post_meta( 'jury', 'pm__jury__dates', array(
		'show_in_rest'			=> true,
		'single'				=> true,
		'label'					=> 'Dates',
		'default'				=> '',
		'type'					=> 'string',
		'sanitize_callback'		=> 'sanitize_text_field',
		'auth_callback'			=> function() { return current_user_can('edit_posts'); }
	) );
}

// Enqueue the JavaScript files for admin UI
add_action('enqueue_block_editor_assets', 'pm__jury__enqueue_admin_scripts');
function pm__jury__enqueue_admin_scripts() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'jury') {
        foreach ( glob( get_template_directory() . '/admin/jury/*.js') as $script ){
            wp_enqueue_script(
                'jury-' . basename($script, '.js'),
                get_template_directory_uri() . '/admin/jury/' . basename($script),
                array('wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data'),
                filemtime( $script ),
                true
            );
        }
    }
}