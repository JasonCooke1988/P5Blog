<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit12fe9e10249af2f8e4072b0b387e6578
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

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit12fe9e10249af2f8e4072b0b387e6578::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit12fe9e10249af2f8e4072b0b387e6578::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}