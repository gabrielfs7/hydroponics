<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Crop;

class CropMock
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

    public static function getResponseBody(Crop $crop): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getPaginationResponseBody($crop)
        ];
    }

    public static function getPaginationResponseBody(Crop $crop): array
    {
        return [
            'id' => (string) $crop->getId(),
            'type' => 'crops',
            'attributes' => [
                'name' => $crop->getName(),
                'quantity' => $crop->getQuantity(),
                'quantityHarvested' => $crop->getQuantityHarvested(),
                'quantityLost' => $crop->getQuantityLost(),
                'createdAt' => $crop->getCreatedAt()->format(DATE_ATOM),
                'harvestedAt' => $crop->getHarvestedAt() ? $crop->getHarvestedAt()->format(DATE_ATOM) : null,
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
