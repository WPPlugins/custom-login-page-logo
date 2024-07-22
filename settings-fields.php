<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    add_action('admin_init', 'clpl_logo_settings_init');

    function clpl_logo_settings_init() {

    	// Adding settings section for custom login logo
        add_settings_section(
            'clpl_logo_section',
            'Custom Login Logo Settings',
            'clpl_logo_section_callback',
            'clpl_logo_settings'
        );

        // Adding fields for settings section
        add_settings_field(
            'clpl_logo_field',
            'Custom Logo URL',
            'clpl_logo_field_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        // register settings
        register_setting('clpl_logo_settings', 'clpl_logo_field');
    }

    function clpl_logo_section_callback() {
        echo '<p>Upload or select a custom logo for the login page.</p>';
    }

    // Displaying form to upload logo
    function clpl_logo_field_callback() {
        $logo_url = esc_attr(get_option('clpl_logo_field'));
        echo '<input type="text" name="clpl_logo_field" id = "custom_login_logo" value="' . esc_url( $logo_url ).'" />';
        echo '<button class="button button-secondary" id="upload_logo">Upload Logo</button>';
        if(empty($logo_url)){
        	
        }
        echo'<div style = "height:auto; width:auto;"><img src = "' .esc_url( $logo_url ).'" style = "width:100px; height:auto;  padding:15px; margin:15px;"></div>';

    }
