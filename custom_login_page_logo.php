<?php

/*
Plugin Name: 	Custom Login Page Logo
Description: 	Allows users to customize the logo on the WordPress login page.
Version: 		1.3
Author: 		Horendra Pal Singh Kandari
License: 		GPL v2 or later
License URI: 	https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: 	custom-login-page-logo
Domain Path: 	/languages

*/

// ========== EXIT IF ACCESSED DIRECTLY ========== //
if ( ! defined( 'ABSPATH' ) ) exit; 

// ========== INCLUDE ALL REQUIRED FILES ========== //
include_once(plugin_dir_path(__FILE__) . 'functions.php');
include_once(plugin_dir_path(__FILE__) . 'admin-menu.php');
include_once(plugin_dir_path(__FILE__) . 'settings-fields.php');







