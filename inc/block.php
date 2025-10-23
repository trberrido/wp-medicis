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

add_filter('pre_render_block', 'themeslug_pre_render_excerpt', 10, 3);

function themeslug_pre_render_excerpt(
	?string $pre_render,
	array $block,
	?WP_Block $parent_block
): ?string {
	if (
		'core/post-excerpt' === $block['blockName']
		&& is_null($pre_render)
		&& ! is_null($parent_block)
		&& isset($parent_block->context['postId'])
		&& has_excerpt($parent_block->context['postId'])
	) {
		add_filter('wp_trim_words', 'themeslug_format_excerpt', 10, 4);
	}

	return $pre_render;
}