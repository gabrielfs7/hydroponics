<?php

namespace GSoares\Hydroponics\Application\Service\System;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class SystemCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    public function create(string $json): ResponseDtoInterface
    {
        return parent::save($json);
    }
}
