<?php

namespace GSoares\Hydroponics\Application\Dto\Crops;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class CropsAttributesDto extends ResourceAttributesDto
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
