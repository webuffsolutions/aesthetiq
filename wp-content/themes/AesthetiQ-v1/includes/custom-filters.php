<?php

/*
    ==========================================
    Remove wordpress version from header / rss
    ==========================================
*/

add_filter('the_generator', '__return_null');

/*
    ==========================================
    Remove script versions
    ==========================================
*/

function removeCSSAndJSVersion($src)
{
    if (strpos($src, '?ver='))
        $src = remove_query_arg('ver', $src);
    return $src;
}

add_filter('style_loader_src', 'removeCSSAndJSVersion', 1000);
add_filter('script_loader_src', 'removeCSSAndJSVersion', 1000);

/*
    ==========================================
    enable shortcodes in a widget area
    ==========================================
*/

add_filter('widget_text', 'do_shortcode');

/*
    ==========================================
    admin footer modification
    ==========================================
*/

function modifyAdminFooter()
{
    echo '<span id="footer-thankyou">Powered by <a href="http://www.webuffsolutions.com" target="_blank">WeBuff Solutions</a></span>';
}

add_filter('admin_footer_text', 'modifyAdminFooter');

/*
    ==========================================
    login logo link redirect
    ==========================================
*/

function customLoginLogoUrl()
{
    return get_bloginfo('url');
}

add_filter('login_headerurl', 'customLoginLogoUrl');

/*
    ==========================================
    login logo url title
    ==========================================
*/

function customLoginLogoUrlTitle()
{
    return 'AesthetiQ Wellness and Spa';
}

add_filter('login_headertitle', 'customLoginLogoUrlTitle');

function customLoginErrorMsg()
{
    return 'These credentials do not match our records.';
}

add_filter('login_errors', 'customLoginErrorMsg');

/*
    ==========================================
    redirect to profile after log in
    ==========================================
*/

function redirectToProfilePageAfterLogin($redirect_to, $request, $user)
{
    return admin_url('profile.php');
}

add_filter('login_redirect', 'redirectToProfilePageAfterLogin', 10, 3);

/*
    ==========================================
    handle custom login redirect
    ==========================================
*/

function handleCustomLoginRedirect($redirect_to, $request, $user)
{
    global $user;
    return admin_url('profile.php');
}

add_filter("login_redirect", "handleCustomLoginRedirect", 10, 3);
