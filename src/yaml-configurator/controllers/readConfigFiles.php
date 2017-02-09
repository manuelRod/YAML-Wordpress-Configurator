<?php

namespace yamlConfigurator\Controllers;

class readConfigFiles {

    /**
     * @var string Will hold the path
     */
    protected $path;

    /**
     * @var string Will define the type of configuration (cpt, custom taxonomy or custom term)
     */
    protected $configurationType;

    function __construct($configurationType) {
        $this->configurationType = $configurationType;
        $this->getConfigFolder();
    }

    /**
     * Get Configuration Path for config files
     */
    private function getConfigFolder() {
        $this->path = CUSTOM_CONFIGURATION_PATH . '/' . $this->configurationType;
    }

    public function getFiles() {
        if (is_dir($this->path)) {
            if ($dh = opendir($this->path)) {
                while (($file = readdir($dh)) !== false){
                    echo "filename:" . $file . "<br>";
                }
                closedir($dh);
            }
        }
    }

}