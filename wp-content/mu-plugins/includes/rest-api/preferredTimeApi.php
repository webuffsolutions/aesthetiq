<?php

add_action('rest_api_init', 'preferredTimeApiRoute');

function preferredTimeApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/preferred-time', [
        'methods' => 'GET', 'callback' => 'getListOfPreferredTimeApi'
    ]);
}

function getListOfPreferredTimeApi()
{
    $allAvailableTime = [
        '01:00', '01:30', '02:00', '02:30', '03:00', '03:30', '04:00', '04:30',
        '05:00', '05:30', '06:00', '06:30', '07:00', '07:30', '08:00', '08:30',
        '09:00', '09:30', '10:00', '10:30', '11:00', '11:30', '12:00', '12:30'
    ];

    return wp_send_json([
        'success' => true,
        'allAvailableTime' => $allAvailableTime
    ], 200);
}
