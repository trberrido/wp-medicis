<?php if ( ! defined( 'ABSPATH' ) ) exit;

add_filter( 'rest_endpoints', 'pm__remove_users_endpoints');
function pm__remove_users_endpoints( $endpoints ): array {

	if ( isset( $endpoints['/wp/v2/users'] ) ) {
		unset( $endpoints['/wp/v2/users'] );
	}
	if ( isset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] ) ) {
		unset( $endpoints['/wp/v2/users/(?P<id>[\d]+)'] );
	}

	return $endpoints;

}

remove_action( 'wp_head', 'wp_generator' );
