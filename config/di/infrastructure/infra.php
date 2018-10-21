<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\SimplifiedYamlDriver;
use Doctrine\ORM\Tools\Setup;
use Doctrine\Common\Cache\FilesystemCache;
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

        $config = Setup::createConfiguration($settings['dev_mode'],null, new FilesystemCache($settings['cache_dir']));
        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($settings['connection'], $config);
    },
];
