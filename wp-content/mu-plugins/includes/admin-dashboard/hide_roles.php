<?php

add_action('admin_menu', 'hideSpecificRoles');

function hideSpecificRoles()
{
    global $wp_roles;

    $roles_to_remove = array('subscriber', 'contributor', 'author', 'editor');

    foreach ($roles_to_remove as $role) {
        if (isset($wp_roles->roles[$role])) {
            $wp_roles->remove_role($role);
        }
    }
}
