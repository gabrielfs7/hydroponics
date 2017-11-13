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

    /**
     * @var WaterVolume
     */
    private $waterVolume;

    /**
     * @var WaterPh
     */
    private $waterPh;

    /**
     * @var WaterEc
     */
    private $waterEc;

    /**
     * @var WaterDbo
     */
    private $waterDbo;

    /**
     * @var WaterTemperature
     */
    private $waterTemperature;
    
    public function __construct(Tank $tank)
    {
        $this->tank = $tank;
    }

    /**
     * @return WaterVolume
     */
    public function getWaterVolume()
    {
        return $this->waterVolume;
    }

    /**
     * @param WaterVolume $waterVolume
     */
    public function changeWaterVolume(WaterVolume $waterVolume)
    {
        $this->waterVolume = $waterVolume;
    }

    /**
     * @return WaterPh
     */
    public function getWaterPh()
    {
        return $this->waterPh;
    }

    /**
     * @param WaterPh $waterPh
     */
    public function changeWaterPh(WaterPh $waterPh)
    {
        $this->waterPh = $waterPh;
    }

    /**
     * @return WaterEc
     */
    public function getWaterEc()
    {
        return $this->waterEc;
    }

    /**
     * @param WaterEc $waterEc
     */
    public function changeWaterEc(WaterEc $waterEc)
    {
        $this->waterEc = $waterEc;
    }

    /**
     * @return WaterDbo
     */
    public function getWaterDbo()
    {
        return $this->waterDbo;
    }

    /**
     * @param WaterDbo $waterDbo
     */
    public function changeWaterDbo(WaterDbo $waterDbo)
    {
        $this->waterDbo = $waterDbo;
    }

    /**
     * @return WaterTemperature
     */
    public function getWaterTemperature()
    {
        return $this->waterTemperature;
    }

    /**
     * @param WaterTemperature $waterTemperature
     */
    public function changeWaterTemperature(WaterTemperature $waterTemperature)
    {
        $this->waterTemperature = $waterTemperature;
    }
}
