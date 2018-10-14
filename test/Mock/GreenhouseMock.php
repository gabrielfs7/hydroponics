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

    public static function getGreenhouseResponseBody(Greenhouse $greenhouse): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => [
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
            ]
        ];
    }
}
