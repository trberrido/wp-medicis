<?php
$block_id = wp_unique_id( 'pm-perec-block-' );

$grouped_posts = [];

$juries = get_terms([
    'taxonomy'      => 'perec_category',
    'hide_empty'    => true,
    'orderby'       => 'menu_order',
    'order'         => 'ASC'
]);

foreach ($juries as $jury) {
    $posts = get_posts([
        'post_type'         => 'perec',
        'posts_per_page'    => -1,
        'post_status'       => 'publish',
        'orderby'           => 'menu_order',
        'order'             => 'ASC',
        'tax_query'         => [
            [
                'taxonomy'  => 'perec_category',
                'field'     => 'term_id',
                'terms'     => $jury->term_id
            ]
        ]
    ]);
    if (!empty($posts)) {
        $grouped_posts[$jury->name] = $posts;
    }
}

?>

<div
    <?php echo get_block_wrapper_attributes(); ?>
    data-wp-interactive="pm/perecs"
    data-wp-init="callbacks.init"
<?php echo wp_interactivity_data_wp_context( ['currentJuryId' => 0 . '', 'currentTitleId' => 0 . '' ] ); ?>
    id="<?php echo esc_attr($block_id); ?>"
>
    <div class="perec-column perec-column__index">

    <?php
        $index_jury = 0;
        foreach ($grouped_posts as $jury => $posts) : ?>

    <div class="perec-index__item" data-juryid="<?php echo $index_jury; ?>">
        <h2 class="perec-index__author has-100-font-size"><?php echo $jury; ?></h2>
        <?php
            $index_title = 0; 
            foreach ($posts as $post) : ?>
            <h3
                data-titleid="<?php echo $index_title; ?>"
                data-wp-on--click="actions.selection"
                <?php echo wp_interactivity_data_wp_context( ['juryId' => $index_jury . '', 'titleId' => $index_title . '' ] ); ?>
                class="perec-index__title has-450-font-size"><?php echo $post->post_title; ?></h3>
        <?php
            $index_title += 1;
            endforeach; ?>
    </div>

<?php
    $index_jury += 1;
    endforeach; ?>

    </div>
    <div class="perec-column perec-column__content">
        <div class="pm-icon pm-icon__plume"></div>
        <?php
            $index_jury = 0; 
            foreach ($grouped_posts as $jury => $posts) : ?>
            <?php
                $index_title = 0; 
                foreach ($posts as $post) : ?>

                    <div
                        class="perec-content__post pm-hidden"
                        data-juryid="<?php echo $index_jury; ?>"
                        data-titleid="<?php echo $index_title; ?>"
                     >
                        <div class="perec-content__text">
                            <?php echo $post->post_content; ?>
                        </div>
                        <p class="perec-content__signature">
                            <?php echo $jury; ?>
                        </p>
                    </div>
            
            <?php
                $index_title += 1;
                endforeach; ?>
        <?php
            $index_jury += 1; 
            endforeach; ?>
    </div>
</div>

<?php //console($grouped_posts[array_key_first($grouped_posts)]); ?>
