<?php

namespace yamlConfigurator\Controllers;

/**
 * Class yamlToTaxonomy
 * @package yamlConfigurator\Controllers
 */
class yamlToTaxonomy extends yamlToAbstract {

    /**
     * Registers custom post type defined on the YAML configuration file.
     *
     * @param string $postTypeName
     * @param array $configuration
     * @return object|\WP_Error
     */
    public function registerCustomConfiguration($postTypeName, $configuration) {
        return register_post_type( 'book', $configuration );
    }
}

