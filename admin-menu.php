<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

    add_action('admin_menu', 'clpl_logo_menu');

    // add admin menu page for custom login logo
    function clpl_logo_menu() {
        add_menu_page(
            'Custom Login Logo',
            'Login Logo',
            'manage_options',
            'clpl-logo-settings',
            'clpl_logo_settings_page'
        );
    }

    // creating settings for custom login logo
    function clpl_logo_settings_page() {
        ?>
        <div class="wrap">
            <h1>Custom Login Page Logo Settings</h1>
            <form method="post" action="options.php">
                <?php
                settings_fields('clpl_logo_settings');
                do_settings_sections('clpl_logo_settings');
                submit_button();
                ?>
            </form>
        </div>
    <?php
    }
