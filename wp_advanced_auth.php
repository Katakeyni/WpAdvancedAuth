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
$loader->add_shortcode('helloworld', $shortcodes, 'helloShortcode');
$loader->init();