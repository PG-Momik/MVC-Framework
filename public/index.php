<?php

require_once __DIR__ . '/../vendor/autoload.php';

use momik\simplemvc\controllers\TestController;
use momik\simplemvc\core\Application;

$rootPath = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(dirname(__DIR__), $config);

$app->router->get('/test', [TestController::class, 'index']);
$app->router->post('/test', [TestController::class, 'index']);


$app->run();