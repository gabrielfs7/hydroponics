<?php

use GSoares\Hydroponics\Application\Action\Crops\CreateCropsAction;
use GSoares\Hydroponics\Application\Action\Crops\DeleteCropsAction;
use GSoares\Hydroponics\Application\Action\Crops\GetCropsAction;
use GSoares\Hydroponics\Application\Action\Crops\ListCropsAction;
use GSoares\Hydroponics\Application\Action\Crops\UpdateCropsAction;
use GSoares\Hydroponics\Application\Decoder\Crops\CropsDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Crops\CropsDtoEncoder;
use GSoares\Hydroponics\Application\Service\Crops\CropsApplicationCreator;
use GSoares\Hydroponics\Application\Service\Crops\CropsApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Crops\CropsApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Crops\CropsApplicationUpdater;
use GSoares\Hydroponics\Application\Service\Crops\CropsAttributesFiller;
use GSoares\Hydroponics\Domain\Factory\Crops\CropsFactory;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Domain\Service\Crops\CropsDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    CropsDtoDecoder::class => function (ContainerInterface $container): CropsDtoDecoder {
        return new CropsDtoDecoder();
    },

    #
    # Application - Encoders
    #
    CropsDtoEncoder::class => function (ContainerInterface $container): CropsDtoEncoder {
        return new CropsDtoEncoder();
    },

    #
    # Application - Service - Creator
    #
    CropsApplicationCreator::class => function (ContainerInterface $container): CropsApplicationCreator {
        $creator = new CropsApplicationCreator(
            $container->get(CropsDtoDecoder::class),
            $container->get(CropsDtoEncoder::class),
            $container->get(CropsFactory::class),
            $container->get(CropsRepository::class),
            $container->get(CropsAttributesFiller::class)
        );

        $creator->setPlantRepository($container->get(PlantRepository::class));

        return $creator;
    },

    #
    # Application - Service - Updater
    #
    CropsApplicationUpdater::class => function (ContainerInterface $container): CropsApplicationUpdater {
        return new CropsApplicationUpdater(
            $container->get(CropsDtoDecoder::class),
            $container->get(CropsDtoEncoder::class),
            $container->get(CropsFactory::class),
            $container->get(CropsRepository::class),
            $container->get(CropsAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    CropsApplicationDeleter::class => function (ContainerInterface $container): CropsApplicationDeleter {
        return new CropsApplicationDeleter(
            $container->get(CropsDtoEncoder::class),
            $container->get(CropsDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    CropsApplicationSearcher::class => function (ContainerInterface $container): CropsApplicationSearcher {
        return new CropsApplicationSearcher(
            $container->get(CropsDtoEncoder::class),
            $container->get(CropsRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    CropsAttributesFiller::class => function (ContainerInterface $container): CropsAttributesFiller {
        $attributesFiller = new CropsAttributesFiller();
        $attributesFiller->setPlantRepository($container->get(PlantRepository::class));
        $attributesFiller->setSystemRepository($container->get(SystemRepository::class));

        return $attributesFiller;
    },

    #
    # Application - Action
    #
    ListCropsAction::class => function (ContainerInterface $container): ListCropsAction {
        return new ListCropsAction($container->get(CropsApplicationSearcher::class));
    },
    GetCropsAction::class => function (ContainerInterface $container): GetCropsAction {
        return new GetCropsAction($container->get(CropsApplicationSearcher::class));
    },
    CreateCropsAction::class => function (ContainerInterface $container): CreateCropsAction {
        return new CreateCropsAction($container->get(CropsApplicationCreator::class));
    },
    UpdateCropsAction::class => function (ContainerInterface $container): UpdateCropsAction {
        return new UpdateCropsAction($container->get(CropsApplicationUpdater::class));
    },
    DeleteCropsAction::class => function (ContainerInterface $container): DeleteCropsAction {
        return new DeleteCropsAction($container->get(CropsApplicationDeleter::class));
    },
];
