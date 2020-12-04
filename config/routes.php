<?php

use App\Controller\UserController;
use App\Controller\AdminController;
use App\Controller\HomeController;
use App\Core\Route;

return [
    new Route('/', HomeController::class, 'index'),
    new Route('/index.php', HomeController::class, 'index'),
    new Route('/admin', AdminController::class, 'index'),
    new Route('/post/([0-9]+)', HomeController::class, 'singlePost'),
    new Route('/post-archive', HomeController::class, 'allPost'),
    new Route('/contact-form', HomeController::class, 'contactForm'),
    new Route('/login', UserController::class, 'loginPage'),
    new Route('/create-account', UserController::class, 'create'),
    new Route('/login-account', UserController::class, 'login'),
    new Route('/create-post', AdminController::class, 'createPost'),
    new Route('/modify-post', AdminController::class, 'modifyPostList'),
    new Route('/modify-post/([0-9]+)', AdminController::class, 'modifyPost'),
    new Route('/validate-comment', AdminController::class, 'validateComment'),
    new Route('/validate-comment/([0-9]+)/([0-9]+)', AdminController::class, 'validateComment'),
    new Route('/user-list', AdminController::class, 'userList'),
    new Route('/user-list/([0-9]+)', AdminController::class, 'setUserAdmin'),
    new Route('/create-comment', HomeController::class, 'createComment'),
];