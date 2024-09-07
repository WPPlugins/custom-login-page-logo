<?php

    // ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

    // ========== DISPLAYING FORM TO UPLOAD LOGO ========== //
    function clpl_logo_field_callback() {
        $logo_url = esc_attr(get_option('clpl_logo_field'));
        echo '<input type="text" name="clpl_logo_field" id = "custom_login_logo" value="' . esc_url( $logo_url ).'" />';
        echo '<button class="button button-secondary" id="upload_logo">'.esc_html__('Upload Logo', 'custom-login-page-logo').'</button>';
        if(empty($logo_url)){
            
        }
        echo'<div style = "height:auto; width:auto;"><img src = "' .esc_url( $logo_url ).'" style = "width:100px; height:auto;  padding:15px; margin:15px;"></div>';

    }

    // ========== CALLBACK FUNCTION OF SETTING'S SECTION ========== //
    function clpl_logo_section_callback() {
        echo '<p>'.esc_html_e('Upload or select a custom logo for the login page.', 'custom-login-page-logo').'</p>';
    }

    // ========== ADDING SETTINGS ========== //
    function clpl_logo_settings_init() {

    	// ========== ADDING SETTING'S SECTION ========== //
        add_settings_section(
            'clpl_logo_section',
            __('Custom Login Logo Settings', 'custom-login-page-logo'),
            'clpl_logo_section_callback',
            'clpl_logo_settings'
        );

        // ========== ADDING FIELDS FOR SETTING'S SECTION ========== //
        add_settings_field(
            'clpl_logo_field',
            __('Custom Logo URL', 'custom-login-page-logo'),
            'clpl_logo_field_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        // ========== REGISTER SETTINGS ========== //
        register_setting('clpl_logo_settings', 'clpl_logo_field');
    }

    add_action('admin_init', 'clpl_logo_settings_init');
