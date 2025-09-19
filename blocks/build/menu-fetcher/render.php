<?php

	$block_id = wp_unique_id( 'pm-menu-fetcher-' );

	$context = array(
		'isOpen' => false
	);

	if ( empty( $attributes['selectedMenu'] ) ) {
		return ;
	}

	$args = array(
		'theme_location'	=> $attributes['selectedMenu'],
		'container'			=> false,
		'echo'				=> false,
		'item_spacing'		=> 'discard',
		'menu_class'		=> ($attributes['hasMobileBurger'] ? 'pm-desktop-only menu' : 'menu')
	);
	$menu = wp_nav_menu( $args );
	if ( $menu === false ) {
		return ;
	}

?>

<div
	<?php echo get_block_wrapper_attributes( ['class' => 'menu__' . $attributes['selectedMenu'] ]); ?>
	id="<?php echo esc_attr($block_id); ?>"
	data-wp-interactive="pm/menu-fetcher"
	data-wp-context='<?php echo wp_json_encode( $context ); ?>'
>
	
	<?php if ($attributes['hasMobileBurger']) : ?>
		<button
			class="pm-burger pm-mobile-only"
			data-wp-on--click="actions.toggle"
			>
			<div class="pm-burger__slices-container">
				<div class="pm-burger__slice"></div>
				<div class="pm-burger__slice"></div>
				<div class="pm-burger__slice"></div>
				<div class="pm-burger__slice"></div>
			</div>
			<span class="pm-burger__label">Menu</span>
		</button>

		<button
			data-wp-on--click="actions.toggle"
			class="pm-mobile-only pm-menu__close-button">Fermer</button>
	<?php endif; ?>

	<?php echo $menu; ?>

</div>