<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

interface ResourceLinksDtoInterface
{

    /**
     * @return string
     */
    public function getSelf();

    /**
     * @return string
     */
    public function getRelated();
}
