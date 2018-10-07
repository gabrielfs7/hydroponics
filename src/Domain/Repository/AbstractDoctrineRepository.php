<?php

namespace GSoares\Hydroponics\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractDoctrineRepository extends EntityRepository implements RepositoryInterface
{
    /** @var array */
    private $filters = [];

    /** @var string */
    private $entityAlias;

    /** @var QueryBuilder */
    private $queryBuilder;

    public function addFilter(string $filter, string $value): self
    {
        $this->filters[$filter] = $value;

        return $this;
    }

    public function clearFilter(string $filter): self
    {
        if (array_key_exists($filter, $this->filters)) {
            $this->filters[$filter] = null;

            unset($this->filters[$filter]);
        }

        return $this;
    }

    public function setEntityAlias(string $entityAlias): self
    {
        $this->entityAlias = $entityAlias;

        return $this;
    }

    public function clearFilters(): self
    {
        $this->filters = [];

        return $this;
    }

    public function findOne(): object
    {
        $this->applyFilter();

        return $this->getQueryBuilder()
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findAll(): array
    {
        $this->applyFilter();

        return $this->getQueryBuilder()
            ->getQuery()
            ->execute();
    }

    public function save($object): object
    {
        $this->getEntityManager()
            ->persist($object);

        $this->getEntityManager()
            ->flush($object);

        return $object;
    }

    protected function getFilter(string $filter): string
    {
        if (array_key_exists($filter, $this->filters)) {
            return $this->filters[$filter];
        }
    }

    protected function applyFilter(): self
    {
        $this->queryBuilder = $this->createQueryBuilder($this->entityAlias);

        if ($id = $this->getFilter('id')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.id = :id")
                ->setParameter('id', $id);
        }

        if ($name = $this->getFilter('name')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.name LIKE :name")
                ->setParameter('name', "%$name%");
        }

        if ($description = $this->getFilter('description')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.description LIKE :description")
                ->setParameter('description', "%$description%");
        }

        if ($createdFrom = $this->getFilter('createdFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.createdAt >= :createdFrom")
                ->setParameter('createdFrom', $createdFrom);
        }

        if ($createdTo = $this->getFilter('createdTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.createdAt <= :createdTo")
                ->setParameter('createdTo', $createdTo);
        }

        if ($updatedFrom = $this->getFilter('updatedFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.updatedAt >= :updatedFrom")
                ->setParameter('updatedFrom', $updatedFrom);
        }

        if ($updatedTo = $this->getFilter('updatedTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.updatedAt <= :updatedTo")
                ->setParameter('updatedTo', $updatedTo);
        }

        if ($deletedFrom = $this->getFilter('deletedFrom')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.deletedAt >= :deletedFrom")
                ->setParameter('deletedFrom', $deletedFrom);
        }

        if ($deletedTo = $this->getFilter('deletedTo')) {
            $this->queryBuilder
                ->andWhere("{$this->entityAlias}.deletedAt <= :deletedTo")
                ->setParameter('deletedTo', $deletedTo);
        }

        return $this;
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }
}
