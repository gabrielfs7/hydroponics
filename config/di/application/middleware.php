<?php

use GSoares\Hydroponics\Application\Middleware\Greenhouse\GreenhouseMiddleware;
use GSoares\Hydroponics\Application\Middleware\System\SystemMiddleware;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use Psr\Container\ContainerInterface;

return [
    GreenhouseMiddleware::class => function (ContainerInterface $container): GreenhouseMiddleware {
        return new GreenhouseMiddleware($container->get(GreenhouseRepository::class));
    },
    SystemMiddleware::class => function (ContainerInterface $container): SystemMiddleware {
        return new SystemMiddleware($container->get(SystemRepository::class));
    },
];
