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

}

add_action( 'admin_enqueue_scripts', 'jen_sunset_load_admin_scripts' );
