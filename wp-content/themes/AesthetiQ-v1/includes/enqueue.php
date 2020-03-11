<?php

/*
@package AesthetiQ Wellness and Spa theme
    ===============
    ENQUEUE FILES
    ===============
*/

function mainStyles()
{
    wp_enqueue_style('main-styles', get_stylesheet_uri());
    wp_enqueue_style('main', get_theme_file_uri('/assets/css/main.css'));
    wp_enqueue_style('fontawesome', '//cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css');
    wp_enqueue_style('custom-fonts', get_theme_file_uri('/assets/fonts/stylesheet.css'));
    wp_enqueue_style('air-datepicker', get_theme_file_uri('/assets/air-datepicker-master/dist/css/datepicker.min.css'));
    // wp_enqueue_style('sweetalert', get_theme_file_uri('/node_modules/sweetalert2/dist/sweetalert2.min.css'));
    // wp_enqueue_style('lightbox', get_theme_file_uri('/node_modules/lightbox2/dist/css/lightbox.min.css'));
    wp_enqueue_style('sweetalert', '//cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.min.css');
    wp_enqueue_style('lightbox', '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/css/lightbox.min.css');

    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_theme_file_uri('/assets/js/main.js'), NULL, '1.0', true);
    wp_enqueue_script('appointment', get_theme_file_uri('/assets/js/appointment.js'), NULL, microtime(), true);

    wp_enqueue_script('popperJS', '//cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', NULL, '1.0', true);
    wp_enqueue_script('bootstrapJS', get_theme_file_uri('/assets/bootstrap-4.3.1-dist/js/bootstrap.min.js', NULL, '1.0', true));
    wp_enqueue_script('airDatePickerJS', get_theme_file_uri('/assets/air-datepicker-master/dist/js/datepicker.min.js', NULL, '1.0', true));
    wp_enqueue_script('airDatePickerEnglishJS', get_theme_file_uri('/assets/air-datepicker-master/dist/js/i18n/datepicker.en.js', NULL, '1.0', true));
    wp_enqueue_script('datepicker-init', get_theme_file_uri('/assets/js/datepicker-init.js'), NULL, '1.0', true);
    // wp_enqueue_script('sweetalert', get_theme_file_uri('/node_modules/sweetalert2/dist/sweetalert2.all.min.js'), NULL, '1.0', true);
    // wp_enqueue_script('lighbox', get_theme_file_uri('/node_modules/lightbox2/dist/js/lightbox.min.js'), NULL, '1.0', true);

    wp_enqueue_script('sweetalert', '//cdn.jsdelivr.net/npm/sweetalert2@9.10.0/dist/sweetalert2.all.min.js', NULL, '1.0', true);
    wp_enqueue_script('lightbox', '//cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.1/js/lightbox.min.js', NULL, '1.0', true);
    wp_enqueue_script('our-services', get_theme_file_uri('/assets/js/our-services.js'), NULL, microtime(), true);
    wp_enqueue_script('our-products', get_theme_file_uri('/assets/js/our-products.js'), NULL, microtime(), true);
    wp_enqueue_script('init', get_theme_file_uri('/assets/js/init.js'), NULL, microtime(), true);

    // https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js
    wp_enqueue_script('jquery-validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js', NULL, '1.0', true);
    wp_enqueue_script('additional-methods', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js', NULL, '1.0', true);

    wp_localize_script('appointment', 'settings', ['site_url' => get_option('siteurl'), 'ajaxurl' => admin_url('admin-ajax.php')]);
    wp_localize_script('init', 'init_settings', ['permalink' => basename(get_permalink())]);

    wp_localize_script('our-services', 'services_settings', [
        'site_url' => get_option('siteurl'),
        'permalink' => basename(get_permalink())
    ]);

    wp_localize_script('our-products', 'products_settings', [
        'site_url' => get_option('siteurl'),
        'permalink' => basename(get_permalink())
    ]);
}

add_action('wp_enqueue_scripts', 'mainStyles');
