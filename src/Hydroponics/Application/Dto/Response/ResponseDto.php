<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

use GSoares\Hydroponics\Application\Dto\Link\LinksDto;

class ResponseDto
{

    /**
     * @var LinksDto
     */
    public $links;

    /**
     * @var object|array
     */
    public $data;
}