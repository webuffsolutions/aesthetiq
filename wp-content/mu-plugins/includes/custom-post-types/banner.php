<?php

function AQCreateBannerCpt()
{
    $labels = [
        'name' => __('Sliders'),
        'singular_name' => __('Slider'),
        'all_items' => __('All Sliders'),
        'add_new_item' => __('New Slider'),
        'add_new' => __('Add New'),
        'new_item' => __('New Slider'),
        'edit_item' => __('Edit Slider'),
        'update_item' => __('Update Slider'),
        'view_item' => __('View Slider'),
        'view_items' => __('View Slider'),
        'search_items' => __('Search Sliders'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Slider Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'post',
        // 'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Sliders',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('banner', $args);
}

add_action('init', 'AQCreateBannerCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteBannerFlush()
{
    AQCreateBannerCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteBannerFlush');

// remove specific column from admin
function removeBannerSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeBannerSpecificColumnsInit()
{
    add_filter('manage_banner_posts_columns', 'removeBannerSpecificColumns');
}

add_action('admin_init', 'removeBannerSpecificColumnsInit');

/*
 * Add columns to banner post list
 */
function customBannerACFColumns($columns)
{
    return array_merge($columns, [
        'banner_image' => __('Featured Image'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_banner_posts_columns', 'customBannerACFColumns');

// Add columns to banner post list
function customBannerColumns($column, $post_id)
{
    switch ($column) {
        case 'banner_image':
            echo '<img src="' . get_field('banner_image')['sizes']['medium'] . '">';
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_banner_posts_custom_column', 'customBannerColumns', 10, 2);

// sortable columns
function customBannerSortableColumns($columns)
{
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-banner_sortable_columns", "customBannerSortableColumns");

// order of columns
function customBannerColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';

    foreach ($columns as $key => $value) {

        if ($key == $before_date) {
            $n_columns['banner_image'] = '';
            $n_columns['order'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_banner_posts_columns', 'customBannerColumnOrder');
