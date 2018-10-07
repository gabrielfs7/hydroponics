<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

interface ResourceCreatorInterface
{
    public function create(string $json): ResponseDtoInterface;
}
