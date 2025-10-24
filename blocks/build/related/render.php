<?php

	if ( empty( $block->context['postId'] ) ) {
		return ;
	}

?>

<div <?php echo get_block_wrapper_attributes(); ?>>

<p class="graduate-footer__heading">Voir aussi</p>

<?php

	$post_id = $block->context['postId'];
	$meta_value = get_post_meta( $post_id, 'pm__graduate__links', true );

	$links = json_decode( $meta_value, true );
	
	if ( empty( $links ) ) {

		$terms = get_the_terms($current_post_id, 'graduate_year');
		if ($terms && !is_wp_error($terms)) {

			$term = array_shift($terms);

			$args = array(
				'post_type' => 'graduate',
				'tax_query' => array(
					array(
						'taxonomy' => 'graduate_year',
						'field'    => 'term_id',
						'terms'    => $term->term_id,
					),
				),
				'post__not_in' => array($post_id), // Exclude current post
				'posts_per_page' => -1, // Get all matching posts
				'orderby' => 'title',
				'order' => 'ASC',
			);

			$related_posts = get_posts( $args );
			
			$links = array_map(function($post) {
				return array(
					'title' => $post->post_title,
					'url' => $post->guid,
				);
			}, $related_posts);

		} else { return ; }

	}

	echo '<ul>';
	foreach ( $links as $link ) {
		echo sprintf(
			'<li><a href="%s" rel="noopener">%s</a></li>',
			esc_url( $link['url'] ),
			esc_html( $link['title'] )
		);
	}
	echo '</ul>';
	
?>

</div>