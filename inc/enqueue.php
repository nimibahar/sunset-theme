<?php

/*
   ============================
     ADMIN ENQUEUE FUNCTIONS
   ============================
*/

function jen_sunset_load_admin_scripts( $hook ) {
    //Here we're checking if we're in our custom admin page and if we're not, we're breaking out of the function
    if( 'toplevel_page_jen_sunset' != $hook ) {
        return;
    }
    //Here we're registering the style and refering his location
    wp_register_style('jen_sunset_admin', get_template_directory_uri() . '/css/jensunset.admin.css', array(), '0.0.1', 'all' );
    // Here we're including the file
    wp_enqueue_style('jen_sunset_admin');

    //Enqueues all scripts, styles, settings, and templates necessary to use all media JavaScript APIs.
    wp_enqueue_media();
    wp_register_script( 'jen-sunset-admin-script', get_template_directory_uri() . '/js/jensunset.admin.js', array('jquery'), '0.0.1', true);
    wp_enqueue_script('jen-sunset-admin-script');
}

add_action( 'admin_enqueue_scripts', 'jen_sunset_load_admin_scripts' );
