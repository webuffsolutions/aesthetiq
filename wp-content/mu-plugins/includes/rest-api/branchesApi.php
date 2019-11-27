<?php

add_action('rest_api_init', 'branchesApiRoute');

function branchesApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/branches', [
        'methods' => 'GET', 'callback' => 'getBranchesApi'
    ]);
}

function getBranchesApi()
{
    $args = [
        'post_type' => 'location',
        'orderby' => 'menu_order',
        'order' => 'ASC'
    ];

    $locations = new WP_Query($args);

    $locationsArr = [];
    while ($locations->have_posts()) {
        $locations->the_post();
        $locationsArr[] = strtoupper(get_the_title());
    }

    return wp_send_json([
        'success' => true,
        'branches' => $locationsArr
    ], 200);
}
