<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_action('pre_get_posts', 'pm__modify_jury_query_exclude_memoriam');

function pm__modify_jury_query_exclude_memoriam( $query ) {
    // Only modify queries in the admin area or if it's the main query
    if (is_admin() && !$query->is_main_query()) {
        return;
    }

	if ($query->get('post_type') === 'jury') {
        
        // Set ordering to use Simple Custom Post Order (menu_order)
        $query->set('orderby', 'menu_order');
        $query->set('order', 'ASC');

	}
    
    // Check if this is a query for 'jury' post type with the "!mem" search keyword
    if ($query->get('post_type') === 'jury' && $query->get('s') === '!mem') {
        
        // Remove the search parameter since we're using it as a trigger
        $query->set('s', '');
        
        // Set up tax_query to exclude posts with "in memoriam" term
        $tax_query = array(
            array(
                'taxonomy' => 'jury_category',
                'field'    => 'name',
                'terms'    => 'In memoriam',
                'operator' => 'NOT IN',
            ),
        );
        
        // If there are existing tax_query parameters, merge them
        $existing_tax_query = $query->get('tax_query');
        if (!empty($existing_tax_query)) {
            $tax_query = array_merge($existing_tax_query, $tax_query);
            $tax_query['relation'] = 'AND'; // Ensure AND relationship
        }

		$query->set('tax_query', $tax_query);
        
        // Ensure we're getting published posts
        $query->set('post_status', 'publish');
    }
}