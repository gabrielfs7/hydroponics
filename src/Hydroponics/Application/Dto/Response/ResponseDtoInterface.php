<?php

namespace GSoares\Hydroponics\Application\Dto\Response;

interface ResponseDtoInterface
{

    /**
     * @return \GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDtoInterface
     */
    public function getLinks();

    /**
     * @var object|array
     */
    public function getData();
}