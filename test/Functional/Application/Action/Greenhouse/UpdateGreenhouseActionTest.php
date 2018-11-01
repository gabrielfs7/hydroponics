<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use DateTimeInterface;
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
        /** @var Greenhouse $entity */
        $entity = $this->createFixture(
            Greenhouse::class,
            [
                    'name' => 'ABC',
                    'description' => 'Created',
                ]
        );

        /** @var Greenhouse $entityFound */
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

        /** @var Greenhouse $entity */
        $entity = $this->greenhouseRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertSame('DEF', $entity->getName());
        $this->assertSame('Updated', $entity->getDescription());
        $this->assertInstanceOf(DateTimeInterface::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getResponseBody($entity));
    }
}
