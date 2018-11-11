<?php

namespace GSoares\Hydroponics\Domain\Entity;

use GSoares\Hydroponics\Domain\Entity\Traits\CropTrait;
use GSoares\Hydroponics\Domain\Entity\Traits\SystemTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\IdTrait;
use GSoares\Hydroponics\Domain\ValueObject\Traits\Time\CreatedAtTrait;

class CropVersion
{
    use IdTrait;
    use CreatedAtTrait;
    use SystemTrait;
    use CropTrait;

    /** @var int */
    private $quantityHarvested;

    /** @var int */
    private $quantityLost;

    public function __construct(Crop $crop, System $system, int $quantityHarvested, int $quantityLost)
    {
        $this->crop = $crop;
        $this->system = $system;
        $this->quantityHarvested = $quantityHarvested;
        $this->quantityLost = $quantityLost;
    }

    public function getQuantityHarvested(): int
    {
        return $this->quantityHarvested;
    }

    public function getQuantityLost(): int
    {
        return $this->quantityLost;
    }
}
