<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\ErrorResponseMock;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;

class GetGreenhouseActionTest extends WebTestCase
{
    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function setUp()
    {
        parent::setUp();

        $this->greenhouseRepository = $this->getContainer()
            ->get(GreenhouseRepository::class);
    }

    public function testCanGetGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->fixtureFactory
            ->create(Greenhouse::class);

        $this->runApp('GET', '/api/greenhouses/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
    }

    public function testCannotGetGreenhouseWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/greenhouses/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ErrorResponseMock::getErrorResponseBody(404, 'Registry found'));
    }

    public function testCreateAGreenhouseWhenProvidingCorrectRequest() : void
    {
        $entity = $this->greenhouseRepository
            ->findOne();

        $this->assertNull($entity);

        $this->runApp(
            'POST',
            '/api/greenhouses',
            GreenhouseMock::getPostRequestBody()
        );

        $entity = $this->greenhouseRepository
            ->findOne();

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
        $this->assertNotNull($entity);
    }

    public function testCanRemoveGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->fixtureFactory
            ->create(Greenhouse::class, ['name' => ' ABC ']);

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
