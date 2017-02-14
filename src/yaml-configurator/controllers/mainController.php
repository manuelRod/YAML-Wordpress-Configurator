<?php

namespace yamlConfigurator\Controllers;
use yamlConfigurator\Controllers\readConfigFiles;
use yamlConfigurator\Controllers\yamlToPost;

class mainController {

    /**
     * It will hold all supported configuration types
     *
     * array
     */
    const CONFIGURATIONTYPES = array (
        'post_types'
    );

    /**
     * Backend hooks
     */
    function hooks() {
        add_action('init', array($this, 'registerConfigurationFiles'));
    }

    /**
     * It goes through all config files, register them and print the result.
     */
    function registerConfigurationFiles() {
        $registered_results = array();
        foreach ($this->getConfigFiles() as $config_type => $files) {
            foreach($files as $file) {
                /**
                 * Check which type of config type
                 */
                if ($config_type == 'post_types') {
                    $yamlToPost = new yamlToPost($file);
                    $configParsed = $yamlToPost->parseYaml();
                    $postTypeName = basename($file, '.yml');
                    if ($yamlToPost->registerCustomConfiguration($postTypeName, $configParsed)) {
                        $registered_results[$config_type][$postTypeName] = true;
                    } else {
                        $registered_results[$config_type][$postTypeName] = false;
                    }
                }
            }
        }
        flush_rewrite_rules();
        $this->printFriendlyResult($registered_results);
    }

    /**
     * Prints a friendly log for the user when finished.
     *
     * @param $registered_results
     */
    private function printFriendlyResult($registered_results) {
        $string = '<h1>Thanks for using YAML Wordpress Dynamic Content Type Configurator</h1>';
        $string .= '<h2>Registration output logs</h2>';
        foreach ($registered_results as $registered_type => $values) {
            $string .= "<h2>$registered_type :</h2>";
            foreach ($values as $name => $value) {
                $success = ($value) ? 'registered' : 'error';
                $string .= "<p>$name : $success</p>";
            }
        }
        echo $string; die;
    }


    /**
     * Gets all configuration files hosted on configuration_files
     *
     * @return array
     */
    function getConfigFiles() {
        $reader = new readConfigFiles();
        $configuration_files = array();
        foreach (self::CONFIGURATIONTYPES as $configuration_type) {
            $reader->getConfigFolder($configuration_type);
            $configuration_files[$configuration_type] = $reader->getFiles();
        }
        return $configuration_files;
    }
}