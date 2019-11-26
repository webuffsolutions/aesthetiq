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
    $branches = [
        'WEST AVE', 'VISAYAS AVE',
        'TIMOG AVE', 'MARILAO',
        'MALOLOS', 'TARLAC',
        'SM TARLAC', 'CALASIAO',
        'CABANATUAN', 'BALIWAG',
        'TELABASTAGAN', 'URDANETA'
    ];

    return wp_send_json([
        'success' => true,
        'branches' => $branches
    ], 200);
}
