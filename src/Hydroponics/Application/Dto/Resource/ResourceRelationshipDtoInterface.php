<?php

namespace GSoares\Hydroponics\Application\Dto\Resource;

interface ResourceRelationshipDtoInterface
{
    /**
     * @return string
     */
    public function getId();

    /**
     * @return string
     */
    public function getType();
}