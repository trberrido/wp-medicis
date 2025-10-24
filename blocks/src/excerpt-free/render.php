<?php
$post_id=$block->context['postId']??get_the_ID();
if(!$post_id)return;

$post=get_post($post_id);
$content=apply_filters('the_content',$post->post_content);

// keep safe HTML (b, strong, i, em)
$allowed_tags='<b><strong><i><em>';
$clean=strip_tags($content,$allowed_tags);

// trim by characters, but don’t break tags
$max_length=300;
if(strlen(strip_tags($clean))>$max_length){
	preg_match('/^.{0,'.$max_length.'}(?=\s|$)/su',$clean,$matches);
	$excerpt=$matches[0].'...';
}else{
	$excerpt=$clean;
}

$wrapper_attributes=get_block_wrapper_attributes();
?>

<div <?php echo $wrapper_attributes; ?>>
	<?php echo $excerpt; ?>
</div>