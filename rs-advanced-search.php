<?php

/**
 * @link     http://ratkosolaja.info/
 * @since    1.0.0
 * @package  RS_Advanced_Search
 *
 * Plugin Name: RS Advanced Search
 * Plugin URI:  http://ratkosolaja.info/plugins/rs-advanced-search/
 * Description: Adds support for Advanced Search.
 * Version:     1.0.5
 * Author:      Ratko Solaja
 * Author URI:  http://ratkosolaja.info/
 * License:     GNU General Public License version 3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 * Text Domain: rs-advanced-search
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_rs_advanced_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-advanced-search-activator.php';
	RS_Advanced_Search_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_rs_advanced_search() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rs-advanced-search-deactivator.php';
	RS_Advanced_Search_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rs_advanced_search' );
register_deactivation_hook( __FILE__, 'deactivate_rs_advanced_search' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rs-advanced-search.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rs_advanced_search() {
	$plugin = new RS_Advanced_Search();
	$plugin->run();
}
run_rs_advanced_search();