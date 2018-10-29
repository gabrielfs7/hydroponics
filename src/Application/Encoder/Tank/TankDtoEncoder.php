<?php

namespace GSoares\Hydroponics\Application\Encoder\Tank;

use GSoares\Hydroponics\Application\Dto\Tank\TankAttributesDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDto;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Entity\Tank;

class TankDtoEncoder implements EncoderInterface
{
    public function encode(object $object): ResourceDtoInterface
    {
        /** @var Tank $object */

        $latestVersion = $object->getLastVersion();

        $attributes = new TankAttributesDto();
        $attributes->name = $object->getName();
        $attributes->description = $object->getDescription();
        $attributes->volumeCapacity = $object->getVolumeCapacity();
        $attributes->currentVolume = $latestVersion->getWaterVolume()->getCurrentVolume();
        $attributes->minVolume = $latestVersion->getWaterVolume()->getMinVolume();
        $attributes->waterTemperature = $latestVersion->getWaterTemperature()->getTemperature();
        $attributes->maxWaterTemperature = $latestVersion->getWaterTemperature()->getMaxTemperature();
        $attributes->minWaterTemperature = $latestVersion->getWaterTemperature()->getMinTemperature();
        $attributes->waterPh = $latestVersion->getWaterPh()->getPh();
        $attributes->maxWaterPh = $latestVersion->getWaterPh()->getMaxPh();
        $attributes->minWaterPh = $latestVersion->getWaterPh()->getMinPh();
        $attributes->waterEc = $latestVersion->getWaterEc()->getEc();
        $attributes->maxWaterEc = $latestVersion->getWaterEc()->getMaxEc();
        $attributes->minWaterEc = $latestVersion->getWaterEc()->getMinEc();
        $attributes->waterDbo = $latestVersion->getWaterDbo()->getDbo();
        $attributes->maxWaterDbo = $latestVersion->getWaterDbo()->getMaxDbo();
        $attributes->minWaterDbo = $latestVersion->getWaterDbo()->getMinDbo();
        $attributes->createdAt = $object->getCreatedAt()->format(DATE_ATOM);

        $dto = new ResourceDto(
            $object->getId(),
            'tanks',
            $attributes,
            new ResourceLinksDto('', ''),
            [],
            []
        );

        return $dto;
    }
}
