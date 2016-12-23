<h1>Jen Sunset Theme Options</h1>
<?php settings_errors(); ?>


<form method="post" action="options.php" class="jen-sunset-general-form">
    <?php settings_fields( 'jen-sunset-theme-support' ); ?>
    <?php do_settings_sections( 'jen_sunset_theme' ); ?>
    <?php submit_button(); ?>
</form>
