<?php

function AQCreateServiceCpt()
{
    $labels = [
        'name' => __('Services'),
        'singular_name' => __('Service'),
        'all_items' => __('All Services'),
        'add_new_item' => __('New Service'),
        'add_new' => __('Add New'),
        'new_item' => __('New Service'),
        'edit_item' => __('Edit Service'),
        'update_item' => __('Update Service'),
        'view_item' => __('View Service'),
        'view_items' => __('View Service'),
        'search_items' => __('Search Services'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Service Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'service',
        'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Services',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['title', 'editor', 'thumbnail', 'page-attributes', 'excerpt'],
        'exclude_from_search' => false,
        'rewrite' => ['slug' => 'services'],
        'show_in_rest' => true,
        'publicly_queryable' => true
    ];

    register_post_type('service', $args);
}

add_action('init', 'AQCreateServiceCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteServiceFlush()
{
    AQCreateServiceCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteServiceFlush');

// remove specific column from admin
function removeServiceSpecificColumns($columns)
{
    // unset($columns['title']);
    return $columns;
}

function removeServiceSpecificColumnsInit()
{
    add_filter('manage_service_posts_columns', 'removeServiceSpecificColumns');
}

add_action('admin_init', 'removeServiceSpecificColumnsInit');

/*
 * Add columns to service post list
 */
function customServiceACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_service_posts_columns', 'customServiceACFColumns');

// Add columns to service post list
function customServiceColumns($column, $post_id)
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

add_action('manage_service_posts_custom_column', 'customServiceColumns', 10, 2);

// sortable columns
function customServiceSortableColumns($columns)
{
    $columns["title"] = "title";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-service_sortable_columns", "customServiceSortableColumns");

// order of columns
function customServiceColumnOrder($columns)
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

add_filter('manage_service_posts_columns', 'customServiceColumnOrder');
