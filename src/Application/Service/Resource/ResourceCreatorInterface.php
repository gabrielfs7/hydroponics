<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use Psr\Http\Message\RequestInterface;

interface ResourceCreatorInterface
{
    public function create(RequestInterface $request): ResponseDtoInterface;
}
