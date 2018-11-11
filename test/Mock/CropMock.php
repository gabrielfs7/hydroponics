<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Crop;

class CropMock
{
    public static function getPostRequestBody(int $plantId, int $systemId): array
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
                    ],
                    'system' => [
                        'data' => [
                            'type' => 'system',
                            'id' => $systemId,
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
        $harvestedAt = $crop->getHarvestedAt();

        return [
            'id' => (string) $crop->getId(),
            'type' => 'crops',
            'attributes' => [
                'name' => $crop->getName(),
                'quantity' => $crop->getQuantity(),
                'quantityHarvested' => $crop->getQuantityHarvested(),
                'quantityLost' => $crop->getQuantityLost(),
                'createdAt' => $crop->getCreatedAt()->format(DATE_ATOM),
                'harvestedAt' => $harvestedAt ? $harvestedAt->format(DATE_ATOM) : null,
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
