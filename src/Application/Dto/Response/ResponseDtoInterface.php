<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface;

interface ResponseDtoInterface
{
    public function getLinks(): ResourceLinksDtoInterface;

    /** @var object|array */
    public function getData(): mixed;
}
