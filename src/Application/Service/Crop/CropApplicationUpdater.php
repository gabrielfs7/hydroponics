<?php

namespace GSoares\Hydroponics\Application\Service\Crop;

use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Service\Resource\AbstractResourceSaver;
use GSoares\Hydroponics\Application\Service\Resource\ResourceUpdaterInterface;
use Psr\Http\Message\RequestInterface;

class CropApplicationUpdater extends AbstractResourceSaver implements ResourceUpdaterInterface
{
    public function update(RequestInterface $request, string $id): ResponseDtoInterface
    {
        return parent::save($request, $this->findDomainObjectById($id));
    }
}
