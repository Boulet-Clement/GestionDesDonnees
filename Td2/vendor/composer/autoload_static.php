<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0f76b22c31e71587556052b28422a712
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $fallbackDirsPsr0 = array (
        0 => __DIR__ . '/../..' . '/src',
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0f76b22c31e71587556052b28422a712::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0f76b22c31e71587556052b28422a712::$prefixDirsPsr4;
            $loader->fallbackDirsPsr0 = ComposerStaticInit0f76b22c31e71587556052b28422a712::$fallbackDirsPsr0;
            $loader->classMap = ComposerStaticInit0f76b22c31e71587556052b28422a712::$classMap;

        }, null, ClassLoader::class);
    }
}
