<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Repository\NutritionalFormula\NutritionalFormulaRepository;
use Psr\Container\ContainerInterface;

return [
    #
    # Domain - Repository
    #
    NutritionalFormulaRepository::class => function (ContainerInterface $container): NutritionalFormulaRepository {
        return new NutritionalFormulaRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Crop::class)
        );
    },
];
