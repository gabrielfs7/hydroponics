<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class GreenhouseCreator extends AbstractResourceSaver implements ResourceCreatorInterface
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
