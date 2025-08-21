<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'pm__graduate__register_metas' );

function pm__graduate__register_metas() {
	register_post_meta( 'graduate', 'pm__graduate__translator_name', array(
		'show_in_rest'			=> true,
		'single'				=> true,
		'label'					=> 'Nom du traducteur',
		'default'				=> '',
		'type'					=> 'string',
		'sanitize_callback'		=> 'sanitize_text_field',
		'auth_callback'			=> function() { return current_user_can('edit_posts'); }
	) );
   	register_post_meta( 'graduate', 'pm__graduate__country', array(
		'show_in_rest'			=> true,
		'single'				=> true,
		'label'					=> 'Pays  de l\'auteur',
		'default'				=> '',
		'type'					=> 'string',
		'sanitize_callback'		=> 'sanitize_text_field',
		'auth_callback'			=> function() { return current_user_can('edit_posts'); }
	) );
}

// Enqueue the JavaScript files for admin UI
add_action('enqueue_block_editor_assets', 'enqueue_book_translator_script');
function enqueue_book_translator_script() {
    $screen = get_current_screen();
    if ($screen && $screen->post_type === 'graduate') {
        foreach ( glob( get_template_directory() . '/admin/graduate/*.js') as $script ){
            wp_enqueue_script(
                basename($script, '.js'),
                get_template_directory_uri() . '/admin/graduate/' . basename($script),
                array('wp-plugins', 'wp-edit-post', 'wp-element', 'wp-components', 'wp-data'),
                filemtime( $script ),
                true
            );
        }
    }
}