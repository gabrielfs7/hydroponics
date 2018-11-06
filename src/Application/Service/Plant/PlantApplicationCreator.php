<?php

namespace GSoares\Hydroponics\Application\Service\Plant;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use Psr\Http\Message\RequestInterface;

class PlantApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    public function create(RequestInterface $request): ResponseDtoInterface
    {
        return parent::save($request);
    }
}
