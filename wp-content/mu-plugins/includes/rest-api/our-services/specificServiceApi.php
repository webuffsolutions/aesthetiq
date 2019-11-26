<?php 

add_action('rest_api_init', 'specificServiceApiRoute');

function specificServiceApiRoute()
{
    // http://localhost/wordpress/aesthetiq/wp-json/aesthetiq-api/v1/specific-service/all-services-pro
    register_rest_route('aesthetiq-api/v1', '/specific-service/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'getSpecificServiceApi'
    ]);
}

function getSpecificServiceApi($data)
{

    // $terms = get_terms(['taxonomy' => 'service_category', 'hide_empty' => false]);
    $term = get_term_by('slug', $data['slug'], 'service_category');
    $term->thumbnail_details = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
    $term->thumbnail_url = $term->thumbnail_details['sizes']['700x250'];

    // services custom post type
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

    $services = [];
    $servicesCpt = new WP_Query($args);

    while ($servicesCpt->have_posts()) {
        $servicesCpt->the_post();
        has_excerpt() ? $excerpt = get_the_excerpt() : $excerpt = '';

        $services[] = [
            'service_id'    => get_the_ID(),
            'service_name'  => get_the_title(),
            'post_content' => get_the_content(),
            'excerpt' => $excerpt,
            'thumbnail_url' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
            'thumbnail_700x250_url' => get_the_post_thumbnail_url(get_the_ID(), '600x550'),
            'permalink' => get_the_permalink()
        ];
    }

    return wp_send_json([
        'api_details' => 'our services page (specific service api)',
        'data' => $term,
        'services' => $services
    ], 200);
}