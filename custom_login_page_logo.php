<?php

/*
Plugin Name: Custom Login Page Logo
Description: Allows users to customize the logo on the WordPress login page.
Version: 1.0
Author: Horendra Pal Singh Kandari
License: GPL v2 or later

*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// Include all required files
include_once(plugin_dir_path(__FILE__) . 'admin-menu.php');
include_once(plugin_dir_path(__FILE__) . 'settings-fields.php');

function clpl_enqueue_scripts(){

    // Include media uploader
    wp_enqueue_media();

    // Register the custom script
    wp_register_script(
        'custom-login-logo-script', // Handle
        plugin_dir_url(__FILE__) . 'js/custom-login-logo.js', // Source
        array('jquery'), // Dependencies
        '1.0.0', // Version
        true // In footer
    );

    // Enqueue the custom script
    wp_enqueue_script('custom-login-logo-script');

}

// Enqueue media uploader and custom scripts
add_action('admin_enqueue_scripts', 'clpl_enqueue_scripts');

// Function to enqueue custom styles and inline styles for the login page
function clpl_enqueue_styles() {

    // Register the custom stylesheet
    wp_register_style(
        'custom-login-logo-style', // Handle
        plugin_dir_url(__FILE__) . 'css/custom-login-logo.css', // Source
        array(), // Dependencies
        '1.0.0' // Version
    );

    // Enqueue the custom stylesheet
    wp_enqueue_style('custom-login-logo-style');

    // Add inline styles to set the background image dynamically
    $logo_url = get_option('clpl_logo_field');
    if (!empty($logo_url)) {
        $inline_style = '
            #login h1 a {
                background-image: url("' . esc_url($logo_url) . '");
            }
        ';
        wp_add_inline_style('custom-login-logo-style', $inline_style);
    }
}

// Hook into the 'login_enqueue_scripts' action to enqueue our custom styles
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');





