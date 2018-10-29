<?php

namespace GSoares\Hydroponics\Application\Service\Tank;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use Psr\Http\Message\RequestInterface;

class TankApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    public function create(RequestInterface $request): ResponseDtoInterface
    {
        return parent::save($request);
    }
}
