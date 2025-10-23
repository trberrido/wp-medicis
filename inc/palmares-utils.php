<?php

/* Used by block pm/palmares */

function print_td($items){ ?>

<?php

$prize_map = array(
	'Français' => 'Littérature française',
	'Étranger' => 'Littérature étrangère',
	'Essai' => 'Essai'
);


?>

	<td class="prize-cell">
		<?php if (!empty($items)): ?>
			<div class="prize-items">
	
				<?php foreach ($items as $item): ?>
					<div class="graduate-item">

						<p class="prize-label--mobile">
							<?php echo esc_html($prize_map[$item['prize']]); ?>
						</p>

						<a class="graduate-link" href="<?php echo esc_url($item['permalink']); ?>">
							<?php echo esc_html($item['author']); ?><br>
							<span class="graduate-link__title"><?php echo esc_html($item['title']); ?></span>
						</a>

						<div class="graduate-infos">
							<?php if (!empty($item['thumbnail'])): ?>
								<span
								data-wp-on--click="actions.toggleModale"
								class="graduate-ico">
									
									<dialog>

										<button>
											<span
											aria-hidden="true"
											class="ico">×</span><span class="text">Fermer</span>
										</button>
										
										<img
										class="graduate-img"
										src="<?php echo esc_url($item['thumbnail']); ?>"
										alt="<?php echo esc_attr($item['title']); ?>">

									</dialog>

								</span>
							<?php else: ?>
								<span class="graduate-empty-ico"></span>
							<?php endif; ?>
							<?php if (!empty($item['editor'])): ?>
								<span class="graduate-publisher">/ <?php echo esc_html($item['editor']); ?></span>
							<?php endif; ?>
						</div>
						
						
					</div>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</td>

<?php }

function display_graduates_table() {

	$block_id = wp_unique_id( 'pm-palmares-' );
	$context = array(
		'decade' 		=> null,
		'activedecades'	=> []
	);

?>

<div

	<?php echo get_block_wrapper_attributes(); ?>
	id="<?php echo esc_attr($block_id); ?>"
	data-wp-interactive="pm/palmares"
	data-wp-context='<?php echo wp_json_encode( $context ); ?>'

>

<?php

	$order = isset($_GET['year_order']) ? sanitize_text_field($_GET['year_order']) : 'DESC';
	$keyword = isset($_GET['keyword']) ? sanitize_text_field($_GET['keyword']) : '';
	$current_url = strtok($_SERVER['REQUEST_URI'], '?');

    // Step 1: Query all graduate posts
    $args = array(
        'post_type' => 'graduate',
        'posts_per_page' => -1
    );
    
    $graduates = get_posts($args);
    
    // Step 2: Build array with graduate information
    $graduate_data = array();
    
    foreach ($graduates as $graduate) {
        $item = array();
        
        // Title
        $item['title'] = $graduate->post_title;
        
        // Year - first item from graduate_year taxonomy
        $years = get_the_terms($graduate->ID, 'graduate_year');
        $item['year'] = (!empty($years) && !is_wp_error($years)) ? $years[0]->name : '';
        
        // Prize - from graduate_prize taxonomy
        $prizes = get_the_terms($graduate->ID, 'graduate_prize');
        $item['prize'] = (!empty($prizes) && !is_wp_error($prizes)) ? $prizes[0]->name : '';
        
        // Editor - from graduate_publisher taxonomy
        $publishers = get_the_terms($graduate->ID, 'graduate_publisher');
        $item['editor'] = (!empty($publishers) && !is_wp_error($publishers)) ? $publishers[0]->name : '';

		$author = get_post_meta($graduate->ID, 'pm__graduate__author_name', true);
		$item['author'] = $author ? $author : '';
        
		if (!empty($keyword)) {
			$title_match = stripos($item['title'], $keyword) !== false;
			$content_match = stripos($graduate->post_content, $keyword) !== false;
			$author_match = stripos($item['author'], $keyword) !== false;
			$publisher_match = stripos($item['editor'], $keyword) !== false;
			$year_match = stripos($item['year'], $keyword) !== false;
			
			if (!$title_match && !$content_match && !$author_match && !$publisher_match && !$year_match) {
				continue; // Skip this graduate if keyword doesn't match
			}
		}

        // Thumbnail URL
        $item['thumbnail'] = get_the_post_thumbnail_url($graduate->ID, 'medium');
        if (!$item['thumbnail']) {
            $item['thumbnail'] = '';
        }

		$item['permalink'] = get_permalink($graduate->ID);
        
        $graduate_data[] = $item;
    }

	$organized_data = array();

	foreach ($graduate_data as $item) {
		$year = $item['year'];
		$prize = $item['prize'];

		if (empty($year) || !in_array($prize, array('Français', 'Étranger', 'Essai'))) {
			continue;
		}

			// Initialize year if not exists
		if (!isset($organized_data[$year])) {
			$organized_data[$year] = array(
				'Français' => array(),
				'Étranger' => array(),
				'Essai' => array()
			);
		}
		
		$organized_data[$year][$prize][] = $item;


	}

	if ($order === 'DESC') {
		krsort($organized_data);
	} else {
		ksort($organized_data);
	} 

?>

<form method="get" action="<?php echo esc_url($current_url); ?>" class="graduate-search-form">
    <?php
    // Preserve other query parameters
    foreach ($_GET as $key => $value) {
        if ($key !== 'keyword') {
            echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($value) . '">';
        }
    }
    ?>
    <input 
        type="text" 
        name="keyword" 
        value="<?php echo esc_attr($keyword); ?>" 
        placeholder="RECHERCHER"
        class="graduate-search-input"
    />
    <button type="submit" class="search-button">Recherche</button>
    <?php /*
	<?php if (!empty($keyword)): ?>
        <a href="<?php echo esc_url($current_url); ?>" class="clear-search">Effacer</a>
    <?php endif; ?>
	*/ ?>
</form>

<?php if (empty($organized_data)) : ?>
	<p class="graduate-no-result">Aucun lauréat ne répond aux critères de recherche.</p>
<?php else: ?>

<?php	// decades filtering part
	
	if (empty($keyword)) :

		$terms = get_terms(array(
			'taxonomy' => 'graduate_year',
			'hide_empty' => true,
			'orderby' => 'name',
			'order' => 'ASC'
		));
		
		$decades = array();

			foreach ($terms as $term) {
			$year = intval($term->name);
			
			if ($year > 0) {
				$decade_start = floor($year / 10) * 10;
				$decade_key = $decade_start;
				
				if (!isset($decades[$decade_key])) {
					$decades[$decade_key] = array(
						'min_year' => $year,
						'max_year' => $year,
						'terms' => array()
					);
				}
				
				$decades[$decade_key]['min_year'] = min($decades[$decade_key]['min_year'], $year);
				$decades[$decade_key]['max_year'] = max($decades[$decade_key]['max_year'], $year);
				$decades[$decade_key]['terms'][] = $term;
			}
		}

		krsort($decades);

		echo '<ul
			class="pm-decade__list"
			data-wp-init="callbacks.init"
			data-default-decade="' . esc_attr( array_key_first( $decades ) ) . '"
		>';
		foreach ($decades as $decade_key => $decade_data) :
			$decade_label = $decade_data['min_year'] . ' - ' . $decade_data['max_year']; ?>

			<li class="pm-decade__ist-item">
				<button
				class="pm-decades__button"
				data-wp-class--active="context.activedecades.is<?php echo esc_attr($decade_key); ?>"
				data-wp-on--click="actions.toggle"
				data-decade="<?php echo $decade_key; ?>">
					<?php echo esc_html($decade_label); ?>
				</button>
			</li>

	<?php endforeach;
		echo '</ul>';
	endif;	
?>

<table class="graduates-table">
	<thead>
		<tr>
			<th>
			<?php
                $new_order = ($order === 'DESC') ? 'ASC' : 'DESC';
                $current_url = strtok($_SERVER['REQUEST_URI'], '?');
                $order_url = add_query_arg('year_order', $new_order, $current_url);
                ?>
                <a class="table-filter-year <?php echo 'pm-tfy pm-tfy--' . ( ($order === 'DESC') ? 'desc' : 'asc' ); ?>" href="<?php echo esc_url($order_url); ?>">
                    Année 
                </a>
			</th>
			<th>Littérature française</th>
			<th>Littérature étrangère</th>
			<th>Essai</th>
		</tr>
	</thead>

	  <tbody>
        <?php foreach ($organized_data as $year => $prizes):
					$decade = floor(intval($year) / 10) * 10;	
		?>
            <tr
			class="graduate-row"

			<?php if (empty($keyword)) : ?>
			data-wp-class--hidden="!context.activedecades.is<?php echo esc_attr($decade); ?>"
			<?php endif; ?>

			data-decade="<?php echo $decade ?>">
                <td class="year-cell"><?php echo esc_html($year); ?></td>
                
				<?php foreach ( $prizes as $prize_name => $items ) {
					print_td($items);
				}
				?>

            </tr>
        <?php endforeach; ?>
    </tbody>



</table>

<?php endif; ?>

</div>

<?php

}
