<?php

namespace GSoares\Hydroponics\Application\Dto\Plant;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class PlantAttributesDto extends ResourceAttributesDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $species;

    /** @var string */
    public $createdAt;
}
