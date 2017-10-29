<?php

namespace GSoares\Hydroponics\Application\Dto\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Link\LinksDto;

class GreenhouseDto
{

    /**
     * @var string
     */
    public $type = 'greenhouse';

    /**
     * @var string
     */
    public $id;

    /**
     * @var GreenhouseAttributesDto
     */
    public $attributes;

    /**
     * @var array
     */
    public $relationships;

    /**
     * @var LinksDto
     */
    public $links;

    /**
     * @var array
     */
    public $meta;
}