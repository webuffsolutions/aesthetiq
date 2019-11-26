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
        'add_new_item' => __('New Service Category'),
        'new_item_name' => __('New Service Category Name'),
        'menu_name' => __('Service Category'),
    ];

    $args = [
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
