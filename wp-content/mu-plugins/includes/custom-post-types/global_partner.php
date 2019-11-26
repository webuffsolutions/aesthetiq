<?php

function AQCreateGlobalPartnerCpt()
{
    $labels = [
        'name' => __('Global Partners'),
        'singular_name' => __('Global Partner'),
        'all_items' => __('All Global Partners'),
        'add_new_item' => __('New Global Partner'),
        'add_new' => __('Add New'),
        'new_item' => __('New Global Partner'),
        'edit_item' => __('Edit Global Partner'),
        'update_item' => __('Update Global Partner'),
        'view_item' => __('View Global Partner'),
        'view_items' => __('View Global Partner'),
        'search_items' => __('Search Global Partners'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Global Partner Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'post',
        // 'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Global Partners',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['thumbnail', 'page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('global_partner', $args);
}

add_action('init', 'AQCreateGlobalPartnerCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteGlobalPartnerFlush()
{
    AQCreateGlobalPartnerCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteGlobalPartnerFlush');

// remove specific column from admin
function removeGlobalPartnerSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeGlobalPartnerSpecificColumnsInit()
{
    add_filter('manage_global_partner_posts_columns', 'removeGlobalPartnerSpecificColumns');
}

add_action('admin_init', 'removeGlobalPartnerSpecificColumnsInit');

/*
 * Add columns to global_partner post list
 */
function customGlobalPartnerACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'partner_name' => __('Partner Name'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_global_partner_posts_columns', 'customGlobalPartnerACFColumns');

// Add columns to global_partner post list
function customGlobalPartnerColumns($column, $post_id)
{
    switch ($column) {
        case 'img':
            echo get_the_post_thumbnail($post_id, 'thumbnail', true);
            break;
        case 'partner_name':
            echo get_post_field('partner_name', $post_id);
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_global_partner_posts_custom_column', 'customGlobalPartnerColumns', 10, 2);

// sortable columns
function customGlobalPartnerSortableColumns($columns)
{
    $columns["partner_name"] = "partner_name";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-global_partner_sortable_columns", "customGlobalPartnerSortableColumns");

// order of columns
function customGlobalPartnerColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';

    foreach ($columns as $key => $value) {

        if ($key == $before_date) {
            $n_columns['img'] = '';
            $n_columns['partner_name'] = '';
            $n_columns['order'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_global_partner_posts_columns', 'customGlobalPartnerColumnOrder');
