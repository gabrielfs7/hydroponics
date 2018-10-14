<?php

namespace GSoares\Hydroponics\Test\Mock;

class ResponseMock
{
    public static function getErrorResponseBody(int $statusCode, string $details): array
    {
        return [
            'errors' => [
                [
                    'status' => $statusCode,
                    'code' => 0,
                    'source' => [
                        'pointer' => null
                    ],
                    'title' => 'Application error',
                    'details' => $details
                ]
            ]
        ];
    }

    public static function getPaginationResponse(array $data): array
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
                'first' => '',
                'prev' => '',
                'next' => '',
                'last' => '',
            ],
            'data' => $data['data'],
            'meta' => [
                'totalEntries' => $data['meta.totalEntries']
            ]
        ];
    }
}
