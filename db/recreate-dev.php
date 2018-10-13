<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;

require __DIR__ . '/../bootstrap.php';

$entityManager = $app->getContainer()
    ->get(EntityManager::class);

$settings = $app->getContainer()
    ->get('settings')['doctrine']['connection'];

$pdo = new PDO(
    "mysql:host=" . $settings['host'],
    $settings['user'],
    $settings['password'],
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]
);

$sql = 'DROP DATABASE IF EXISTS hydroponics;
CREATE DATABASE IF NOT EXISTS hydroponics;';

#
# Drop database and create new one.
#
echo PHP_EOL . ' - Removing old database...';
$pdo->exec($sql);

$schemaTool = new SchemaTool($entityManager);
$schemaTool->createSchema($entityManager->getMetadataFactory()->getAllMetadata());

$sql = 'USE hydroponics;
INSERT INTO Greenhouse(id, name, created_at) VALUES(1, \'My Cool Greenhouse\', NOW());
INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(1, 1, \'System NFT 1\', NOW());
INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(2, 1, \'System NFT 2\', NOW());
INSERT INTO System(id, greenhouse_id, name, created_at) VALUES(3, 1, \'System NFT 2\', NOW());';

#
# Create registries.
#
echo PHP_EOL . ' - Creating default registries...' . PHP_EOL;
$pdo->exec($sql);