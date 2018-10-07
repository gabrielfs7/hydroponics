<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\TankTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\CreatedAtTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\DeletedAtTrait;
use GSoares\Hydroponics\Domain\ValueObject\WaterDbo;
use GSoares\Hydroponics\Domain\ValueObject\WaterEc;
use GSoares\Hydroponics\Domain\ValueObject\WaterPh;
use GSoares\Hydroponics\Domain\ValueObject\WaterTemperature;
use GSoares\Hydroponics\Domain\ValueObject\WaterVolume;

class TankVersion
{
    use IdTrait;
    use CreatedAtTrait;
    use DeletedAtTrait;
    use TankTrait;

    /** @var WaterVolume */
    private $waterVolume;

    /** @var WaterPh */
    private $waterPh;

    /** @var WaterEc */
    private $waterEc;

    /** @var WaterDbo */
    private $waterDbo;

    /** @var WaterTemperature */
    private $waterTemperature;

    public function __construct(
        Tank $tank,
        WaterVolume $waterVolume,
        WaterPh $waterPh,
        WaterEc $waterEc,
        WaterDbo $waterDbo,
        WaterTemperature $waterTemperature
    )
    {
        $this->tank = $tank;
        $this->waterVolume = $waterVolume;
        $this->waterPh = $waterPh;
        $this->waterEc = $waterEc;
        $this->waterDbo = $waterDbo;
        $this->waterTemperature = $waterTemperature;
    }

    public function getWaterVolume(): WaterVolume
    {
        return $this->waterVolume;
    }

    public function getWaterPh(): WaterPh
    {
        return $this->waterPh;
    }

    public function getWaterEc(): WaterEc
    {
        return $this->waterEc;
    }

    public function getWaterDbo(): WaterDbo
    {
        return $this->waterDbo;
    }

    public function getWaterTemperature(): WaterTemperature
    {
        return $this->waterTemperature;
    }
}
