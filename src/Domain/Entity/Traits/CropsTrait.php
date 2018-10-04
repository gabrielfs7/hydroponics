<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use ArrayAccess;

trait CropsTrait
{
    /** @var ArrayAccess */
    protected $crops;

    public function getCrops(): ArrayAccess
    {
        return $this->crops;
    }
}
