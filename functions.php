<?php

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 

// ========= ENQUEUE MEDIA UPLOADER AND SCRIPTS ========= //
function clpl_enqueue_scripts(){

    // REGISTER PLUGIN SCRIPT
    wp_register_script(
        'custom-login-logo-script', // HANDLE
        plugin_dir_url(__FILE__) . 'js/custom-login-logo.js', // SOURCE
        array('jquery', 'wp-i18n'), // DEPENDENCIES
        '1.0.0', // VERSION
        true // IN FOOTER
    );

    // INCLUDE MEDIA UPLOADER
    wp_enqueue_media();

    // ENQUEUE THE CUSTOM SCRIPT
    wp_enqueue_script('custom-login-logo-script');

    $clpl_translation_array = array(
        'choose_or_upload_logo' => esc_html__('Choose or Upload a Logo', 'custom-login-page-logo'),
        'use_this_logo'         => esc_html__('Use this Logo', 'custom-login-page-logo'),
    );

    wp_localize_script('custom-login-logo-script', 'clpl_Translations', $clpl_translation_array);

}

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // REGISTER PLUGIN STYLESHEET
    wp_register_style(
        'custom-login-logo-style', // HANDLE
        plugin_dir_url(__FILE__) . 'css/custom-login-logo.css', // SOURCE
        array(), // DEPENDENCIES
        '1.0.0' // VERSION
    );

    // ENQUEUE PLUGIN STYLESHEET
    wp_enqueue_style('custom-login-logo-style');

    // ADD INLINE STYLES TO SET THE BACKGROUND IMAGE DYNAMICALLY
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

// ========= LOAD TEXT DOMAIN ========= //
function clpl_load_textdomain() {
    load_plugin_textdomain( 'custom-login-page-logo', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

add_action('admin_enqueue_scripts', 'clpl_enqueue_scripts');
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');
add_action( 'plugins_loaded', 'clpl_load_textdomain' );
