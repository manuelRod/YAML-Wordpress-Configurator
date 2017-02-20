<?php
namespace yamlConfigurator\Controllers;

class unregisterTaxonomy implements unregisterCustomTypeInterface {

    /**
     * @param $taxonomy_name
     * @return bool|\WP_Error
     */
    public function unregister($taxonomy_name) {
        return unregister_taxonomy($taxonomy_name);
    }
}

