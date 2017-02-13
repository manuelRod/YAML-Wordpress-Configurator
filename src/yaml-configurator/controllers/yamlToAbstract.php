<?php

namespace yamlConfigurator\Controllers;
use Symfony\Component\Yaml\Parser;


abstract class yamlToAbstract {

    /**
     * @var string
     */
    protected $yamlPath;

    /**
     * @var array
     */
    protected $yamlParsed;

    /**
     * @param $yamlPath string
     */
    public function __construct($yamlPath) {
        $this->yamlPath = $yamlPath;
        $this->yamlParsed = $this->parseYaml();
    }

    /**
     * Parses YAML file defined on path and returns its array interpretation
     * @return array
     */
    protected function parseYaml() {
        $yaml = new Parser();
        return $yaml->parse( file_get_contents( $this->yamlPath ) );
    }

    /**
     * Registers the custom type of data defined on the YAML configuration file
     * @return mixed
     */
    abstract public function register();

}
