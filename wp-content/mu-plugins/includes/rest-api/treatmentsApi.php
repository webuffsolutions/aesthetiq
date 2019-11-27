<?php

add_action('rest_api_init', 'treatmentsApiRoute');

function treatmentsApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/treatments', [
        'methods' => 'GET', 'callback' => 'getTreatmentsApi'
    ]);
}

function getTreatmentsApi()
{

    // $test = [
    //     ['FACIAL TREATMENTS' => [
    //         ['options' => 'AQ Clean'],
    //         ['options' => 'AQ Pure']
    //     ]],
    //     ['WELLNESS' => [
    //         ['options' => 'AQ Relax'],
    //         ['options' => 'AQ Indulge']
    //     ]]
    // ];

    $terms = get_terms([
        'taxonomy' => 'service_category', 
        'hide_empty' => false,
        'exclude' => [13] // exclude featured signature treatments
    ]);

    $treatmentsArr = [];
    $servicesArr = [];

    foreach ($terms as $term) {
        $term->name = strtoupper($term->name);

        $args = [
            'post_type' => 'service',
            'orderby' => 'menu_order',
            'order' => 'ASC',
            'tax_query' => [
                [
                    'taxonomy' => 'service_category',
                    'field' => 'slug',
                    'terms' => $term->slug
                ]
            ]
        ];

        $services = new WP_Query($args);
        while ($services->have_posts()) {
            $services->the_post();
            $servicesArr[] = ['options' => wp_specialchars_decode( get_the_title() )];
        }

        // array of final objects
        $treatmentsArr[] = (object) [$term->name => $servicesArr];

        $servicesArr = []; //empty arr
    }

    return wp_send_json([
        'success' => true,
        'treatments' => $treatmentsArr
    ], 200);
}
