<?php

add_action('rest_api_init', 'birthDetailsApiRoute');

function birthDetailsApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/birth-details', [
        'methods' => 'GET', 'callback' => 'getBirthDetailsApi'
    ]);
}

function getBirthDetailsApi()
{
    $birthMonths = [
        'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
        'October', 'November', 'December'
    ];

    $birthDates = [];
    for ($x = 1; $x < 32; $x++) {
        $birthDates[] = $x;
    }

    $birthYears = [];
    for ($x = 2019; $x > 1940; $x--) {
        $birthYears[] = $x;
    }

    return wp_send_json([
        'success' => true,
        'birthMonths' => $birthMonths,
        'birthDates' => $birthDates,
        'birthYears' => $birthYears
    ], 200);
}
