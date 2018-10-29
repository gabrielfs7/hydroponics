<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use Doctrine\Common\Persistence\ObjectManager;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\ValueObject\WaterDbo;
use GSoares\Hydroponics\Domain\ValueObject\WaterEc;
use GSoares\Hydroponics\Domain\ValueObject\WaterPh;
use GSoares\Hydroponics\Domain\ValueObject\WaterTemperature;
use GSoares\Hydroponics\Domain\ValueObject\WaterVolume;

class FixtureMapping
{
    public function getMapping(ObjectManager $objectManager): array
    {
        $mapping = [
            Greenhouse::class => function (array $params, array $mapping) {
                $entity = new Greenhouse($params['name'] ?? ('Test ' . rand(0, 9999)));
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            },
            System::class => function (array $params, array $mapping) use ($objectManager) {
                $greenhouse = $params['greenhouse'] ?? $mapping[Greenhouse::class]($params, $mapping);
                $tank = $params['tank'] ?? $mapping[Tank::class]($params, $mapping);

                if (!$greenhouse->getId()) {
                    $objectManager->persist($greenhouse);
                }

                if (!$tank->getId()) {
                    $objectManager->persist($tank);
                }

                $entity = new System(
                    $params['name'] ?? ('Test ' . rand(0, 9999)),
                    $greenhouse,
                    $tank
                );

                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            },
            Tank::class => function (array $params, array $mapping) use ($objectManager) {
                $nutritionalFormula = $params['nutritionalFormula'] ??
                    $mapping[NutritionalFormula::class]($params, $mapping);

                if (!$nutritionalFormula->getId()) {
                    $objectManager->persist($nutritionalFormula);
                }

                $entity = new Tank(
                    $params['name'] ?? ('Test ' . rand(0, 9999)),
                    $params['volumeCapacity'] ?? 0,
                    $nutritionalFormula
                );
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                $tankVersion = new TankVersion(
                    $entity,
                    new WaterVolume(
                        $params['currentVolume'] ?? 1,
                        $params['minVolume'] ?? 1
                    ),
                    new WaterPh(
                        $params['waterPh'] ?? 1,
                        $params['maxWaterPh'] ?? 1,
                        $params['minWaterPh'] ?? 1
                    ),
                    new WaterEc(
                        $params['waterEc'] ?? 1,
                        $params['maxWaterEc'] ?? 1,
                        $params['minWaterEc'] ?? 1
                    ),
                    new WaterDbo(
                        $params['waterDbo'] ?? 1,
                        $params['maxWaterDbo'] ?? 1,
                        $params['minWaterDbo'] ?? 1
                    ),
                    new WaterTemperature(
                        $params['waterTemperature'] ?? 1,
                        $params['maxWaterTemperature'] ?? 1,
                        $params['minWaterTemperature'] ?? 1
                    )
                );

                $tankVersion->changeCreatedAt(new DateTimeImmutable());

                $entity->addVersion($tankVersion);

                return $entity;
            },
            NutritionalFormula::class => function (array $params, array $mapping) {
                $entity = new NutritionalFormula($params['name'] ?? ('Test ' . rand(0, 9999)));
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            }
        ];

        $recursiveMapping = [];

        foreach ($mapping as $class => $map) {
            $recursiveMapping[$class] = function (array $params) use ($map, $mapping) {
                return $map($params, $mapping);
            };
        }

        return $recursiveMapping;
    }
}
