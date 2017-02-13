<?php

namespace yamlConfigurator\Controllers;
use yamlConfigurator\Controllers\yamlToAbstract;

class yamlToPost extends yamlToAbstract {

    public function registerCustomConfiguration($configuration) {
        var_dump($configuration);die;
    }
}
