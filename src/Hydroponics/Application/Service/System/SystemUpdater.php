<?php

namespace GSoares\Hydroponics\Application\Service\System;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;

class SystemUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
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