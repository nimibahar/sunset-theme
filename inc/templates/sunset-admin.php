<h1>Jen Sunset Theme Options</h1>
<?php settings_errors(); ?>
<form method="post" action="options.php">
    <?php settings_fields( 'jen-sunset-settings-group' ); ?>
    <?php do_settings_sections( 'jen_sunset' ); ?>
    <?php submit_button(); ?>
</form>
