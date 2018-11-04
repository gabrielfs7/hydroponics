<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use Doctrine\Common\Persistence\ObjectManager;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\Plant;
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
                $entity = new Greenhouse($params['name'] ?? self::randomName());
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? self::randomName());

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
                    $params['name'] ?? self::randomName(),
                    $greenhouse,
                    $tank
                );

                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? self::randomName());

                return $entity;
            },
            Tank::class => function (array $params, array $mapping) use ($objectManager) {
                $nutritionalFormula = $params['nutritionalFormula'] ??
                    $mapping[NutritionalFormula::class]($params, $mapping);

                if (!$nutritionalFormula->getId()) {
                    $objectManager->persist($nutritionalFormula);
                }

                $entity = new Tank(
                    $params['name'] ?? self::randomName(),
                    $params['volumeCapacity'] ?? self::randomInt(),
                    $nutritionalFormula
                );
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? self::randomName());

                $tankVersion = new TankVersion(
                    $entity,
                    new WaterVolume(
                        $params['currentVolume'] ?? self::randomInt(),
                        $params['minVolume'] ?? self::randomInt()
                    ),
                    new WaterPh(
                        $params['waterPh'] ?? self::randomInt(),
                        $params['maxWaterPh'] ?? self::randomInt(),
                        $params['minWaterPh'] ?? self::randomInt()
                    ),
                    new WaterEc(
                        $params['waterEc'] ?? self::randomInt(),
                        $params['maxWaterEc'] ?? self::randomInt(),
                        $params['minWaterEc'] ?? self::randomInt()
                    ),
                    new WaterDbo(
                        $params['waterDbo'] ?? self::randomInt(),
                        $params['maxWaterDbo'] ?? self::randomInt(),
                        $params['minWaterDbo'] ?? self::randomInt()
                    ),
                    new WaterTemperature(
                        $params['waterTemperature'] ?? self::randomInt(),
                        $params['maxWaterTemperature'] ?? self::randomInt(),
                        $params['minWaterTemperature'] ?? self::randomInt()
                    )
                );

                $tankVersion->changeCreatedAt(new DateTimeImmutable());

                $entity->addVersion($tankVersion);

                return $entity;
            },
            NutritionalFormula::class => function (array $params, array $mapping) {
                $entity = new NutritionalFormula($params['name'] ?? self::randomName());
                $entity->changeDescription($params['description'] ?? self::randomName());

                return $entity;
            },
            Plant::class => function (array $params, array $mapping) {
                $entity = new Plant(
                    $params['name'] ?? self::randomName(),
                    $params['species'] ?? self::randomName()
                );
                $entity->changeCreatedAt(new DateTimeImmutable());

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

    private static function randomInt(int $min = 1, int $max = 999): int
    {
        return rand($min, $max);
    }

    private static function randomName(int $maxLength = 25): string
    {
        return substr(str_repeat(implode('', range('A', 'Z', rand(1, 23))), $maxLength), 0, $maxLength);
    }
}
