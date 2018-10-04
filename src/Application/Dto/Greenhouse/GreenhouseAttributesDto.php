<?php

namespace GSoares\Hydroponics\Application\Dto\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class GreenhouseAttributesDto extends ResourceAttributesDto
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
     * @var string
     */
    public $createdAt;
}
