<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use DateTime;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;
use GSoares\Hydroponics\Test\Mock\GreenhouseMock;
use GSoares\Hydroponics\Test\Mock\ResponseMock;

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
        $entity = $this->createFixture(Greenhouse::class);

        $this->runApp('GET', '/api/greenhouses/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
    }

    public function testCannotGetGreenhouseWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/greenhouses/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody(ResponseMock::getErrorResponseBody(404, 'Registry found'));
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
        $this->assertResponseHasBody(GreenhouseMock::getGreenhouseResponseBody($entity));
    }

    public function testCanGetAllGreenhouses() : void
    {
        $entity1 = $this->createFixture(
            Greenhouse::class,
                [
                    'name' => 'ABC',
                    'description' => 'I am 1',
                ]
            );

        $entity2 = $this->createFixture(
                Greenhouse::class,
                [
                    'name' => 'DEF',
                    'description' => 'I am 2',
                ]
            );

        $this->runApp(
            'GET',
            '/api/greenhouses'
        );

        $expectedResponse = ResponseMock::getPaginationResponse(
            [
                'meta.totalEntries' => 2,
                'data' => [
                    GreenhouseMock::getGreenhousePaginationResponseBody($entity1),
                    GreenhouseMock::getGreenhousePaginationResponseBody($entity2),
                ]
            ]
        );

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($expectedResponse);
    }
}
