<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5cc3d41b9ee45cf6e79eb4cdce5c2fd6
{
    public static $prefixLengthsPsr4 = array (
        'B' => 
        array (
            'Bacoder\\Servicesgenerator\\' => 26,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Bacoder\\Servicesgenerator\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5cc3d41b9ee45cf6e79eb4cdce5c2fd6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5cc3d41b9ee45cf6e79eb4cdce5c2fd6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5cc3d41b9ee45cf6e79eb4cdce5c2fd6::$classMap;

        }, null, ClassLoader::class);
    }
}
