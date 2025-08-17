<?php if ( ! defined( 'ABSPATH' ) ) exit;

/* Create a CPT jury, with the option In memoriam */

add_action( 'init', 'pm__register_cpt__jury' );

function pm__register_cpt__jury() {
	$labels = array(
		'name'					=> 'Jurés',
		'singular_name'			=> 'Juré',
		'menu_name'				=> 'Jurés',
		'all_items'				=> 'Tous les jurés',
		'add_new'				=> 'Ajouter un juré',
		'add_new_item'			=> 'Ajouter un nouveau juré',
		'edit_item'				=> 'Modifier le juré',
		'new_item'				=> 'Nouveau juré',
		'view_item'				=> 'Voir le juré',
		'search_items'			=> 'Rechercher un juré',
		'not_found'				=> 'Aucun juré trouvé',
		'not_found_in_trash'	=> 'Aucun juré trouvé dans la corbeille'
	);

	register_post_type( 'jury',
		array(
			'label'				=> 'juré',
			'labels'			=> $labels,
			'supports'			=> array( 
				'title',
				'excerpt',
				'editor',
				'thumbnail'
			),
			'show_in_rest'		=> true,
			'public'			=> true,
			'menu_icon'			=> 'dashicons-image-filter',
			'rewrite'			=> array( 
				'slug' => 'jures',
			)
		)
	);

	$args = array(
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'has_archive'       => false,
	);
	register_taxonomy( 'jury_category', array( 'jury' ), $args );

	$term_name = 'In memoriam';
	if ( null === term_exists( $term_name, 'jury_category' ) ){
		wp_insert_term( $term_name, 'jury_category', null );
	}

}

