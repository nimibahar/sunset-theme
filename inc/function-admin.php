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
    add_submenu_page( 'jen_sunset', 'Jen Sunset Sidebar Options', 'Sidebar', 'manage_options', 'jen_sunset', 'jen_sunset_theme_create_page' );
    add_submenu_page( 'jen_sunset', 'Jen Sunset Theme Options', 'Theme Options', 'manage_options', 'jen_sunset_theme', 'jen_sunset_theme_support_page' );
    add_submenu_page( 'jen_sunset', 'Jen Sunset Contact Form', 'Contact Form', 'manage_options', 'jen_sunset_theme_contact', 'jen_sunset_contact_form_page' );
    add_submenu_page( 'jen_sunset', 'Jen Sunset CSS Options', 'Custom CSS', 'manage_options', 'jen_sunset_css', 'jen_sunset_theme_settings_page' );

    //Activate custom settings
    add_action( 'admin_init', 'jen_sunset_custom_settings' );

}

add_action( 'admin_menu', 'sunset_add_admin_page' );

function jen_sunset_custom_settings() {
    //Sidebar options
    register_setting( 'jen-sunset-settings-group', 'profile_pic' );
    register_setting( 'jen-sunset-settings-group', 'first_name' );
    register_setting( 'jen-sunset-settings-group', 'last_name' );
    register_setting( 'jen-sunset-settings-group', 'user_description' );
    register_setting( 'jen-sunset-settings-group', 'facebook_handler' );
    register_setting( 'jen-sunset-settings-group', 'linkedin_handler' );
    register_setting( 'jen-sunset-settings-group', 'twitter_handler', 'jen_sunset_sanitize_twitter_handler' );

    add_settings_section( 'jen-sunset-sidebar-options', 'Sidebar Options', 'jen_sidebar_options', 'jen_sunset' );

    add_settings_field('sidebar-pic','Profile Picture','jen_sunset_sidebar_profile_pic','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-name','Full Name','jen_sunset_sidebar_name','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-description','Description','jen_sunset_sidebar_description','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-facebook', 'Facebook handler', 'jen_sunset_sidebar_facebook','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-linkedin', 'LinkedIn handler', 'jen_sunset_sidebar_linkedin','jen_sunset', 'jen-sunset-sidebar-options' );
    add_settings_field('sidebar-linkedin', 'Twitter handler', 'jen_sunset_sidebar_twitter','jen_sunset', 'jen-sunset-sidebar-options' );

    //Theme Support Options
    register_setting( 'jen-sunset-theme-support', 'post_formats' );
    register_setting( 'jen-sunset-theme-support', 'custom_header' );
    register_setting( 'jen-sunset-theme-support', 'custom_background' );

    add_settings_section( 'jen-sunset-theme-options', 'Theme Options', 'jen_sunset_theme_options', 'jen_sunset_theme' );

    add_settings_field( 'post-formats', 'Post Formats', 'jen_sunset_post_formats', 'jen_sunset_theme', 'jen-sunset-theme-options' );
    add_settings_field( 'custom-header', 'Custom Header', 'jen_sunset_custom_header', 'jen_sunset_theme', 'jen-sunset-theme-options' );
    add_settings_field( 'custom-background', 'Custom Background', 'jen_sunset_custom_background', 'jen_sunset_theme', 'jen-sunset-theme-options' );

    //Contact Form Options
    register_setting( 'jensunset-contact-options', 'activate_contact' );

    add_settings_section( 'jen-sunset-contact-section', 'Contact Form', 'jen_sunset_contact_section', 'jen_sunset_theme_contact' );

    add_settings_field( 'activate-form', 'Activate Contact Form', 'jensunset_activate_contact', 'jen_sunset_theme_contact','jen-sunset-contact-section' );
}

function jen_sunset_theme_options() {
    echo 'Activate and deactivate specific Theme Support Options';
}

function jen_sunset_contact_section() {
    echo 'Activate and deactivate the Built-in Contact Form';
}

function jensunset_activate_contact() {
    $options = get_option( 'activate_contact' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="activate_contact" name="activate_contact" value="1" '.$checked.' /> </label>';

}

function jen_sidebar_options() {
    echo 'Customize your Sidebar Information';
}

function jen_sunset_post_formats() {
    $options = get_option( 'post_formats' );
    $formats = array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' );
    $output = '';
    foreach ( $formats as $format ) {
        $checked = ( @$options[$format] == 1 ? 'checked' : '');
        $output .= '<label><input type="checkbox" id="'.$format.'" name="post_formats['.$format.']" value="1" '.$checked.'>'.$format.'</label><br>';
    }
    echo $output;
}

function jen_sunset_custom_header() {
    $options = get_option( 'custom_header' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_header" name="custom_header" value="1" '.$checked.' /> Activate the Custom Header</label>';

}

function jen_sunset_custom_background() {
    $options = get_option( 'custom_background' );
    $checked = ( @$options == 1 ? 'checked' : '');
    echo '<label><input type="checkbox" id="custom_background" name="custom_background" value="1" '.$checked.' /> Activate the Custom Background</label>';

}

// Sidebar Options Functions
function jen_sunset_sidebar_profile_pic() {
    $profile_pic = esc_attr( get_option( 'profile_pic' ) );
    if ( empty($profile_pic) ){
          echo
              '<input type="button" class="button button-secondary" value="Upload Profile Picture" id="upload-button" />
                <input type="hidden" id="profile-pic" name="profile_pic" value="'.$profile_pic.'"  />';
    } else {
          echo
              '<input type="button" class="button button-secondary" value="Replace Profile Picture" id="upload-button" />
                <input type="hidden" id="profile-pic" name="profile_pic" value="'.$profile_pic.'"  />
                <input type="button" class="button button-secondery" value="Remove" id="remove-picture">';
    }
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

//Template submenu functions
function jen_sunset_theme_create_page() {
    //generation of our admin page
    require_once( get_template_directory() . '/inc/templates/sunset-admin.php');
}

function jen_sunset_theme_support_page() {
    require_once( get_template_directory() . '/inc/templates/jensunset-theme-support.php' );
}

function jen_sunset_contact_form_page() {
    require_once( get_template_directory() . '/inc/templates/jensunset-contact-form.php' );
}

function jen_sunset_theme_settings_page() {
    echo '<h1>Jen Sunset Custom CSS</h1>';
}
