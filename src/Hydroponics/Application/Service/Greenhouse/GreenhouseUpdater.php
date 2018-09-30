<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;

class GreenhouseUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
{

    /**
     * @param string $json
     * @param string $id
     * @return ResourceDtoInterface
     */
    public function update($json, $id)
    {
        return parent::save($json, $this->findDomainObjectById($id));
    }
}
