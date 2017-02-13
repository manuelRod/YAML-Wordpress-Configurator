<?php

namespace yamlConfigurator\Controllers;
use yamlConfigurator\Controllers\readConfigFiles;

class mainController {

    /**
     * It will hold all supported configuration types
     * array
     */
    const CONFIGURATIONTYPES = array (
        'post_types'
    );

    /**
     * Backend hooks
     */
    function hooks() {
        add_action('init', array($this, 'readConfigFiles'));
    }

    /**
     * Gets all configuration files hosted on configuration_files
     *
     * @return array
     */
    function readConfigFiles() {
        $reader = new readConfigFiles();
        $configuration_files = array();
        foreach (self::CONFIGURATIONTYPES as $configuration_folder) {
            $reader->getConfigFolder($configuration_folder);
            $configuration_files[$configuration_folder] = $reader->getFiles();
        }
        return $configuration_files;
    }
}