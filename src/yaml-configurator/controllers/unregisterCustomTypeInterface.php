<?php


namespace yamlConfigurator\Controllers;
/**
 * It will be the contract to unregister CPT, taxonomies or tags
 *
 * Interface unregisterCustomTypeInterface
 * @package yamlConfigurator\Controllers
 */
interface unregisterCustomTypeInterface {
    /**
     * custom type name to be unregistered
     * @param $name
     * @return mixed
     */
    public function unregister($name);
}

