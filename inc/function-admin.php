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
    //Activate custom settings
    add_action( 'admin_init', 'jen_sunset_custom_settings' );

}

add_action( 'admin_menu', 'sunset_add_admin_page' );

function jen_sunset_custom_settings() {
    register_setting( 'jen-sunset-settings-group', 'first_name' );
    register_setting( 'jen-sunset-settings-group', 'last_name' );
    register_setting( 'jen-sunset-settings-group', 'user_description' );

    register_setting( 'jen-sunset-settings-group', 'facebook_handler' );
    register_setting( 'jen-sunset-settings-group', 'linkedin_handler' );
    register_setting( 'jen-sunset-settings-group', 'twitter_handler', 'jen_sunset_sanitize_twitter_handler' );

    add_settings_section( 'jen-sunset-sidebar-options', 'Sidebar Options', 'jen_sidebar_options', 'jen_sunset' );

    add_settings_field('sidebar-name','Full Name','jen_sunset_sidebar_name','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-description','Description','jen_sunset_sidebar_description','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-facebook', 'Facebook handler', 'jen_sunset_sidebar_facebook','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-linkedin', 'LinkedIn handler', 'jen_sunset_sidebar_linkedin','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-linkedin', 'Twitter handler', 'jen_sunset_sidebar_twitter','jen_sunset', 'jen-sunset-sidebar-options' );

}
function jen_sidebar_options() {
  echo 'Customize your Sidebar Information';
}

function jen_sunset_sidebar_name() {
  $firstName = esc_attr( get_option( 'first_name' ) );
  $lastName = esc_attr( get_option( 'last_name' ) );
  echo '<input type="text" name="first_name" value="'.$firstName.'" placeholder="First Name" />
  <input type="text" name="last_name" value="'.$lastName.'" placeholder="Last Name"  />';
}

function jen_sunset_sidebar_description() {
    $description = esc_attr( get_option( 'user_description' ) );
    echo '<input type="text" name="user_description" value="'.$description.'" placeholder="Description" /><p class="description">Write something smart</p>';
}

function jen_sunset_sidebar_facebook() {
    $facebook = esc_attr( get_option( 'facebook_handler' ) );
    echo '<input type="text" name="facebook_handler" value="'.$facebook.'" placeholder="Facebook handler" />';
}

function jen_sunset_sidebar_linkedin() {
    $linkedin = esc_attr( get_option( 'linkedin_handler' ) );
    echo '<input type="text" name="linkedin_handler" value="'.$linkedin.'" placeholder="LinkedIn Handler" />';
}

function jen_sunset_sidebar_twitter() {
    $twitter = esc_attr( get_option( 'twitter_handler' ) );
    echo '<input type="text" name="twitter_handler" value="'.$twitter.'" placeholder="Twitter Handler" />
    <p class=description>Input your Twitter username without the @ character.</p>';
}


//Santizing the user's twitter input with WP built in function
function jen_sunset_sanitize_twitter_handler( $input ){
	$output = sanitize_text_field( $input );
	$output = str_replace('@', '', $output);
	return $output;
}


function jen_sunset_theme_create_page() {
    //generation of our admin page
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php');
}

function jen_sunset_theme_settings_page() {
    echo '<h1>Jen Sunset Custom CSS</h1>';
}
