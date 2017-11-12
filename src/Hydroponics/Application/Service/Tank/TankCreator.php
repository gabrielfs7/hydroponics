<?php

namespace GSoares\Hydroponics\Application\Service\Tank;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class TankCreator extends AbstractResourceSaver implements ResourceCreatorInterface
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
        $parameters->offsetSet('name', $resourceDto->getAttributeValue('name'));
        $parameters->offsetSet('volumeCapacity', $resourceDto->getAttributeValue('volumeCapacity'));

        return $parameters;
    }
}