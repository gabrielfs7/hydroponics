<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;

class RemoveGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanRemoveGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->createFixture(Greenhouse::class, ['name' => ' ABC ']);

        $entityFound = $this->greenhouseRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals($entity->getId(), $entityFound->getId());
        $this->assertNull($entityFound->getDeletedAt());

        $this->runApp(
            'DELETE',
            '/api/greenhouses/'. $entityFound->getId()
        );

        $entity = $this->greenhouseRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
    }
}
