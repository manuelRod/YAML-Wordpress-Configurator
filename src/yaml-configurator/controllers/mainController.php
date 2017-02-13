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
     *
     */
    function registerConfigurationFiles() {

        foreach ($this->getConfigFiles() as $config_type => $files) {
            foreach($files as $file) {
                /**
                 * Check which type of config type
                 */
                if ($config_type == 'post_types') {
                    $yamlToPost = new yamlToPost($file);
                    $configParsed = $yamlToPost->parseYaml();
                    $yamlToPost->registerCustomConfiguration($configParsed);
                }
            }
        }
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