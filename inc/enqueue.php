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


/*
   ============================
     FRONT-END ENQUEUE FUNCTIONS
   ============================
*/

function jen_sunset_load_scripts() {
    wp_register_style('jen_sunset_css', get_template_directory_uri() . '/css/jen_sunset.css', array(), '0.0.1', 'all' );
    wp_enqueue_style('jen_sunset_css');
    wp_register_style('animate', get_template_directory_uri() . '/css/animate.css', array(), '0.0.1', 'all' );
    wp_enqueue_style('animate');


    // wp_deregister_script( 'jquery' );
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '3.1.1', true);
    wp_enqueue_script( 'jquery' );
    wp_register_script( 'waypoints', get_template_directory_uri() . '/js/jquery.wapoints.min.js', array('jQuery'), '4.0.0', true);
    wp_enqueue_script( 'waypoints' );
    wp_register_script( 'wow', get_template_directory_uri() . '/js/wow.min.js', array(), '1.1.3', true);
    wp_enqueue_script( 'wow' );

}

add_action( 'wp_enqueue_scripts', 'jen_sunset_load_scripts' );
