<h1>Jen Sunset Theme Options</h1>
<?php settings_errors(); ?>

<?php

    $firstName = esc_attr( get_option( 'first_name' ) );
    $lastName = esc_attr( get_option( 'last_name' ) );
    $fullName = $firstName . ' ' . $lastName;
    $description = esc_attr( get_option( 'user_description' ) );
?>

<div class="jen-sunset-sidebar-preview">
    <div class="jen-sunset-sidebar">
          <h1 class="jen-sunset-username"><?php print $fullName ?></h1>
          <h2 class="jen-sunset-description"><?php print $description ?></h2>
          <div class="icons-wrapper">

          </div>
    </div>
</div>

<form method="post" action="options.php" class="jen-sunset-general-form">
    <?php settings_fields( 'jen-sunset-settings-group' ); ?>
    <?php do_settings_sections( 'jen_sunset' ); ?>
    <?php submit_button(); ?>
</form>
