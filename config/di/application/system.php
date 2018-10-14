<?php

use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
use GSoares\Hydroponics\Application\Decoder\System\SystemDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\System\SystemDtoEncoder;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationDeleter;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationSearcher;
use GSoares\Hydroponics\Application\Service\System\SystemAttributesFiller;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationCreator;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationUpdater;
use GSoares\Hydroponics\Domain\Factory\System\SystemFactory;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Domain\Service\System\SystemDeleter;
use Psr\Container\ContainerInterface;

return [
    #
    # Application - Decoders
    #
    SystemDtoDecoder::class => function (ContainerInterface $container): SystemDtoDecoder {
        return new SystemDtoDecoder();
    },

    #
    # Application - Encoders
    #
    SystemDtoEncoder::class => function (ContainerInterface $container): SystemDtoEncoder {
        return new SystemDtoEncoder();
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
    SystemApplicationCreator::class => function (ContainerInterface $container): SystemApplicationCreator {
        return new SystemApplicationCreator(
            $container->get(SystemDtoDecoder::class),
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemFactory::class),
            $container->get(SystemRepository::class),
            $container->get(SystemAttributesFiller::class)
        );
    },

    #
    # Application - Service - Updater
    #
    SystemApplicationUpdater::class => function (ContainerInterface $container): SystemApplicationUpdater {
        return new SystemApplicationUpdater(
            $container->get(SystemDtoDecoder::class),
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemFactory::class),
            $container->get(SystemRepository::class),
            $container->get(SystemAttributesFiller::class)
        );
    },

    #
    # Application - Service - Deleter
    #
    SystemApplicationDeleter::class => function (ContainerInterface $container): SystemApplicationDeleter {
        return new SystemApplicationDeleter(
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemDeleter::class)
        );
    },

    #
    # Application - Service - Searcher
    #
    SystemApplicationSearcher::class => function (ContainerInterface $container): SystemApplicationSearcher {
        return new SystemApplicationSearcher(
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    SystemAttributesFiller::class => function (ContainerInterface $container): SystemAttributesFiller {
        return new SystemAttributesFiller();
    },
];
