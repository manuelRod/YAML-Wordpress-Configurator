<?php
/*
 * Plugin Name: YAML Wordpress Dynamic Content Type Configurator
 * Description: Easy the hassle of creating custom posts, taxonomies and terms via YAML configuration files.
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

define('CUSTOM_CONFIGURATION_PATH', dirname( __FILE__ ) . '/configuration_files/');
define('YAML_OPTIONS', 'yaml_configurator_register');

// Register autoloader
spl_autoload_register( 'yaml_configurator_autoloader' );
function yaml_configurator_autoloader( $class_name ) {
    if ( false !== strpos( $class_name, 'yamlConfigurator' ) ) {
        $classes_dir = realpath( plugin_dir_path( __FILE__ ) ) . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR;
        $class_file = str_replace( '\\', DIRECTORY_SEPARATOR, $class_name ) . '.php';
        $class_file = str_replace( 'yamlConfigurator', 'yaml-configurator', $class_file );
        require_once $classes_dir . $class_file;
    }

    // Autoload symfony yaml
    if ( false !== strpos( $class_name, 'Symfony' ) ) {
        $class_file = str_replace( 'Symfony\\Component\\Yaml\\', 'symfony/yaml/', $class_name ) . '.php';
        require_once realpath( plugin_dir_path( __FILE__ ) ) . '/vendor/' . $class_file;
    }
}

use yamlConfigurator\Controllers\mainController;
(new mainController())->hooks();

