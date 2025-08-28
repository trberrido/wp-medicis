<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'init', 'pm__register_menu' );
function pm__register_menu() {
	register_nav_menus( array(
		'primary'		=> 'Navigation principale',
		'secondary'		=> 'Navigation secondaire',
		'home-footer' 	=> 'Pied de page (Accueil)',
		)
	);
}