<?php

namespace GSoares\Hydroponics\Domain\Repository;

interface RepositoryInterface
{
    public function addFilter(string $filter, string $value): RepositoryInterface;

    public function clearFilter(string $filter): RepositoryInterface;

    public function clearFilters(): RepositoryInterface;

    public function findAll(): array;

    public function findOne(): object;

    public function save($object): object;
}
