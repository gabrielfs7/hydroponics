<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use ArrayAccess;
use ArrayObject;
use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractResourceSaver
{
    /** @var DecoderInterface */
    private $decoder;

    /** @var EncoderInterface */
    private $encoder;

    /** @var ResourceAttributesFillerInterface */
    private $attributesFiller;

    /** @var FactoryInterface */
    protected $factory;

    /** @var RepositoryInterface */
    protected $repository;

    public function __construct(
        DecoderInterface $decoder,
        EncoderInterface $encoder,
        FactoryInterface $factory,
        RepositoryInterface $repository,
        ResourceAttributesFillerInterface $attributesFiller
    ) {
        $this->decoder = $decoder;
        $this->encoder = $encoder;
        $this->factory = $factory;
        $this->repository = $repository;
        $this->attributesFiller = $attributesFiller;
    }

    protected function save(string $json, object $domainObject = null): ResponseDtoInterface
    {
        $resourceDto = $this->decodeJson($json);

        if (!$domainObject) {
            $domainObject = $this->factory
                ->make($this->fillFactoryParameters($resourceDto));
        }

        $this->fillAttributes($domainObject, $resourceDto);

        $domainObject = $this->repository
            ->save($domainObject);

        return $this->createResponseDto($domainObject);
    }

    protected function fillAttributes(object $domainObject, ResourceDtoInterface $resourceDto): void
    {
        $this->attributesFiller
            ->fillAttributes($domainObject, $resourceDto);
    }

    protected function decodeJson(string $json): ResourceDtoInterface
    {
        return $this->decoder
            ->decode($json);
    }

    protected function createResponseDto(object $domainObject): ResponseDtoInterface
    {
        $data = $this->encoder
            ->encode($domainObject);

        return new ResponseDto(new ResourceLinksDto('', ''), $data);
    }

    protected function findDomainObjectById(string $id): object
    {
        return $this->repository
            ->clearFilters()
            ->addFilter('id', $id)
            ->findOne();
    }

    protected function fillFactoryParameters(ResourceDtoInterface $resourceDto): ArrayAccess
    {
        $parameters = new ArrayObject();

        foreach ($resourceDto->getAttributes() as $name => $value) {
            $parameters->offsetSet($name, $value);
        }

        return $parameters;
    }
}
