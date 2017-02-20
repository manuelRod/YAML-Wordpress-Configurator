<?php

namespace yamlConfigurator\Controllers;
use yamlConfigurator\Controllers\yamlToService;

class mainController {

    /**
     * It will hold all supported configuration types
     * post_types
     * taxonomies
     *
     * Array
     */
    const CONFIGURATIONTYPES = array (
        'post_types',
        'taxonomies'
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
        if (!$this->checkScope()) {
            //return;
        }

        $registered_results = array();
        foreach ($this->getConfigFiles() as $config_type => $files) {
            foreach($files as $file) {
                $yamlTo = yamlToService::yamlTo($config_type, $file);
                $configParsed = $yamlTo->parseYaml();
                $typeName = basename($file, '.yml');
                $registered_results[$config_type][$typeName] = $yamlTo->registerCustomConfiguration($typeName, $configParsed);
            }
        }
        $this->afterRegisterProcess($registered_results);
    }

    /**
     * Unregister deleted configurations
     * 
     * @param $deleted_configurations
     */
    function unregisterConfigurationFiles($deleted_configurations)
    {
        foreach ($deleted_configurations as $config_type => $files) {
            foreach ($files as $file_name => $value) {
                $unregister_service = unregisterService::unregister($config_type);
                $unregister_service->unregister($file_name);
            }
        }
    }

    /**
     * After Register process
     * 1. Check if any deleted configuration
     * 2. Unregister Deleted Configuration
     * 3. Save new registered options
     * 4. Flush Rules
     * 5. Print result on screen
     *
     *
     * @param $registered_results
     */
    protected function afterRegisterProcess($registered_results)
    {
        $deleted_configurations = $this->checkDeletedConfigurations($registered_results);
        $this->unregisterConfigurationFiles($deleted_configurations);

        $this->saveRegisteredOptions($registered_results);
        flush_rewrite_rules();
        $this->printFriendlyResult($registered_results, $deleted_configurations);
    }


    /**
     * Compare Registered Custom Types from DB with new $registed_results, differences will be returned.
     *
     * @param array $registered_results
     * @return array
     */
    protected function checkDeletedConfigurations($registered_results) {
        $diffs = array();
        $options = get_option(YAML_OPTIONS);
        foreach ($options as $custom_type => $custom_type_registered_names) {
            foreach ($custom_type_registered_names as $ctrn => $value) {
                if (!isset($registered_results[$custom_type][$ctrn])) {
                    $diffs[$custom_type][$ctrn] = true;
                }
            }
        }
        return $diffs;
    }

    /**
     * Saves on Options the registered custom types
     *
     * @param array $registered_results
     * @return bool
     */
    protected function saveRegisteredOptions($registered_results) {
        return update_option(YAML_OPTIONS, $registered_results, false);
    }

    /**
     * Prints a friendly log for the user when finished.
     *
     * @param array $registered_results
     * @param array $deleted_configurations
     */
    protected function printFriendlyResult($registered_results, $deleted_configurations) {
        $string = '<h1>Thanks for using YAML Wordpress Dynamic Content Type Configurator</h1>';
        $string .= '<h2>Registration output logs</h2>';
        if (empty($registered_results)) {
            $string .= "<p>Nothing to register</p>";
        } else {
            foreach ($registered_results as $registered_type => $values) {
                $string .= "<h2>$registered_type :</h2>";
                foreach ($values as $name => $value) {
                    $success = ($value) ? 'registered' : 'error';
                    $string .= "<p>$name : $success</p>";
                }
            }
        }

        $string .= '<h2>Unregistered output logs</h2>';
        if (empty($deleted_configurations)) {
            $string .= "<p>Nothing to Unregister</p>";
        } else {
            foreach ($deleted_configurations as $registered_type => $values) {
                $string .= "<h2>$registered_type :</h2>";
                foreach ($values as $name => $value) {
                    $success = ($value) ? 'unregistered' : 'error';
                    $string .= "<p>$name : $success</p>";
                }
            }
        }

        echo $string; die;
    }

    /**
     * Registration will be triggered by yaml-register parameter on the url and by admin user
     * avoid external people using the system.
     *
     * @return bool
     */
    private function checkScope() {
        if (isset($_GET['yaml-register']) && current_user_can('administrator')) {
            return true;
        }
        return false;
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
