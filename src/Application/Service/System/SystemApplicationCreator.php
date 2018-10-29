<?php

namespace GSoares\Hydroponics\Application\Service\System;

use ArrayAccess;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use GSoares\Hydroponics\Domain\Repository\Tank\TankRepositoryTrait;
use Psr\Http\Message\RequestInterface;

class SystemApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    use TankRepositoryTrait;

    public function create(RequestInterface $request): ResponseDtoInterface
    {
        return parent::save($request);
    }

    protected function buildFactoryParameters(
        RequestInterface $request,
        ResourceDtoInterface $resourceDto
    ): ArrayAccess {
        # @TODO Improve relationship handling here
        $tankId = $resourceDto->getRelationships()['tanks'][0]['data']['id'];

        $tank = $this->getTankRepository()
            ->find($tankId);

        $parameters = parent::buildFactoryParameters($request, $resourceDto);
        $parameters->offsetSet('tank', $tank);

        return $parameters;
    }
}
