<?php
namespace yamlConfigurator\Controllers;

class readConfigFiles {

    /**
     * @var string
     */
    protected $path;

    /**
     * Get Configuration Path for config files
     */
    public function getConfigFolder($configurationType) {
        $this->path = CUSTOM_CONFIGURATION_PATH . $configurationType;
    }

    /**
     * Get all configuration files from a given folder
     *
     * @return array
     */
    public function getFiles() {
        $files = array();
        if (is_dir($this->path)) {
            if ($dh = opendir($this->path)) {
                while (($file = readdir($dh)) !== false) {
                    if ($file != "." && $file != "..") {
                        $files[] = $this->path . '/' . $file;
                    }
                }
                closedir($dh);
            }
        }
        return $files;
    }

}
