<?php

namespace GSoares\Hydroponics\Application\Service\Crop;

use DateTimeImmutable;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\ResourceAttributesFillerInterface;
use GSoares\Hydroponics\Domain\Entity\Crop;
use GSoares\Hydroponics\Domain\Entity\CropVersion;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepositoryTrait;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepositoryTrait;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class CropAttributesFiller implements ResourceAttributesFillerInterface
{
    use PlantRepositoryTrait;
    use SystemRepositoryTrait;

    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): object
    {
        # @TODO Improve relationship handling here
        $systemId = $resourceDto->getRelationships()['system']['data']['id'] ?? 0;

        $currentDate = new DateTimeImmutable();

        /** @var Crop $domainObject */
        $domainObject->changeUpdatedAt($currentDate);

        if ($name = $resourceDto->getAttributeValue('name')) {
            $domainObject->changeName($name);
        }

        if ($quantity = $resourceDto->getAttributeValue('quantity')) {
            $domainObject->changeQuantity($quantity);
        }

        /** @var System $system */
        $system = $this->getSystemRepository()
            ->find($systemId);

        $cropVersion = new CropVersion(
            $domainObject,
            $system,
            $resourceDto->getAttributeValue('quantityHarvested') ?? 0,
            $resourceDto->getAttributeValue('quantityLost') ?? 0
        );
        $cropVersion->changeCreatedAt($currentDate);

        $domainObject->addVersion($cropVersion);

        return $domainObject;
    }
}
