<?php

function AQCreateAppointmentCpt()
{
    $labels = [
        'name' => __('Appointments'),
        'singular_name' => __('Appointment'),
        'all_items' => __('All Appointments'),
        'add_new_item' => __('New Appointment'),
        'add_new' => __('Add New'),
        'new_item' => __('New Appointment'),
        'edit_item' => __('Edit Appointment'),
        'update_item' => __('Update Appointment'),
        'view_item' => __('View Appointment'),
        'view_items' => __('View Appointment'),
        'search_items' => __('Search Appointments'),
        'not_found' => __('No results found.'),
        'not_found_in_trash' => __('No results found.'),
        'attributes' => __('Appointment Order ( 1 - 10 )')
    ];

    $args = [
        'capability_type' => 'post',
        // 'map_meta_cap' => true,
        'public' => false,
        'publicly_queryable' => false,
        'show_ui' => true,
        'label'  => 'Appointments',
        'labels' => $labels,
        'menu_icon' => 'dashicons-calendar-alt',
        'menu_position' => 10,
        'supports' => [''],
        'exclude_from_search' => true,
    ];

    register_post_type('appointment', $args);
}

add_action('init', 'AQCreateAppointmentCpt', 0);

// get permalinks to work when you activate the plugin
function AQRewriteAppointmentFlush()
{
    AQCreateAppointmentCpt();
    flush_rewrite_rules();
}

register_activation_hook(__FILE__, 'AQRewriteAppointmentFlush');

// remove specific column from admin
function removeAppointmentSpecificColumns($columns)
{
    unset($columns['title']);
    return $columns;
}

function removeAppointmentSpecificColumnsInit()
{
    add_filter('manage_appointment_posts_columns', 'removeAppointmentSpecificColumns');
}

add_action('admin_init', 'removeAppointmentSpecificColumnsInit');

/*
 * Add columns to appointment post list
 */
function customAppointmentACFColumns($columns)
{
    return array_merge($columns, [
        'full_name' => __('Full Name'),
        'mobile_no' => __('Mobile No.'),
        'treatment' => __('Treatment'),
        'preferred_branch' => __('Preferred Branch'),
        'preferred_date_time' => __('Preferred Date / Time'),
        'date' => __('Date Added')
    ]);
}

add_filter('manage_appointment_posts_columns', 'customAppointmentACFColumns');

// Add columns to appointment post list
function customAppointmentColumns($column, $post_id)
{

    $rawPreferredDate = get_post_field('preferred_date', $post_id);
    $rawPreferredTime = get_post_field('preferred_time', $post_id);

    $preferredDate = date('m/d/Y', strtotime($rawPreferredDate));
    $preferredTime = date('h:i A', strtotime($rawPreferredTime));

    $dateTime = $preferredDate . ' - ' . $preferredTime;

    switch ($column) {
        case 'full_name':
            echo get_post_field('full_name', $post_id);
            break;
        case 'mobile_no':
            echo get_post_field('mobile_no', $post_id);
            break;
        case 'treatment':
            echo get_post_field('treatment', $post_id);
            break;
        case 'preferred_branch':
            echo get_post_field('preferred_branch', $post_id);
            break;
        case 'preferred_date_time':
            echo $dateTime;
            break;
    }
}

add_action('manage_appointment_posts_custom_column', 'customAppointmentColumns', 10, 2);

// sortable columns
function customAppointmentSortableColumns($columns)
{
    $columns["full_name"] = "full_name";
    $columns["mobile_no"] = "mobile_no";
    $columns["treatment"] = "treatment";
    $columns["preferred_branch"] = "preferred_branch";
    $columns["preferred_date_time"] = "preferred_date_time";
    return $columns;
}

add_filter("manage_edit-appointment_sortable_columns", "customAppointmentSortableColumns");

// order of columns
function customAppointmentColumnOrder($columns)
{
    $n_columns = array();
    $before_date = 'date';

    foreach ($columns as $key => $value) {

        if ($key == $before_date) {
            $n_columns['full_name'] = '';
            $n_columns['email'] = '';
            $n_columns['mobile_no'] = '';
            $n_columns['treatment'] = '';
            $n_columns['preferred_branch'] = '';
            $n_columns['preferred_date_time'] = '';
        }

        $n_columns[$key] = $value;
    }

    return $n_columns;
}

add_filter('manage_appointment_posts_columns', 'customAppointmentColumnOrder');
