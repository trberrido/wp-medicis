<?php
$post_id=$block->context['postId']??get_the_ID();
if(!$post_id)return;

$post=get_post($post_id);
$content=$post->post_content??'';

// keep formatting, remove shortcodes and block comments
$content=do_blocks($content);
$content=wpautop($content);

// use wp_html_excerpt to preserve tag integrity
$excerpt=wp_html_excerpt($content,300);
if(strlen(strip_tags($content))>300){
	$excerpt.='...';
}

$wrapper_attributes=get_block_wrapper_attributes();
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php echo $excerpt; ?>
</div>