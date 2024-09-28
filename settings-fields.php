<?php

    // ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

    // ========== DISPLAYING FORM FIELD (UPLOAD LOGO) ========== //
    function clpl_logo_field_callback() {
        
        $logo_url = esc_attr(get_option('clpl_logo_field'));
        echo '<input type="text" name="clpl_logo_field" id = "custom_login_logo" value="' . esc_url( $logo_url ).'" />';
        echo '<button class="button button-secondary" id="upload_logo">'.esc_html__('Upload Logo', 'custom-login-page-logo').'</button>';
        if(!empty($logo_url)){
            echo'<div id = "clpl_logo_container"><img src = "' .esc_url( $logo_url ).'" ></div>';
        }

    }

    // ========== DISPLAYING FORM FIELD (LOGO WIDTH) ========== //
    function clpl_logo_width_callback() {
    
        $width = esc_attr(get_option('clpl_logo_width', '100'));
        echo '<input type="number" name="clpl_logo_width" id = "clpl_logo_width" min = "0" max = "600" 
        value="' . esc_attr($width) .'"/>';

    }

    // ========== DISPLAYING FORM FIELD (LOGO WIDTH MEASUREMENT UNIT) ========== //
    function clpl_logo_width_unit_callback() {
    
        $width_mmt = esc_attr(get_option('clpl_logo_width_unit', 'px'));
        echo '<select name="clpl_logo_width_unit" id = "clpl_logo_width_unit" >
                <option value="px" ' . selected($width_mmt, 'px', false) . ' >Pixels (px)</option>
                <option value="%" ' . selected($width_mmt, '%', false) . ' >Percentage (%)</option>
            </select>';

    }

    // ========== DISPLAYING FORM FIELD (LOGO HEIGHT) ========== //
    function clpl_logo_height_callback() {
        
        $height         = esc_attr(get_option('clpl_logo_height', '100'));
        echo '<input type="number" name="clpl_logo_height" id = "clpl_logo_height"  min = "0" max = "600" 
        value = "'.esc_attr($height).'"/>';

    }

    // ========== DISPLAYING FORM FIELD (LOGO HEIGHT MEASUREMENT UNIT) ========== //
    function clpl_logo_height_unit_callback() {
        
        $height_mmt     = esc_attr(get_option('clpl_logo_height_unit', 'px'));
        echo'<select name="clpl_logo_height_unit" id = "clpl_logo_height_unit" >
                <option value="px" ' . selected($height_mmt, 'px', false) . ' >Pixels (px)</option>
                <option value="%" ' . selected($height_mmt, '%', false) . ' >Percentage (%)</option>
                </select>';

    }

    // ========== CALLBACK FUNCTION OF SETTING'S SECTION ========== //
    function clpl_logo_section_callback() {
        echo '<p>'.esc_html__('(Upload or select a custom logo for the login page.)', 'custom-login-page-logo').'</p>';
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
            __('Custom Logo URL', 'custom-login-page-logo'), // CUSTOM LOGO URL
            'clpl_logo_field_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_width',
            __('Custom Logo Width', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH
            'clpl_logo_width_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_width_unit',
             __('Custom Logo Width Unit', 'custom-login-page-logo'), // CUSTOM LOGO WIDTH MEASUREMENT UNIT
            'clpl_logo_width_unit_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        add_settings_field(
            'clpl_logo_height',
            __('Custom Logo Height', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT
            'clpl_logo_height_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );
        add_settings_field(
            'clpl_logo_height_unit',
             __('Custom Logo Height Unit', 'custom-login-page-logo'), // CUSTOM LOGO HEIGHT MEASUREMENT UNIT
            'clpl_logo_height_unit_callback',
            'clpl_logo_settings',
            'clpl_logo_section'
        );

        // ========== REGISTER SETTINGS ========== //
        register_setting('clpl_logo_settings', 'clpl_logo_field');
        register_setting('clpl_logo_settings', 'clpl_logo_width');
        register_setting('clpl_logo_settings', 'clpl_logo_width_unit');
        register_setting('clpl_logo_settings', 'clpl_logo_height');
        register_setting('clpl_logo_settings', 'clpl_logo_height_unit');
        
    }

    add_action('admin_init', 'clpl_logo_settings_init');
