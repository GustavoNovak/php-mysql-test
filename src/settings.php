<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Databse connection
        'connection' => [
            'driver' => 'pdo_mysql',
            'host' => 'localhost',
            'port' => 3306,
            'dbname' => 'car_sharing',
            'user' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'driverOptions' => array(
                1002 => 'SET NAMES utf8'
            )
        ],
    ],
];
