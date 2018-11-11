<?php

use GSoares\Hydroponics\Application\Action\Crop\CreateCropAction;
use GSoares\Hydroponics\Application\Action\Crop\DeleteCropAction;
use GSoares\Hydroponics\Application\Action\Crop\GetCropAction;
use GSoares\Hydroponics\Application\Action\Crop\ListCropAction;
use GSoares\Hydroponics\Application\Action\Crop\UpdateCropAction;
use GSoares\Hydroponics\Application\Decoder\Crop\CropDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Crop\CropDtoEncoder;
use GSoares\Hydroponics\Application\Service\Crop\CropApplicationCreator;
use GSoares\Hydroponics\Application\Service\Crop\CropApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Crop\CropApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Crop\CropApplicationUpdater;
use GSoares\Hydroponics\Application\Service\Crop\CropAttributesFiller;
use GSoares\Hydroponics\Domain\Factory\Crop\CropFactory;
use GSoares\Hydroponics\Domain\Repository\Crop\CropRepository;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Domain\Service\Crop\CropDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    CropDtoDecoder::class => function (ContainerInterface $container): CropDtoDecoder {
        return new CropDtoDecoder();
    },

    #
    # Application - Encoders
    #
    CropDtoEncoder::class => function (ContainerInterface $container): CropDtoEncoder {
        return new CropDtoEncoder();
    },

    #
    # Application - Service - Creator
    #
    CropApplicationCreator::class => function (ContainerInterface $container): CropApplicationCreator {
        $creator = new CropApplicationCreator(
            $container->get(CropDtoDecoder::class),
            $container->get(CropDtoEncoder::class),
            $container->get(CropFactory::class),
            $container->get(CropRepository::class),
            $container->get(CropAttributesFiller::class)
        );

        $creator->setPlantRepository($container->get(PlantRepository::class));

        return $creator;
    },

    #
    # Application - Service - Updater
    #
    CropApplicationUpdater::class => function (ContainerInterface $container): CropApplicationUpdater {
        return new CropApplicationUpdater(
            $container->get(CropDtoDecoder::class),
            $container->get(CropDtoEncoder::class),
            $container->get(CropFactory::class),
            $container->get(CropRepository::class),
            $container->get(CropAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    CropApplicationDeleter::class => function (ContainerInterface $container): CropApplicationDeleter {
        return new CropApplicationDeleter(
            $container->get(CropDtoEncoder::class),
            $container->get(CropDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    CropApplicationSearcher::class => function (ContainerInterface $container): CropApplicationSearcher {
        return new CropApplicationSearcher(
            $container->get(CropDtoEncoder::class),
            $container->get(CropRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    CropAttributesFiller::class => function (ContainerInterface $container): CropAttributesFiller {
        $attributesFiller = new CropAttributesFiller();
        $attributesFiller->setPlantRepository($container->get(PlantRepository::class));
        $attributesFiller->setSystemRepository($container->get(SystemRepository::class));

        return $attributesFiller;
    },

    #
    # Application - Action
    #
    ListCropAction::class => function (ContainerInterface $container): ListCropAction {
        return new ListCropAction($container->get(CropApplicationSearcher::class));
    },
    GetCropAction::class => function (ContainerInterface $container): GetCropAction {
        return new GetCropAction($container->get(CropApplicationSearcher::class));
    },
    CreateCropAction::class => function (ContainerInterface $container): CreateCropAction {
        return new CreateCropAction($container->get(CropApplicationCreator::class));
    },
    UpdateCropAction::class => function (ContainerInterface $container): UpdateCropAction {
        return new UpdateCropAction($container->get(CropApplicationUpdater::class));
    },
    DeleteCropAction::class => function (ContainerInterface $container): DeleteCropAction {
        return new DeleteCropAction($container->get(CropApplicationDeleter::class));
    },
];
