<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\System;

class SystemMock
{
    public static function getPostRequestBody(int $tankId): array
    {
        return [
            'data' => [
                'type' => 'system',
                'attributes' => [
                    'name' => 'Name test',
                    'description' => 'Description test',
                ],
                'relationships' => [
                    'tanks' => [
                        [
                            'data' => [
                                'type' => 'tank',
                                'id' => $tankId,
                            ]
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
                'type' => 'system',
                'attributes' => [
                    'name' => $params['name'],
                    'description' => $params['description'],
                ],
                'relationships' => [
                    'greenhouse' => [
                        'data' => [
                            'type' => 'greenhouse',
                            'id' => $params['greenhouseId'],
                        ]
                    ],
                    'tanks' => [
                        [
                            'data' => [
                                'type' => 'tank',
                                'id' => $params['tankId'],
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public static function getResponseBody(System $system): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getPaginationResponseBody($system)
        ];
    }

    public static function getPaginationResponseBody(System $system): array
    {
        return [
            'id' => (string) $system->getId(),
            'type' => 'system',
            'attributes' => [
                'name' => $system->getName(),
                'description' => $system->getDescription(),
                'createdAt' => $system->getCreatedAt()->format(DATE_ATOM),
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
