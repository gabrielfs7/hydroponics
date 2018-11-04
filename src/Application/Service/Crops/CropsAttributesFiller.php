<?php

namespace GSoares\Hydroponics\Application\Service\Crops;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;
use GSoares\Hydroponics\Domain\Entity\Crops;

class CropsAttributesFiller implements ResourceAttributesFillerInterface
{
    public function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): object
    {
        /** @var Crops $domainObject */
        $domainObject->changeUpdatedAt(new \DateTime());
        $domainObject->changeName($resourceDto->getAttributes()->name);
        $domainObject->changeQuantityLost($resourceDto->getAttributes()->quantityLost ?? 0);
        $domainObject->changeQuantityHarvested($resourceDto->getAttributes()->quantityHarvested ?? 0);

        return $domainObject;
    }
}