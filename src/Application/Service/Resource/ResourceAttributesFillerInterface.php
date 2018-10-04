<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;

interface ResourceAttributesFillerInterface
{

    /**
     * @param object $domainObject
     * @param ResourceDtoInterface $resourceDto
     * @return object
     */
    public function fillAttributes($domainObject, ResourceDtoInterface $resourceDto);
}
