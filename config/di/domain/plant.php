<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Factory\Plant\PlantFactory;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Domain\Service\Plant\PlantDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    PlantRepository::class => function (ContainerInterface $container): PlantRepository {
        return new PlantRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Plant::class)
        );
    },

    #
    # Domain - Factory
    #
    PlantFactory::class => function (ContainerInterface $container): PlantFactory {
        return new PlantFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    PlantDeleter::class => function (ContainerInterface $container): PlantDeleter {
        return new PlantDeleter($container->get(PlantRepository::class));
    },
];
