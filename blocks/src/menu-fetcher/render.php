<?php

	if ( empty( $attributes['selectedMenu'] ) ) {
		return ;
	}

	$args = array(
		'menu'				=> $attributes['selectedMenu'],
		'container'			=> false,
		'echo'				=> false,
		'item_spacing'		=> 'discard'
	);
	$menu = wp_nav_menu( $args );
	if ( $menu === false ) {
		return ;
	}

?>

<div <?php echo get_block_wrapper_attributes(); ?>>
	<?php echo $menu; ?>
</div>