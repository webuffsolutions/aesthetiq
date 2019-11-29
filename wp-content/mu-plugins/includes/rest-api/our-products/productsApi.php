<?php

add_action('rest_api_init', 'productsApiRoute');

function productsApiRoute()
{
    //wp-json/aesthetiq-api/v1/{params or payload}
    register_rest_route('aesthetiq-api/v1', '/products', [
        'methods' => 'GET', 'callback' => 'getProductsApi'
    ]);
}

function getProductsApi()
{

    $terms = get_terms([
        'taxonomy' => 'product_category', 
        'hide_empty' => false
    ]);

    $productCategory = [];

    $i = 0;
    foreach ($terms as $term) {
        $productCategory[$i]['term_id'] = $term->term_id;
        $productCategory[$i]['name'] = $term->name;
        $productCategory[$i]['slug'] = $term->slug;
        $productCategory[$i]['taxonomy'] = $term->taxonomy;
        $productCategory[$i]['description'] = $term->description;
        $productCategory[$i]['thumbnail_details'] = get_field('thumbnail', $term->taxonomy . '_' . $term->term_id);
        $productCategory[$i]['thumbnail_url'] = $productCategory[$i]['thumbnail_details']['sizes']['700x250'];

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

        $products1 = new WP_Query($args);
        while ($products1->have_posts()) {
            $products1->the_post();

            $productCategory[$i]['products'][] = [
                'product_id'    => get_the_ID(),
                'product_name'  => get_the_title(),
                'thumbnail_url' => get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'),
                'permalink' => get_the_permalink()
            ];
        }

        $i++;
    }

    $args = ['numberposts' => -1, 'post_type' => 'product'];
    $products = get_posts($args);
    $productsArr = [];

    $x = 0;
    $ids = [];
    foreach ($products as $product) {
        $productsArr[$x]['ID'] = $product->ID;
        $productsArr[$x]['post_title'] = $product->post_title;
        $productsArr[$x]['post_content'] = $product->post_content;
        $productsArr[$x]['menu_order'] = $product->menu_order;
        $productsArr[$x]['post_date'] = $product->post_date;
        $productsArr[$x]['post_type'] = $product->post_type;
        $x++;
    }

    return wp_send_json([
        'api_details'      => 'our products page (list of products api)',
        'product_category' => $productCategory,
        'products'         => $productsArr
    ], 200);
}
