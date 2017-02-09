<?php

namespace yamlConfigurator\Controllers;
use yamlConfigurator\Controllers\readConfigFiles;

abstract class abstractCustomImplementer {

    /**
     * @var string Will define the type of configuration (cpt, custom taxonomy or custom term)
     */
    protected $configurationType;

    /**
     * @var array Holds config files
     */
    protected $configFiles;


    /**
     * @param $configurationType
     */
    public function __construct($configurationType) {
        $this->configurationType = $configurationType;
    }

    /**
     * Read config files from
     */
    public function readConfigFiles() {
        $reader = new readConfigFiles($this->configurationType);
        $this->configFiles = $reader->getFiles();
    }

    abstract function implementYamlConfiguration();

    public function run() {

    }

}