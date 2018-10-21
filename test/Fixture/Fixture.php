<?php

namespace GSoares\Hydroponics\Test\Fixture;

use DateTimeImmutable;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;

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

    public function load(ObjectManager $manager)
    {
        foreach ($this->entities as $entity) {
            $mapping = $this->getMapping();
            $entity = $mapping[$entity['name']]($entity['params']);

            $manager->persist($entity);

            $this->lastEntity = $entity;
        }

        $manager->flush();

        $this->entities = [];
    }

    private function getMapping()
    {
        return [
            Greenhouse::class => function (array $params) {
                $entity = new Greenhouse($params['name'] ?? ('Test ' . rand(0, 9999)));
                $entity->changeCreatedAt(new DateTimeImmutable());
                $entity->changeDescription($params['description'] ?? ('description ' . rand(0, 9999)));

                return $entity;
            }
        ];
    }
}
