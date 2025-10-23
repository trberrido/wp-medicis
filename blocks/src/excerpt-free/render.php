<?php

// Get the post ID from context or current post
$post_id = $block->context['postId'];

if (!$post_id) {
    return;
}

// Get the raw post content
$post = get_post($post_id);
$raw_content = $post->post_content ?? '';

// Get first 45 characters without filtering HTML
$excerpt = substr($raw_content, 0, 300);


// Add ellipsis if content was truncated
if (strlen($raw_content) > 45) {
    $excerpt .= '...';
}

// Get block wrapper attributes
$wrapper_attributes = get_block_wrapper_attributes();
?>

<div <?php echo $wrapper_attributes; ?>>
    <?php echo $excerpt; ?>
</div>