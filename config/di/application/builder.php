<?php

use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Builders
    #
    ErrorCollectionDtoBuilder::class => function (ContainerInterface $container): ErrorCollectionDtoBuilder {
        return new ErrorCollectionDtoBuilder();
    },
];
