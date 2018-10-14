<?php

namespace GSoares\Hydroponics\Application\Exception\Http;

use ErrorException;
use GSoares\Hydroponics\Application\Builder\Error\ErrorCollectionDtoBuilder;
use GSoares\Hydroponics\Application\Dto\Error\ErrorCollectionDto;

abstract class HttpException extends ErrorException
{
    public function getErrorCollection(): ErrorCollectionDto
    {
        $builder = new ErrorCollectionDtoBuilder();
        $builder->configCode($this->getCode())
            ->configStatus($this->getStatusCode())
            ->configDetails($this->getMessage())
            ->configTitle('Application error')
            ->addError();

        return $builder->build();
    }

    abstract public function getStatusCode(): int;
}
