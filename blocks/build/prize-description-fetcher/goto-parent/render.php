<?php

$post_id = $block->context['postId'];

if (!$post_id){
	return ;
}
	
	
if (get_post_type($post_id) === 'page') {
 
	$parent_id = wp_get_post_parent_id($post_id);

	if ($parent_id) {
		$parent_title = get_the_title($parent_id);
		$parent_url = get_permalink($parent_id);
		echo '<a class="pm-rootitle" href="' . esc_url($parent_url) . '">' . esc_html($parent_title) . '</a>';
	} else {
		echo '<h1 class="pm-rootitle">' . get_the_title() . '</h1>';
	}
    
}

if (get_post_type($post_id) === 'post') {
	$page = get_page_by_path('la-vie-du-prix');
	$url = get_permalink($page->ID);
	echo '<a class="pm-rootitle" href="' . esc_url($url) . '">' . esc_html($page->post_title) . '</a>';
}

if (get_post_type($post_id) === 'jury') {

	if (has_term('in-memoriam', 'jury_category', $post_id)) {
		$page = get_page_by_path('les-jures/in-memoriam');

	} else {
		$page = get_page_by_path('les-jures');
	}
	$url = get_permalink($page->ID);
	echo '<a class="pm-rootitle" href="' . esc_url($url) . '">' . esc_html($page->post_title) . '</a>';
}