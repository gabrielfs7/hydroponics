<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            'dev_mode' => true, // if true, metadata caching is forcefully disabled
            'cache_dir' => APP_ROOT . '/var/doctrine',
            'metadata_dirs' => [
                APP_ROOT . '/config/orm'
            ],
            'entity_dirs' => [
                APP_ROOT . '/src/Domain/Entity'
            ],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'hydroponics_mysql',
                'port' => 3306,
                'dbname' => 'hydroponics',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8'
            ]
        ]
    ],
];
