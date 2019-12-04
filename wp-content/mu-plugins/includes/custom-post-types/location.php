<?php

function AQCreateLocationCpt()
{
    $labels = [
        'name' => __('Locations'),
        'singular_name' => __('Location'),
        'all_items' => __('All Locations'),
        'add_new_item' => __('New Location'),
        'add_new' => __('Add New'),
        'new_item' => __('New Location'),
        'edit_item' => __('Edit Location'),
        'update_item' => __('Update Location'),
        'view_item' => __('View Location'),
        'view_items' => __('View Location'),
        'search_items' => __('Search Locations'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Location Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'location',
        'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Locations',
        'labels' => $labels,
        'menu_icon' => 'dashicons-location',
        'menu_position' => 10,
        'supports' => ['title', 'editor', 'thumbnail', 'page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('location', $args);
}

add_action('init', 'AQCreateLocationCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteLocationFlush()
{
    AQCreateLocationCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteLocationFlush');

// remove specific column from admin
function removeLocationSpecificColumns($columns)
{
    // unset($columns['title']);
    return $columns;
}

function removeLocationSpecificColumnsInit()
{
    add_filter('manage_location_posts_columns', 'removeLocationSpecificColumns');
}

add_action('admin_init', 'removeLocationSpecificColumnsInit');

/*
 * Add columns to location post list
 */
function customLocationACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'title' => __('Location'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_location_posts_columns', 'customLocationACFColumns');

// Add columns to location post list
function customLocationColumns($column, $post_id)
{
    switch ($column) {
        case 'img':
            echo get_the_post_thumbnail($post_id, 'thumbnail', true);
            break;
        case 'title':
            echo get_the_title($post_id);
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_location_posts_custom_column', 'customLocationColumns', 10, 2);

// sortable columns
function customLocationSortableColumns($columns)
{
    $columns["title"] = "title";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-location_sortable_columns", "customLocationSortableColumns");

// order of columns
function customLocationColumnOrder($columns)
{
    $n_columns = array();
    $before_title = 'title';
    $before_date = 'date';

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

add_filter('manage_location_posts_columns', 'customLocationColumnOrder');
