<?php

namespace App\Helper;

use App\Core\Container;

class Template
{

    public static function img(string $path) : string
    {
        return self::getBasePath().'/img'.$path;
    }

    public static function assets(string $path) : string
    {
        return self::getBasePath().$path;
    }

    public static function getBasePath(): string {
        $container = Container::getInstance();
        $basePath = '';
        if ($container->has('base.path')) {
            $basePath = $container->get('base.path');;
        }

        return $basePath;
    }

}