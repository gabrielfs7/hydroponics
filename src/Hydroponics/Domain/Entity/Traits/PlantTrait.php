<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Plant;

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
