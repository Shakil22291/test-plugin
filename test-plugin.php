<?php

/**
 * Plugin Name: Test plugin
 * Pluign URI: https://www.facebook.com
 * Description: Learn plugin development
 * version: 1.0
 * Author: Shakil Hossain
 * Author URI: https://www.facebook.com
 */
require_once 'vendor/autoload.php';
require_once ABSPATH . '/wp-includes/pluggable.php';

use Inc\TestPlugin;

define('MYPLUGIN_PATH', plugin_dir_path(__FILE__));

register_activation_hook(__FILE__, [TestPlugin::class, 'activate']);
register_deactivation_hook(__FILE__, [TestPlugin::class, 'deactivate']);

$testplugin = new TestPlugin();

$testplugin->run();
