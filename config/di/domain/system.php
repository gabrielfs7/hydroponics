<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Factory\System\SystemFactory;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Domain\Service\System\SystemDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    SystemRepository::class => function (ContainerInterface $container): SystemRepository {
        return new SystemRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(System::class)
        );
    },

    #
    # Domain - Factory
    #
    SystemFactory::class => function (ContainerInterface $container): SystemFactory {
        return new SystemFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    SystemDeleter::class => function (ContainerInterface $container): SystemDeleter {
        return new SystemDeleter($container->get(SystemRepository::class));
    },
];
