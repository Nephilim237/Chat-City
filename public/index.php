<?php

use Chat\Router;

require_once '../vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router(dirname(__DIR__) . '/views/');

$router->get('/register', 'register', 'register')
    ->post('/register', 'register', 'postregister')
    ->run();

