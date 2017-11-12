<?php

namespace GSoares\Hydroponics\Application\Service\Tank;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;

class TankAttributesFiller implements ResourceAttributesFillerInterface
{

    /**
     * @param object $domainObject
     * @param ResourceDtoInterface $resourceDto
     * @return object
     */
    public function fillAttributes($domainObject, ResourceDtoInterface $resourceDto)
    {
        $domainObject->changeUpdatedAt(new \DateTime());
        $domainObject->changeName($resourceDto->getAttributeValue('name'));
        $domainObject->changeDescription($resourceDto->getAttributeValue('description'));

        return $domainObject;
    }
}