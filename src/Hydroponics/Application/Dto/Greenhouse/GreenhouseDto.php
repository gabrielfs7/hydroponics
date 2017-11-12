<?php

namespace GSoares\Hydroponics\Application\Dto\Greenhouse;

use GSoares\Hydroponics\Application\Dto\Link\LinksDto;

class GreenhouseDto
{

    /**
     * @var string
     */
    public $type = 'greenhouses';

    /**
     * @var string
     */
    public $id;

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Greenhouse\GreenhouseAttributesDto
     */
    public $attributes;

    /**
     * @var \GSoares\Hydroponics\Application\Dto\Relationship\RelationshipDto[]
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