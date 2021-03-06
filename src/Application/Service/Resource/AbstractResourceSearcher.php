<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDtoInterface;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Application\Exception\Http\NotFoundException;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractResourceSearcher implements ResourceSearcherInterface
{
    /** @var DecoderInterface */
    private $encoder;

    /** @var RepositoryInterface */
    private $repository;

    public function __construct(EncoderInterface $encoder, RepositoryInterface $repository)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    public function search(array $filters): ResponseDtoInterface
    {
        $domainObjects = $this->setSearchFilters($filters)
            ->findAll();

        $dtoList = [];

        foreach ($domainObjects as $domainObject) {
            $dtoList[] = $this->encoder
                ->encode($domainObject);
        }

        // @TODO Must fill the links with pagination
        $links = new ResourceLinksDto('', '');
        $links->addLink('first', '');
        $links->addLink('prev', '');
        $links->addLink('next', '');
        $links->addLink('last', '');

        $responseDto = new ResponseDto($links, $dtoList);
        $responseDto->changeMeta(
            [
                'totalEntries' => count($dtoList)
            ]
        );

        return $responseDto;
    }

    public function searchById(string $id): ResponseDtoInterface
    {
        $domainObject = $this->setSearchFilters(['id' => $id])
            ->findOne();

        if (!$domainObject) {
            throw new NotFoundException('Registry found');
        }

        $dto = $this->encoder
            ->encode($domainObject);

        return new ResponseDto(new ResourceLinksDto('', ''), $dto);
    }

    private function setSearchFilters(array $filters): RepositoryInterface
    {
        $this->repository
            ->clearFilters();

        foreach ($filters as $filterName => $filterValue) {
            $this->repository
                ->addFilter($filterName, $filterValue);
        }

        return $this->repository;
    }
}
