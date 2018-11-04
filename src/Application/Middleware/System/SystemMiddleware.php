<?php

namespace GSoares\Hydroponics\Application\Middleware\System;

use GSoares\Hydroponics\Application\Exception\Http\NotFoundException;
use GSoares\Hydroponics\Application\Middleware\MiddlewareInterface;
use GSoares\Hydroponics\Domain\Entity\System;
use GSoares\Hydroponics\Domain\Repository\System\SystemRepository;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class SystemMiddleware implements MiddlewareInterface
{
    private const REQUESTED_SYSTEM = 'requested-system';

    /** @var SystemRepository */
    private $systemRepository;

    public function __construct(SystemRepository $systemRepository)
    {
        $this->systemRepository = $systemRepository;
    }

    public function __invoke(
        ServerRequestInterface $request,
        ResponseInterface $response,
        callable $next
    ): ResponseInterface {
        if ($system = $this->getSystem($request)) {
            $request = $request->withAttribute(self::REQUESTED_SYSTEM, $system);
        }

        return $next($request, $response);
    }

    private function getSystem(ServerRequestInterface $request): ?System
    {
        $pattern = '/\/api\/greenhouses\/\d\/systems\/\d\/crops/';
        $path = $request->getUri()->getPath();

        if (preg_match($pattern, $path) == 0) {
            return null;
        }

        $systemId = preg_replace('/\/api\/greenhouses\/\d\/systems\//', '', $path);
        $systemId = preg_replace('/\/crops.*/', '', $systemId);

        /** @var System $system */
        $system = $this->systemRepository
            ->find((int)$systemId);

        if (!$system) {
            throw new NotFoundException(sprintf('System %s not found', $systemId));
        }

        return $system;
    }
}
