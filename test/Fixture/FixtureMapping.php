<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use Doctrine\Common\Persistence\ObjectManager;
use GSoares\Hydroponics\Domain\Entity\Crops;
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
    /** @var ObjectManager */
    private $objectManager;

    /** @var array */
    private $mapping;

    public function getMapping(ObjectManager $objectManager): iterable
    {
        $this->objectManager = $objectManager;
        $this->mapping = $this->getMappedInstances();

        $recursiveMapping = [];

        foreach ($this->mapping as $class => $map) {
            $recursiveMapping[$class] = function (array $params) use ($map) {
                return $map($params);
            };
        }

        return $recursiveMapping;
    }

    private function getMappedInstances(): array
    {
        return [
            Greenhouse::class => function (array $params) {
                $entity = new Greenhouse($params['name'] ?? self::randomName());
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? self::randomName());

                return $entity;
            },
            System::class => function (array $params) {
                /** @var Greenhouse $greenhouse */
                $greenhouse = $this->getManageableEntity('greenhouse', Greenhouse::class, $params);

                /** @var Tank $tank */
                $tank = $this->getManageableEntity('tank', Tank::class, $params);

                $entity = new System(
                    $params['name'] ?? self::randomName(),
                    $greenhouse,
                    $tank
                );

                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? self::randomName());

                return $entity;
            },
            Tank::class => function (array $params) {
                /** @var NutritionalFormula $nutritionalFormula */
                $nutritionalFormula = $this->getManageableEntity(
                    'nutritionalFormula',
                    NutritionalFormula::class,
                    $params
                );

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
            Crops::class => function (array $params) {
                /** @var System $system */
                $system = $this->getManageableEntity('system', System::class, $params);

                /** @var Plant $plant */
                $plant = $this->getManageableEntity('plant', Plant::class, $params);

                $entity = new Crops(
                    $params['name'] ?? self::randomName(),
                    $params['quantity'] ?? self::randomInt(),
                    $system,
                    $plant
                );
                $entity->changeCreatedAt(new DateTimeImmutable());

                return $entity;
            },
            NutritionalFormula::class => function (array $params) {
                $entity = new NutritionalFormula($params['name'] ?? self::randomName());
                $entity->changeDescription($params['description'] ?? self::randomName());

                return $entity;
            },
            Plant::class => function (array $params) {
                $entity = new Plant(
                    $params['name'] ?? self::randomName(),
                    $params['species'] ?? self::randomName()
                );
                $entity->changeCreatedAt(new DateTimeImmutable());

                return $entity;
            }
        ];
    }

    private function getManageableEntity(string $paramName, string $entityClassName, array $params): object
    {
        $entity = $params[$paramName] ?? $this->mapping[$entityClassName]($params, $this->mapping);

        if (!$entity->getId()) {
            $this->objectManager->persist($entity);

            return $entity;
        }

        return $this->objectManager->merge($entity);
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
