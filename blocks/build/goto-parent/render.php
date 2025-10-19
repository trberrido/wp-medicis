<?php

$post_id = $block->context['postId'];

if ($post_id && get_post_type($post_id) === 'page') {
    $parent_id = wp_get_post_parent_id($post_id);

	if ($parent_id) {
		$parent_title = get_the_title($parent_id);
		$parent_url = get_permalink($parent_id);
		echo '<a href="' . esc_url($parent_url) . '">' . esc_html($parent_title) . '</a>';
	} else {
		echo '<h1>' . get_the_title() . '</h1>';
	}
    
    
} else {
	echo '<h1>' . get_the_title() . '</h1>';
}