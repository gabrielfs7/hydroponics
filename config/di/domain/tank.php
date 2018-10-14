<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\Factory\Tank\TankFactory;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Domain\Repository\Tank\TankVersionRepository;
use GSoares\Hydroponics\Domain\Service\Tank\TankDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    TankRepository::class => function (ContainerInterface $container): TankRepository {
        return new TankRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Tank::class)
        );
    },
    TankVersionRepository::class => function (ContainerInterface $container): TankVersionRepository {
        return new TankVersionRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(TankVersion::class)
        );
    },

    #
    # Domain - Factory
    #
    TankFactory::class => function (ContainerInterface $container): TankFactory {
        return new TankFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    TankDeleter::class => function (ContainerInterface $container): TankDeleter {
        return new TankDeleter($container->get(TankRepository::class));
    },
];
