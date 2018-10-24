<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use Doctrine\Common\Persistence\ObjectManager;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\NutritionalFormula;

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
                $nutritionalFormula = $params['nutritionalFormula'] ?? $mapping[NutritionalFormula::class]($params, $mapping);

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
