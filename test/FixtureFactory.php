<?php

namespace GSoares\Hydroponics\Test;

use DateTimeImmutable;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;

class FixtureFactory
{
    /** @var EntityManager */
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function create($entityName, array $params = []): object
    {
        $mapping = $this->getMapping();
        $entity = $mapping[$entityName]($params);

        $class = new class($entity) implements FixtureInterface
        {
            /** @var object */
            private $entity;

            public function __construct($entity)
            {
                $this->entity = $entity;
            }

            public function load(ObjectManager $manager)
            {
                $manager->persist($this->entity);
                $manager->flush();
            }
        };

        $loader = new Loader();
        $loader->addFixture($class);

        $purger = new ORMPurger($this->entityManager);

        $executor = new ORMExecutor($this->entityManager, $purger);
        $executor->execute($loader->getFixtures(), true);

        return $entity;
    }

    private function getMapping()
    {
        return [
            Greenhouse::class => function (array $params) {
                $entity = new Greenhouse($params['name'] ?? 'Test');
                $entity->changeCreatedAt(new DateTimeImmutable());

                return $entity;
            }
        ];
    }
}
