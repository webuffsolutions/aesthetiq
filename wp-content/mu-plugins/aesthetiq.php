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
include_once('includes/custom-post-types/product.php');

// custom taxonomies
include_once('includes/taxonomies/service_category.php');
include_once('includes/taxonomies/product_category.php');

// custom rest api
include_once('includes/rest-api/birthDetailsApi.php');
include_once('includes/rest-api/treatmentsApi.php');
include_once('includes/rest-api/branchesApi.php');
include_once('includes/rest-api/preferredTimeApi.php');
include_once('includes/rest-api/our-services/servicesApi.php');
include_once('includes/rest-api/our-services/specificServiceApi.php');

// custom actions
include_once('includes/actions/submit-appointment.php');

// admin dashboard functions
include_once('includes/admin-dashboard/add_category_tag_to_page.php');
include_once('includes/admin-dashboard/hide_roles.php');