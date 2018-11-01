<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use DateTimeInterface;
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
        /** @var Greenhouse $greenhouse */
        $greenhouse = $this->createFixture(Greenhouse::class);

        /** @var System $entity */
        $entity = $this->createFixture(System::class);

        $this->assertNull($entity->getDeletedAt());

        $this->runApp(
            'DELETE',
            sprintf(
                '/api/greenhouses/%s/systems/%s',
                $greenhouse->getId(),
                $entity->getId()
            )
        );

        /** @var System $entity */
        $entity = $this->systemRepository
            ->addFilter('id', $entity->getId())
            ->findOne();

        $this->assertInstanceOf(DateTimeInterface::class, $entity->getDeletedAt());
        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }
}
