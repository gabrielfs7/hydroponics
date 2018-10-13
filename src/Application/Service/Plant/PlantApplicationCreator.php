<?php

namespace GSoares\Hydroponics\Application\Service\Plant;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;

class PlantApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    public function create(string $json): ResponseDtoInterface
    {
        return parent::save($json);
    }
}
