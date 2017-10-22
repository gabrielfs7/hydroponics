<?php

namespace GSoares\Hydroponics\Domain\ValueObject\Traits;

use GSoares\Hydroponics\Domain\ValueObject\Plant;

trait PlantTrait
{

    /**
     * @var Plant
     */
    protected $plant;

    /**
     * @return Plant
     */
    public function getPlant()
    {
        return $this->plant;
    }
}
