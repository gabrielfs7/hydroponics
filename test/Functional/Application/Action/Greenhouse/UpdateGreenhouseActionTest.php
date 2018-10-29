<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use DateTime;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;

class UpdateGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanUpdateGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->createFixture(
            Greenhouse::class,
            [
                    'name' => 'ABC',
                    'description' => 'Created',
                ]
        );

        $entityFound = $this->greenhouseRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals('ABC', $entityFound->getName());
        $this->assertEquals('Created', $entityFound->getDescription());
        $this->assertNull($entityFound->getUpdatedAt());

        $this->runApp(
            'PATCH',
            '/api/greenhouses/'. $entityFound->getId(),
            GreenhouseMock::getPatchRequestBody(
                [
                    'name' => 'DEF',
                    'description' => 'Updated',
                ]
            )
        );

        $entity = $this->greenhouseRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertEquals('DEF', $entity->getName());
        $this->assertEquals('Updated', $entity->getDescription());
        $this->assertInstanceOf(DateTime::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getResponseBody($entity));
    }
}
