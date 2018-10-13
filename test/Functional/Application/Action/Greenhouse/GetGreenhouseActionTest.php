<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action\Greenhouse;

use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Test\Functional\Application\Action\WebTestCase;

class GetGreenhouseActionTest extends WebTestCase
{
    public function testCanGetGreenhouseWhenProvidingExistentId() : void
    {
        $entity = $this->getFixtureFactory()->create(Greenhouse::class);

        $this->runApp('GET', '/api/greenhouses/1');

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($this->getGreenhouseResponseBody($entity));
    }

    public function testCannotGetGreenhouseWhenProvidingNoExistentId() : void
    {
        $this->runApp('GET', '/api/greenhouses/2');

        $this->assertResponseHasStatusCode(404);
        $this->assertResponseHasBody($this->getResponseError(404, 'Registry found'));
    }

    public function testCreateAGreenhouseWhenProvidingCorrectRequest() : void
    {
        $this->runApp(
            'POST',
            '/api/greenhouses',
            $this->getRequestBody()
        );

        $entity = $this->getContainer()->get(GreenhouseRepository::class)->findOne(1);

        $this->assertResponseHasStatusCode(200);
        $this->assertResponseHasBody($this->getGreenhouseResponseBody($entity));
    }

    private function getRequestBody(): array
    {
        return [
            'data' => [
                'type' => 'greenhouse',
                'attributes' => [
                    'name' => 'Name test',
                    'description' => 'Description test',
                ]
            ]
        ];
    }

    private function getGreenhouseResponseBody(Greenhouse $greenhouse)
    {
        return [
            'links' => [
                'self' => '',
                'related' => '',
            ],
            'data' => [
                'id' => (string) $greenhouse->getId(),
                'type' => 'greenhouse',
                'attributes' => [
                    'name' => $greenhouse->getName(),
                    'description' => $greenhouse->getDescription(),
                    'createdAt' => $greenhouse->getCreatedAt()->format(DATE_ATOM),
                ],
                'relationships' => [],
                'links' => [
                    'self' => '',
                    'related' => '',
                ],
                'meta' => []
            ]
        ];
    }

    protected function getResponseError(int $statusCode, string $details): array
    {
        return [
            'errors' => [
                [
                    'status' => $statusCode,
                    'code' => 0,
                    'source' => [
                        'pointer' => null
                    ],
                    'title' => 'Application error',
                    'details' => $details
                ]
            ]
        ];
    }
}
