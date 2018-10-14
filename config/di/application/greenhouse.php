<?php

use GSoares\Hydroponics\Application\Action\Greenhouse\CreateGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\DeleteGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\GetGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\ListGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\UpdateGreenhouseAction;
use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
use GSoares\Hydroponics\Application\Decoder\Greenhouse\GreenhouseDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Greenhouse\GreenhouseDtoEncoder;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseAttributesFiller;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationCreator;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationUpdater;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Domain\Service\Greenhouse\GreenhouseDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    GreenhouseDtoDecoder::class => function (ContainerInterface $container): GreenhouseDtoDecoder {
        return new GreenhouseDtoDecoder();
    },

    #
    # Application - Encoders
    #
    GreenhouseDtoEncoder::class => function (ContainerInterface $container): GreenhouseDtoEncoder {
        return new GreenhouseDtoEncoder();
    },

    #
    # Application - Builders
    #
    ErrorCollectionDtoBuilder::class => function (ContainerInterface $container): ErrorCollectionDtoBuilder {
        return new ErrorCollectionDtoBuilder();
    },

    #
    # Application - Service - Creator
    #
    GreenhouseApplicationCreator::class => function (ContainerInterface $container): GreenhouseApplicationCreator {
        return new GreenhouseApplicationCreator(
            $container->get(GreenhouseDtoDecoder::class),
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseFactory::class),
            $container->get(GreenhouseRepository::class),
            $container->get(GreenhouseAttributesFiller::class)
        );
    },

    #
    # Application - Service - Updater
    #
    GreenhouseApplicationUpdater::class => function (ContainerInterface $container): GreenhouseApplicationUpdater {
        return new GreenhouseApplicationUpdater(
            $container->get(GreenhouseDtoDecoder::class),
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseFactory::class),
            $container->get(GreenhouseRepository::class),
            $container->get(GreenhouseAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    GreenhouseApplicationDeleter::class => function (ContainerInterface $container): GreenhouseApplicationDeleter {
        return new GreenhouseApplicationDeleter(
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    GreenhouseApplicationSearcher::class => function (ContainerInterface $container): GreenhouseApplicationSearcher {
        return new GreenhouseApplicationSearcher(
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    GreenhouseAttributesFiller::class => function (ContainerInterface $container): GreenhouseAttributesFiller {
        return new GreenhouseAttributesFiller();
    },

    #
    # Application - Action
    #
    ListGreenhouseAction::class => function (ContainerInterface $container): ListGreenhouseAction {
        return new ListGreenhouseAction($container->get(GreenhouseApplicationSearcher::class));
    },
    GetGreenhouseAction::class => function (ContainerInterface $container): GetGreenhouseAction {
        return new GetGreenhouseAction($container->get(GreenhouseApplicationSearcher::class));
    },
    CreateGreenhouseAction::class => function (ContainerInterface $container): CreateGreenhouseAction {
        return new CreateGreenhouseAction($container->get(GreenhouseApplicationCreator::class));
    },
    UpdateGreenhouseAction::class => function (ContainerInterface $container): UpdateGreenhouseAction {
        return new UpdateGreenhouseAction($container->get(GreenhouseApplicationUpdater::class));
    },
    DeleteGreenhouseAction::class => function (ContainerInterface $container): DeleteGreenhouseAction {
        return new DeleteGreenhouseAction($container->get(GreenhouseApplicationDeleter::class));
    },
];
