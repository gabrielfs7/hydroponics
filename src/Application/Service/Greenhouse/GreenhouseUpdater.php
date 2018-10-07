<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;

class GreenhouseUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
{
    public function update(string $json, string $id): ResponseDtoInterface
    {
        return parent::save($json, $this->findDomainObjectById($id));
    }
}
