<?php

/*
    ==========================================
    custom login layout
    ==========================================
*/

function customLoginLayout()
{
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-style.css" />';
}

add_action('login_head', 'customLoginLayout');


/*
    ==========================================
    remove login shake effect
    ==========================================
*/

function removeLoginShakeEffectOnError()
{
    remove_action('login_head', 'wp_shake_js', 12);
}

add_action('login_head', 'removeLoginShakeEffectOnError');

/*
    ==========================================
    remove wordpress admin bar logo in admin area
    ==========================================
*/

function removeAdminBarLogoInAdminArea()
{
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'removeAdminBarLogoInAdminArea', 0);

/*
    ==========================================
    redirect to profile when dashboard is accessed
    ==========================================
*/

function redirectDashboardToProfilePage()
{
    wp_redirect(admin_url('profile.php'));
}

add_action('load-index.php', 'redirectDashboardToProfilePage');

function remove_menus()
{
    global $menu;
    $restricted = array(__('Dashboard'), __('Posts'), __('Comments'));
    //$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
    end($menu);
    while (prev($menu)) {
        $value = explode(' ', $menu[key($menu)][0]);
        if (in_array($value[0] != NULL ? $value[0] : '', $restricted)) {
            unset($menu[key($menu)]);
        }
    }
}
add_action('admin_menu', 'remove_menus');

/*
    ==========================================
    hide edit appointment update button
    ==========================================
*/

function hideEditAppointmentUpdate() { ?>
    <style type="text/css">
        .post-php.post-type-appointment #publishing-action {display:none;}
    </style>
<?php }

add_action('admin_enqueue_scripts', 'hideEditAppointmentUpdate' );