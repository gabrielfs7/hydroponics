<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

trait CropsTrait
{

    /**
     * @var \ArrayObject
     */
    protected $crops;

    /**
     * @return \ArrayAccess
     */
    public function getCrops()
    {
        return $this->crops;
    }
}
