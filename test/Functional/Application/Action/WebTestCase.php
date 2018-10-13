<?php

namespace GSoares\Hydroponics\Test\Functional\Application\Action;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use GSoares\Hydroponics\Test\FixtureFactory;
use Psr\Container\ContainerInterface;
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\Environment;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class WebTestCase extends TestCase
{
    /** @var Response */
    private $response;

    public function runApp(
        string $requestMethod,
        string $requestUri,
        array $requestData = null
    ) : ResponseInterface
    {
        $request = $this->createRequest($requestMethod, $requestUri, $requestData);

        return $this->response = $this->getApp()->process($request, new Response());
    }

    public function assertResponseHasStatusCode(int $statusCode): void
    {
        $this->assertEquals($statusCode, $this->response->getStatusCode());
    }

    public function assertResponseHasBody(array $expectedBody): void
    {
        $responseBody = json_decode((string) $this->response->getBody(), true);

        $this->assertEquals($expectedBody, $responseBody);
    }

    private function createRequest(
        string $requestMethod,
        string $requestUri,
        array $requestData = null
    ): RequestInterface
    {
        $request = Request::createFromEnvironment(
            Environment::mock(
                [
                    'REQUEST_METHOD' => $requestMethod,
                    'REQUEST_URI' => $requestUri
                ]
            )
        );

        if (isset($requestData)) {
            $request->getBody()->write(json_encode($requestData));
        }

        return $request;
    }

    protected function getFixtureFactory(): FixtureFactory
    {
        static $cache;

        if ($cache) {
            return $cache;
        }

        $entityManager = $this->getApp()
            ->getContainer()
            ->get(EntityManager::class);

        return $cache = new FixtureFactory($entityManager);
    }

    protected function getContainer(): ContainerInterface
    {
        return $this->getApp()->getContainer();
    }

    protected function getApp(): App
    {
        static $cache;

        if ($cache) {
            return $cache;
        }

        $settings = require APP_ROOT . '/config/settings.php';
        $dependencies = require APP_ROOT . '/config/dependencies.php';

        // @TODO Move to a separate environment settings file.
        $settings['settings']['doctrine']['connection'] = [
            'driver' => 'pdo_sqlite',
            'dbname' => 'hydroponics',
            'charset' => 'utf8',
            'memory' => true,
        ];

        $app = new App(
            array_merge(
                $settings,
                $dependencies
            )
        );

        $this->createSchema($app);

        require APP_ROOT . '/config/middleware.php';
        require APP_ROOT . '/config/routes.php';

        return $cache = $app;
    }

    private function createSchema(App $app): void
    {
        static $cacheDb;

        if ($cacheDb) {
            return;
        }

        $entityManager = $app->getContainer()->get(EntityManager::class);

        $schemaTool = new SchemaTool($entityManager);
        $classes = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool->createSchema($classes);

        $cacheDb = true;
    }
}
