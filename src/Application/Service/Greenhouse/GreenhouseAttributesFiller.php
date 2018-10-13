<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;

class GreenhouseAttributesFiller implements ResourceAttributesFillerInterface
{
    public function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): object
    {
        $domainObject->changeUpdatedAt(new \DateTime());
        $domainObject->changeName($resourceDto->getAttributeValue('name'));
        $domainObject->changeDescription($resourceDto->getAttributeValue('description'));

        return $domainObject;
    }
}
