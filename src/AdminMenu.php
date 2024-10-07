<?php

namespace Telekinesis;

class AdminMenu
{

    public static function admin_menu_init(){
        add_submenu_page( 'tools.php', 'Telekinesis', 'Telekinesis', 'manage_options', 'telekinesis', [ '\Telekinesis\AdminMenu', 'admin_menu_page' ]);
    }


    public static function admin_menu_page(){
        if ( !current_user_can( 'manage_options' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo '<div class="wrap">';

        echo "<h2>" . __( 'Telekinesis config', 'telekinesis' ) . "</h2>";
        echo '<p>Options for the telekinesis (updater) module</p>';
        echo '</div>';

        if( isset($_POST[ 'telekinesis_secret' ]) ) {
            update_option( 'telekinesis_secret', sanitize_text_field($_POST[ 'telekinesis_secret' ]) );
            ?>
            <div class="updated"><p><strong><?php _e('settings saved.', 'telekinesis' ); ?></strong></p></div>
            <?php

        }
        ?>

        <form name="form1" method="post" action="">
            <p><?php _e("Secret Key", 'telekinesis' ); ?>
                <input type="password" name="telekinesis_secret" value="<?php echo sanitize_text_field(get_option('telekinesis_secret')); ?>" size="100">
            </p><hr />
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
            </p>
        </form>
        </div>
        <?php
    }
}