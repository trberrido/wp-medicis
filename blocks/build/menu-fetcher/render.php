<?php

	if ( empty( $attributes['selectedMenu'] ) ) {
		return ;
	}

	$args = array(
		'theme_location'	=> $attributes['selectedMenu'],
		'container'			=> false,
		'echo'				=> false,
		'item_spacing'		=> 'discard'
	);
	$menu = wp_nav_menu( $args );
	if ( $menu === false ) {
		return ;
	}

?>

<div <?php echo get_block_wrapper_attributes( ['class' => 'menu__' . $attributes['selectedMenu'] ]); ?>>
	<?php echo $menu; ?>
</div>