<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit7b5502ec67cd9f01f7c9c2d086e3b8bb
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\Yaml\\' => 23,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\Yaml\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/yaml',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Composer\\Installers\\' => 
            array (
                0 => __DIR__ . '/..' . '/composer/installers/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit7b5502ec67cd9f01f7c9c2d086e3b8bb::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit7b5502ec67cd9f01f7c9c2d086e3b8bb::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit7b5502ec67cd9f01f7c9c2d086e3b8bb::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
