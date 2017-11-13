<?php

namespace GSoares\Hydroponics\Application\Dto\Tank;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class TankAttributesDto extends ResourceAttributesDto
{

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $description;

    /**
     * @var float
     */
    public $volumeCapacity;

    /**
     * @var float
     */
    public $currentVolume;

    /**
     * @var float
     */
    public $minVolume;

    /**
     * @var float
     */
    public $waterTemperature;

    /**
     * @var float
     */
    public $maxWaterTemperature;

    /**
     * @var float
     */
    public $minWaterTemperature;

    /**
     * @var float
     */
    public $waterPh;

    /**
     * @var float
     */
    public $maxWaterPh;

    /**
     * @var float
     */
    public $minWaterPh;

    /**
     * @var float
     */
    public $waterEc;

    /**
     * @var float
     */
    public $maxWaterEc;

    /**
     * @var float
     */
    public $minWaterEc;

    /**
     * @var float
     */
    public $waterDbo;

    /**
     * @var float
     */
    public $maxWaterDbo;

    /**
     * @var float
     */
    public $minWaterDbo;

    /**
     * @var string
     */
    public $createdAt;
}
