<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceDtoInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Factory\FactoryInterface;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractResourceSaver
{

    /**
     * @var DecoderInterface
     */
    private $decoder;

    /**
     * @var EncoderInterface
     */
    private $encoder;

    /**
     * @var ResourceAttributesFillerInterface
     */
    private $attributesFiller;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var RepositoryInterface
     */
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

    /**
     * @param string $json
     * @param object $domainObject
     * @return ResourceDtoInterface
     */
    protected function save($json, $domainObject = null)
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

    /**
     * @param object $domainObject
     * @param ResourceDtoInterface $resourceDto
     */
    protected function fillAttributes($domainObject, ResourceDtoInterface $resourceDto)
    {
        $this->attributesFiller
            ->fillAttributes($domainObject, $resourceDto);
    }

    /**
     * @param string $json
     * @return ResourceDtoInterface
     */
    protected function decodeJson($json)
    {
        return $this->decoder
            ->decode($json);
    }

    /**
     * @param object $domainObject
     * @return ResourceDtoInterface
     */
    protected function createResponseDto($domainObject)
    {
        $data = $this->encoder
            ->encode($domainObject);

        return new ResponseDto(new ResourceLinksDto('', ''), $data);
    }

    /**
     * @param int $id
     * @return object
     */
    protected function findDomainObjectById($id)
    {
        return $this->repository
            ->clearFilters()
            ->addFilter('id', $id)
            ->findOne();
    }

    /**
     * @param ResourceDtoInterface $resourceDto
     * @return \ArrayAccess
     */
    protected function fillFactoryParameters(ResourceDtoInterface $resourceDto)
    {
        $parameters = new \ArrayObject();

        foreach ($resourceDto as $name => $value) {
            if (is_string($value) || is_numeric($value)) {
                $parameters->offsetSet($name, $value);
            }
        }

        return $parameters;
    }
}