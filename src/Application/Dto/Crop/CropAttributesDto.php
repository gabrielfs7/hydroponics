<?php

namespace GSoares\Hydroponics\Application\Dto\Crop;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class CropAttributesDto extends ResourceAttributesDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $quantity;

    /** @var string */
    public $createdAt;

    /** @var string */
    public $harvestedAt;

    /** @var int */
    public $quantityHarvested;

    /** @var int */
    public $quantityLost;
}
