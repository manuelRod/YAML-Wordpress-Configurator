<?php
namespace yamlConfigurator\Controllers;

class unregisterCustomPostType implements unregisterCustomTypeInterface {

    /**
     * @param $post_type
     * @return bool|\WP_Error
     */
    public function unregister($post_type) {
        return unregister_post_type($post_type);
    }
}

