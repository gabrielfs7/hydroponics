<?php

namespace GSoares\Hydroponics\Application\Middleware\Greenhouse;

use GSoares\Hydroponics\Application\Exception\Http\NotFoundException;
use GSoares\Hydroponics\Application\Middleware\MiddlewareInterface;
use GSoares\Hydroponics\Domain\Repository\Greenhouse\GreenhouseRepository;
use GSoares\Hydroponics\Domain\Entity\Greenhouse;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Http\Request;
use Slim\Http\Uri;

class GreenhouseMiddleware implements MiddlewareInterface
{
    public const REQUESTED_GREENHOUSE = 'requested-greenhouse';

    /** @var GreenhouseRepository */
    private $greenhouseRepository;

    public function __construct(GreenhouseRepository $greenhouseRepository)
    {
        $this->greenhouseRepository = $greenhouseRepository;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        if ($greenhouse = $this->getGreenhouse($request)) {
            $request = $request->withAttribute(self::REQUESTED_GREENHOUSE, $greenhouse);
        }

        return $next($request, $response);
    }

    private function getGreenhouse(ServerRequestInterface $request): ?Greenhouse
    {
        $pattern = '/\/api\/greenhouses\/\d\/systems/';
        $path = $request->getUri()->getPath();

        if (preg_match($pattern, $path) == 0) {
            return null;
        }

        $greenhouseId = preg_replace('/\/api\/greenhouses\//', '', $path);
        $greenhouseId = preg_replace('/\/systems.*/', '', $greenhouseId);

        $greenhouse = $this->greenhouseRepository
            ->find((int)$greenhouseId);

        if (!$greenhouse) {
            throw new NotFoundException(sprintf('Greenhouse %s not found', $greenhouseId));
        }

        return $greenhouse;
    }
}
