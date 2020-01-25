<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], Monolog\Logger::DEBUG));
    return $logger;
};

// API container
$container['api'] = function ($c) {
    $api = $c->get('settings')['api'];
    $api['api_url'] = $api['base_url'] . '/api/' . $api['version'];
    return $api;
};

// Database container
$container['db'] = function ($c) {
    $db = $c->get('settings')['db'];
    $pdo = new PDO($db['dsn'].':'.$db['database']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

// Todo model container 
$container['todo'] = function($c) {
    return new App\Model\Todo($c->get('db'));
};

// Subtasks model container 
$container['subtasks'] = function($c) {
    return new App\Model\Subtasks($c->get('db'));
};