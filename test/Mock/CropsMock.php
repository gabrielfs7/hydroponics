<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Crops;

class CropsMock
{
    public static function getPostRequestBody(int $plantId): array
    {
        return [
            'data' => [
                'type' => 'crops',
                'attributes' => [
                    'name' => 'Name test',
                    'quantity' => 1000
                ],
                'relationships' => [
                    'plant' => [
                        'data' => [
                            'type' => 'plant',
                            'id' => $plantId,
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function getPatchRequestBody(array $params): array
    {
        return [
            'data' => [
                'type' => 'crops',
                'attributes' => [
                    'name' => $params['name'],
                    'quantity' => $params['quantity'],
                    'quantityHarvested' => $params['quantityHarvested'],
                    'quantityLost' => $params['quantityLost'],
                    'harvestedAt' => $params['harvestedAt'],
                ],
                'relationships' => [
                    'system' => [
                        'data' => [
                            'type' => 'system',
                            'id' => $params['systemId'],
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function getResponseBody(Crops $crops): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getPaginationResponseBody($crops)
        ];
    }

    public static function getPaginationResponseBody(Crops $crops): array
    {
        return [
            'id' => (string) $crops->getId(),
            'type' => 'crops',
            'attributes' => [
                'name' => $crops->getName(),
                'quantity' => $crops->getQuantity(),
                'quantityHarvested' => $crops->getQuantityHarvested(),
                'quantityLost' => $crops->getQuantityLost(),
                'createdAt' => $crops->getCreatedAt()->format(DATE_ATOM),
                'harvestedAt' => $crops->getHarvestedAt() ? $crops->getHarvestedAt()->format(DATE_ATOM) : null,
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
