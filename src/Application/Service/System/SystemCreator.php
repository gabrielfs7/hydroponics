<?php

namespace GSoares\Hydroponics\Application\Service\System;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class SystemCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{

    /**
     * @param string $json
     * @return ResourceDtoInterface
     */
    public function create($json)
    {
        return parent::save($json);
    }
}
