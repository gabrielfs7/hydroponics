<?php

use GSoares\Hydroponics\Application\Middleware\Greenhouse\GreenhouseMiddleware;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use Psr\Container\ContainerInterface;

return [
    GreenhouseMiddleware::class => function (ContainerInterface $container): GreenhouseMiddleware {
        return new GreenhouseMiddleware($container->get(GreenhouseRepository::class));
    },
];
