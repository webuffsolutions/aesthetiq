<?php

add_theme_support('title-tag');
add_theme_support('post-thumbnails');

include(get_template_directory() . '/includes/enqueue.php');
include(get_template_directory() . '/includes/custom-filters.php');
include(get_template_directory() . '/includes/custom-actions.php');
include(get_template_directory() . '/includes/image-sizes.php');
include(get_template_directory() . '/includes/custom-nav-menus.php');