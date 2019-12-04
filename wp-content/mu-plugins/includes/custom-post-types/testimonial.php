<?php

function AQCreateTestimonialCpt()
{
    $labels = [
        'name' => __('Testimonials'),
        'singular_name' => __('Testimonial'),
        'all_items' => __('All Testimonials'),
        'add_new_item' => __('New Testimonial'),
        'add_new' => __('Add New'),
        'new_item' => __('New Testimonial'),
        'edit_item' => __('Edit Testimonial'),
        'update_item' => __('Update Testimonial'),
        'view_item' => __('View Testimonial'),
        'view_items' => __('View Testimonial'),
        'search_items' => __('Search Testimonials'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Testimonial Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'testimonial',
        'map_meta_cap' => true,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'label'  => 'Testimonials',
        'labels' => $labels,
        'menu_icon' => 'dashicons-format-chat',
        'menu_position' => 10,
        'supports' => ['thumbnail', 'page-attributes'],
        'exclude_from_search' => true,
    ];

    register_post_type('testimonial', $args);
}

add_action('init', 'AQCreateTestimonialCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteTestimonialFlush()
{
    AQCreateTestimonialCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteTestimonialFlush');

// remove specific column from admin
function removeTestimonialSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeTestimonialSpecificColumnsInit()
{
    add_filter('manage_testimonial_posts_columns', 'removeTestimonialSpecificColumns');
}

add_action('admin_init', 'removeTestimonialSpecificColumnsInit');

/*
 * Add columns to testimonial post list
 */
function customTestimonialACFColumns($columns)
{
    return array_merge($columns, [
        'img' => __('Featured Image'),
        'full_name' => __('Full Name'),
        'message' => __('Message'),
        'rating' => __('Rating'),
        'order' => __('Sort Order'),
        'date' => __('Date Added')
    ]);
}

add_filter('manage_testimonial_posts_columns', 'customTestimonialACFColumns');

// Add columns to testimonial post list
function customTestimonialColumns($column, $post_id)
{

    switch ($column) {
        case 'img':
            echo get_the_post_thumbnail($post_id, 'thumbnail', true);
            break;
        case 'full_name':
            echo get_post_field('full_name', $post_id);
            break;
        case 'message':
            echo get_post_field('message', $post_id);
            break;
        case 'rating':
            echo get_post_field('rating', $post_id) . '/5';
            break;
        case 'order':
            echo get_post_field('menu_order', $post_id);
            break;
    }
}

add_action('manage_testimonial_posts_custom_column', 'customTestimonialColumns', 10, 2);

// sortable columns
function customTestimonialSortableColumns($columns)
{
    $columns["full_name"] = "full_name";
    $columns["rating"] = "rating";
    $columns["order"] = "order";
    return $columns;
}

add_filter("manage_edit-testimonial_sortable_columns", "customTestimonialSortableColumns");

// order of columns
function customTestimonialColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';

    foreach ($columns as $key => $value) {

        if ($key == $before_date) {
            $n_columns['img'] = '';
            $n_columns['full_name'] = '';
            $n_columns['message'] = '';
            $n_columns['rating'] = '';
            $n_columns['order'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_testimonial_posts_columns', 'customTestimonialColumnOrder');
