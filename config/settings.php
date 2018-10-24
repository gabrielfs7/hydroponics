<?php

return [
    'settings' => [
        'displayErrorDetails' => true,
        'addContentLengthHeader' => false,
        'determineRouteBeforeAppMiddleware' => false,

        'doctrine' => [
            'dev_mode' => true, // if true, metadata caching is forcefully disabled
            'cache_dir' => APP_ROOT . '/var/doctrine',
            'prefixes' => [
                APP_ROOT . '/config/orm/Entity' => 'GSoares\Hydroponics\Domain\Entity',
                APP_ROOT . '/config/orm/ValueObject' => 'GSoares\Hydroponics\Domain\ValueObject',
            ],
            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => 'hydroponics_mysql',
                'port' => 3306,
                'dbname' => 'hydroponics',
                'user' => 'root',
                'password' => 'root',
                'charset' => 'utf8',
            ]
        ]
    ],
];
