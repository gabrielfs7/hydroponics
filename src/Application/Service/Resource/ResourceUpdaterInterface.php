<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use Psr\Http\Message\RequestInterface;

interface ResourceUpdaterInterface
{
    public function update(RequestInterface $request, string $id): ResponseDtoInterface;
}
