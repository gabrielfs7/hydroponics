<?php

namespace GSoares\Hydroponics\Application\Dto\System;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceAttributesDto;

class SystemAttributesDto extends ResourceAttributesDto
{
    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var string */
    public $createdAt;
}
