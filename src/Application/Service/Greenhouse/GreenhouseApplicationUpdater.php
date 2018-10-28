<?php

namespace GSoares\Hydroponics\Application\Service\Greenhouse;

use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use Psr\Http\Message\RequestInterface;

class GreenhouseApplicationUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
{
    public function update(RequestInterface $request, string $id): ResponseDtoInterface
    {
        return parent::save($request, $this->findDomainObjectById($id));
    }
}
