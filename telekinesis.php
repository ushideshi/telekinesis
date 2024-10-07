<?php
/*
 * Plugin Name: Telekinesis
 * Plugin URI: https://github.com/ushideshi/telekinesis
 * Description: This plugin provides a wrapper for remote maintenance
 * Version: 0.1
 * Requires at least: 6.5
 * Requires PHP:      7.4
 * Author:            Alex B
 * Author URI:        https://github.com/ushideshi/
 * Text Domain:       telekinesis
*/


require_once 'src/Init.php';
require_once 'src/Request.php';
require_once 'src/Report.php';
require_once 'src/Updater.php';
require_once 'src/AdminMenu.php';

register_activation_hook( __FILE__, 'testactivate'  );


function testactivate() {

    flush_rewrite_rules();
}



add_action( 'init', [ '\Telekinesis\Init', 'add_update_endpoint' ]  );
add_filter( 'query_vars',  [ '\Telekinesis\Init', 'add_query_var' ] );
add_action( 'template_include', [ '\Telekinesis\Request','check_query_vars' ]);
add_action( 'admin_menu', [ '\Telekinesis\AdminMenu', 'admin_menu_init' ] );







