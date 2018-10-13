<?php

namespace GSoares\Hydroponics\Application\Service\System;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;

class SystemApplicationUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
{
    public function update(string $json, string $id): ResponseDtoInterface
    {
        return parent::save($json, $this->findDomainObjectById($id));
    }
}
