<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../vendor/autoload.php';

use momik\simplemvc\controllers\HomeController;
use momik\simplemvc\controllers\LoginController;
use momik\simplemvc\controllers\ProfileController;
use momik\simplemvc\controllers\RegisterController;
use momik\simplemvc\core\Application;
use momik\simplemvc\core\facades\Router;

$rootPath = dirname(__DIR__);

$dotenv = Dotenv\Dotenv::createImmutable($rootPath);
$dotenv->load();

$config = [
    'db' => [
        'dsn'      => $_ENV['DB_DSN'],
        'user'     => $_ENV['DB_USER'],
        'password' => $_ENV['DB_PASSWORD'],
    ]
];
$app    = new Application(dirname(__DIR__), $config);

Router::GET('/', [HomeController::class, 'index']);

Router::GET('/login', [LoginController::class, 'index']);
Router::POST('/login', [LoginController::class, 'login']);

Router::GET('/register', [RegisterController::class, 'index']);
Router::POST('/register', [RegisterController::class, 'register']);

Router::GET('/profile', [ProfileController::class, 'index']);

Router::GET('/logout', [LoginController::class, 'logout']);

$app->run();