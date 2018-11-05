<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Plant;

trait PlantTrait
{
    /** @var Plant */
    protected $plant;

    public function getPlant(): Plant
    {
        return $this->plant;
    }

    public function changePlant(Plant $plant): self
    {
        $this->plant = $plant;

        return $this;
    }
}
