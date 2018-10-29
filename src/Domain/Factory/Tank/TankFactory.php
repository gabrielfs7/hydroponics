<?php

namespace GSoares\Hydroponics\Domain\Factory\Tank;

use ArrayAccess;
use GSoares\Hydroponics\Domain\Entity\Tank;
use GSoares\Hydroponics\Domain\Entity\TankVersion;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Domain\ValueObject\WaterDbo;
use GSoares\Hydroponics\Domain\ValueObject\WaterEc;
use GSoares\Hydroponics\Domain\ValueObject\WaterPh;
use GSoares\Hydroponics\Domain\ValueObject\WaterTemperature;
use GSoares\Hydroponics\Domain\ValueObject\WaterVolume;
use GSoares\Hydroponics\Infrastructure\DateTime\DateTimeProvider;

class TankFactory implements FactoryInterface
{
    /** @var DateTimeProvider */
    private $dateTimeProvider;

    public function __construct(DateTimeProvider $dateTimeProvider)
    {
        $this->dateTimeProvider = $dateTimeProvider;
    }

    public function make(ArrayAccess $parameters): Tank
    {
        $tank = new Tank(
            $parameters->offsetGet('name'),
            $parameters->offsetGet('volumeCapacity'),
            null // @TODO Handle tank with nutritional formula
        );
        $tank->changeCreatedAt($this->dateTimeProvider->current());

        $tankVersion = new TankVersion(
            $tank,
            new WaterVolume(
                $parameters->offsetGet('currentVolume'),
                $parameters->offsetGet('minVolume')
            ),
            new WaterPh(
                $parameters->offsetGet('waterPh'),
                $parameters->offsetGet('maxWaterPh'),
                $parameters->offsetGet('minWaterPh')
            ),
            new WaterEc(
                $parameters->offsetGet('waterEc'),
                $parameters->offsetGet('maxWaterEc'),
                $parameters->offsetGet('minWaterEc')
            ),
            new WaterDbo(
                $parameters->offsetGet('waterDbo'),
                $parameters->offsetGet('maxWaterDbo'),
                $parameters->offsetGet('minWaterDbo')
            ),
            new WaterTemperature(
                $parameters->offsetGet('waterTemperature'),
                $parameters->offsetGet('maxWaterTemperature'),
                $parameters->offsetGet('minWaterTemperature')
            )
        );

        $tankVersion->changeCreatedAt($this->dateTimeProvider->current());

        $tank->addVersion($tankVersion);

        return $tank;
    }
}
