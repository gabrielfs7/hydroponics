<?php

namespace GSoares\Hydroponics\Application\Builder\Error;

use GSoares\Hydroponics\Application\Dto\Error\ErrorCollectionDto;
use GSoares\Hydroponics\Application\Dto\Error\ErrorDto;
use GSoares\Hydroponics\Application\Dto\Error\SourceDto;

class ErrorCollectionDtoBuilder implements ErrorCollectionDtoBuilderInterface
{

    /** @var ErrorDto[] */
    private $errors = [];

    /** @var ErrorDto */
    private $error;

    public function configCode(int $code): ErrorCollectionDtoBuilderInterface
    {
        $this->getError()
            ->code = $code;

        return $this;
    }

    public function configStatus(int $status): ErrorCollectionDtoBuilderInterface
    {
        $this->getError()
            ->status = $status;

        return $this;
    }

    public function configTitle(string $title): ErrorCollectionDtoBuilderInterface
    {
        $this->getError()
            ->title = $title;

        return $this;
    }

    public function configDetails(string $details): ErrorCollectionDtoBuilderInterface
    {
        $this->getError()
            ->details = $details;

        return $this;
    }

    public function configSourcePointer(string $sourcePointer): ErrorCollectionDtoBuilderInterface
    {
        $this->getError()
            ->source
            ->pointer = $sourcePointer;

        return $this;
    }

    public function addError(): ErrorCollectionDtoBuilderInterface
    {
        $this->errors[] = $this->error;
        $this->error = null;

        return $this;
    }

    public function build(): ErrorCollectionDto
    {
        $errorCollection = new ErrorCollectionDto();
        $errorCollection->errors = $this->errors;

        $this->errors = [];

        return $errorCollection;
    }

    private function getError(): ErrorDto
    {
        if ($this->error) {
            return $this->error;
        }

        $this->error = new ErrorDto();
        $this->error->source = new SourceDto();

        return $this->error;
    }
}
