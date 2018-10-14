<?php

use GSoares\Hydroponics\Application\Decoder\Plant\PlantDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Plant\PlantDtoEncoder;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Plant\PlantAttributesFiller;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationCreator;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationUpdater;
use GSoares\Hydroponics\Domain\Factory\Plant\PlantFactory;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Domain\Service\Plant\PlantDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    PlantDtoDecoder::class => function (ContainerInterface $container): PlantDtoDecoder {
        return new PlantDtoDecoder();
    },

    #
    # Application - Encoders
    #
    PlantDtoEncoder::class => function (ContainerInterface $container): PlantDtoEncoder {
        return new PlantDtoEncoder();
    },

    #
    # Application - Service - Creator
    #
    PlantApplicationCreator::class => function (ContainerInterface $container): PlantApplicationCreator {
        return new PlantApplicationCreator(
            $container->get(PlantDtoDecoder::class),
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantFactory::class),
            $container->get(PlantRepository::class),
            $container->get(PlantAttributesFiller::class)
        );
    },

    #
    # Application - Service - Updater
    #
    PlantApplicationUpdater::class => function (ContainerInterface $container): PlantApplicationUpdater {
        return new PlantApplicationUpdater(
            $container->get(PlantDtoDecoder::class),
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantFactory::class),
            $container->get(PlantRepository::class),
            $container->get(PlantAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    PlantApplicationDeleter::class => function (ContainerInterface $container): PlantApplicationDeleter {
        return new PlantApplicationDeleter(
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    PlantApplicationSearcher::class => function (ContainerInterface $container): PlantApplicationSearcher {
        return new PlantApplicationSearcher(
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    PlantAttributesFiller::class => function (ContainerInterface $container): PlantAttributesFiller {
        return new PlantAttributesFiller();
    },
];
