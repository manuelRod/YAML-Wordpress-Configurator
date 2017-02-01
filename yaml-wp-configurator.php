<?php
/*
 * Plugin Name: YAML Wordpress Dynamic Content Type Configurator
 * Description: Easy the hassle of creating custom types of content via YML configuration files.
 * Version: 0.0.1
 * Text Domain: yaml-wp-configurator
 * Domain Path: /languages
 * Author: Manuel Rodriguez Rosado
 * Author URI: http://www.cosmonauta.es
 * Plugin URI: http://www.cosmonauta.es
 */

// If this file is accessed, then abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

spl_autoload_register( 'yaml_configurator_autoloader' ); // Register autoloader
function yaml_configurator_autoloader( $class_name ) {

    if ( false !== strpos( $class_name, 'yamlConfigurator' ) ) {
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
        $class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name ) . '.php';
        $class_file = str_replace( 'yamlConfigurator', 'yaml-configurator', $class_file );
        require_once $classes_dir . $class_file;
    }
}

add_action( 'plugins_loaded', 'yaml_configurator_init' ); // Hook initialization function


define('CUSTOM_POST_TYPE_PATH', dirname( __FILE__ ) . '/configuration_files/post_types/');




