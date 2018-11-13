<?php

use GSoares\Hydroponics\Application\Action\Tank\CreateTankAction;
use GSoares\Hydroponics\Application\Action\Tank\DeleteTankAction;
use GSoares\Hydroponics\Application\Action\Tank\GetTankAction;
use GSoares\Hydroponics\Application\Action\Tank\ListTankAction;
use GSoares\Hydroponics\Application\Action\Tank\UpdateTankAction;
use GSoares\Hydroponics\Application\Decoder\Tank\TankDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Tank\TankDtoEncoder;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Tank\TankAttributesFiller;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationCreator;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationUpdater;
use GSoares\Hydroponics\Domain\Factory\Tank\TankFactory;
use GSoares\Hydroponics\Domain\Repository\NutritionalFormula\NutritionalFormulaRepository;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Domain\Service\Tank\TankDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    TankDtoDecoder::class => function (ContainerInterface $container): TankDtoDecoder {
        return new TankDtoDecoder();
    },

    #
    # Application - Encoders
    #
    TankDtoEncoder::class => function (ContainerInterface $container): TankDtoEncoder {
        return new TankDtoEncoder();
    },

    #
    # Application - Service - Creator
    #
    TankApplicationCreator::class => function (ContainerInterface $container): TankApplicationCreator {
        return new TankApplicationCreator(
            $container->get(TankDtoDecoder::class),
            $container->get(TankDtoEncoder::class),
            $container->get(TankFactory::class),
            $container->get(TankRepository::class),
            $container->get(TankAttributesFiller::class)
        );
    },

    #
    # Application - Service - Updater
    #
    TankApplicationUpdater::class => function (ContainerInterface $container): TankApplicationUpdater {
        return new TankApplicationUpdater(
            $container->get(TankDtoDecoder::class),
            $container->get(TankDtoEncoder::class),
            $container->get(TankFactory::class),
            $container->get(TankRepository::class),
            $container->get(TankAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    TankApplicationDeleter::class => function (ContainerInterface $container): TankApplicationDeleter {
        return new TankApplicationDeleter(
            $container->get(TankDtoEncoder::class),
            $container->get(TankDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    TankApplicationSearcher::class => function (ContainerInterface $container): TankApplicationSearcher {
        return new TankApplicationSearcher(
            $container->get(TankDtoEncoder::class),
            $container->get(TankRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    TankAttributesFiller::class => function (ContainerInterface $container): TankAttributesFiller {
        return new TankAttributesFiller(
            $container->get(DateTimeProvider::class),
            $container->get(NutritionalFormulaRepository::class)
        );
    },

    #
    # Application - Action
    #
    ListTankAction::class => function (ContainerInterface $container): ListTankAction {
        return new ListTankAction($container->get(TankApplicationSearcher::class));
    },
    GetTankAction::class => function (ContainerInterface $container): GetTankAction {
        return new GetTankAction($container->get(TankApplicationSearcher::class));
    },
    CreateTankAction::class => function (ContainerInterface $container): CreateTankAction {
        return new CreateTankAction($container->get(TankApplicationCreator::class));
    },
    UpdateTankAction::class => function (ContainerInterface $container): UpdateTankAction {
        return new UpdateTankAction($container->get(TankApplicationUpdater::class));
    },
    DeleteTankAction::class => function (ContainerInterface $container): DeleteTankAction {
        return new DeleteTankAction($container->get(TankApplicationDeleter::class));
    },
];
