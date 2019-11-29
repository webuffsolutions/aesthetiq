<?php

add_action('init', 'createProductCategoryHierarchicalTaxonomy', 0);

function createProductCategoryHierarchicalTaxonomy()
{

    // Add new taxonomy, make it hierarchical like categories
    //first do the translations part for GUI
    $labels = [
        'name' => _x('Product Category', 'taxonomy general name'),
        'singular_name' => _x('Product Category', 'taxonomy singular name'),
        'search_items' =>  __('Search Product Category'),
        'all_items' => __('All Product Category'),
        'parent_item' => __('Parent Product Category'),
        'parent_item_colon' => __('Parent Product Category:'),
        'edit_item' => __('Edit Product Category'),
        'update_item' => __('Update Product Category'),
        'add_new_item' => __('Publish'),
        'new_item_name' => __('New Product Category Name'),
        'menu_name' => __('Product Category'),
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
    register_taxonomy('product_category', 'product', $args);
}
