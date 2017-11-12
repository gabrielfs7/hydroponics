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

    /**
     * @param ResourceDtoInterface $resourceDto
     * @return \ArrayObject
     */
    protected function fillFactoryParameters(ResourceDtoInterface $resourceDto)
    {
        $parameters = new \ArrayObject();
        $parameters->offsetSet('name', $resourceDto->getAttributes()->name);

        return $parameters;
    }
}