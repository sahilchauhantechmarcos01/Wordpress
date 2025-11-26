<?php
/*
Plugin Name: Books CPT
Plugin URI: https://wordpress.com/plugin
Description: This a custom cpt
Version: 1.0.0
Author: Sahil
Author URI: https://wordpress.com/
Licence: GPLv2 or later
Text Domain: books-plugin
*/


defined('ABSPATH') or die('Unaccessible File');

require_once plugin_dir_path(__FILE__).'includes/class-plugin.php';

function book_start(){
    $plugin = new \CPT\Plugin();
    $plugin->init();
}

add_action('plugins_loaded','book_start');

function book_activate() {
    $plugin = new \CPT\Plugin();
    $plugin->activate();
}

register_activation_hook(__FILE__, 'book_activate');
