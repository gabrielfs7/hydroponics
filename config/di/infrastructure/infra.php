<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
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
        $settings = $container->get('settings')['doctrine'];

        $driver = new SimplifiedYamlDriver($settings['prefixes']);

        $config = Setup::createConfiguration($settings['dev_mode']);
        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($settings['connection'], $config);
    },
];
