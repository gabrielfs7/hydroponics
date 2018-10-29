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
use Psr\Http\Message\RequestInterface;
use Slim\Http\Request;

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

    protected function save(RequestInterface $request, object $domainObject = null): ResponseDtoInterface
    {
        $resourceDto = $this->decoder
            ->decode((string)$request->getBody());

        if (!$domainObject) {
            $domainObject = $this->factory
                ->make($this->buildFactoryParameters($request, $resourceDto));
        }

        $this->attributesFiller
            ->fillAttributes($domainObject, $resourceDto);

        $domainObject = $this->repository
            ->save($domainObject);

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

    /**
     * @param Request|RequestInterface $request
     * @param ResourceDtoInterface $resourceDto
     *
     * @return ArrayAccess
     */
    protected function buildFactoryParameters(
        RequestInterface $request,
        ResourceDtoInterface $resourceDto
    ): ArrayAccess {
        $parameters = new ArrayObject();

        foreach ($resourceDto->getAttributes() as $name => $value) {
            $parameters->offsetSet($name, $value);
        }

        foreach ($resourceDto->getRelationships() as $name => $value) {
            $parameters->offsetSet('relationship.' . $name, $value);
        }

        # @TODO Proper handle how inject request attribute objects in factories
        foreach ($request->getAttributes() as $attributeName => $attributeValue) {
            $prefix = 'requested-';

            if (strpos($attributeName, $prefix) == 0) {
                $parameters->offsetSet(str_replace($prefix, '', $attributeName), $attributeValue);
            }
        }

        return $parameters;
    }
}
