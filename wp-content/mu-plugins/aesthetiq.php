<?php

// Plugin Name: AesthetiQ
// Plugin URI: https://webuffsolutions.com
// Description: AesthetiQ Wellness and SPA - Custom Plugin
// Version: 1.0
// Author: Denneth Dacara
// Author URI: https://webuffsolutions.com

if (!defined('ABSPATH')) exit;

// custom post types
include_once('includes/custom-post-types/banner.php');
include_once('includes/custom-post-types/global_partner.php');
include_once('includes/custom-post-types/loyalty_partner.php');
include_once('includes/custom-post-types/location.php');
include_once('includes/custom-post-types/redirect.php');
include_once('includes/custom-post-types/appointment.php');
include_once('includes/custom-post-types/service.php');
include_once('includes/custom-post-types/testimonial.php');

// custom taxonomies
include_once('includes/taxonomies/service_category.php');

// custom rest api
include_once('includes/rest-api/birthDetailsApi.php');
include_once('includes/rest-api/treatmentsApi.php');
include_once('includes/rest-api/branchesApi.php');
include_once('includes/rest-api/preferredTimeApi.php');
include_once('includes/rest-api/our-services/servicesApi.php');
include_once('includes/rest-api/our-services/specificServiceApi.php');

// custom actions
include_once('includes/actions/submit-appointment.php');

// add categories and tags to page cpt 
function myplugin_settings()
{
    // add tag / category metabox to page
    // register_taxonomy_for_object_type('post_tag', 'page');
    register_taxonomy_for_object_type('category', 'page');
}

add_action('init', 'myplugin_settings');
