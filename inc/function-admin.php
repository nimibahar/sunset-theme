<?php

/*
   ==============
     ADMIN PAGE
   ==============
*/

function sunset_add_admin_page(){
    // built in wp function:
    add_menu_page( 'Sunset Theme Options', 'Sunset', 'manage_options', 'jen-sunset', 'sunset_theme_create_page', get_template_directory_uri() . '/img/jen-logo-mini.svg', 110 );

}

add_action( 'admin_menu', 'sunset_add_admin_page');

function sunset_theme_create_page() {
    //generation of our admin page
    echo '<h1>Jen Sunset Menu</h1>';
}
