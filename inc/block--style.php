<?php if ( ! defined( 'ABSPATH' ) ) exit;

//add_action( 'init', 'pm__register_blocks_styles' );
function pm__register_blocks_styles(): void {

	/* [
		spacename/block-name = [
				style-slug => 'Style Label'
			]
		]
	*/

	$blocks = array(
		'core/paragraph'	=> array(
			'highlight'		=> 'Highlight'
		)
	);

	foreach ( $blocks as $block_name => $style_properties ) {
		foreach ( $style_properties as $name => $label ) {
			register_block_style( $block_name, array(
				'name'			=> $name,
				'label'			=> $label
			) );
		}
	}

}

add_action( 'init', 'pm__enqueue_blocks_styles' );
function pm__enqueue_blocks_styles(): void {

	$blocks_css_directory = '/assets/css/blocks/';
	foreach ( glob( get_stylesheet_directory() . $blocks_css_directory . '*', GLOB_ONLYDIR ) as $directory ) {
		$namespace = basename( $directory );
		foreach ( glob( $directory . '/*.css' ) as $css_file ) {
			$blockname = basename( $css_file, '.css' );
			wp_enqueue_block_style(
				$namespace . '/' . $blockname,
				array(
					'handle'	=> 'df-' . $namespace . '-' . $blockname,
					'src'		=> get_template_directory_uri() . $blocks_css_directory . $namespace . '/' . $blockname . '.css',
					'path'		=> get_template_directory() . $blocks_css_directory . $namespace . '/' . $blockname . '.css',
					'ver'		=> filemtime( get_template_directory() . $blocks_css_directory . $namespace . '/' . $blockname . '.css' )
				)
			);
		}
	}

}