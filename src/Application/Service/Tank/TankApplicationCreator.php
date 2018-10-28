<?php

namespace GSoares\Hydroponics\Application\Service\Tank;

use ArrayAccess;
use ArrayObject;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class TankApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    public function create(string $json): ResponseDtoInterface
    {
        return parent::save($json);
    }

    protected function buildFactoryParameters(ResourceDtoInterface $resourceDto): ArrayAccess
    {
        $parameters = new ArrayObject();
        $parameters->offsetSet('name', $resourceDto->getAttributeValue('name'));
        $parameters->offsetSet('volumeCapacity', $resourceDto->getAttributeValue('volumeCapacity'));

        return $parameters;
    }
}
