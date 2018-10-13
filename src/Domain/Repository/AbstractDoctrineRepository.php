<?php

namespace GSoares\Hydroponics\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

abstract class AbstractDoctrineRepository extends EntityRepository implements RepositoryInterface
{
    /** @var array */
    private $filters = [];

    /** @var QueryBuilder */
    private $queryBuilder;

    public function addFilter(string $filter, string $value): RepositoryInterface
    {
        $this->filters[$filter] = $value;

        return $this;
    }

    public function clearFilter(string $filter): RepositoryInterface
    {
        if (array_key_exists($filter, $this->filters)) {
            $this->filters[$filter] = null;

            unset($this->filters[$filter]);
        }

        return $this;
    }

    public function clearFilters(): RepositoryInterface
    {
        $this->filters = [];

        return $this;
    }

    public function findOne(): ?object
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

    protected function getEntityAlias(): string
    {
        return str_replace('\\', '_', $this->_entityName);
    }

    protected function getFilter(string $filter): ?string
    {
        if (!array_key_exists($filter, $this->filters)) {
            return null;
        }

        return $this->filters[$filter];
    }

    protected function applyFilter(): self
    {
        $entityAlias = $this->getEntityAlias();

        $this->queryBuilder = $this->createQueryBuilder($entityAlias);

        if ($id = $this->getFilter('id')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.id = :id")
                ->setParameter('id', $id);
        }

        if ($name = $this->getFilter('name')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.name LIKE :name")
                ->setParameter('name', "%$name%");
        }

        if ($description = $this->getFilter('description')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.description LIKE :description")
                ->setParameter('description', "%$description%");
        }

        if ($createdFrom = $this->getFilter('createdFrom')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.createdAt >= :createdFrom")
                ->setParameter('createdFrom', $createdFrom);
        }

        if ($createdTo = $this->getFilter('createdTo')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.createdAt <= :createdTo")
                ->setParameter('createdTo', $createdTo);
        }

        if ($updatedFrom = $this->getFilter('updatedFrom')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.updatedAt >= :updatedFrom")
                ->setParameter('updatedFrom', $updatedFrom);
        }

        if ($updatedTo = $this->getFilter('updatedTo')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.updatedAt <= :updatedTo")
                ->setParameter('updatedTo', $updatedTo);
        }

        if ($deletedFrom = $this->getFilter('deletedFrom')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.deletedAt >= :deletedFrom")
                ->setParameter('deletedFrom', $deletedFrom);
        }

        if ($deletedTo = $this->getFilter('deletedTo')) {
            $this->queryBuilder
                ->andWhere("{$entityAlias}.deletedAt <= :deletedTo")
                ->setParameter('deletedTo', $deletedTo);
        }

        return $this;
    }

    protected function getQueryBuilder(): QueryBuilder
    {
        return $this->queryBuilder;
    }
}
