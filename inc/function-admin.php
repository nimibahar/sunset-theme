<?php

/*
   ==============
     ADMIN PAGE
   ==============
*/

function sunset_add_admin_page(){
    // Generate Jen-Sunset Admin Page with built in WP function:
    add_menu_page( 'Jen Sunset Theme Options', 'Jen Sunset', 'manage_options', 'jen_sunset', 'jen_sunset_theme_create_page', get_template_directory_uri() . '/img/jen-logo-mini.svg', 110 );
    // Generate Sunset Admin Sub Pages
    add_submenu_page( 'jen_sunset', 'Jen Sunset Theme Options', 'General', 'manage_options', 'jen_sunset', 'jen_sunset_theme_create_page' );
    add_submenu_page( 'jen_sunset', 'Jen Sunset CSS Options', 'Custom CSS', 'manage_options', 'jen_sunset_css', 'jen_sunset_theme_settings_page' );
}

add_action( 'admin_menu', 'sunset_add_admin_page');

function jen_sunset_theme_create_page() {
    //generation of our admin page
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php');
}

function jen_sunset_theme_settings_page() {
    echo '<h1>Jen Sunset Custom CSS</h1>';
}
