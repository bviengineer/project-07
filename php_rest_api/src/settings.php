<?php
return [
    'settings' => [
        'displayErrorDetails' => true,

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => __DIR__ . '/../logs/app.log',
        ],

        // API settings
        'api' => [
            'version' => 'v1',
            'base_url' => 'http://localhost:8888',
        ],

        // Database settings
        'db' => [
            'dsn' => 'sqlite',
            'database' => __DIR__ . 'src/todo.db',
        ],
    ],
];
