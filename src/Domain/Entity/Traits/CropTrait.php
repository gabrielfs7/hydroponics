<?php

namespace GSoares\Hydroponics\Domain\Entity\Traits;

use GSoares\Hydroponics\Domain\Entity\Crop;

trait CropTrait
{
    /** @var Crop */
    protected $crop;

    public function getCrop(): Crop
    {
        return $this->crop;
    }
}
