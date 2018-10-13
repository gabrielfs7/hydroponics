<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\Common\Cache\FilesystemCache;
use GSoares\Hydroponics\Application\Action\Greenhouse\CreateGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\DeleteGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\GetGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\ListGreenhouseAction;
use GSoares\Hydroponics\Application\Action\Greenhouse\UpdateGreenhouseAction;
use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
use GSoares\Hydroponics\Application\Decoder\Greenhouse\GreenhouseDtoDecoder;
use GSoares\Hydroponics\Application\Decoder\Plant\PlantDtoDecoder;
use GSoares\Hydroponics\Application\Decoder\System\SystemDtoDecoder;
use GSoares\Hydroponics\Application\Decoder\Tank\TankDtoDecoder;
use GSoares\Hydroponics\Application\Encoder\Greenhouse\GreenhouseDtoEncoder;
use GSoares\Hydroponics\Application\Encoder\Plant\PlantDtoEncoder;
use GSoares\Hydroponics\Application\Encoder\System\SystemDtoEncoder;
use GSoares\Hydroponics\Application\Encoder\Tank\TankDtoEncoder;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseAttributesFiller;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationCreator;
use GSoares\Hydroponics\Application\Service\Greenhouse\GreenhouseApplicationUpdater;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Plant\PlantAttributesFiller;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationCreator;
use GSoares\Hydroponics\Application\Service\Plant\PlantApplicationUpdater;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationDeleter;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationSearcher;
use GSoares\Hydroponics\Application\Service\System\SystemAttributesFiller;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationCreator;
use GSoares\Hydroponics\Application\Service\System\SystemApplicationUpdater;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationDeleter;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationSearcher;
use GSoares\Hydroponics\Application\Service\Tank\TankAttributesFiller;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationCreator;
use GSoares\Hydroponics\Application\Service\Tank\TankApplicationUpdater;
use GSoares\Hydroponics\Domain\Entity\Crops;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\Factory\Greenhouse\GreenhouseFactory;
use GSoares\Hydroponics\Domain\Factory\Plant\PlantFactory;
use GSoares\Hydroponics\Domain\Factory\System\SystemFactory;
use GSoares\Hydroponics\Domain\Factory\Tank\TankFactory;
use GSoares\Hydroponics\Domain\Repository\Crops\CropsRepository;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepository;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepository;
use GSoares\Hydroponics\Domain\Repository\Tank\TankVersionRepository;
use GSoares\Hydroponics\Domain\Service\Crops\CropsDeleter;
use GSoares\Hydroponics\Domain\Service\Greenhouse\GreenhouseDeleter;
use GSoares\Hydroponics\Domain\Service\Plant\PlantDeleter;
use GSoares\Hydroponics\Domain\Service\System\SystemDeleter;
use GSoares\Hydroponics\Domain\Service\Tank\TankDeleter;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;
use Psr\Container\ContainerInterface;

return [
    #
    # Infra
    #
    DateTimeProvider::class => function (ContainerInterface $container): DateTimeProvider {
        return new DateTimeProvider();
    },
    EntityManager::class => function (ContainerInterface $container): EntityManager {
        $settings = $container->get('settings');

        $config = Setup::createYAMLMetadataConfiguration(
            $settings['doctrine']['metadata_dirs'],
            $settings['doctrine']['dev_mode'],
            null,
            new FilesystemCache($settings['doctrine']['cache_dir'])
        );

        return EntityManager::create($settings['doctrine']['connection'], $config);
    },

    #
    # Infra - Repository
    #
    GreenhouseRepository::class => function (ContainerInterface $container): GreenhouseRepository {
        return new GreenhouseRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Greenhouse::class)
        );
    },
    SystemRepository::class => function (ContainerInterface $container): SystemRepository {
        return new SystemRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(System::class)
        );
    },
    TankRepository::class => function (ContainerInterface $container): TankRepository {
        return new TankRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Tank::class)
        );
    },
    TankVersionRepository::class => function (ContainerInterface $container): TankVersionRepository {
        return new TankVersionRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(TankVersion::class)
        );
    },
    PlantRepository::class => function (ContainerInterface $container): PlantRepository {
        return new PlantRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Plant::class)
        );
    },
    CropsRepository::class => function (ContainerInterface $container): CropsRepository {
        return new CropsRepository(
            $container->get(EntityManager::class),
            new ClassMetadata(Crops::class)
        );
    },

    #
    # Application - Decoders
    #
    GreenhouseDtoDecoder::class => function (ContainerInterface $container): GreenhouseDtoDecoder {
        return new GreenhouseDtoDecoder();
    },
    SystemDtoDecoder::class => function (ContainerInterface $container): SystemDtoDecoder {
        return new SystemDtoDecoder();
    },
    TankDtoDecoder::class => function (ContainerInterface $container): TankDtoDecoder {
        return new TankDtoDecoder();
    },
    PlantDtoDecoder::class => function (ContainerInterface $container): PlantDtoDecoder {
        return new PlantDtoDecoder();
    },

    #
    # Application - Encoders
    #
    GreenhouseDtoEncoder::class => function (ContainerInterface $container): GreenhouseDtoEncoder {
        return new GreenhouseDtoEncoder();
    },
    SystemDtoEncoder::class => function (ContainerInterface $container): SystemDtoEncoder {
        return new SystemDtoEncoder();
    },
    TankDtoEncoder::class => function (ContainerInterface $container): TankDtoEncoder {
        return new TankDtoEncoder();
    },
    PlantDtoEncoder::class => function (ContainerInterface $container): PlantDtoEncoder {
        return new PlantDtoEncoder();
    },

    #
    # Application - Builders
    #
    ErrorCollectionDtoBuilder::class => function (ContainerInterface $container): ErrorCollectionDtoBuilder {
        return new ErrorCollectionDtoBuilder();
    },

    #
    # Domain - Factory
    #
    GreenhouseFactory::class => function (ContainerInterface $container): GreenhouseFactory {
        return new GreenhouseFactory($container->get(DateTimeProvider::class));
    },
    TankFactory::class => function (ContainerInterface $container): TankFactory {
        return new TankFactory($container->get(DateTimeProvider::class));
    },
    SystemFactory::class => function (ContainerInterface $container): SystemFactory {
        return new SystemFactory($container->get(DateTimeProvider::class));
    },
    PlantFactory::class => function (ContainerInterface $container): PlantFactory {
        return new PlantFactory($container->get(DateTimeProvider::class));
    },

    #
    # Domain - Service
    #
    GreenhouseDeleter::class => function (ContainerInterface $container): GreenhouseDeleter {
        return new GreenhouseDeleter($container->get(GreenhouseRepository::class));
    },
    TankDeleter::class => function (ContainerInterface $container): TankDeleter {
        return new TankDeleter($container->get(TankRepository::class));
    },
    SystemDeleter::class => function (ContainerInterface $container): SystemDeleter {
        return new SystemDeleter($container->get(SystemRepository::class));
    },
    CropsDeleter::class => function (ContainerInterface $container): CropsDeleter {
        return new CropsDeleter($container->get(CropsRepository::class));
    },
    PlantDeleter::class => function (ContainerInterface $container): PlantDeleter {
        return new PlantDeleter($container->get(PlantRepository::class));
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
    SystemApplicationCreator::class => function (ContainerInterface $container): SystemApplicationCreator {
        return new SystemApplicationCreator(
            $container->get(SystemDtoDecoder::class),
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemFactory::class),
            $container->get(SystemRepository::class),
            $container->get(SystemAttributesFiller::class)
        );
    },
    TankApplicationCreator::class => function (ContainerInterface $container): TankApplicationCreator {
        return new TankApplicationCreator(
            $container->get(TankDtoDecoder::class),
            $container->get(TankDtoEncoder::class),
            $container->get(TankFactory::class),
            $container->get(TankRepository::class),
            $container->get(TankAttributesFiller::class)
        );
    },
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
    GreenhouseApplicationUpdater::class => function (ContainerInterface $container): GreenhouseApplicationUpdater {
        return new GreenhouseApplicationUpdater(
            $container->get(GreenhouseDtoDecoder::class),
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseFactory::class),
            $container->get(GreenhouseRepository::class),
            $container->get(GreenhouseAttributesFiller::class)
        );
    },
    SystemApplicationUpdater::class => function (ContainerInterface $container): SystemApplicationUpdater {
        return new SystemApplicationUpdater(
            $container->get(SystemDtoDecoder::class),
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemFactory::class),
            $container->get(SystemRepository::class),
            $container->get(SystemAttributesFiller::class)
        );
    },
    TankApplicationUpdater::class => function (ContainerInterface $container): TankApplicationUpdater {
        return new TankApplicationUpdater(
            $container->get(TankDtoDecoder::class),
            $container->get(TankDtoEncoder::class),
            $container->get(TankFactory::class),
            $container->get(TankRepository::class),
            $container->get(TankAttributesFiller::class)
        );
    },
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
    GreenhouseApplicationDeleter::class => function (ContainerInterface $container): GreenhouseApplicationDeleter {
        return new GreenhouseApplicationDeleter(
            $container->get(GreenhouseDtoEncoder::class),
            $container->get(GreenhouseDeleter::class)
        );
    },
    SystemApplicationDeleter::class => function (ContainerInterface $container): SystemApplicationDeleter {
        return new SystemApplicationDeleter(
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemDeleter::class)
        );
    },
    TankApplicationDeleter::class => function (ContainerInterface $container): TankApplicationDeleter {
        return new TankApplicationDeleter(
            $container->get(TankDtoEncoder::class),
            $container->get(TankDeleter::class)
        );
    },
    PlantApplicationDeleter::class => function (ContainerInterface $container): PlantApplicationDeleter {
        return new PlantApplicationDeleter(
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantDeleter::class)
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
    SystemApplicationSearcher::class => function (ContainerInterface $container): SystemApplicationSearcher {
        return new SystemApplicationSearcher(
            $container->get(SystemDtoEncoder::class),
            $container->get(SystemRepository::class)
        );
    },
    TankApplicationSearcher::class => function (ContainerInterface $container): TankApplicationSearcher {
        return new TankApplicationSearcher(
            $container->get(TankDtoEncoder::class),
            $container->get(TankRepository::class)
        );
    },
    PlantApplicationSearcher::class => function (ContainerInterface $container): PlantApplicationSearcher {
        return new PlantApplicationSearcher(
            $container->get(PlantDtoEncoder::class),
            $container->get(PlantRepository::class)
        );
    },

    #
    # Application - Service - AttributesFiller
    #
    GreenhouseAttributesFiller::class => function (ContainerInterface $container): GreenhouseAttributesFiller {
        return new GreenhouseAttributesFiller();
    },
    SystemAttributesFiller::class => function (ContainerInterface $container): SystemAttributesFiller {
        return new SystemAttributesFiller();
    },
    TankAttributesFiller::class => function (ContainerInterface $container): TankAttributesFiller {
        return new TankAttributesFiller();
    },
    PlantAttributesFiller::class => function (ContainerInterface $container): PlantAttributesFiller {
        return new PlantAttributesFiller();
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
