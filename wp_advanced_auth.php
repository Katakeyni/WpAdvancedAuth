<?php
/**
 *
 * Plugin Name: WP Advanced Auth
 * Description: Used by millions, Akismet is quite possibly the best way in the
 * Author: Aicha Garmy
 */

if ( ! defined( 'WPINC' ) ) {
    die;
}

require_once(__DIR__ . '/vendor/autoload.php');

$loader = new Aicha\PluginLoader();
$shortcodes = new Aicha\Shortcodes();
$assets = new Aicha\AssetsInit();
$ajaxrunner = new Aicha\AjaxRunner();
$loader->add_shortcode('helloworld', $shortcodes, 'helloShortcode');
$loader->add_action( 'admin_enqueue_scripts', $assets, 'enqueue_stylesheets' );
$loader->add_action( 'admin_enqueue_scripts', $assets, 'enqueue_scripts' );
$loader->add_action( 'wp_ajax_create_new_groupe_action', $ajaxrunner, 'create_new_groupe_action' );
$loader->add_action( 'wp_ajax_nopriv_create_new_groupe_action', $ajaxrunner, 'create_new_groupe_action' );
$loader->init();

function plugin_activation() {

  global $wpdb;
  $table_name = $wpdb->prefix . "utilisateur";

	$sql = "CREATE TABLE $table_name (
	  `ID` bigint(20) UNSIGNED NOT NULL,
	  `user_login` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_pass` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_nicename` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_url` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_registered` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
	  `user_activation_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
	  `user_status` int(11) NOT NULL DEFAULT '0',
	  `display_name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT ''
	) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
  require_once (ABSPATH . 'wp-admin/includes/upgrade.php');
  dbDelta($sql);

}

register_activation_hook(__FILE__, 'plugin_activation');