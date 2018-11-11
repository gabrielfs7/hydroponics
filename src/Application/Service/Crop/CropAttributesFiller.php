<?php

namespace GSoares\Hydroponics\Application\Service\Crop;

use DateTimeImmutable;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\Plant;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepositoryTrait;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepositoryTrait;

class CropAttributesFiller implements ResourceAttributesFillerInterface
{
    use PlantRepositoryTrait;
    use SystemRepositoryTrait;

    public function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): object
    {
        /** @var Crop $domainObject */
        $domainObject->changeUpdatedAt(new \DateTime());

        if ($name = $resourceDto->getAttributeValue('name')) {
            $domainObject->changeName($name);
        }

        if ($quantity = $resourceDto->getAttributeValue('quantity')) {
            $domainObject->changeQuantity($quantity);
        }

        if ($quantityLost = $resourceDto->getAttributeValue('quantityLost')) {
            $domainObject->changeQuantityLost($quantityLost);
        }

        if ($quantityHarvested = $resourceDto->getAttributeValue('quantityHarvested')) {
            $domainObject->changeQuantityHarvested($quantityHarvested);
        }

        if ($harvestedAt = $resourceDto->getAttributeValue('harvestedAt')) {
            $domainObject->changeHarvestedAt(new DateTimeImmutable($harvestedAt));
        }

        # @TODO Improve relationship handling here
        $plantId = $resourceDto->getRelationships()['plant']['data']['id'] ?? 0;
        $systemId = $resourceDto->getRelationships()['system']['data']['id'] ?? 0;

        /** @var Plant $plant */
        $plant = $this->getPlantRepository()
            ->find($plantId);

        /** @var System $system */
        $system = $this->getSystemRepository()
            ->find($systemId);

        if ($system) {
            $domainObject->changeSystem($system);
        }

        if ($plant) {
            $domainObject->changePlant($plant);
        }

        return $domainObject;
    }
}
