<?php

$post_id = $block->context['postId'];

if (!$post_id){
	return ;
}

// Get the terms for the 'graduate_prize' taxonomy
$terms = get_the_terms($post_id, 'graduate_prize');

// Check if terms exist and are not an error
if (!$terms || is_wp_error($terms)) {
    return '';
}

// Get the first term
$first_term = reset($terms);

// Get the term description
$description = term_description($first_term->term_id, 'graduate_prize');

// If there's no description, return empty
if (empty($description)) {
    return '';
}

// Get block wrapper attributes
$wrapper_attributes = get_block_wrapper_attributes();

// Output the description
?>
<div <?php echo $wrapper_attributes; ?>>
    <?php echo $description; ?>
</div>