<?php
// DIC configuration

use App\Controllers\TaskController;
use App\Models\TaskModel;

$container = $app->getContainer();

// view renderer
$container['view'] = function ($c) {
    return new Slim\Views\PhpRenderer(__DIR__ . '/../views/');
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

// PDO
$container['Pdo'] = function($c) {
    $settings = $c->get('settings')['db'];
    return new PDO("mysql:host={$settings['host']};dbname={$settings['database']};charset=utf8", $settings['user'], $settings['pw']);
};

// TaskModel
$container['TaskModel'] = function($c) {
    $pdo = $c->get('Pdo');
    return new TaskModel($pdo);
};