<?php
$block_id = wp_unique_id( 'pm-year-filter-block-' );
$years = get_terms([
    'taxonomy'      => 'graduate_year',
    'hide_empty'    => true,
    'orderby'       => 'name',
    'order'         => 'DESC'
]);
?>

<ul
    <?php echo get_block_wrapper_attributes(); ?>
    data-wp-interactive="pm/year-filter"
    data-wp-init="callbacks.init"
    <?php echo wp_interactivity_data_wp_context( ['currentYear' => $years[0]->name ] ); ?>
    id="<?php echo esc_attr($block_id); ?>"
>

    <?php

    foreach ($years as $year) : ?>

    <li
        class="pm-year-filter-item"
        data-wp-on--click="actions.selection"
        <?php echo wp_interactivity_data_wp_context( ['year' => $year->name ] ); ?>
    >
        <?php echo esc_html($year->name); ?>
    </li>

    <?php endforeach; ?>

</ul>