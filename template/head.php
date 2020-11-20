<?php

use App\Core\Container;
use App\Helper\Template;

$container = Container::getInstance();
$url = $container->get('base.path');
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">



    <title>P5 Blog - Jason Cooke</title>
    <link rel="apple-touch-icon" sizes="180x180" href="<?= Template::assets('/apple-touch-icon.png') ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= Template::assets('/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= Template::assets('/favicon-16x16.png') ?>">
    <link rel="manifest" href="<?= Template::assets('/site.webmanifest') ?>">
    <link rel="mask-icon" href="<?= Template::assets('/safari-pinned-tab.svg') ?>" color="#5bbad5">
    <!-- Bootstrap core CSS -->
    <link href="<?= Template::assets('/gulp/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="<?= Template::assets('/gulp/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic' rel='stylesheet'
          type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
          rel='stylesheet' type='text/css'>

    <!-- Custom styles for this template -->
    <link href="<?= Template::assets('/css/clean-blog.css') ?>" rel="stylesheet">

</head>
<body>


<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?= $url ?>/index.php">P5 Blog - Jason Cooke</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url ?>/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url ?>/post-archive">Le Blog</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= $url ?>/login">Connexion utilisateur</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?= Template::img('/home-bg.jpg') ?>')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">
                    <h1>Blog P5</h1>
                    <span class="subheading">Un blog sur le développement d'appliction PHP POO</span>
                    <img class="logo" src="<?= Template::img('/pngegg.png') ?>" alt="Dev logo">
                </div>
            </div>
        </div>
    </div>
</header>