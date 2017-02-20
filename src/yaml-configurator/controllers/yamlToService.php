<?php

namespace yamlConfigurator\Controllers;

/**
 * Service to instantiate depending on the configuration type
 *
 * Class yamlToService
 * @package yamlConfigurator\Controllers
 */
class yamlToService {

    static function yamlTo($configuration_type, $yaml_path) {
        switch ($configuration_type) {
            case 'post_types':
                return  new yamlToPost($yaml_path);
                break;
            case 'taxonomies':
                return new yamlToTaxonomy($yaml_path);
                break;
        }
    }
}

