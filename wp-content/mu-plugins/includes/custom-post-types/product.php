<?php

function AQCreateProductCpt()
{
    $labels = [
        'name' => __('Products'),
        'singular_name' => __('Product'),
        'all_items' => __('All Products'),
        'add_new_item' => __('New Product'),
        'add_new' => __('Add New'),
        'new_item' => __('New Product'),
        'edit_item' => __('Edit Product'),
        'update_item' => __('Update Product'),
        'view_item' => __('View Product'),
        'view_items' => __('View Product'),
        'search_items' => __('Search Products'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Product Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'product',
        'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Products',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'excerpt'],
        'exclude_from_search' => false,
        'rewrite' => ['slug' => 'products'],
        'show_in_rest' => true,
        'publicly_queryable' => true
    ];

    register_post_type('product', $args);
}

add_action('init', 'AQCreateProductCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteProductFlush()
{
    AQCreateProductCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteProductFlush');

// remove specific column from admin
function removeProductSpecificColumns($columns)
{
    // unset($columns['title']);
    return $columns;
}

function removeProductSpecificColumnsInit()
{
    add_filter('manage_product_posts_columns', 'removeProductSpecificColumns');
}

add_action('admin_init', 'removeProductSpecificColumnsInit');

/*
 * Add columns to product post list
 */
function customProductACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_product_posts_columns', 'customProductACFColumns');

// Add columns to product post list
function customProductColumns($column, $post_id)
{
    switch ($column) {
        case 'img':
            echo get_the_post_thumbnail($post_id, 'thumbnail', true);
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_product_posts_custom_column', 'customProductColumns', 10, 2);

// sortable columns
function customProductSortableColumns($columns)
{
    $columns["title"] = "title";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-product_sortable_columns", "customProductSortableColumns");

// order of columns
function customProductColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';
    $before_title = 'title';

    foreach ($columns as $key => $value) {

        if ($key == $before_title) {
            $n_columns['img'] = '';
        }

        if ($key == $before_date) {
            $n_columns['order'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_product_posts_columns', 'customProductColumnOrder');
