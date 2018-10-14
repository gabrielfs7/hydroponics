<?php

namespace GSoares\Hydroponics\Test\Mock;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class GreenhouseMock
{
    public static function getPostRequestBody(): array
    {
        return [
            'data' => [
                'type' => 'greenhouse',
                'attributes' => [
                    'name' => 'Name test',
                    'description' => 'Description test',
                ]
            ]
        ];
    }

    public static function getPatchRequestBody(array $params): array
    {
        return [
            'data' => [
                'type' => 'greenhouse',
                'attributes' => [
                    'name' => $params['name'],
                    'description' => $params['description'],
                ]
            ]
        ];
    }

    public static function getGreenhouseResponseBody(Greenhouse $greenhouse): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => self::getGreenhousePaginationResponseBody($greenhouse)
        ];
    }

    public static function getGreenhousePaginationResponseBody(Greenhouse $greenhouse): array
    {
        return [
            'id' => (string) $greenhouse->getId(),
            'type' => 'greenhouse',
            'attributes' => [
                'name' => $greenhouse->getName(),
                'description' => $greenhouse->getDescription(),
                'createdAt' => $greenhouse->getCreatedAt()->format(DATE_ATOM),
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
