<?php 

add_action('rest_api_init', 'specificProductApiRoute');

function specificProductApiRoute()
{
    // http://localhost/wordpress/aesthetiq/wp-json/aesthetiq-api/v1/specific-service/all-services-pro
    register_rest_route('aesthetiq-api/v1', '/specific-product/(?P<slug>[a-zA-Z0-9-]+)', [
        'methods' => 'GET',
        'callback' => 'getSpecificProductApi'
    ]);
}

function getSpecificProductApi($data)
{

    $term = get_term_by('slug', $data['slug'], 'product_category');
    $term->thumbnail_details = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
    $term->thumbnail_url = $term->thumbnail_details['sizes']['700x250'];

    // products custom post type
    $args = [
        'post_type' => 'product',
        'orderby' => 'menu_order',
        'order' => 'ASC',
        'tax_query' => [
            [
                'taxonomy' => 'product_category',
                'field' => 'slug',
                'terms' => $term->slug
            ]
        ]
    ];

    $products = [];
    $productsCpt = new WP_Query($args);

    while ($productsCpt->have_posts()) {
        $productsCpt->the_post();
        has_excerpt() ? $excerpt = get_the_excerpt() : $excerpt = '';

        $products[] = [
            'product_id'    => get_the_ID(),
            'product_name'  => get_the_title(),
            'post_content' => get_the_content(),
            'excerpt' => $excerpt,
            'thumbnail_url' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
            'thumbnail_700x250_url' => get_the_post_thumbnail_url(get_the_ID(), '600x550'),
            'permalink' => get_the_permalink()
        ];
    }

    return wp_send_json([
        'api_details' => 'our products page (specific product api)',
        'data' => $term,
        'products' => $products
    ], 200);
}