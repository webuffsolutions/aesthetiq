<?php

// navigation menus (register theme locations)
register_nav_menus([
    'primary' => __('Primary Menu'),
    'header_schedules' => __('Header - Schedules'),
    'footer_our_team' => __('Footer - Our Team'),
    'footer_menu' => __('Footer - Menu'),
    'footer_contact' => __('Footer - Contact'),
    // 'footer_follow' => __('Footer - Follow'),
    'footer_legal' => __('Footer - Legal')
]);

// custom nav list item args
function additionalClassOnListItem($classes, $item, $args)
{
    if ($args->theme_location == 'primary') {
        if ($args->add_li_class) {
            $classes[] = $args->add_li_class;
        }
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'additionalClassOnListItem', 1, 3);

function wpse156165_menu_add_class($atts, $item, $args)
{
    if ($args->theme_location == 'primary') {
        $class = 'nav-link hover-link';
    }

    if (
        $args->theme_location == 'footer_menu' || $args->theme_location == 'footer_follow'
        || $args->theme_location == 'footer_legal'
    ) {
        $class = 'text-white';
    }

    $atts['class'] = $class;
    return $atts;
}

add_filter('nav_menu_link_attributes', 'wpse156165_menu_add_class', 10, 3);
