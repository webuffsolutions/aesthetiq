<?php

function AQCreateLoyaltyProgramPartnerCpt()
{
    $labels = [
        'name' => __('Loyalty Program Partners'),
        'singular_name' => __('Loyalty Program Partner'),
        'all_items' => __('All Loyalty Program Partners'),
        'add_new_item' => __('New Loyalty Program Partner'),
        'add_new' => __('Add New'),
        'new_item' => __('New Loyalty Program Partner'),
        'edit_item' => __('Edit Loyalty Program Partner'),
        'update_item' => __('Update Loyalty Program Partner'),
        'view_item' => __('View Loyalty Program Partner'),
        'view_items' => __('View Loyalty Program Partner'),
        'search_items' => __('Search Loyalty Program Partners'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Loyalty Program Partner Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'loyalty_partner',
        'map_meta_cap' => true,
        'public' => true,
        'label'  => 'Loyalty Program Partners',
        'labels' => $labels,
        'menu_icon' => 'dashicons-list-view',
        'menu_position' => 10,
        'supports' => ['thumbnail', 'page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('loyalty_partner', $args);
}

add_action('init', 'AQCreateLoyaltyProgramPartnerCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteLoyaltyProgramPartnerFlush()
{
    AQCreateLoyaltyProgramPartnerCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteLoyaltyProgramPartnerFlush');

// remove specific column from admin
function removeLoyaltyProgramPartnerSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeLoyaltyProgramPartnerSpecificColumnsInit()
{
    add_filter('manage_loyalty_partner_posts_columns', 'removeLoyaltyProgramPartnerSpecificColumns');
}

add_action('admin_init', 'removeLoyaltyProgramPartnerSpecificColumnsInit');

/*
 * Add columns to loyalty_partner post list
 */
function customLoyaltyProgramPartnerACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'partner_name' => __('Partner Name'),
        'order' => __('Sort Order')
    ]);
}

add_filter('manage_loyalty_partner_posts_columns', 'customLoyaltyProgramPartnerACFColumns');

// Add columns to loyalty_partner post list
function customLoyaltyProgramPartnerColumns($column, $post_id)
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

add_action('manage_loyalty_partner_posts_custom_column', 'customLoyaltyProgramPartnerColumns', 10, 2);

// sortable columns
function customLoyaltyProgramPartnerSortableColumns($columns)
{
    $columns["partner_name"] = "partner_name";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-loyalty_partner_sortable_columns", "customLoyaltyProgramPartnerSortableColumns");

// order of columns
function customLoyaltyProgramPartnerColumnOrder($columns)
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

add_filter('manage_loyalty_partner_posts_columns', 'customLoyaltyProgramPartnerColumnOrder');
