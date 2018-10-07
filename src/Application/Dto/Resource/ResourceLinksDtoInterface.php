<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

interface ResourceLinksDtoInterface
{
    public function getSelf(): string;

    public function getRelated(): string;
}
