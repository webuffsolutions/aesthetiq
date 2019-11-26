<?php

add_action('rest_api_init', 'servicesApiRoute');

function servicesApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/services', [
        'methods' => 'GET', 'callback' => 'getServicesApi'
    ]);
}

function getServicesApi()
{

    $terms = get_terms([
        'taxonomy' => 'service_category', 
        'hide_empty' => false,
        'exclude' => [13] // exclude featured signature treatments
    ]);

    $serviceCategory = [];

    $i = 0;
    foreach ($terms as $term) {
        $serviceCategory[$i]['term_id'] = $term->term_id;
        $serviceCategory[$i]['name'] = $term->name;
        $serviceCategory[$i]['slug'] = $term->slug;
        $serviceCategory[$i]['taxonomy'] = $term->taxonomy;
        $serviceCategory[$i]['description'] = $term->description;
        $serviceCategory[$i]['thumbnail_details'] = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
        $serviceCategory[$i]['thumbnail_url'] = $serviceCategory[$i]['thumbnail_details']['sizes']['700x250'];

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

        $services1 = new WP_Query($args);
        while ($services1->have_posts()) {
            $services1->the_post();

            $serviceCategory[$i]['services'][] = [
                'service_id'    => get_the_ID(),
                'service_name'  => get_the_title(),
                'thumbnail_url' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'permalink' => get_the_permalink()
            ];
        }

        $i++;
    }

    $args = ['numberposts' => -1, 'post_type' => 'service'];
    $services = get_posts($args);
    $servicesArr = [];

    $x = 0;
    $ids = [];
    foreach ($services as $service) {
        $servicesArr[$x]['ID'] = $service->ID;
        $servicesArr[$x]['post_title'] = $service->post_title;
        $servicesArr[$x]['post_content'] = $service->post_content;
        $servicesArr[$x]['menu_order'] = $service->menu_order;
        $servicesArr[$x]['post_date'] = $service->post_date;
        $servicesArr[$x]['post_type'] = $service->post_type;
        $x++;
    }

    return wp_send_json([
        'api_details'      => 'our services page (list of services api)',
        'service_category' => $serviceCategory,
        'services'         => $servicesArr
    ], 200);
}
