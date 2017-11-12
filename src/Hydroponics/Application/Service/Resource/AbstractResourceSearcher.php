<?php

namespace GSoares\Hydroponics\Application\Service\Resource;

use GSoares\Hydroponics\Application\Decoder\DecoderInterface;
use GSoares\Hydroponics\Application\Dto\Resource\ResourceLinksDto;
use GSoares\Hydroponics\Application\Dto\Response\ResponseDto;
use GSoares\Hydroponics\Application\Encoder\EncoderInterface;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractResourceSearcher implements ResourceSearcherInterface
{

    /**
     * @var DecoderInterface
     */
    private $encoder;

    /**
     * @var RepositoryInterface
     */
    private $repository;

    public function __construct(EncoderInterface $encoder, RepositoryInterface $repository)
    {
        $this->encoder = $encoder;
        $this->repository = $repository;
    }

    /**
     * @param array $filters
     * @return ResponseDto
     */
    public function search(array $filters)
    {
        $domainObjects = $this->setSearchFilters($filters)
            ->findAll();

        $dtoList = [];

        foreach ($domainObjects as $domainObject) {
            $dtoList[] = $this->encoder
                ->encode($domainObject);
        }

        return new ResponseDto(new ResourceLinksDto('', ''), $dtoList);
    }

    /**
     * @param int $id
     * @return ResponseDto
     */
    public function searchById($id)
    {
        $domainObject = $this->setSearchFilters(['id' => $id])
            ->findOne();

        $dto = $this->encoder
            ->encode($domainObject);

        return new ResponseDto(new ResourceLinksDto('', ''), $dto);
    }

    /**
     * @param array $filters
     * @return RepositoryInterface
     */
    private function setSearchFilters(array $filters)
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