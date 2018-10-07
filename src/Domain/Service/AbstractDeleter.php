<?php

namespace GSoares\Hydroponics\Domain\Service;

use DateTimeImmutable;
use GSoares\Hydroponics\Domain\Repository\RepositoryInterface;

abstract class AbstractDeleter implements DeleterInterface
{
    /** @var RepositoryInterface */
    private $repository;

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function delete(int $id): object
    {
        $object = $this->repository
            ->clearFilters()
            ->addFilter('id', $id)
            ->findOne();

        $object->changeDeletedAt(new DateTimeImmutable());

        return $this->repository
            ->save($object);
    }
}
