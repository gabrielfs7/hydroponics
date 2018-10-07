<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

interface ResourceSearcherInterface
{
    public function search(array $parameters): ResponseDtoInterface;

    public function searchById(string $id): ResponseDtoInterface;
}
