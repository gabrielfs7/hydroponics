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
        $domainObject->changeName($resourceDto->getAttributes()->name);
        $domainObject->changeDescription($resourceDto->getAttributes()->description);

        return $domainObject;
    }
}