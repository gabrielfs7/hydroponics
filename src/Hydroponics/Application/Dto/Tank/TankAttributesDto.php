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
     * @var string
     */
    public $createdAt;
}