<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\System;

use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\SystemMock;

class CreateSystemActionTest extends WebTestCase
{
    /** @var SystemRepository */
    private $systemRepository;

    public function setUp()
    {
        parent::setUp();

        $this->systemRepository = $this->getContainer()
            ->get(SystemRepository::class);
    }

    public function testCreateASystemWhenProvidingCorrectRequest() : void
    {
        $entity = $this->systemRepository
            ->findOne();

        $this->assertNull($entity);

        $this->runApp(
            'POST',
            '/api/systems',
            SystemMock::getPostRequestBody()
        );

        $entity = $this->systemRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(SystemMock::getResponseBody($entity));
        $this->assertNotNull($entity);
    }
}
