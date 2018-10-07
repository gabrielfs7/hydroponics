<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

interface ResourceUpdaterInterface
{
    public function update(string $json, string $id): ResponseDtoInterface;
}
