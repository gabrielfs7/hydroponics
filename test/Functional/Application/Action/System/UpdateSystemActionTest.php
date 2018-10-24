<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use DateTime;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;

class UpdateSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanUpdateSystemWhenProvidingExistentId() : void
    {
        $entity = $this->createFixture(
                System::class,
                [
                    'name' => 'ABC',
                    'description' => 'Created',
                ]
            );

        $entityFound = $this->systemRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals('ABC', $entityFound->getName());
        $this->assertEquals('Created', $entityFound->getDescription());
        $this->assertNull($entityFound->getUpdatedAt());

        $this->runApp(
            'PATCH',
            '/api/systems/'. $entityFound->getId(),
            SystemMock::getPatchRequestBody(
                [
                    'name' => 'DEF',
                    'description' => 'Updated',
                ]
            )
        );

        $entity = $this->systemRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertEquals('DEF', $entity->getName());
        $this->assertEquals('Updated', $entity->getDescription());
        $this->assertInstanceOf(DateTime::class, $entity->getUpdatedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }
}
