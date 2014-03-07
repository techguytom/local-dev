<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider as SP;

$app = new Application();
$app['debug'] = true;

// Registers
$app->register(new SP\ServiceControllerServiceProvider());

// Controllers
$app['index.controller'] = $app->share(function() use ($app) {
    return new \Controller\IndexController();
});

// Routes
$app->get('/', 'index.controller:indexAction');


$app->run();
