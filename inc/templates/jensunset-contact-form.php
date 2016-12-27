<h1>Jen Sunset Contact Form</h1>
<?php settings_errors(); ?>


<form method="post" action="options.php" class="jen-sunset-general-form">
    <?php settings_fields( 'jensunset-contact-options' ); ?>
    <?php do_settings_sections( 'jen_sunset_theme_contact' ); ?>
    <?php submit_button(); ?>
</form>
