<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Domain\Service\Greenhouse\GreenhouseDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    GreenhouseRepository::class => function (ContainerInterface $container): GreenhouseRepository {
        return new GreenhouseRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Greenhouse::class)
        );
    },

    #
    # Domain - Factory
    #
    GreenhouseFactory::class => function (ContainerInterface $container): GreenhouseFactory {
        return new GreenhouseFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    GreenhouseDeleter::class => function (ContainerInterface $container): GreenhouseDeleter {
        return new GreenhouseDeleter($container->get(GreenhouseRepository::class));
    },
];
