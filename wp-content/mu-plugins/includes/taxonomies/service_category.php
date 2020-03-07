<?php

add_action('init', 'createServiceCategoryHierarchicalTaxonomy', 0);

function createServiceCategoryHierarchicalTaxonomy()
{

    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
    $labels = [
        'name' => _x('Service Category', 'taxonomy general name'),
        'singular_name' => _x('Service Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Service Category'),
        'all_items' => __('All Service Category'),
        'parent_item' => __('Parent Service Category'),
        'parent_item_colon' => __('Parent Service Category:'),
        'edit_item' => __('Edit Service Category'),
        'update_item' => __('Update Service Category'),
        'add_new_item' => __('Publish'),
        'new_item_name' => __('New Service Category Name'),
        'menu_name' => __('Service Category'),
    ];

    $args = [
        'capabilities' => array(
            'manage_terms' => 'edit_services',
            'edit_terms' => 'edit_services',
            'delete_terms' => 'edit_services',
            'assign_terms' => 'edit_services',
        ),
        'capability_type' => 'service_category',
        'map_meta_cap' => true,
        'hierarchical' => true,
        'labels' => $labels,
        'show_ui' => true,
        'show_admin_column' => true,
        'query_var' => true,
        // 'rewrite' => array('slug' => 'topic'),
    ];

    // Now register the taxonomy
    register_taxonomy('service_category', 'service', $args);
}
