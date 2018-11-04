<?php

namespace GSoares\Hydroponics\Application\Service\Crops;

use ArrayAccess;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceCreatorInterface;
use GSoares\Hydroponics\Domain\Repository\Plant\PlantRepositoryTrait;
use Psr\Http\Message\RequestInterface;

class CropsApplicationCreator extends AbstractResourceSaver implements ResourceCreatorInterface
{
    use PlantRepositoryTrait;

    public function create(RequestInterface $request): ResponseDtoInterface
    {
        return parent::save($request);
    }

    protected function buildFactoryParameters(
        RequestInterface $request,
        ResourceDtoInterface $resourceDto
    ): ArrayAccess {
        # @TODO Improve relationship handling here
        $plantId = $resourceDto->getRelationships()['plant']['data']['id'];

        $plant = $this->getPlantRepository()
            ->find($plantId);

        $parameters = parent::buildFactoryParameters($request, $resourceDto);
        $parameters->offsetSet('plant', $plant);

        return $parameters;
    }
}
