<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

interface ResourceDeleterInterface
{
    public function delete(string $id): ResponseDtoInterface;
}
