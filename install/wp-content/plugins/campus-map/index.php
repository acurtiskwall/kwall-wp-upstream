<?php
/**
 * Plugin Name: Campus Map
 * Description: Adds a Campus map
 * Version: 1.0
 * Author: Kwall
 * License: GPLv2
 */

if( ! function_exists('add_action') ){
    echo "Not Wordpress";
    exit;
}


//Setup
 define('PLUGIN_URL', plugin_dir_url(__FILE__) );

//Includes
require_once( ABSPATH . 'wp-admin/includes/upgrade.php');
include_once( 'includes/activate.php' );
include_once( 'includes/campus-map.php' );
include_once( 'includes/campus-map.js' );

//Hooksa
register_activation_hook( __FILE__ , 'campusmap_activate_plugin' );
register_deactivation_hook( __FILE__ , 'campusmap_deactivate_plugin' );
?>
