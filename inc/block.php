<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'pm__register_blocks_types' );
function pm__register_blocks_types(): void {

	wp_register_block_metadata_collection(
		get_stylesheet_directory() . '/blocks/build/',
		get_stylesheet_directory() . '/blocks/build/blocks-manifest.php',
	);

	foreach ( glob( get_stylesheet_directory() . '/blocks/build/*' ) as $block_directory ) {
		register_block_type( $block_directory );
	}

}