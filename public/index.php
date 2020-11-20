<?php
session_start();

use App\Core\Container;
use App\Core\Request;

require '../vendor/autoload.php';

$services  = require '../config/services.php';
$routes = require '../config/routes.php';

Container::init($services);

$app = new App\Kernel($routes);

$response = $app->run(new Request());

$response->done();