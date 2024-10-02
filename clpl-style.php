<?php

// ========== EXIT IF ACCESSED DIRECTLY ==========//
    if ( ! defined( 'ABSPATH' ) ) exit; 

// ========= ENQUEUE STYLE ========= //
function clpl_enqueue_styles() {

    // ADD STYLES TO ADMIN LOGIN PAGE
    $logo_url = get_option('clpl_logo_field');
    $logo_width = get_option('clpl_logo_width', '100'); // DEFAULT 100
    $logo_width_unit = get_option('clpl_logo_width_unit', 'px'); // DEFAULT PX
    $logo_height = get_option('clpl_logo_height', '100'); // DEFAULT 100
    $logo_height_unit = get_option('clpl_logo_height_unit', 'px'); // DEFAULT PX
    $logo_redirect_url = get_option('clpl_logo_redirect_url', site_url()); // DEFAULT SITE URL
    $logo_shadow = get_option('clpl_logo_shadow', '0'); // LOGO SHADOW

    // ========= SETS LOGO STYLE ========= //
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

    // ========= SETS LOGO REDIRECT URL ========= //
    if(!empty($logo_redirect_url)){

        function clpl_logo_redirect_url() {

            $logo_redirect_url = get_option('clpl_logo_redirect_url', site_url());

            if(empty($logo_redirect_url)){
                $logo_redirect_url = site_url();
            } 
            return esc_url($logo_redirect_url);       
                   
        }
        
        function clpl_logo_redirect_url_title() {
            $blog_name = get_bloginfo( 'name' );
            return $blog_name;
        }
        add_filter( 'login_headerurl', 'clpl_logo_redirect_url' );
        add_filter( 'login_headertext', 'clpl_logo_redirect_url_title' );
    }
    
    // ========= SETS LOGO SHADOW ========= //
    if(!empty($logo_shadow)){
        if($logo_shadow == 1){
            echo '<style>
            #login h1 a {
                box-shadow:0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            }
                </style>';
        }

    }
}
add_action('login_enqueue_scripts', 'clpl_enqueue_styles');