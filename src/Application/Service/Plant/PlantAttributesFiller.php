<?php

namespace GSoares\Hydroponics\Application\Service\Plant;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;
use GSoares\Hydroponics\Domain\Entity\Plant;

class PlantAttributesFiller implements ResourceAttributesFillerInterface
{
    public function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): object
    {
        /** @var Plant $domainObject */
        $domainObject->changeUpdatedAt(new \DateTime());
        $domainObject->changeName($resourceDto->getAttributes()->name);
        $domainObject->changeSpecies($resourceDto->getAttributes()->species);

        return $domainObject;
    }
}
