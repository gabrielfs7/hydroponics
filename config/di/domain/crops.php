<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Domain\Service\Crops\CropsDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    CropsRepository::class => function (ContainerInterface $container): CropsRepository {
        return new CropsRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Crops::class)
        );
    },

    #
    # Domain - Service
    #
    CropsDeleter::class => function (ContainerInterface $container): CropsDeleter {
        return new CropsDeleter($container->get(CropsRepository::class));
    },
];
