<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\ValueObject\NutritionalFormula;

class FixtureMapping
{
    public function getMapping(): array
    {
        $mapping = [
            Greenhouse::class => function (array $params, array $mapping) {
                $entity = new Greenhouse($params['name'] ?? ('Test ' . rand(0, 9999)));
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            },
            System::class => function (array $params, array $mapping) {
                $entity = new System(
                    $params['name'] ?? ('Test ' . rand(0, 9999)),
                    $params['greenhouse'] ?? $mapping['greenhouse'],
                    $params['tank'] ?? $mapping['tank']
                );
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            },
            Tank::class => function (array $params, array $mapping) {
                $entity = new Tank(
                    $params['name'] ?? ('Test ' . rand(0, 9999)),
                    $params['volumeCapacity'] ?? 0,
                    $params['nutritionalFormula'] ?? $mapping['nutritionalFormula']
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
