<?php 

$args = [
    'theme_location' => 'primary',
    'container'      => false, // add div container
    'menu_class'     => 'navbar-nav order-lg-2 order-1', // ul class
    'add_li_class'   => 'nav-item px-2' // custom arg [function = additionalClassOnListItem()]
];

wp_nav_menu($args);