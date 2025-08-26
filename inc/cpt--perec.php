<?php if ( ! defined( 'ABSPATH' ) ) exit;

/* Create a CPT à la Perec, with juries as categories */

add_action( 'init', 'pm__perec__register_cpt' );

function pm__perec__register_cpt() {
	$labels = array(
		'name'					=> 'À la Perec',
		'singular_name'			=> 'À la Perec',
		'menu_name'				=> 'À la Perec',
		'all_items'				=> 'Tous les articles à la Perec',
		'add_new'				=> 'Ajouter un article à la Perec',
		'add_new_item'			=> 'Ajouter un nouvel article à la Perec',
		'edit_item'				=> 'Modifier l’article à la Perec',
		'new_item'				=> 'Nouvel article à la Perec',
		'view_item'				=> 'Voir l’article à la Perec',
		'search_items'			=> 'Rechercher un article à la Perec',
		'not_found'				=> 'Aucun article à la Perec trouvé',
		'not_found_in_trash'    => 'Aucun article à la Perec trouvé dans la corbeille'
	);

	register_post_type( 'perec',
		array(
			'label'				=> 'à la Perec',
			'labels'			=> $labels,
			'supports'			=> array( 
				'title',
				'editor',
			),
			'show_in_rest'		=> true,
			'public'			=> true,
			'menu_icon'			=> 'dashicons-format-status',
			'rewrite'			=> array( 
				'slug' => 'perec-articles',
			)
	));
	
	register_taxonomy( 'perec_category', array( 'perec' ), array(
		'label'             => 'Jurés',
		'labels'            => array(
			'name'          => 'Jurés',
			'singular_name' => 'Juré',
			'add_new_item'  => 'Ajouter un juré',
			'edit_item'     => 'Modifier le juré',
			'search_items'  => 'Rechercher un juré',
			'not_found'     => 'Aucun juré trouvé',
			'not_found_in_trash' => 'Aucun juré trouvé dans la corbeille'
		),
		'hierarchical'      => true,
		'show_in_rest'      => true,
		'has_archive'       => false,
		'show_in_menu'      => false,
		'capabilities'      => array(
			'manage_terms'  => 'do_not_allow',
			'edit_terms'    => 'do_not_allow',
			'delete_terms'  => 'edit_posts',
			'assign_terms'  => 'edit_posts'
		)
	));

	/* list all post of cpt jury
	 * and create a term for each juré
	 */
	$args = array(
		'post_type'         => 'jury',
		'posts_per_page'    => -1,
		'post_status'       => 'publish',
		'orderby'           => 'title',
		'order'             => 'ASC',
	);
	$jury_posts = get_posts( $args );
	if ( ! empty( $jury_posts ) ) {
		foreach ( $jury_posts as $jury_post ) {
			$term_name = $jury_post->post_title;
			if ( null === term_exists( $term_name, 'perec_category' ) ){
				wp_insert_term( $term_name, 'perec_category', null );
			}
		}
	}

}