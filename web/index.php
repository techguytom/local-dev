<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider as SP;

$app = new Application();

// Environment
$app['debug'] = true;
$app['siteDirectories'] = __DIR__ . '/../../sites';

// Registers
$app->register(new SP\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(),
    array(
        'twig.path' => __DIR__ . '/../tgt/Views',
    )
);
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__ . "/../config/parameters.yml"));

// Controllers
$app['index.controller'] = $app->share(function() {
    return new \Controller\IndexController();
});

// Routes
$app->get('/', 'index.controller:indexAction');

$app->run();
