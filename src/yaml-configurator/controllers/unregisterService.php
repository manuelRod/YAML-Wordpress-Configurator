<?php

namespace yamlConfigurator\Controllers;

/**
 * Service to unregister custom type depending on the configuration type
 *
 * Class unregisterService
 * @package yamlConfigurator\Controllers
 */
class unregisterService {

    static function unregister($configuration_type) {
        switch ($configuration_type) {
            case 'post_types':
                return new unregisterCustomPostType();
                break;
            case 'taxonomies':
                return new unregisterTaxonomy();
                break;
        }
    }
}

