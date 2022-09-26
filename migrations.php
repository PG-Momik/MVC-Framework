<?php

require_once __DIR__ . '/vendor/autoload.php';

use momik\simplemvc\Application;

$rootPath = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$config = [
    'db' => [
        'dsn' => $_ENV['DB_DSN'],
        'user' => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app = new Application(__DIR__, $config);
//
$app->database->applyMigration();