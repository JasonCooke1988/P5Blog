<?php

use App\Core\Container;
use App\Manager\AccountManager;
use App\Manager\CommentManager;
use App\Manager\PostManager;
use App\Manager\UserManager;
use App\Service\PDOFactory;
use App\Service\Session;

$config = require 'config.php';
return [
        PostManager::class => function (Container $container) {
            return new PostManager($container->get(PDOFactory::class));
        }, CommentManager::class => function (Container $container) {
            return new CommentManager($container->get(PDOFactory::class));
        }, UserManager::class => function (Container $container)  {
            return new UserManager($container->get(PDOFactory::class));
        }, AccountManager::class => function (Container $container) {
            return new AccountManager($container->get(PDOFactory::class));
        }, PDOFactory::class => function (Container $container) use ($config) {
            return new PDOFactory($config);
        }, Session::class => function (Container $containter) {
            return new Session();
        }
    ] + $config;