<?php

namespace GSoares\Hydroponics\Test\Mock;

class ErrorResponseMock
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
}
