<?php

namespace GSoares\Hydroponics\Domain\Repository;

interface RepositoryInterface
{
    public function addFilter(string $filter, string $value): self;

    public function clearFilter(string $filter): self;

    public function clearFilters(): self;

    public function findAll(): array;

    public function findOne(): object;

    public function save($object): object;
}
