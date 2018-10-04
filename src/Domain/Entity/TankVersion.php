<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\TankTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\ModifiedAtTrait;
use GSoares\Hydroponics\Domain\ValueObject\WaterDbo;
use GSoares\Hydroponics\Domain\ValueObject\WaterEc;
use GSoares\Hydroponics\Domain\ValueObject\WaterPh;
use GSoares\Hydroponics\Domain\ValueObject\WaterTemperature;
use GSoares\Hydroponics\Domain\ValueObject\WaterVolume;

class TankVersion
{
    use IdTrait;
    use ModifiedAtTrait;
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
    
    public function __construct(Tank $tank)
    {
        $this->tank = $tank;
    }

    public function getWaterVolume(): WaterVolume
    {
        return $this->waterVolume;
    }

    public function changeWaterVolume(WaterVolume $waterVolume): void
    {
        $this->waterVolume = $waterVolume;
    }

    public function getWaterPh(): WaterPh
    {
        return $this->waterPh;
    }

    public function changeWaterPh(WaterPh $waterPh): void
    {
        $this->waterPh = $waterPh;
    }

    public function getWaterEc()
    {
        return $this->waterEc;
    }

    public function changeWaterEc(WaterEc $waterEc): void
    {
        $this->waterEc = $waterEc;
    }

    public function getWaterDbo(): WaterDbo
    {
        return $this->waterDbo;
    }

    public function changeWaterDbo(WaterDbo $waterDbo): void
    {
        $this->waterDbo = $waterDbo;
    }

    public function getWaterTemperature(): WaterTemperature
    {
        return $this->waterTemperature;
    }

    public function changeWaterTemperature(WaterTemperature $waterTemperature): void
    {
        $this->waterTemperature = $waterTemperature;
    }
}
