<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Plant;

class PlantMock
{
    public static function getPostRequestBody(): array
    {
        return [
            'data' => [
                'type' => 'plant',
                'attributes' => [
                    'name' => 'Name test',
                    'species' => 'Species test',
                ]
            ]
        ];
    }

    public static function getPatchRequestBody(array $params): array
    {
        return [
            'data' => [
                'type' => 'plant',
                'attributes' => [
                    'name' => $params['name'],
                    'species' => $params['species'],
                ]
            ]
        ];
    }

    public static function getResponseBody(Plant $plant): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getPaginationResponseBody($plant)
        ];
    }

    public static function getPaginationResponseBody(Plant $plant): array
    {
        return [
            'id' => (string) $plant->getId(),
            'type' => 'plant',
            'attributes' => [
                'name' => $plant->getName(),
                'species' => $plant->getSpecies(),
                'createdAt' => $plant->getCreatedAt()->format(DATE_ATOM),
            ],
            'relationships' => [],
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'meta' => []
        ];
    }
}
