<?php

	if ( empty( $attributes['metaKey'] ) || empty( $block->context['postId'] ) ) {
		return ;
	}

	$meta_value = get_post_meta( $block->context['postId'], $attributes['metaKey'], true );

	if ( empty( $meta_value ) ) {
		return ;
	}


	echo sprintf(
		'<p %s>%s</p>',
		get_block_wrapper_attributes(),
		esc_html( $meta_value )
	);
	