<?php

use App\Controller\UserController;
use App\Controller\AdminController;
use App\Controller\HomeController;

return [
  new \App\Core\Route('/', HomeController::class,'index'),
  new \App\Core\Route('/index.php', HomeController::class,'index'),
  new \App\Core\Route('/admin', AdminController::class,'index'),
  new \App\Core\Route('/post/([0-9]+)', HomeController::class,'singlePost'),
  new \App\Core\Route('/post-archive', HomeController::class,'allPost'),
  new \App\Core\Route('/contact-form', HomeController::class,'contactForm'),
  new \App\Core\Route('/login', UserController::class,'loginPage'),
  new \App\Core\Route('/create-account', UserController::class,'create'),
  new \App\Core\Route('/login-account', UserController::class,'login'),
  new \App\Core\Route('/create-post', AdminController::class,'createPost'),
  new \App\Core\Route('/create-comment', HomeController::class,'createComment'),
];