<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;

class RemoveSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanRemoveSystemWhenProvidingExistentId() : void
    {
        $greenhouse = $this->createFixture(Greenhouse::class);
        $entity = $this->createFixture(System::class, ['name' => ' ABC ']);

        $entityFound = $this->systemRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertEquals($entity->getId(), $entityFound->getId());
        $this->assertNull($entityFound->getDeletedAt());

        $this->runApp(
            'DELETE',
            sprintf('/api/greenhouses/%s/systems/%s',
                $greenhouse->getId(),
                $entityFound->getId()
            )
        );

        $entity = $this->systemRepository
            ->addFilter('id', $entityFound->getId())
            ->findOne();

        $this->assertNotNull($entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }
}
