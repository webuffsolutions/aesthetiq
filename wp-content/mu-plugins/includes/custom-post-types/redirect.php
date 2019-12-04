<?php

function AQCreateRedirectCpt()
{
    $labels = [
        'name' => __('Redirects'),
        'singular_name' => __('Redirect'),
        'all_items' => __('All Redirects'),
        'add_new_item' => __('New Redirect'),
        'add_new' => __('Add New'),
        'new_item' => __('New Redirect'),
        'edit_item' => __('Edit Redirect'),
        'update_item' => __('Update Redirect'),
        'view_item' => __('View Redirect'),
        'view_items' => __('View Redirect'),
        'search_items' => __('Search Redirects'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Redirect Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'redirect',
        'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Redirects',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['thumbnail', 'page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('redirect', $args);
}

add_action('init', 'AQCreateRedirectCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteRedirectFlush()
{
    AQCreateRedirectCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteRedirectFlush');

// remove specific column from admin
function removeRedirectSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeRedirectSpecificColumnsInit()
{
    add_filter('manage_redirect_posts_columns', 'removeRedirectSpecificColumns');
}

add_action('admin_init', 'removeRedirectSpecificColumnsInit');

/*
 * Add columns to redirect post list
 */
function customRedirectACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'shortcut_description' => __('Shortcut Description'),
        'redirect_button_label' => __('Redirect Button Label'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_redirect_posts_columns', 'customRedirectACFColumns');

// Add columns to Redirect post list
function customRedirectColumns($column, $post_id)
{
    switch ($column) {
        case 'img':
            echo get_the_post_thumbnail($post_id, 'thumbnail', true);
            break;
        case 'shortcut_description':
            echo get_post_field('shortcut_description', $post_id);
            break;
        case 'redirect_button_label':
            echo get_post_field('redirect_button_label', $post_id);
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_redirect_posts_custom_column', 'customRedirectColumns', 10, 2);

// sortable columns
function customRedirectSortableColumns($columns)
{
    $columns["shortcut_description"] = "shortcut_description";
    $columns["redirect_button_label"] = "redirect_button_label";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-redirect_sortable_columns", "customRedirectSortableColumns");

// order of columns
function customRedirectColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';

    foreach ($columns as $key => $value) {

        if ($key == $before_date) {
            $n_columns['img'] = '';
            $n_columns['shortcut_description'] = '';
            $n_columns['redirect_button_label'] = '';
            $n_columns['order'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_redirect_posts_columns', 'customRedirectColumnOrder');
