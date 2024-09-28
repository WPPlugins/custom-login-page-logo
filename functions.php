<?php

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 


// ========== REGISTER PLUGIN ALL SCRIPTS ========== //
function clpl_register_scripts(){

    // REGISTER PLUGIN SCRIPT
    wp_register_script(
        'custom-login-logo-script', // HANDLE
        plugin_dir_url(__FILE__) . 'js/custom-login-logo.js', // SOURCE
        array('jquery', 'wp-i18n'), // DEPENDENCIES
        '1.0.0', // VERSION
        true // IN FOOTER
    );

    // REGISTER PLUGIN STYLESHEET
    wp_register_style(
        'custom-login-logo-style', // HANDLE
        plugin_dir_url(__FILE__) . 'css/custom-login-logo.css', // SOURCE
        array(), // DEPENDENCIES
        '1.0.0' // VERSION
    );
}

// ========= ENQUEUE MEDIA UPLOADER AND SCRIPTS ========= //
function clpl_enqueue_scripts(){

    $screen = get_current_screen();

    if ( isset( $screen->id ) && $screen->id === 'toplevel_page_clpl-logo-settings' ) {

        // INCLUDE MEDIA UPLOADER
        wp_enqueue_media();

        // ENQUEUE PLUGIN STYLESHEET
        wp_enqueue_style('custom-login-logo-style');

        // ENQUEUE THE CUSTOM SCRIPT
        wp_enqueue_script('custom-login-logo-script');

        $clpl_translation_array = array(
            'choose_or_upload_logo' => esc_html__('Choose or Upload a Logo', 'custom-login-page-logo'),
            'use_this_logo'         => esc_html__('Use this Logo', 'custom-login-page-logo'),
        );

        wp_localize_script('custom-login-logo-script', 'clpl_Translations', $clpl_translation_array);
    }

}

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // ADD STYLES TO SET LOGIN PAGE FOR LOGO DYNAMICALLY
    $logo_url = get_option('clpl_logo_field');
    $logo_width = get_option('clpl_logo_width', '100'); // Default 100
    $logo_width_unit = get_option('clpl_logo_width_unit', 'px'); // Default px
    $logo_height = get_option('clpl_logo_height', '100'); // Default 100
    $logo_height_unit = get_option('clpl_logo_height_unit', 'px'); // Default px

    if (!empty($logo_url)) {
        echo '<style>
            #login h1 a {
                background-image: url(' . esc_url($logo_url) . ');
                width: ' . esc_attr($logo_width) . esc_attr($logo_width_unit) . ';
                height: ' . esc_attr($logo_height) . esc_attr($logo_height_unit) . ';
                background-size: ' . esc_attr($logo_width) . esc_attr($logo_width_unit) . ' ' . esc_attr($logo_height) . esc_attr($logo_height_unit) . ';
                background-repeat: no-repeat;
            }
        </style>';
    }

}

// ========= LOAD TEXT DOMAIN ========= //
function clpl_load_textdomain() {
    load_plugin_textdomain( 'custom-login-page-logo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action('admin_enqueue_scripts', 'clpl_register_scripts');
add_action('admin_enqueue_scripts', 'clpl_enqueue_scripts');
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');
add_action('plugins_loaded', 'clpl_load_textdomain' );
