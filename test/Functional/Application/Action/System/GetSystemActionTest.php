<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

class GetSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCanGetSystemWhenProvidingExistentId() : void
    {
        $entity = $this->createFixture(System::class);

        $this->runApp('GET', '/api/systems/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
    }

    public function testCannotGetSystemWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/systems/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
    }
}
