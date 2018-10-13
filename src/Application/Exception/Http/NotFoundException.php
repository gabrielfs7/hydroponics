<?php

namespace GSoares\Hydroponics\Application\Exception\Http;

class NotFoundException extends HttpException
{
    public function getStatusCode(): int
    {
        return 404;
    }
}