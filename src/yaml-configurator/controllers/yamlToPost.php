<?php

namespace yamlConfigurator\Controllers;

/**
 * Class yamlToPost
 * @package yamlConfigurator\Controllers
 */
class yamlToPost extends yamlToAbstract {

    /**
     * Registers custom post type defined on the YAML configuration file.
     *
     * @param string $postTypeName
     * @param array $configuration
     * @return object|\WP_Error
     */
    public function registerCustomConfiguration($postTypeName, $configuration) {
        return register_post_type( $postTypeName, $configuration );
    }
}

