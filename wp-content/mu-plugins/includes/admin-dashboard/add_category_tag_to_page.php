<?php 

add_action('init', 'myPluginSettings');

// add categories and tags to page cpt 
function myPluginSettings()
{
    // add tag / category metabox to page
    // register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}
