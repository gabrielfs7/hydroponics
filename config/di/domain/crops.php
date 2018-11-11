<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Factory\Crop\CropFactory;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Domain\Service\Crop\CropDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    CropRepository::class => function (ContainerInterface $container): CropRepository {
        return new CropRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Crop::class)
        );
    },

    #
    # Domain - Factory
    #
    CropFactory::class => function (ContainerInterface $container): CropFactory {
        return new CropFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    CropDeleter::class => function (ContainerInterface $container): CropDeleter {
        return new CropDeleter($container->get(CropRepository::class));
    },
];
