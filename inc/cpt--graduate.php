<?php if ( ! defined( 'ABSPATH' ) ) exit;

/* Create a CPT lauréat with:
 - years (tag)
 - catagorie (cat)
 - editeur (tag)
  - post meta: translator name
 */

add_action( 'init', 'pm__graduate__register_cpt' );

function pm__graduate__register_cpt() {
	$labels = array(
		'name'					=> 'Lauréats',
		'singular_name'			=> 'Lauréat',
		'menu_name'				=> 'Lauréats',
		'all_items'				=> 'Tous les lauréats',
		'add_new'				=> 'Ajouter un lauréat',
		'add_new_item'			=> 'Ajouter un nouveau lauréat',
		'edit_item'				=> 'Modifier le lauréat',
		'new_item'				=> 'Nouveau lauréat',
		'view_item'				=> 'Voir le lauréat',
		'search_items'			=> 'Rechercher un lauréat',
		'not_found'				=> 'Aucun lauréat trouvé',
		'not_found_in_trash'	=> 'Aucun lauréat trouvé dans la corbeille'
	);

	register_post_type( 'graduate',
		array(
			'label'				=> 'lauréat',
			'labels'			=> $labels,
			'supports'			=> array( 
				'title',
				'excerpt',
				'editor',
				'thumbnail',
				'custom-fields'
			),
			'show_in_rest'      => true,
			'public'            => true,
			'menu_icon'         => 'dashicons-book',
			'rewrite'           => array( 
				'slug' => 'laureat',
			)
		)
	);
	
	$args_year = array(
		'label'             => 'Années',
		'labels'            => array(
			'name'          => 'Années',
			'singular_name' => 'Année',
			'add_new_item'  => 'Ajouter une année',
			'edit_item'     => 'Modifier l’année',
			'search_items'  => 'Rechercher une année',
			'not_found'     => 'Aucune année trouvée',
			'not_found_in_trash' => 'Aucune année trouvée dans la corbeille'
		),
		'hierarchical'      => false,
		'show_in_rest'      => true,
		'has_archive'       => false,
	);
	register_taxonomy( 'graduate_year', array( 'graduate' ), $args_year );

	$args_publisher = array(
		'label'             => 'Éditeurs',
		'labels'            => array(
			'name'          => 'Éditeurs',
			'singular_name' => 'Éditeur',
			'add_new_item'  => 'Ajouter un éditeur',
			'edit_item'     => 'Modifier l’éditeur',
			'search_items'  => 'Rechercher un éditeur',
			'not_found'     => 'Aucun éditeur trouvé',
			'not_found_in_trash' => 'Aucun éditeur trouvé dans la corbeille'
		),
		'hierarchical'      => false,
		'show_in_rest'      => true,
		'has_archive'       => false,
	);
	register_taxonomy( 'graduate_publisher', array( 'graduate' ), $args_publisher );

	$args_prize = array(
		'label'				=> 'Prix',
		'labels'			=> array(
			'name'          	=> 'Prix',
			'singular_name' 	=> 'Prix',
			'add_new_item'  	=> 'Ajouter un prix',
			'edit_item'     	=> 'Modifier le prix',
			'search_items'  	=> 'Rechercher un prix',
			'not_found'     	=> 'Aucun prix trouvé',
			'not_found_in_trash' => 'Aucun prix trouvé dans la corbeille'
		),
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'has_archive'       => true,
		'rewrite'           => array(
			'slug' => 'prix',
		)
	);
	register_taxonomy( 'graduate_prize', array( 'graduate' ), $args_prize );
	$terms_prize = array(
		array(
			'name'			=> 'Français',
			'description'	=> 'Prix du roman en français',
		),
		array(
			'name'			=> 'Étranger',
			'description'	=> 'Prix du roman étranger',
		),
		array(
			'name'			=> 'Essai',
			'description'	=> 'Prix de l\'essai',
		)
	);
	foreach ( $terms_prize as $term ) {
		if ( null === term_exists( $term['name'], 'graduate_prize' ) ) {
			wp_insert_term( $term['name'], 'graduate_prize', array(
				'description' => $term['description']
			) );
		}
	}

}