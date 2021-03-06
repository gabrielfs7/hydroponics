<?php

namespace GSoares\Hydroponics\Test\Fixture;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class Fixture extends AbstractFixture
{
    /** @var object[] */
    private $entities = [];

    /** @var object */
    private $lastEntity;

    public function add($entityName, array $params = []): self
    {
        $this->entities[] = [
            'name' => $entityName,
            'params' => $params,
        ];

        return $this;
    }

    public function getLastEntity(): object
    {
        return $this->lastEntity;
    }

    public function load(ObjectManager $manager): void
    {
        foreach ($this->entities as $entity) {
            $entity = $this->getMapping($manager)[$entity['name']]($entity['params']);

            $manager->persist($entity);

            $this->lastEntity = $entity;
        }

        $manager->flush();

        $this->entities = [];
    }

    private function getMapping(ObjectManager $manager): iterable
    {
        return (new FixtureMapping())->getMapping($manager);
    }
}
